  <div class="d-flex py-3 add_task_big_block" id="addTaskAsync">
    <div class="add_task_icon_block">
      <svg class="add_task_icon" class="svg-icon" viewBox="0 0 20 20">
        <path d="M13.388,9.624h-3.011v-3.01c0-0.208-0.168-0.377-0.376-0.377S9.624,6.405,9.624,6.613v3.01H6.613c-0.208,0-0.376,0.168-0.376,0.376s0.168,0.376,0.376,0.376h3.011v3.01c0,0.208,0.168,0.378,0.376,0.378s0.376-0.17,0.376-0.378v-3.01h3.011c0.207,0,0.377-0.168,0.377-0.376S13.595,9.624,13.388,9.624z M10,1.344c-4.781,0-8.656,3.875-8.656,8.656c0,4.781,3.875,8.656,8.656,8.656c4.781,0,8.656-3.875,8.656-8.656C18.656,5.219,14.781,1.344,10,1.344z M10,17.903c-4.365,0-7.904-3.538-7.904-7.903S5.635,2.096,10,2.096S17.903,5.635,17.903,10S14.365,17.903,10,17.903z"></path>
      </svg>
    </div>
    <div class="add_task_text_block">
      <p class="add_task_text">Add task</p>
    </div>
  </div>
  <div id="AddTaskDisplay" class="mt-1">
    <div class="add_task_block">
      <div class="add_task_block_id">
        <div>
          <span id="taskInput" class="textarea" role="textbox" contenteditable></span>
        </div>
      </div>
    </div>
    <div class="py-2">
      <button type="button" class="btn btn-primary" onclick="taskCreate()">Add task</button>
      <button type="button" class="btn btn-danger" id="removeClass">Cancel</button>
    </div>
  </div>