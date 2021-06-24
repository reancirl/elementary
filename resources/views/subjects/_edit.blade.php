<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
        <div class="modal-content">
            <form action="{{ route('subjects.update',$subject->id) }}" method="post">
                @csrf              
                @method('patch')
                <div class="modal-header">
                    <h4 class="modal-title">Update Subjects</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-3" placeholder="Name" required value="{{ $subject->name ?? '' }}">
                    <input type="text" name="description" class="form-control mb-3" placeholder="Description" required value="{{ $subject->description ?? '' }}">
                    <select name="grade_level_id" class="form-control mb-3" required>
                        <option value="1">-- Select Grade Level --</option>
                        @foreach($gls as $i => $gl)
                            <option value="{{ $gl->id }}" {{ $gl->id == $subject->grade_level_id ? 'selected' : '' }}>{{ $gl->name }}</option>
                        @endforeach
                    </select>
                    <select name="status" class="form-control mb-3" required>
                        <option value="1" {{ $subject->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $subject->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>