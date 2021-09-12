<div class="form-group">
    <label for="message-text" class="col-form-label">Update</label>
    <textarea class="form-control" id="message-subtask">{{ $subtask->subtask }}</textarea>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="subtaskUpdate({{ $subtask->id }}, {{ $subtask->task_id }})" data-dismiss="modal">Update</button>
    </div>
</div>