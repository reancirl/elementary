<div class="modal fade" id="primaryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
        <div class="modal-content">
            <form action="{{ route('grades.store') }}" method="post">
                @csrf              
                <div class="modal-header">
                    <h5 class="modal-title">Create {{ $request->type ?? 'Exam' }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="type" value="{{ $request->type ?? 'Exam' }}">
                    <input type="hidden" name="section_id" value="{{ $section->id ?? '' }}">
                    <input type="hidden" name="subject_id" value="{{ $subject->id ?? '' }}">

                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control mb-3" id="name" required>

                    <label for="number_of_items">Number of Items:</label>
                    <input type="number" name="number_of_items" class="form-control mb-3" id="number_of_items" step="any" required>

                    <label for="passing_score">Passing Score:</label>
                    <input type="number" name="passing_score" class="form-control mb-3" id="passing_score" step="any" required>

                    <label for="date">Date:</label>
                    <input type="date" name="date" class="form-control mb-3" id="date">

                    <label for="deadline">Deadline:</label>
                    <input type="date" name="deadline" class="form-control mb-3" id="deadline">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>