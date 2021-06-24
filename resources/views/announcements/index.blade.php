@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="fa fa-align-justify"></i> {{ __('Announcements') }}</h4>
                            <a href="{{ route('announcements.create') }}" class="btn btn-primary ml-auto">
                                <i class="cil-plus"></i>
                                Create
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($announcements as $i => $ann)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $ann->title ?? '' }}</td>
                                            <td>
                                                @if ($ann->priority == 1)
                                                    <span class="badge badge-danger">Top Prio</span>
                                                @elseif ($ann->priority == 2)
                                                    <span class="badge badge-success">High Prio</span>
                                                @else
                                                    <span class="badge badge-secondary">Normal Prio</span>
                                                @endif
                                            </td>
                                            <td>{{ $ann->status ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <form action="{{ route('announcements.destroy', $ann->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('announcements.edit', $ann->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm btn_delete">Delete</button>
                                                    <a href="{{ route('sms.index') }}?body={{ $ann->body }}"
                                                        class="btn btn-success btn-sm">Send
                                                        SMS</a>
                                                </form>
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
@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection
