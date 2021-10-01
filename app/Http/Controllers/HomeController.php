<?php

namespace App\Http\Controllers;

use App\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //count(Tasks::find($data)->subtasks) hammasi
    function index() {
        return view('todo.home');
    }
    function read()
    {
        $protcent = auth()->user()->task()->latest()->where('chapter_id', 0)->get()->pluck('id')->map(function ($data) {
            count(Tasks::find($data)->subtasks) ? $active = count(Tasks::find($data)->subtasks) : $active = 1;
            $data = Tasks::find($data)->subtasks->pluck('required');
            $newdata = false;
            $finished = 0;
            foreach($data as $newdata){
                if($newdata) {
                    $finished++;
                }
            }
            return round(((($finished + $active) / $active) * 100 - 100));
        });
        $done = 0;
        foreach($protcent as $pro) {
            $done += $pro;
        }
        return view('todo.createTasks', [
            'tasks' => auth()->user()->task()->latest()->where('chapter_id', 0)->get(),
            'i' => 1,
            'protcent' => $protcent,
            'j' => 0,
        ]);
    }
    function readToday() {
        return view('todo.createTasks', [
            'tasks' => auth()->user()->task()->latest()->where('chapter_id', 0)->where('date', date('y-m-d'))->get(),
            'i' => 1,
            'protcent' => 0,
            'j' => 0,
        ]);
    }
    public function calendar() {
        return view('todo.calendar', [
            'tasks' => auth()->user()->task()->latest()->where('chapter_id', 0)->get(),
            'i' => 1,
            'j' => 0,
        ]);
    }
    public function create() {
        return view('todo.create');
    }
    public function store(Request $request)
    {
        $this->validation();

        $data = Tasks::where('task', $request->input('task'))->get()->map(function ($tasks) {
            if($tasks->required === 0) {
                return true;
            }else {
                return false;
            }
        });
        $newdata = false;
        foreach($data as $newdata) {
            if($newdata === true) {
                break;
            }else {
                $newdata = false;
            }
        }
        if($newdata) {
            $data = 'Such a task is already included';
            return response()->json(array('data'=> $data), 200);
        };

        Tasks::create([
            'task' => $request->input('task'),
            'chapter_id' => $request->input('chapter_id'),
            'user_id' => auth()->user()->id,
            'date' => $request->input('date')
        ]);
        $data = 'New task has been created';
        return response()->json(array('data'=> $data), 200);
    }

    public function edit(Tasks $task) {
        return view('todo.edit', compact('task'));
    }
    public function update(Request $request, Tasks $task) {
        $this->validation();

        $task->update([
            'task' => $request->input('task'),
            'user_id' => auth()->user()->id
        ]);

        
    }


    // show
    // edit
    // update
    // destroy

    public function delete(Tasks $task) {
        return view('todo.delete', [
            'task' => $task,
        ]);
    }

    public function destroy(Tasks $task) {
        $task->delete();
    }

    public function finished(Tasks $task) {
        $task->update([
            'required' => !$task->required,
        ]);

        return redirect(route('home'));
    }
    protected function validation()
    {
        return request()->validate([
            'task' => 'required|max:255',
        ]);
    }
}
