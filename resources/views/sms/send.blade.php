@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <h4>Send SMS to parents for those student who fail</h4>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-12" style="" id="msg-alert">
                </div>
            </div>
            <h6 class="mb-3 mt-4">Message will be sent to {{ $count ?? '0' }} parent(s)</h6>
            <form action="" id="form" class="row">
                <div class="col-md-12" style="margin-bottom:10px;">
                    <input type="text" placeholder="Numbers (if multiple, separate by comma)" id="numbers"
                        class="form-control" readonly value={{ $parents_phone_numbers ?? '' }}>
                </div>
                <br>
                <div class="col-md-12" style="margin-bottom:24px;">
                    <textarea name="message" id="message" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary" id="send-btn">
                        Send SMS
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="append-div"></div>
@endsection

@section('script')
    @include('sms._script')
@endsection
