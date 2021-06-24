@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="cil-paperclip"></i>  {{ $student->user->name ?? '' }} : {{ __('Grades') }}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Score</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tests as $i => $test)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $test->subject_name ?? '' }}</td>
                                            <td>{{ $test->type ?? '' }}</td>
                                            <td>{{ $test->name ?? '' }}</td>
                                            <td>{{ $test->score ?? '0' }} / {{ $test->number_of_items }}</td>
                                            <td>{{ $test->percentage ?? '0' }}%</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No Activity / Exam yet!</td>
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