@extends('dashboard.base')

@section('content')
    @include('fees._transact')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="fa fa-align-justify"></i>  {{ __('Fees') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="get">
                                <div class="d-flex mb-4">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search Student ..." value="{{ $request->keyword ?? '' }}" required>
                                    <button class="btn btn-primary ml-2" type="submit">Search</button>
                                    <a href="{{ route('fees.index') }}" class="btn btn-danger">Clear</a>
                                </div>
                            </form>
                            <table class="table table-responsive-sm table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student</th>
                                        <th>Grade Level</th>
                                        <th>Sections</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fees as $i => $fee)
                                        @if($fee->student)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $fee->student->id_number ?? 'N/a' }} - {{ $fee->student->user->name ?? '' }}</td>
                                                <td>{{ $fee->enrolment->section->gradeLevel->name ?? '' }}</td>
                                                <td>{{ $fee->enrolment->section->name ?? '' }}</td>
                                                <td>
                                                    @if(isset($fee->transactions))
                                                        <span style="color:blue;cursor:pointer" class="remaining_balance_btn" data-url="{{ route('transactions.show',$fee->id) }}">
                                                            <u>{{ $fee->remaining_balance ?? 'N/a' }}</u>
                                                        </span>
                                                    @else
                                                        {{ $fee->remaining_balance ?? 'N/a' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm btn_transact" 
                                                    data-id="{{ $fee->id ?? 0 }}" 
                                                    data-balance="{{ $fee->remaining_balance ?? '0.00'}}" 
                                                    data-student="{{ $fee->student->user->name ?? '' }}" >
                                                        Transact
                                                    </button>
                                                </td>
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
        $('.btn_transact').click(function(e) {
            var remaining_balance = $(this).data('balance');

            if(remaining_balance == 0) {
                swal ({
                    text: 'No pending balance',
                    icon: 'error',
                    button: 'OK',
                });
            } else {
                $('#primaryModal').modal('show');
                var student_name = $(this).data('student');
                $('#student_name').html(student_name);

                $('#remaining_balance').val(remaining_balance);

                var id = $(this).data('id');
                $('#fee_id').val(id);
            }            
        });

        $('#paid_amount').on('input',function(e) {
            var amount = $(this).val();
            var balance = $('#remaining_balance').val();
            var change = balance - amount;
            $('#change_amount').val(change.toFixed(2));
        });

        $('.remaining_balance_btn').click(function(e) {
            var div = $('.append-div');
            div.empty();
            var url = $(this).data('url');
            $.ajax({
			    url: url,
			    success:function(data){
			        div.append(data);
			        $('#history_modal').modal('show');
			    }
			});
        });
    </script>
@endsection