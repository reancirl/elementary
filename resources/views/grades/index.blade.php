@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="fa fa-align-justify"></i>  {{ __('Grades') }}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Grade Level</th>
                                        <th width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sections as $i => $sec)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $sec->name ?? '' }}</td>
                                            <td>{{ $sec->gradeLevel->name ?? '' }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-primary text-black btn-sm" href="{{ route('grades.show',$sec->id) }}">View Subjects</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No Assigned Sections!</td>
                                        </tr>
                                    @endforelse
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