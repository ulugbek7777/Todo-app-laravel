<?php

namespace App\Http\Controllers;

use App\subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    public function index($subtask) {
        return view('subtasks.index', [
            'subtasks' => subtask::where('task_id', $subtask)->get(),
            'id' => $subtask,
            'i' => 1
        ]);
    }
    // public function read($subtask) {
    //     return view('subtasks.index', [
    //         'subtasks' => subtask::where('task_id', $subtask)->get(),
    //         'id' => $subtask,
    //         'i' => 1
    //     ]);
    // }
    public function store(Request $request, $id) {
        $this->validation();
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
            $data = 'such a subtask is already included';
            return response()->json(array('data'=> $data), 200);
        };

        subtask::create([
            'subtask' => $request->input('subtask'),
            'task_id' => $id
        ]);
        $data = 'New subtask has been created';
        return response()->json(array('data'=> $data), 200);
    }

    public function edit(subtask $subtask) {
        return view('subtasks.edit', [
            'subtask' => $subtask
        ]);
    }
    public function update(Request $request,subtask $subtask) {
        $this->validation();
        $subtask->update([
            'subtask' => $request->input('subtask')
        ]);

        return redirect(route('subtask.index', $subtask->task_id));
    }

    public function delete(subtask $subtask) {
        return view('subtasks.delete', [
            'subtask' => $subtask
        ]);
    }
    public function destroy(subtask $subtask) {
        $data = $subtask->task_id;
        $subtask->delete();
        return redirect(route('subtask.index', $data));
    }

    public function finished(subtask $subtask) {
        $data = $subtask->task_id;
        $subtask->update([
            'required' => !$subtask->required,
        ]);

        return redirect(route('subtask.index', $data));
    }
    protected function validation()
    {
        return request()->validate([
            'subtask' => 'required|max:100',
        ]);
    }
}
