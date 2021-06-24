<div class="modal fade" id="primaryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
        <div class="modal-content">
            <form action="{{ route('enrolments.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Enrol Student</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <select name="grade_level_id" class="form-control mb-3" id="grade_level_select" required>
                        <option value="1">-- Select Grade Level --</option>
                        @foreach($gls as $i => $gl)
                            <option value="{{ $gl->id }}">{{ $gl->name }}</option>
                        @endforeach
                    </select>
                    <select name="section_id" class="form-control mb-3" id="section_select" required>
                        <option value="">-- Select Section --</option>
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