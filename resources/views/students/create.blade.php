@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h4><i class="fa fa-align-justify"></i> {{ __('Create Student') }}</h4>
                        <a href="{{ route('students.index') }}" class="btn btn-primary ml-auto">
                            Go Back
                        </a>
                    </div>
                    <form action="{{ route('students.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <label for="id_number">ID Number</label>
                                    <input type="text" id="id_number" name="id_number" class="form-control" required readonly value="{{ $student_id_number }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" required readonly value="@student.com">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-4">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" id="middle_name" name="middle_name" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="birthday">Birthday</label>
                                    <input type="date" id="date" name="birthday" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="grade_level_entered">Grade Level</label>
                                    <select name="grade_level_entered" id="grade_level_entered" class="form-control" required>
                                        @foreach($gls as $i => $gl)
                                        <option value="{{ $gl->id }}">{{ $gl->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <h3 class="mb-2">Parents Information</h3>

                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <label for="mothers_maiden_name">Mother's Maiden Name</label>
                                    <input type="text" id="mothers_maiden_name" name="mothers_maiden_name" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="fathers_name">Father's Name</label>
                                    <input type="text" id="fathers_name" name="fathers_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <label for="parents_contact_number">Parents Contact Number</label>
                                    <input type="text" id="parents_contact_number" name="parents_contact_number" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="parent_email">Parent Email</label>
                                    <input type="email" id="parent_email" name="parent_email" class="form-control" required>
                                </div>
                            </div>

                            <h3 class="mb-2">Emergency Contact</h3>

                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <label for="emergency_contact_person">Emergency Contact Person</label>
                                    <input type="text" id="emergency_contact_person" name="emergency_contact_person" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="emergency_contact_number">Emergency Contact Number</label>
                                    <input type="text" id="emergency_contact_number" name="emergency_contact_number" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-sm-6">
                                    <label for="emergency_contact_person_relationship">Emergency Contact Person Relationship</label>
                                    <input type="text" id="emergency_contact_person_relationship" name="emergency_contact_person_relationship" class="form-control" placeholder="Ex: Guardian/Parent/Spouse">
                                </div>
                                <div class="col-sm-6">
                                    <label for="emergency_contact_address">Emergency Contact Address</label>
                                    <input type="text" id="emergency_contact_address" name="emergency_contact_address" class="form-control">
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="ml-auto">
                                    <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="append-div"></div>
@endsection

@section('script')
<script type="text/javascript">
    var email_val = $('#email').val();

    $('#first_name').on('input', function(e) {
        $('#email').val('');
        var last_name = $('#last_name').val();
        var first_name = $(this).val();
        if (last_name != '') {
            var result = last_name + '.' + first_name + email_val;
        } else {
            var result = first_name + email_val;
        }
        $('#email').val(result);
    });

    $('#last_name').on('input', function(e) {
        $('#email').val('')
        var last_name = $(this).val();
        var first_name = $('#first_name').val();
        if (first_name != '') {
            var result = last_name + '.' + first_name + email_val;
        } else {
            var result = last_name + email_val;
        }
        $('#email').val(result);
    });
</script>
@endsection