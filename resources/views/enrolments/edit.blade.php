@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <h4><i class="fa fa-align-justify"></i> {{ __('Update Enrolment') }}</h4>
                        <a href="{{ url()->previous() }}" class="btn btn-primary ml-auto">
                            Go Back
                        </a>
                    </div>
                    <form action="{{ route('enrolments.update',$enrolment->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-4">
                                    <label for="id_number">ID Number</label>
                                    <input type="text" id="id_number" name="" class="form-control" readonly value="{{ $enrolment->student->id_number ?? '' }}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="" class="form-control" readonly value="{{ $enrolment->student->user->name ?? '' }}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="gradeLevel">Grade Level</label>
                                    <input type="text" id="gradeLevel" name="" class="form-control" readonly value="{{ $enrolment->section->gradeLevel->name ?? '' }}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <label for="section">Section</label>
                                    <select name="section_id" id="section" class="form-control">
                                        @foreach($sections as $s)
                                            <option value="{{ $s->id }}" {{ $s->id == $enrolment->section_id ? 'selected' : '' }}>{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="0" {{ $enrolment->withdrawn == 0 ? 'selected' : '' }}>Enroled</option>
                                        <option value="1" {{ $enrolment->withdrawn == 1 ? 'selected' : '' }}>Withdraw</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="ml-auto">
                                    <a href="{{ route('enrolments.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Update</button>
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
<script type="text/javascript">

</script>
@endsection