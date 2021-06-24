@extends('dashboard.base')

@section('content')
    @include('sections._create')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="fa fa-align-justify"></i>  {{ __('Sections') }}</h4>
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
                                        <th>Grade Level</th>
                                        <th>Adviser</th>
                                        <th>Number of Subjects</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($secs as $i => $sec)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $sec->name ?? '' }}</td>
                                            <td>{{ $sec->gradeLevel->name ?? '' }}</td>
                                            <td>{{ $sec->adviser->name ?? 'Not Assigned' }}</td>
                                            <td>{{ $sec->gradeLevel->subjects->count() ?? '0' }}</td>
                                            <td>{{ $sec->status ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <form action="{{ route('sections.destroy',$sec->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-primary btn-sm btn_view" data-url="{{ route('sections.edit',$sec->id) }}">Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm btn_delete">Delete</button>
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
    <div class="append-div"></div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.btn_view').click(function(e) {
            var div = $('.append-div');
            div.empty();
            var url = $(this).data('url');
            $.ajax({
			    url: url,
			    success:function(data){
			        div.append(data);
			        $('#edit_modal').modal('show');
			    }
			});
        });
    </script>
@endsection