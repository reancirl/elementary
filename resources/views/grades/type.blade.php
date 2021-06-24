@extends('dashboard.base')

@section('content')
    @include('grades._create')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="fa fa-align-justify"></i>  Section {{ $section->name ?? 'N/a' }} - {{ $subject->name ?? 'N/a' }} : {{ $request->type ?? '' }}</h4>
                            <button class="btn btn-primary ml-auto" type="button" data-toggle="modal" data-target="#primaryModal">
                            <i class="cil-plus"></i>
                                Create
                            </button> 
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th># of Items</th>
                                        <th>Passing Score</th>
                                        <th>Deadline</th>
                                        <th width="15%">Input Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $i => $d)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $d->name ?? '' }}</td>
                                            <td>{{ $d->number_of_items ?? '0' }}</td>
                                            <td>{{ $d->passing_score ?? '0' }}</td>
                                            <td>{{ $d->deadline ?? 'N/a' }}</td>
                                            <td>
                                                <a class="btn btn-primary text-black btn-sm" href="{{ route('grades.edit',$d->id) }}">View Students</a>
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