@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4><i class="fa fa-align-justify"></i> {{ __('School Details') }}</h4>
                        </div>
                        <form action="{{ route('dashboard.schoolInfoStore') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <label for="last_name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" required
                                            value="{{ $school->name ?? '' }}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address" class="form-control" required
                                            value="{{ $school->address ?? '' }}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <label for="address">Image</label>
                                        <input type="file" id="image" name="image">
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <div class="ml-auto">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="append-div"></div>
@endsection

@section('script')

@endsection
