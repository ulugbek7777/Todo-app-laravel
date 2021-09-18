<div class="form-group">
    <label for="message-text" class="col-form-label">Update</label>
    <textarea class="form-control" id="chapterTextToUpdate">{{ $chapter->chapter }}</textarea>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updateChapter({{ $chapter->id }})" data-dismiss="modal">Update</button>
    </div>
</div>