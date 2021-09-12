<div class="form-group">
    <label for="message-text" class="col-form-label">Update</label>
    <textarea class="form-control" id="message-text">{{ $task->task }}</textarea>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="update({{ $task->id }})" data-dismiss="modal">Update</button>
    </div>
</div>