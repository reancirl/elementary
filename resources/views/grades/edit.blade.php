@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ route('grades.update',$data->id) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="card">
                            <div class="card-header d-flex">
                                <h5><i class="fa fa-align-justify"></i>  Section {{ $section->name ?? 'N/a' }} - {{ $data->subject->name ?? 'N/a' }} : {{ $data->type ?? '' }} - {{ $data->name ?? '' }} | Total Number of Items = {{ $data->number_of_items ?? '' }} | Passing Rate = {{ number_format($data->passing_score/$data->number_of_items*100,2) }}%</h5>                            
                                <input type="hidden" id="number_of_items" value="{{ $data->number_of_items }}">
                                <a class="btn btn-secondary ml-auto" href="{{ url()->previous() }}">
                                    Go Back
                                </a>
                            </div>
                            <div class="card-body mb-0 pb-0">
                                <table class="table table-responsive-sm table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Info</th>
                                            <th width="20%">Score</th>
                                            <th width="20%">Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($enrolments as $i => $e)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $e->student->user->name ?? '' }}</td>
                                                <td>
                                                    @php
                                                        $enrolment_subject = $e->getEnrolmentSubject($data->subject->id);
                                                    @endphp
                                                    <input type="number" class="form-control text-right score" 
                                                            max="{{ $data->number_of_items ?? '100' }}" 
                                                            name="score[{{$i}}]" 
                                                            required
                                                            value="{{ $enrolment_subject->studentGrade->where('grade_id',$data->id)->first()->score ?? 0 }}">
                                                    <input type="hidden" name="enrolment_subject_id[{{ $i }}]" value="{{ $enrolment_subject->id ?? '' }}">
                                                    <input type="hidden" name="grade_id[{{ $i }}]" value="{{ $data->id ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control text-right percentage" 
                                                            readonly 
                                                            placeholder="%" 
                                                            name="percentage[{{$i}}]"
                                                            value="{{ $enrolment_subject->studentGrade->where('grade_id',$data->id)->first() ? number_format($enrolment_subject->studentGrade->where('grade_id',$data->id)->first()->percentage,2) : 0 }}">
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
        $('.score').on('input',function(e) {
            var value = $(this).val();
            var total_items = $('#number_of_items').val();
            var percentage = value/total_items*100;
            $(this).closest('tr').find('.percentage').val(percentage.toFixed(2));
        });
    </script>
@endsection