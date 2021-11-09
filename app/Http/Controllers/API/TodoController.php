<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\subtask;
use App\Tasks;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    function index() 
    {
        $tasks = auth()->user()->task()->where('chapter_id', 0)->orderBy('order_id')->get();
        return response()->json($tasks);
    }
    function sortPriority() 
    {
        $tasks = auth()->user()->task()->where('chapter_id', 0)->orderBy('priority', 'asc')->get();
        return response()->json($tasks);
    }
    function reorder(Request $request) 
    {
        
        if($request->input('date') === 'all') {
            $tasks = auth()->user()->task()->where('chapter_id', 0)->orderBy('order_id')->get();
        } else {
            $tasks = auth()->user()->task()->where('chapter_id', 0)->orderBy('order_id')->where('date', $request->input('date'))->get();
        }
        $destask = $tasks[$request->input('desI')]->order_id;
        for($i = 0; $i <= count($tasks); $i++) {
            if($request->input('desI') > $request->input('srcI') && $i >= $request->input('srcI') && $i <= $request->input('desI')) {
                if($i === $request->input('srcI')) {
                    $task_id = $tasks[$i]->order_id;
                    $tasks[$i]->update([
                        'order_id' => $tasks[$request->input('desI')]->order_id,
                    ]);
                } else {
                    $tsk_order = $task_id;
                    $task_id = $tasks[$i]->order_id;
                    $tasks[$i]->update([
                        'order_id' => $tsk_order,
                    ]);
                }
            } else if($request->input('desI') < $request->input('srcI') && $i <= $request->input('srcI') && $i >= $request->input('desI')) {
                if($i === $request->input('srcI')) {
                    $tasks[$i]->update([
                        'order_id' => $destask,
                    ]);
                    return response($tasks[$request->input('desI')]->order_id);
                } else {
                    $j = $i + 1;
                    $tasks[$i]->update([
                        'order_id' => $tasks[$j]->order_id,
                    ]);
                }
            }
        }
    }
    function show(Tasks $task) 
    {
        $subtasks = $task->subtasks()->get();
        return response()->json(array('task' => $task, 'subtasks' => $subtasks));
    }
    public function store(Request $request) 
    {
        Tasks::create([
            'task' => $request->input('task'),
            'chapter_id' => $request->input('chapter_id'),
            'description' => $request->input('description'),
            'user_id' => auth()->user()->id,
            'date' => $request->input('date'),
            'priority' => $request->input('numPriority'),
        ]);
        $data = 'New task has been created';
        $lastTask = auth()->user()->task()->get()->last();
        $lastTask->update([
            'order_id' => $lastTask->id
        ]);
         
        return response()->json(array('data'=> $data, 'task' => $lastTask), 200);
    }

    public function update(Request $request, Tasks $task) 
    {
        $task->update([
            'task' => $request->input('task'),
            'description' => $request->input('description'),
            'priority' => $request->input('numPriority'),
            'user_id' => auth()->user()->id
        ]);
        
        return response()->json(array('chapter_id' => $task->chapter_id));
    }


    public function finished(Tasks $task) 
    {
        $task->update([
            'required' => !$task->required,
        ]);
        $finishedTasks = auth()->user()->task()->where('chapter_id', 0)->get();
        return response()->json($finishedTasks);
    }

    public function destroy(Tasks $task) 
    {
        $task->delete();

        return response()->json(array('chapter_id' => $task->chapter_id));
    }

    public function today() 
    {
        $todayTasks = auth()->user()->task()->where('date', date('Y-d-m'));
        return response()->json(array('tasks' => $todayTasks->orderBy('order_id')->get(),
        'date' => date('Y-d-m')
    ));
    }
    public function calendar(Request $request) 
    {
        $calendarTasks = auth()->user()->task()
        ->where('date', $request->input('date'))->orderBy('order_id')->get();
        return response()->json(array('tasks' => $calendarTasks, 'date' => $request->input('date')
    ));
    }
    public function changePosition(Request $request, Tasks $task) {
        $task->update([
            'chapter_id' => $request->input('chapter_id')
        ]);
    }
    public function changePsToSubtask(Request $request) {
        $subtask = Tasks::find($request->input('dropTask'));
        $task = Tasks::find($request->input('dropTask'))->delete();
        subtask::create([
            'subtask' => $subtask->task,
            'description' => $subtask->description,
            'task_id' => $request->input('dragTask')
        ]);
    }
}
