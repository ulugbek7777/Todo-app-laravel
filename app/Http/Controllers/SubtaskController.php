<?php

namespace App\Http\Controllers;

use App\subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    public function index($id) {
        return view('subtasks.index', [
            'subtasks' => subtask::where('task_id', $id)->get(),
            'id' => $id,
            'i' => 1
        ]);
    }
    public function store(Request $request, $id) {
        $request->validate([
            'subtask' => 'required|max:100',
        ]);
        $data = subtask::where('subtask', $request->input('subtask'))->get()->map(function ($tasks) {
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
            return redirect(route('home'). '/' . $id . '/subtasks')->with('message', 'such a subtask is already included');
        };

        subtask::create([
            'subtask' => $request->input('subtask'),
            'task_id' => $id
        ]);
        return redirect(route('home'). '/' . $id . '/subtasks')->with('message', 'your post has been added!');
    }

    public function edit($id) {
        return view('subtasks.edit', [
            'subtask' => subtask::find($id)
        ]);
    }
    public function update(Request $request,$id) {
        $request->validate([
            'subtask' => 'required',
        ]);
        subtask::find($id)->update([
            'subtask' => $request->input('subtask')
        ]);

        return redirect(route('home'). '/' . subtask::find($id)->task_id . '/subtasks');
    }

    public function delete($id) {
        return view('subtasks.delete', [
            'subtask' => subtask::find($id)
        ]);
    }
    public function destroy($id) {
        $data = subtask::find($id)->task_id;
        subtask::find($id)->delete();
        return redirect(route('home'). '/' . $data . '/subtasks');
    }

    public function finished($id) {
        $data = subtask::find($id)->task_id;
        subtask::find($id)->update([
            'required' => !subtask::find($id)->required,
        ]);

        return redirect(route('home'). '/' . $data . '/subtasks');
    }
}
