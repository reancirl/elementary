@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h4><i class="fa fa-align-justify"></i> {{ __('Students') }}</h4>
                        <a href="{{ route('students.create') }}" class="btn btn-primary ml-auto">
                            <i class="cil-plus"></i>
                            Create
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="get">
                            <div class="d-flex mb-4">
                                <input type="text" class="form-control" name="keyword" placeholder="Search Student ...">
                                <select name="grade_level_id" class="form-control">
                                    <option value="">-- Select Grade Level --</option>
                                    @foreach($gls as $i => $gl)
                                    <option value="{{ $gl->id }}">{{ $gl->name ?? '' }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary ml-2" type="submit">Search</button>
                                <a href="{{ route('students.index') }}" class="btn btn-danger">Clear</a>
                            </div>
                        </form>
                        <table class="table table-responsive-sm table-striped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Number</th>
                                    <th>Name</th>
                                    <th>Grade Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $i => $s)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $s->id_number ?? '' }}</td>
                                    <td>{{ $s->user->name ?? '' }}</td>
                                    <td>{{ $s->latestEnrolment ? $s->latestEnrolment->gradeLevel->name : $s->gradeLevel->name }}</td>
                                    <td>
                                        <a href="{{ route('students.show',$s->id) }}" class="btn btn-success btn-sm">View</a>
                                        <a href="{{ route('students.edit',$s->id) }}" class="btn btn-primary btn-sm">Edit</a>
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