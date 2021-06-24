@extends('dashboard.base')

@section('content')
    @include('school-years._create')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="fa fa-align-justify"></i>  {{ __('School Years') }}</h4>
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
                                        <th>School Year</th>
                                        <th>Status</th>
                                        <th>Enrolment Date</th>
                                        <th>Modify Enrolment: End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sys as $i => $sy)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $sy->year_start }} - {{ $sy->year_end }}</td>
                                            <td>{{ $sy->status ? 'Active' : '' }}</td>
                                            <td>
                                                @if($sy->enrolment_start_date)
                                                    {{ date('M d,Y',strtotime($sy->enrolment_start_date)) }} - {{ $sy->enrolment_end_date ? date('M d,Y',strtotime($sy->enrolment_end_date)) : 'N/A' }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $sy->enrolment_modify_date_limit ? date('M d,Y',strtotime($sy->enrolment_modify_date_limit)) : 'N/A' }}</td>
                                            <td>
                                                <form action="{{ route('school-years.destroy',$sy->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-primary btn-sm btn_view" data-url="{{ route('school-years.edit',$sy->id) }}">Edit</button>
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

