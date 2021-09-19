  @foreach ($tasks as $task)
  <div class="task-block d-flex py-3" style="position: relative">
    <div class="" style="position: relative">
      <label class="container_checkbox">
        <input type="checkbox" {{ $task->required ? 'checked' : ''}} onchange="taskFinished({{$task->id}})">
        <span class="checkmark"></span>
      </label>
    </div>
    <div class="text-block">
      <p class="checkbox_text">{{$task->task}}</p>
    </div>
    <div class="form-buttons">
      <form style="{{ $task->required ? 'display: none' : 'display: inline-block' }}" 
        action="{{route('home')}}/{{$task->id}}/subtasks" method="GET" data-toggle="modal" data-target=".bd-example-modal-lg">
        <img onclick="subtaskRead({{$task->id}})" 
        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Subtasks"
        class="form-icon" src="https://cdn-icons-png.flaticon.com/128/839/839860.png" 
        alt="">
        
      </form>
      <form style="{{ $task->required ? 'display: none' : 'display: inline-block' }}">
        <img onclick="edit({{ $task->id }}, {{ $task->chapter_id }})" data-toggle="modal" data-target="#exampleModal"
        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
        class="form-icon" src="https://cdn-icons-png.flaticon.com/128/1159/1159633.png" 
        alt="">
      </form>
      <form class="" style="display: inline-block">
        <img onclick="destroy({{ $task->id }}, {{ $task->chapter_id }})"
        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
        class="form-icon" src="https://cdn-icons-png.flaticon.com/128/1214/1214428.png" 
        alt="">
      </form>
      @if ($protcent === 0)
        @else
        <form style="{{ $task->required ? 'display: none' : 'display: inline-block' }}">
          <button type="button" class="btn btn-success ms-1">
             {{ $protcent[ $j++ ].'% Done' }}
          </button>
        </form>
      @endif
      
    </div>
  </div>
  @endforeach

