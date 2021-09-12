@extends('layouts.app')

@section('content')
<!-- Modal -->
<div class="modal fade" style="z-index: 10000" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="showTask">
        
      </div>
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="showSubtasks">
      
    </div>
  </div>
</div>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-12">
          <div class="card rounded-3">
            <div class="card-body p-4">
  
              <h1 class="text-center my-3 pb-3 font-weight-bold">To Do App</h1>
  
             {{-- create tasks --}}
             @include('todo.create')
              <div id="read">
                
              </div>
              <div>
                
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<script>  
  function read() { 
      $.get("{{ url('home/read') }}", {}, function(data, status) {
        $('#read').html(data)
      });
    };
  function edit(task) {
    $.get("{{ url('home') }}/" + task + '/edit', {}, function(data, status) {
        $('#exampleModalLabel').html('Edit Product')
        $('#showTask').html(data)
    });
  }

  function update(id) {
    let task = $('#message-text').val();
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'put',
        header:{
          'X-CSRF-TOKEN': token
        },
        url: '{{ url('home') }}/' + id + '/update',
        data:{
          _token: token,
          "task": task,
          dataType: 'json', 
          contentType:'application/json', 
        },  
        success: function(response) {
          $('.btn-close').click();
          read()
        }
      });
  }
  function taskFinished(id) { 
    console.log(id);
    $.ajax({
        type: 'get',
        url: '{{ url('home') }}/' + id + '/finished',
        data: "id=" +id,
        success: function(response) {
          read();
        }
    });
  }
  function destroy(id) {
    let a = confirm('Do you want to delete this task?');
    if (a) {
      $.ajax({
        type: 'get',
        url: '{{ url('home') }}/' + id + '/delete',
        data: "id=" +id,
        success: function(response) {
          $('.btn-close').click();
          read()
        }
      });
    }
  }
  

  //subtask

  function subtaskRead(id) { 
    console.log(id);
      $.get("{{ url('home') }}/" + id + '/subtasks', {}, function(data, status) {
        $('#showSubtasks').html(data)
      });
  };

  function subtaskCreate(id) {
    $('#addSubtask').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: '{{ route('home') }}/' + id + '/subtask' + '/create',
        data: $('#addSubtask').serialize(),
        success: function(response) {
          alert(response.data)
          subtaskRead(id)
          $('#createInput').val(null);
        }
      });
    })
  }
  function subtaskEdit(subtask) {
    $.get("{{ url('home') }}/" + subtask + '/subtask/edit', {}, function(data, status) {
        $('#exampleModalLabel').html('Edit Subtask')
        $('#showTask').html(data)
    });
  }
  function subtaskUpdate(id, task_id) {
    let subtask = $('#message-subtask').val();
    console.log(task_id);
    $.ajax({
        type: 'get',
        url: '{{ url('home') }}/' + id + '/subtask/update',
        data: "subtask=" +subtask,
        success: function() {
          subtaskRead(task_id);
        }
      });
  }
  function subtaskDestroy(id, task_id) {
    let a = confirm('Do you want to delete this subtask?');
    if (a) {
      $.ajax({
        type: 'get',
        url: '{{ url('home') }}/' + id + '/subtask/delete',
        data: "id=" +id,
        success: function(response) {
          $('.btn-close').click();
          subtaskRead(task_id);
        }
      });
    }
  }
  function subtaskFinished(id, task_id) { 
    $.ajax({
        type: 'get',
        url: '{{ url('home') }}/' + id + '/subtask/finished',
        data: "id=" +id,
        success: function(response) {
          subtaskRead(task_id);
        }
    });
  }
  
  $(document).ready(function(){
    read()
    subtaskRead()
    $('#addform').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: '{{ route('home') }}',
        data: $('#addform').serialize(),
        success: function(response) {
          console.log($('#createInput').val())
          alert(response.data)
          read()
          $('#createInput').val(null);
        }
      });
    })
  })
</script>

@endsection


