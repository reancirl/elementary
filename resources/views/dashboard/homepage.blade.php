@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    @role('admin|cashier')
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-primary p-3">
                    <h5>Total Number of Students</h5>
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-users" style="font-size:3rem"></i>
                        <h1 class="ml-4">{{ $student_count ?? '0' }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-success p-3">
                    <h5>Total Number of Enrolees</h5>
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-graduation-cap" style="font-size:3rem"></i>
                        <h1 class="ml-4">{{ $enrolees_count ?? '0' }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-warning p-3">
                    <h5>Total Number of Sections</h5>
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-list" style="font-size:3rem"></i>
                        <h1 class="ml-4">{{ $section_count ?? '0' }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-danger p-3">
                    <h5>Total Number of Teachers</h5>
                    <div class="d-flex justify-content-center">
                        <i class="fa fa-user" style="font-size:3rem"></i>
                        <h1 class="ml-4">{{ $teachers_count ?? '0' }}</h1>
                    </div>
                </div>
            </div>
        </div>
    @endrole
    @role('parent')
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-danger p-3">
                    <h4 class="text-center font-weight-bold">Remaining Balance</h4>
                    <h1 class="ml-4">₱ {{ number_format($balance,2) }}</h1>
                </div>
            </div>
        </div>
    @endrole
    <h3>Announcements</h3>
    <table class="table table-responsive-sm table-striped text-center">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Title</th>
                <th>Priority</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($announcements as $i => $a)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $a->title ?? '' }}</td>
                    <td>
                        @if($a->priority == 1)
                            <span class="badge badge-danger">Top Prio</span>
                        @elseif ($a->priority == 2)
                            <span class="badge badge-success">High Prio</span>
                        @else
                            <span class="badge badge-secondary">Normal Prio</span>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm btn_announcement"
                        data-title="{{ $a->title }}"
                        data-content="{!! $a->body !!}"
                        data-priority={{ $a->priority }}>
                            Full Content
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('dashboard._announcement')

@endsection

@section('script')
    <script type="text/javascript">
        $('.btn_announcement').click(function(e) {
            var title = $(this).data('title');
            var content = $(this).data('content');
            var priority = $(this).data('priority');

            $('.modal-title').html(title);
            $('#content').html(content);

            $('#announcement_modal').modal('show');
        });

    </script>
    {{-- <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script> --}}
@endsection
