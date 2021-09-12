<form id="addform" action="#" class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-4">
    {{ csrf_field() }}
    <div class="col-10">
      <div class="form-outline">
        <input autofocus name="task" type="text" id="createInput" class="form-control" required/>
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