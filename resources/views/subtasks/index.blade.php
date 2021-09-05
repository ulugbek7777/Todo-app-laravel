@extends('layouts.app')

@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
  
              <h4 class="text-center my-3 pb-3">Subtasks</h4>
  
              <form action="{{route('home')}}/{{$id}}/subtask/create" method="POST" class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-4">
                @csrf
                <div class="col-10">
                  <div class="form-outline">
                    <input name="subtask" type="" id="form1" class="form-control" />
                    <div style="position: absolute; width:100%">
                        @error('subtask')
                        <p style="color: red">{{ $errors->first('subtask') }}</p>
                        @else
                        <label class="form-label position-absolute" for="form1">
                            @if (session('message'))
                                    <p class="bg-danger">{{ session('message') }}</p>
                                @else
                                Enter a subtask here
                            @endif
                        </label>
                        @enderror  
                    </div> 
                  </div>
                </div>
  
                <div class="col-2 ml-0 pl-0">
                  <button type="submit" class="btn btn-primary">Add subtask</button>
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
                  @foreach ($subtasks as $subtask)
                    <tr style="{{ $subtask->required ? 'background: silver;opacity:0.8' : '' }}">
                      <th scope="row">{{ $i++ }}</th>
                      <td>{{ $subtask->subtask }}</td>
                      <td>
                          <form style="{{ $subtask->required ? 'display: none' : 'display: inline-block' }}" action="/home/{{ $subtask->id }}/subtask/edit">
                            <button type="submit" class="btn btn-secondary ms-1">
                              Edit
                            </button>
                          </form>
                          <form class="" action="/home/{{ $subtask->id }}/subtask/delete" style="display: inline-block">
                            <button type="submit" class="btn btn-danger">
                              Delete
                            </button>
                          </form>
                          <form method="GET" action="/home/{{ $subtask->id }}/subtask/finished" style="display: inline-block">
                            @csrf
                            <button type="submit" class="btn btn-success ms-1">
                              {{ $subtask->required ? 'Restart' : 'Finished' }}
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

<style>
</style>