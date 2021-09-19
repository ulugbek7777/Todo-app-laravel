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
  
  {{-- create tasks --}}
  <div class="row" style="width: 100%">
    <div class="col- sidebar_container">
      <div class="sidebar_block">

      </div>
    </div>
    <div class="col-8 align-items-center m-auto">
      <div style="position: relative;" class="pt-4 pb-4">
        <h3 class="font-weight-bold d-inline-block" id="todoOrToday">To Do App</h3>
        <p class="d-inline-block" id="date"></p>
        <div class="dropdown iconSet">
          <img src="https://cdn-icons-png.flaticon.com/512/2467/2467852.png" class="form-icon " alt="" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item font-weight-bold" onclick="allEvent()" style="cursor: pointer">All</a></li>
            <li><a class="dropdown-item font-weight-bold" onclick="todayEvent()" style="cursor: pointer">Today</a></li>
            <li><a class="dropdown-item font-weight-bold" href="#">Others...</a></li>
          </ul>
        </div>
      </div>
      <div id="read"></div>
      @include('todo.create')
      <div id="chapterBlock">
        <div id="getChapters"></div>
        <div class="add_chapter_block">
          <div id="chaperBlock" class="chapter_block" style="margin-bottom: 80px">
            <p class="add_chapter">Add Chapter</p>
          </div>
          <div class="chater_input_block" id="chapterInputBlock">
            @include('chapter.create')
          </div>        
        </div>
      </div>
      
      
      
    </div>
  </div>
  




  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<script>  
  function read() { 
      $.get("{{ url('home/read') }}", {}, function(data, status) {
        $('#read').html(data)
      });
  };
  function readToday() { 
      $.get("{{ url('home/read/today') }}", {}, function(data, status) {
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
          checkToday ? readToday() : read()
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
          checkToday ? readToday() : read()
        }
    });
  }
  function destroy(id) {
    let a = confirm('Do you want to delete this task?');
    let token = $('meta[name="csrf-token"]').attr('content');
    if (a) {
      $.ajax({
        type: 'delete',
        url: '{{ url('home') }}/' + id + '/delete',
        data:{
          _token: token,
          "id": id,
          dataType: 'json', 
          contentType:'application/json', 
        },  
        success: function(response) {
          $('.btn-close').click();
          checkToday ? readToday() : read()
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
          subtaskRead(id);
          checkToday ? readToday() : read()
          $('#createInput').val(null);
        },
        error: function () {
          alert('ERROR');
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
          checkToday ? readToday() : read()
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
          checkToday ? readToday() : read()
        }
    });
  }

  

  function taskCreate() {
    let b = $('#taskInput').text();
    if(b.length > 500) {
      alert('Your text is more than 500 words');
    }else if (b.length == 0) {
      alert('write something');
    } else {
      let token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        type: 'POST',
        url: '{{ route('home') }}',
        data:{
          _token: token,
          "task": b,
          "chapter_id": '' + 0,
          dataType: 'json', 
          contentType:'application/json', 
        },
        success: function(response) {
          console.log(response.data)
          checkToday ? readToday() : read()
          $('#taskInput').text(null);
        },
      
      });
    }
    
      
  }

  //chapter

  function getChapters() { 
      $.get("{{ route('index.chapter') }}", {}, function(data, status) {
        
        $('#getChapters').html(data)
      });
  };

  function getChaptersTasks(id) { 
      $.get("home/chapter/" + id + "/show", {}, function(data, status) {
        $('#TaskInChapterBlock' + id).html(data)
      });
  };

  function chapterCreate() {
    let b = $('#chapterInput').val();
    if(b.length > 100) {
      alert('Your words length must be less then 100 Your words length ' + b.length);
    } else if (b.length == 0) {
      alert('Write something')
    } else {
      let token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        type: 'POST',
        url: 'home/chapter',
        data:{
          _token: token,
          "chapter": b,
          dataType: 'json', 
          contentType:'application/json', 
        },
        success: function() {
          $('#chapterInput').val(null);
          getChapters()
        },
      
      });
    }
  }
  function taskCreateInChapter(id) {
    let b = $('#taskChapterInput' + id).text();
    if(b.length > 500) {
      alert('Your text is more than 500 words');
    }else if (b.length == 0) {
      alert('write something');
    } else {
      let token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        type: 'POST',
        url: '{{ route('home') }}',
        data:{
          _token: token,
          "task": b,
          "chapter_id": id,
          dataType: 'json', 
          contentType:'application/json', 
        },
        success: function(response) {
          alert(response.data)
          $('#taskChapterInput' + id).text(null);
          getChaptersTasks(id);
        },
      
      });
    }
  }

  function editChapterToModal(chapter) {
    $.get("{{ url('home') }}/chapter/" + chapter + '/edit', {}, function(data, status) {
        $('#exampleModalLabel').html('Edit Chapter')
        $('#showTask').html(data)
    });
  }

  function updateChapter(id) {
    let chapter = $('#chapterTextToUpdate').val();
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'put',
        header:{
          'X-CSRF-TOKEN': token
        },
        url: '{{ url('home') }}/chapter/' + id + '/update',
        data:{
          _token: token,
          "chapter": chapter,
          dataType: 'json', 
          contentType:'application/json', 
        },  
        success: function(response) {
          $('.btn-close').click();
          getChapters()
        }
      });
  }
  function Chapterdestroy(id) {
    let a = confirm('Do you want to delete this chapter?');
    let token = $('meta[name="csrf-token"]').attr('content');
    if (a) {
      $.ajax({
        type: 'delete',
        url: '{{ url('home') }}/chapter/' + id + '/delete',
        data:{
          _token: token,
          "id": id,
          dataType: 'json', 
          contentType:'application/json', 
        },  
        success: function(response) {
          $('.btn-close').click();
          getChapters()
        }
      });
    }
  }
  let checkToday = false;
  function todayEvent() {
    checkToday = true;
    readToday();
    $('#todoOrToday').text('Today') 
    $('#chapterBlock').css({display: 'none'})
    $('#date').text('{{ date('D d-M') }}') 
  }
  function allEvent() {
    checkToday = false;
    read();
    $('#todoOrToday').text('To Do App') 
    $('#chapterBlock').css({display: 'block'})
    $('#date').text('') 
  }
  
  $(document).ready(function(){
    read()
    subtaskRead()
    getChapters()
    $("#addTaskAsync").click(function(){
        $("#AddTaskDisplay").css({display: "block"});
        $("#addTaskAsync").addClass('importantRule');
    });
    $("#removeClass").click(function(){
        $("#AddTaskDisplay").css({display: "none"});
        $("#addTaskAsync").removeClass('importantRule');
    });

    //chapter
    $("#chaperBlock").click(function(){
        $("#chapterInputBlock").css({display: "block"});
        $("#chaperBlock").css({display: "none"});
    });
    $("#removeChapterClass").click(function(){
        $("#chapterInputBlock").css({display: "none"});
        $("#chaperBlock").css({display: "block"});
    });
  })

  
</script>

@endsection


