
  <table class="table mb-4">
    <thead>
      <tr>
        <th scope="col">Check</th>
        <th scope="col">Todo item</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tasks as $task)
        <tr style="{{ $task->required ? 'background: silver;opacity:0.8' : '' }}">
          <th scope="row">
            <input {{ $task->required ? 'checked' : ''}} onchange="taskFinished({{$task->id}})" type="checkbox" aria-label="Checkbox for following text input">
          </th>
          <td>{{ $task->task }}</td>
          <td>
              <form style="{{ $task->required ? 'display: none' : 'display: inline-block' }}" 
                action="{{route('home')}}/{{$task->id}}/subtasks" method="GET" data-toggle="modal" data-target=".bd-example-modal-lg">
                <button onclick="subtaskRead({{$task->id}})" type="button" class="btn btn-primary ms-1">
                  Subtask 
                </button>
              </form>
              <form style="{{ $task->required ? 'display: none' : 'display: inline-block' }}">
                <button onclick="edit({{ $task->id }})" type="button" class="btn btn-secondary ms-1" data-toggle="modal" data-target="#exampleModal">
                  Edit
                </button>
              </form>
              <form class="" style="display: inline-block">
                <button onclick="destroy({{ $task->id }})" type="button" class="btn btn-danger">
                  Delete
                </button>
              </form>
              <form style="{{ $task->required ? 'display: none' : 'display: inline-block' }}">
                <button type="button" class="btn btn-success ms-1">
                   {{ $protcent[ $j++ ].'% Done' }}
                </button>
              </form>
            </td>
          </tr>
        @endforeach
    </tbody>
  </table>
