@extends('layouts.app')

@section('content')
{{-- @if (session('message'))
  <div class="alert alert-block position-absolute" style="width: 100%;height: 100vh;z-index: 100;background-color: rgba(0, 0, 0, 0.5);">
    <div class="container py-5 h-100" style="">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="pr-4 pl-4 bg-light">
          <button type="button" class="close" data-dismiss="alert">×</button>    
          <strong style="color: red">{{ session('message') }}</strong>
      </div>
      </div>
    </div>
  </div>
  

@endif --}}
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
  
              <h1 class="text-center my-3 pb-3 font-weight-bold">To Do App</h1>
  
              <form action="{{ route('home') }}" method="POST" class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-4">
                @csrf
                <div class="col-10">
                  <div class="form-outline">
                    <input name="task" type="text"  class="form-control" required/>
                    <div style="position: absolute; width:100%">
                      @error('task')
                      <p style="color: red">{{ $errors->first('task') }}</p>
                      @else
                      <label class="form-label position-absolute" for="form1">
                        @if (session('message'))
                          <p class="bg-danger">{{ session('message') }}</p>
                          @else
                          Enter a task here
                        @endif
                      </label>
                      @enderror  
                    </div>
                  </div>
                </div>
  
                <div class="col-2 ml-0 pl-0">
                  <button type="submit" class="btn btn-primary">Add task</button>
                </div>
              </form>
              <table class="table mb-4">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Todo item</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tasks as $task)
                    <tr style="{{ $task->required ? 'background: silver;opacity:0.8' : '' }}">
                      <th scope="row">{{ $i++ }}</th>
                      <td>{{ $task->task }}</td>
                      <td>
                          <form style="{{ $task->required ? 'display: none' : 'display: inline-block' }}" 
                            action="{{route('home')}}/{{$task->id}}/subtasks" method="GET">
                            <button type="submit" class="btn btn-primary ms-1">
                              Subtask
                            </button>
                          </form>
                          <form style="{{ $task->required ? 'display: none' : 'display: inline-block' }}" action="/home/{{ $task->id }}/edit">
                            <button type="submit" class="btn btn-secondary ms-1">
                              Edit
                            </button>
                          </form>
                          <form class="" action="/home/{{ $task->id }}/delete" style="display: inline-block">
                            <button type="submit" class="btn btn-danger">
                              Delete
                            </button>
                          </form>
                          <form class="" action="/home/{{ $task->id }}/finished" style="display: inline-block">
                            <button type="submit" class="btn btn-success ms-1">
                               {{ $task->required ? 'Restart' : $protcent[ $j++ ].'% Done' }}
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
