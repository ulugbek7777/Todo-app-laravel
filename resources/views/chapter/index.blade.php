@foreach ($chapters as $chapter)
<div class="pb-3">
    <div class="togler-block" id={{"chapterIconRotate" . $chapter->id}}  onclick="openTask({{ $chapter->id }})">
      <img class="image-togler" id="image-togler" src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Arrow-down.svg" alt="">
    </div>
    <div class="text-block">
      <p>{{ $chapter->chapter }}</p>
    </div>
    <div class="button-block">
      <form style="display: inline-block">
        <button onclick="editChapterToModal({{ $chapter->id }})" type="button" class="btn btn-secondary ms-1" data-toggle="modal" data-target="#exampleModal">
          Edit
        </button>
      </form>
      <form class="" style="display: inline-block">
        <button type="button" class="btn btn-danger" onclick="Chapterdestroy({{ $chapter->id }})">
          Delete
        </button>
      </form>
    </div>
</div>
<div class="show_tasks" id="{{ 'showTasks' . $chapter->id }}">
    <div id={{"TaskInChapterBlock" . $chapter->id }}>
        {{-- @include('chapter.show') --}}
    </div>
    
    <div class="d-flex py-3 add_task_big_block" onclick="addTaskAsyncChapter({{ $chapter->id }})" id={{"addTaskAsyncChapter" . $chapter->id}}>
        <div class="add_task_icon_block">
          <svg class="add_task_icon" class="svg-icon" viewBox="0 0 20 20">
            <path d="M13.388,9.624h-3.011v-3.01c0-0.208-0.168-0.377-0.376-0.377S9.624,6.405,9.624,6.613v3.01H6.613c-0.208,0-0.376,0.168-0.376,0.376s0.168,0.376,0.376,0.376h3.011v3.01c0,0.208,0.168,0.378,0.376,0.378s0.376-0.17,0.376-0.378v-3.01h3.011c0.207,0,0.377-0.168,0.377-0.376S13.595,9.624,13.388,9.624z M10,1.344c-4.781,0-8.656,3.875-8.656,8.656c0,4.781,3.875,8.656,8.656,8.656c4.781,0,8.656-3.875,8.656-8.656C18.656,5.219,14.781,1.344,10,1.344z M10,17.903c-4.365,0-7.904-3.538-7.904-7.903S5.635,2.096,10,2.096S17.903,5.635,17.903,10S14.365,17.903,10,17.903z"></path>
          </svg>
        </div>
        <div class="add_task_text_block">
          <p class="add_task_text">Add task</p>
        </div>
      </div>
      <div class="chapterAddTaskInput" id={{"AddTaskDisplayChapter" . $chapter->id}} class="mt-1">
        <div class="add_task_block">
          <div class="add_task_block_id">
            <div>
              <span id={{"taskChapterInput" . $chapter->id}} class="textarea" role="textbox" contenteditable></span>
            </div>
          </div>
        </div>
        <div class="py-2">
          <button type="button" class="btn btn-primary" onclick="taskCreateInChapter({{ $chapter->id }})">Add task</button>
          <button type="button" class="btn btn-danger" id="removeChapterClass" onclick="removeChapterClass({{ $chapter->id }})">Cancel</button>
        </div>
      </div>
      
</div>
@endforeach
<style>
    .togler-block {
        transform: rotate(-90deg);
    }
</style>
<script>
    
   function openTask(id) {
       if($('#showTasks' + id).css("display") == 'none') {
        getChaptersTasks(id);
        $('#showTasks' + id).css({display: 'block'});
        $('#chapterIconRotate' + id).css('transform', "rotate(0deg)");
       } else {
        $('#showTasks' + id).css({display: 'none'});
        $('#chapterIconRotate' + id).css('transform', "rotate(-90deg)");
       }
   }
   function addTaskAsyncChapter(id) {
    $("#AddTaskDisplayChapter" + id).css({display: "block"});
    $("#addTaskAsyncChapter" + id).addClass('importantRule');
   }
   function removeChapterClass(id) {
    $("#AddTaskDisplayChapter" + id).css({display: "none"});
    $("#addTaskAsyncChapter" + id).removeClass('importantRule');
   }

    
</script>
<style>
    .show_tasks {
        display: none
    }
    .chapterAddTaskInput {
        display: none
    }
</style>