<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    public function store(Request $request, $id) 
    {
        $subtask = subtask::create([
            'subtask' => $request->input('subtask'),
            'task_id' => $id
        ]);
        return response()->json(array('subtask'=> $subtask), 200);
    }

    public function update(Request $request,subtask $subtask) 
    {
        $subtask->update([
            'subtask' => $request->input('subtask')
        ]);

        return response()->json(array('subtask'=> $subtask), 200);
    }

    public function destroy(subtask $subtask) 
    {
        $data = $subtask->task_id;
        $subtask->delete();
    }

    public function finished(subtask $subtask) 
    {
        $data = !$subtask->required;
        $subtask->update([
            'required' => !$subtask->required,
        ]);
        return response()->json(array('required' => $data));
    }
}
