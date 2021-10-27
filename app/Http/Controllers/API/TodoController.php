<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Tasks;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    function index() 
    {
        $tasks = auth()->user()->task()->where('chapter_id', 0)->get();
        return response()->json($tasks);
    }
    function sortPriority() 
    {
        $tasks = auth()->user()->task()->where('chapter_id', 0)->orderBy('priority', 'asc')->get();
        return response()->json($tasks);
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
        $todayTasks = auth()->user()->task()->latest()->where('date', date('Y-d-m'));
        return response()->json(array('tasks' => $todayTasks->get(),
        'date' => date('Y-d-m')
    ));
    }
    public function calendar(Request $request) 
    {
        $calendarTasks = auth()->user()->task()->latest()
        ->where('date', $request->input('date'))->get();
        return response()->json(array('tasks' => $calendarTasks, 'date' => $request->input('date')
    ));
    }
    public function changePosition(Request $request, Tasks $task) {
        $task->update([
            'chapter_id' => $request->input('chapter_id')
        ]);
    }
}
