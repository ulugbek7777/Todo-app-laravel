<?php

namespace App\Http\Controllers\API;

use App\Chapter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChapterController extends Controller
{  
    public function index()
    {
        return response()->json(auth()->user()->chapter()->with('task')->get());
    }

    
    public function store(Request $request)
    {
        Chapter::create([
            'chapter' => $request->input('chapter'),
            'user_id' => auth()->user()->id
        ]);
        $data = 'Your chapter here';
        return response()->json(array('data'=> $data, 'chapter' => auth()->user()->chapter()->get()->last()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
