@extends('dashboard.base')

@section('css')
    <style>
        .active {
            border: 3px solid #3c4b64;
        }
        .flex-fill {
            cursor: pointer;
        }
        .div-display-hidden {
            display: none; 
        }
    </style>
@endsection

@section('content')
    @include('students._enrol')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="fa fa-user"></i> STUDENT INFORMATION</h4>
                            <a href="{{ route('students.index') }}" class="btn btn-primary ml-auto">
                                Go Back
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 text-center">
                                    <img src="{{ $student->gender ? url('/assets/img/male-placeholder-image.jpeg') : url('/assets/img/female-placeholder.jpg') }}" alt="Student Image" height="250" class="active" style="border-radius:50%">
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="mb-3"><strong>ID NUMBER: {{ $student->id_number ?? '' }}</strong></h4>
                                    <h4 class="mb-3"><strong>{{ $student->user->name ?? '' }}</strong></h4>
                                    <hr width="60%" align="left">
                                    <h6 class="mb-3">Email: <span>{{ $student->user->email ?? '' }}</span> </h6>
                                    <h6 class="mb-3">Address: {{ $student->address ?? '' }}</h6>
                                    <h6 class="mb-3">Birthday: {{ $student->birthday ?  date('M d,Y',strtotime($student->birthday)) : '' }}</h6>
                                    <a href="{{ route('students.edit',$student->id) }}" class="btn btn-primary">Update Info</a>
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="mb-3"><strong>ENROLMENT INFORMATION</strong></h4>
                                    <h6 class="mb-3"><strong>Enrolment Status: </strong>
                                        <span class="p-2 badge badge-{{ $student->getLatestEnrolment() ?  ($student->getLatestEnrolment()->withdrawn ? 'secondary' : 'success') : 'danger' }}">
                                            {{ $student->getLatestEnrolment() ?  ($student->getLatestEnrolment()->withdrawn ? 'Withdrawn' : 'Enroled') : 'Not-Enroled' }}
                                        </span>
                                    </h6>
                                    <h6 class="mb-3"><strong>Grade Level: </strong> {{ $student->getLatestEnrolment() ? $student->getLatestEnrolment()->section->gradeLevel->name : $student->gradeLevel->name }} </h6>
                                    <h6 class="mb-3"><strong>Section: {{ $student->getLatestEnrolment() ? $student->getLatestEnrolment()->withdrawn == 0 ? $student->getLatestEnrolment()->section->name : 'N/a' : 'N/a' }}</strong> </h6>
                                    <hr width="70%" align="left">
                                    <h6 class="mb-3">Date Enroled: {{ $student->getLatestEnrolment() ? date('M d, Y',strtotime($student->getLatestEnrolment()->date_enroled)) : 'N/a' }}</h6>
                                    <h6 class="mb-3">Payment Status: 
                                        <span class="p-2 badge badge-{{ $student->fees->count() > 0 ? ($student->fees->sum('remaining_balance') == 0 ? 'success' : 'warning text-white') : 'secondary' }}">
                                            {{ $student->fees->count() > 0 ? ($student->fees->sum('remaining_balance') == 0 ? 'Cleared' : 'With Balance') : 'No Record' }}
                                        </span>
                                    </h6>
                                    @role('admin')
                                        @if($student->getLatestEnrolment() && $student->getLatestEnrolment()->withdrawn == 0)
                                            <a href="{{ route('enrolments.edit',$student->id) }}" class="btn btn-success">Update Enrolment</a>
                                        @else
                                            <button class="btn btn-primary enrol_btn" data-toggle="modal" data-target="#primaryModal" data-url="{{ route('enrolments.fillSection') }}">Enrol Student</button>
                                        @endif
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex text-center">
                        <div class="bg-white flex-fill active" id="parents_info_btn">
                            <h2 class="text-dark p-2">Parents Information</h2>
                        </div>
                        <div class="bg-white flex-fill" id="emergency_contact_btn">
                            <h2 class="text-dark p-2">Emergency Contact</h2>
                        </div>
                    </div>

                    <div class="flex-column bg-white" id="parents_info_div">
                        <hr>
                        <table class="table" style="font-size:1.3rem">
                            <tr>
                                <td>Mother's Maiden Name</td>
                                <td>{{ $student->parent->mothers_maiden_name ?? 'N/a' }}</td>
                            </tr>
                            <tr>
                                <td>Father's Name</td>
                                <td>{{ $student->parent->fathers_name ?? 'N/a' }}</td>
                            </tr>
                            <tr>
                                <td>Contact Number</td>
                                <td>{{ $student->parent->parents_contact_number ?? 'N/a' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="flex-column bg-white div-display-hidden" id="emergency_contact_div">
                        <hr>
                        <table class="table" style="font-size:1.3rem">
                            <tr>
                                <td>Emergency Contact Person</td>
                                <td>{{ $student->parent->emergency_contact_person ?? 'N/a' }}</td>
                            </tr>
                            <tr>
                                <td>Emergency Contact Number</td>
                                <td>{{ $student->parent->emergency_contact_number ?? 'N/a' }}</td>
                            </tr>
                            <tr>
                                <td>Relationship</td>
                                <td>{{ $student->parent->emergency_contact_person_relationship ?? 'N/a' }}</td>
                            </tr>
                            <tr>
                                <td>Emergency Contact Address</td>
                                <td>{{ $student->parent->emergency_contact_address ?? 'N/a' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="append-div"></div>
@endsection

@section('script')
<script type="text/javascript">
    $('#parents_info_btn').click(function(e) {
        $('.flex-fill').removeClass('active');
        $(this).addClass('active');
        $('#parents_info_div').removeClass('div-display-hidden');
        $('#emergency_contact_div').addClass('div-display-hidden');
    });

    $('#emergency_contact_btn').click(function(e) {
        $('.flex-fill').removeClass('active');
        $(this).addClass('active');
        $('#emergency_contact_div').removeClass('div-display-hidden');
        $('#parents_info_div').addClass('div-display-hidden');
    });

    $('#grade_level_select').on('change',function(e) {
        var value = $(this).val();
        var url = $('.enrol_btn').data('url');
        $('#section_select').empty();
        $.ajax({
            url: url,
            type: 'GET',
            data: {grade_level_id: value},
            success: function (data) {
                if(data.count > 0) {
                    $('#section_select').append('<option value="">-- Select Section --</option>');
                    $.each(data.sections, function(i, item) {
                        $('#section_select').append('<option value="'+item.id+'">'+item.name+'</option>');
                    });
                } else {
                    alert('Grade level does not have any active section')
                    $('#section_select').append('<option value="">Grade level does not have any active section</option>');
                }
                
            }
        });

    });
</script>
@endsection