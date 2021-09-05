@extends('layouts.app')

@section('content')

    <div style="height: 93.3vh">
        <div class="row d-flex justify-content-center container align-items-center h-100 w-50 m-auto">
            <div class="col-12 bg-light">
                <div class="col-12 p-3">
                    <div class="row">
                        <div class="col-8"><h3>{{ $subtask->subtask }}</h3></div>
                        <div class="col-2">
                            <form action="{{route('home')}}/{{$subtask->id}}/subtask/delete" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Ok
                                </button>
                            </form>
                        </div>
                        <div class="col-2">
                            <form action="{{route('home')}}/{{$subtask->id}}/subtask/delete">
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