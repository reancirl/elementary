<div class="modal fade" id="primaryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
        <div class="modal-content">
            <form action="{{ route('school-years.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Create New School Year</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <select name="year_start" class="form-control mb-3" id="year_start" required>
                        <option value="">-- Select Year Start --</option>
                        @for ($i = 2021; $i <= 2030; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <select name="year_end" class="form-control mb-3" id="year_end" required>
                        <option value="">-- Select Year End --</option>
                        @for ($i = 2022; $i <= 2031; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <select name="status" class="form-control mb-3" id="status" required>
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                    Enrolment Start Date
                    <input type="date" class="form-control mb-3" id="date" name="enrolment_start_date">
                    Enrolment End Date
                    <input type="date" class="form-control mb-3" id="date" name="enrolment_end_date">
                    Enrolment Modify Date Limit
                    <input type="date" class="form-control mb-3" id="date" name="enrolment_modify_date_limit">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
