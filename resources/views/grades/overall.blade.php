@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ route('grades.overallGradeStore') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header d-flex">
                                <h5><i class="fa fa-align-justify"></i>  Section {{ $section->name ?? 'N/a' }} - {{ $subject->name ?? 'N/a' }} | Overall Grade</h5>                            
                                <a class="btn btn-secondary ml-auto" href="{{ url()->previous() }}">
                                    Go Back
                                </a>
                            </div>
                            <div class="card-body mb-0 pb-0">
                                <div class="d-flex justify-content-around mb-2">
                                    @php
                                        $first_fail_count = $enrolments->where('first_grading_grade','<','75')->whereNotNull('first_grading_grade')->count();
                                        $second_fail_count = $enrolments->where('second_grading_grade','<','75')->whereNotNull('second_grading_grade')->count();;
                                        $third_fail_count = $enrolments->where('third_grading_grade','<','75')->whereNotNull('third_grading_grade')->count();;
                                        $fourth_fail_count = $enrolments->where('fourth_grading_grade','<','75')->whereNotNull('fourth_grading_grade')->count();;
                                    @endphp
                                    @if($first_fail_count > 0 )
                                        <a href="{{ route('sms.failedStudents',['first_grading_grade',$section->id,$subject->id]) }}" class="btn btn-primary text-white btn-sm">Send SMS:Failed Students - First Grading</a>
                                    @endif
                                    @if($second_fail_count > 0 )
                                        <a href="{{ route('sms.failedStudents',['second_grading_grade',$section->id,$subject->id]) }}" class="btn btn-primary text-white btn-sm">Send SMS:Failed Students - Second Grading</a>
                                    @endif
                                    @if($third_fail_count > 0 )
                                        <a href="{{ route('sms.failedStudents',['third_grading_grade',$section->id,$subject->id]) }}" class="btn btn-primary text-white btn-sm">Send SMS:Failed Students - Third Grading</a>
                                    @endif
                                    @if($fourth_fail_count > 0 )
                                        <a href="{{ route('sms.failedStudents',['fourth_grading_grade',$section->id,$subject->id]) }}" class="btn btn-primary text-white btn-sm">Send SMS:Failed Students - Fourth Grading</a>
                                    @endif
                                </div>
                                <table class="table table-responsive-sm table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th width="1%">#</th>
                                            <th width="25%">Student Info</th>
                                            <th width="15%">First Grading</th>
                                            <th width="15%">Second Grading</th>
                                            <th width="15%">Third Grading</th>
                                            <th width="15%">Fourth Grading</th>
                                            <th width="15%">Final Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enrolments as $i => $e)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $e->student->id_number }} - {{ $e->student->user->name ?? '' }}</td>
                                                <td>
                                                    <input type="number" class="form-control text-right first" name="first_grading_grade[{{ $i }}]" max="100" value="{{ $e->first_grading_grade ?? '' }}">
                                                    <input type="hidden" value="{{ $e->enrolment_id }}" name="enrolment_id[{{ $i }}]">
                                                    <input type="hidden" value="{{ $subject->id }}" name="subject_id">
                                                </td>
                                                <td>
                                                    <input type="number" max="100" class="form-control text-right second" name="second_grading_grade[{{ $i }}]" value="{{ $e->second_grading_grade ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="number" max="100" class="form-control text-right third" name="third_grading_grade[{{ $i }}]" value="{{ $e->third_grading_grade ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="number" max="100" class="form-control text-right fourth" name="fourth_grading_grade[{{ $i }}]" value="{{ $e->fourth_grading_grade ?? '' }}">
                                                </td>
                                                <td>
                                                    @php
                                                        $final = 0;
                                                        $count = 0;                                                        
                                                        if ($e->first_grading_grade) {
                                                            $count++;
                                                            $final += $e->first_grading_grade;
                                                        }
                                                        if ($e->second_grading_grade) {
                                                            $count++;
                                                            $final += $e->second_grading_grade;
                                                        }
                                                        if ($e->third_grading_grade) {
                                                            $count++;
                                                            $final += $e->third_grading_grade;
                                                        }
                                                        if ($e->fourth_grading_grade) {
                                                            $count++;
                                                            $final += $e->fourth_grading_grade;
                                                        }
                                                        if($final > 0) {
                                                            $final /= $count;
                                                        } else {
                                                            $final = '';
                                                        }
                                                    @endphp
                                                    <input type="number" class="form-control text-right final" readonly value="{{ $final ?? '' }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>                                
                                </table>
                                <hr>
                            </div>
                            <div class="d-flex mt-0">
                                <button class="btn btn-primary text-black ml-auto mb-2 mr-2" type="submit">Submit Grades</button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
    <div class="append-div"></div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.form-control').on('input',function(e) {
            var first = $(this).closest('tr').find('.first').val();
            var second = $(this).closest('tr').find('.second').val();
            var third = $(this).closest('tr').find('.third').val();
            var fourth = $(this).closest('tr').find('.fourth').val();
            var final = 0;
            var count = parseInt(0);
            if(first != '') {
                final += parseFloat(first);
                count++;
            }
            if(second != '') {
                final += parseFloat(second);
                count++;
            }
            if(third != '') {
                final += parseFloat(third);
                count++;
            }
            if(fourth != '') {
                final += parseFloat(fourth);
                count++;
            }
            final /= count;
            $(this).closest('tr').find('.final').val(final.toFixed(2));
        });
    </script>
@endsection