@extends('layouts.app')

@section('content')

    <div style="height: 93.3vh">
        <div class="row d-flex justify-content-center container align-items-center h-100 w-50 m-auto">
            <div class="col-12 bg-light">
                <div class="col-12 pt-4 pb-5">
                    <div class="row">
                        <form class="col-10" action="{{route('home')}}/{{$subtask->id}}/subtask/edit" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-10">
                                    <input name="subtask" type="" id="form1" value="{{ $subtask->subtask }}" class="form-control" />
                                    <div style="position: absolute; width:100%">
                                        @error('subtask')
                                        <p style="color: red">{{ $errors->first('subtask') }}</p>
                                        @else
                                        <label class="form-label position-absolute" for="form1">Enter a subtask here</label>
                                        @enderror  
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-danger">
                                        Ok
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="col-2">
                            <form action="{{ route('home') }}/{{$subtask->task_id}}/subtasks" method="GET">
                                <button type="submit" class="btn btn-primary">
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
@endsection