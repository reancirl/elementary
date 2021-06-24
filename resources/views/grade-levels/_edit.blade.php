<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
        <div class="modal-content">
            <form action="{{ route('grade-levels.update',$gradeLevel->id) }}" method="post">
                @csrf              
                @method('patch')
                <div class="modal-header">
                    <h4 class="modal-title">Update Grade Level</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-3" placeholder="Name" required value="{{ $gradeLevel->name }}">
                    <input type="number" name="fee" class="form-control mb-3" placeholder="Fee" min="0" step="0.01" required value="{{ $gradeLevel->fee }}">
                    <select name="status" class="form-control mb-3" id="role_select">
                        <option value="1" {{ $gradeLevel->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $gradeLevel->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>