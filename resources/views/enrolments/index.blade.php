@extends('dashboard.base')

@section('content')
    @include('fees._transact')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="fa fa-align-justify"></i>  {{ __('Enrolments') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="get">
                                <div class="d-flex mb-4">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search Student ..." value="{{ $request->keyword ?? '' }}">
                                    <select name="sy_id" class="form-control">
                                        <option value="">-- Select School Year --</option>
                                        @foreach($sys as $i => $sy)
                                        <option value="{{ $sy->id }}" {{ $sy->id == $request->sy_id ? 'selected' : '' }}>{{ $sy->year_start }} - {{ $sy->year_end }}</option>
                                        @endforeach
                                    </select>
                                    <select name="grade_level_id" class="form-control">
                                        <option value="">-- Select Grade Level --</option>
                                        @foreach($gls as $i => $gl)
                                        <option value="{{ $gl->id }}" {{ $gl->id == $request->grade_level_id ? 'selected' : '' }}>{{ $gl->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary ml-2" type="submit">Search</button>
                                    <a href="{{ route('enrolments.index') }}" class="btn btn-danger">Clear</a>
                                </div>
                            </form>
                            <table class="table table-responsive-sm table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID Number</th>
                                        <th>Name</th>
                                        <th>Grade Level</th>
                                        <th>Sections</th>
                                        <th>Enroled By</th>
                                        <th>Date Enroled</th>
                                        <th>Status</th>
                                        @role('admin')
                                            <th>Action</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrolments as $i => $e)
                                        @if($e->section && $e->student)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $e->student->id_number ?? '' }}</td>
                                                <td>{{ $e->student->user->name ?? '' }}</td>
                                                <td>{{ $e->section->gradeLevel->name ?? '' }}</td>
                                                <td>{{ $e->section->name ?? '' }}</td>
                                                <td>{{ $e->enroledBy->name ?? '' }}</td>
                                                <td>{{ date('M d,Y',strtotime($e->created_at)) }}</td>
                                                <td>
                                                    @if($e->withdrawn)
                                                        <span class="badge badge-danger">Withdrawn</span>
                                                    @else
                                                        <span class="badge badge-success">Enroled</span>
                                                    @endif
                                                </td>
                                                @role('admin')
                                                    <td>
                                                        <a href="{{ route('enrolments.edit',$e->id) }}" class="btn btn-primary btn-sm">Update</a>
                                                    </td>
                                                @endrole
                                            </tr>
                                        @endif
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