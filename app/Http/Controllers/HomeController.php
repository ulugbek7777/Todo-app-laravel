<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;

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
    public function protcent($data = 5) {
        $active = count(Tasks::find($data)->subtasks);
        $data = Tasks::find($data)->subtasks->pluck('required');
        $newdata = false;
        $finished = 0;
        foreach($data as $newdata){
            if($newdata) {
                $finished++;
            }
        }
        return (($finished + $active) / $active) * 100 - 100;
    }
    public function index()
    {
        $protcent = Tasks::latest()->get()->pluck('id')->map(function ($data) {
            count(Tasks::find($data)->subtasks) ? $active = count(Tasks::find($data)->subtasks) : $active = 1;
            $data = Tasks::find($data)->subtasks->pluck('required');
            $newdata = false;
            $finished = 0;
            foreach($data as $newdata){
                if($newdata) {
                    $finished++;
                }
            }
            return (($finished + $active) / $active) * 100 - 100;
        });
        $done = 0;
        foreach($protcent as $pro) {
            $done += $pro;
        }
        return view('todo.home', [
            'tasks' => Tasks::latest()->get(),
            'i' => 1,
            'protcent' => $protcent,
            'j' => 0,
        ]);
    }

    public function create() {

    }
    public function store(Request $request)
    {
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
        
        $request->validate([
            'task' => 'required|max:100',
        ]);
        if($newdata) {
            return redirect('/home')->with('message', 'such a task is already included');
        };

        Tasks::create([
            'task' => $request->input('task'),
            'user_id' => auth()->user()->id
        ]);
        return redirect('/home')->with('message', 'your post has been added!');
    }

    public function edit($id) {
        return view('todo.edit', [
            'task' => Tasks::find($id)
        ]);
    }
    public function update(Request $request, $id) {
        $request->validate([
            'task' => 'required|max:100',
        ]);
        Tasks::find($id)->update([
            'task' => $request->input('task'),
            'user_id' => auth()->user()->id
        ]);

        return redirect(route('home'));
    }


    // show
    // edit
    // update
    // destroy

    public function delete($id) {
        return view('todo.delete', [
            'task' => Tasks::find($id),
        ]);
    }

    public function destroy($id) {
        Tasks::find($id)->delete();

        return redirect(route('home'));
    }

    public function finished($id) {
        Tasks::find($id)->update([
            'required' => !Tasks::find($id)->required,
        ]);

        return redirect(route('home'));
    }
}
