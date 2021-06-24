@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="fa fa-align-justify"></i>  Section {{ $section->name ?? 'N/a' }} Subjects</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th width="30%">Input Grades</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($section->gradeLevel->subjects as $i => $subject)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $subject->name ?? '' }}</td>
                                            <td>{{ $subject->description ?? '' }}</td>
                                            <td>
                                                <a class="btn btn-secondary text-black btn-sm" href="{{ route('grades.type.create',[$section->id,$subject->id]) }}?type=Assignment">Assignment</a>
                                                <a class="btn btn-secondary text-black btn-sm" href="{{ route('grades.type.create',[$section->id,$subject->id]) }}?type=Activities">Activities</a>
                                                <a class="btn btn-secondary text-black btn-sm" href="{{ route('grades.type.create',[$section->id,$subject->id]) }}?type=Quizzes">Quizzes</a>
                                                <a class="btn btn-secondary text-black btn-sm" href="{{ route('grades.type.create',[$section->id,$subject->id]) }}?type=Exams">Exams</a>
                                                <br>
                                                <a class="btn btn-danger text-white btn-sm mt-1" href="{{ route('grades.overallGrade',[$section->id,$subject->id]) }}">Overall Grade</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="append-div"></div>
@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection