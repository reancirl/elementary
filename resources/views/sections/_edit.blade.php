<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
        <div class="modal-content">
            <form action="{{ route('sections.update',$section->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="modal-header">
                    <h4 class="modal-title">Create New Sections</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-3" placeholder="Name" required value="{{ $section->name ?? '' }}">
                    <select name="grade_level_id" class="form-control mb-3" required>
                        <option value="1">-- Select Grade Level --</option>
                        @foreach($gls as $i => $gl)
                            <option value="{{ $gl->id }}" {{ $gl->id == $section->grade_level_id ? 'selected' : '' }}>{{ $gl->name }}</option>
                        @endforeach
                    </select>
                    <select name="adviser_id" class="form-control mb-3" required>
                        <option value="0">-- Select Section Adviser --</option>
                        @foreach($advisers as $i => $adv)
                            <option value="{{ $adv->id }}" {{ $adv->id == $section->adviser_id ? 'selected' : '' }}>{{ $adv->name }}</option>
                        @endforeach
                    </select>
                    <select name="status" class="form-control mb-3" required>
                        <option value="1" {{ $section->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $section->status == 0 ? 'selected' : '' }}>Inactive</option>
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