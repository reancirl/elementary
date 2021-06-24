@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <h4>Send SMS</h4>
            <div class="d-flex mb-3">
                <button class="btn btn-secondary mr-3" id="btn-student">Search Student</button>
                {{-- <button class="btn btn-secondary mx-3" id="btn-parent">Search Parent</button> --}}
                <button class="btn btn-secondary" id="btn-bulk">Send in Bulk</button>
            </div>
            <form data-search-url="{{ route('sms.searchStudent') }}" method="GET" id="search-student">
                <div id="student-search" class="row search-div" style="display:none;">
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="student_first_name" name="student_first_name"
                            placeholder="Student First Name">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="student_last_name" name="student_last_name"
                            placeholder="Student Last Name" required>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-success" id="student-btn-search" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <div id="parent-search" class="row search-div" style="display:none;">
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="student_first_name" placeholder="Parent First Name">
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="student_last_name" placeholder="Parent Last Name">
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-success" id="parent-btn-search" type="button">Search</button>
                </div>
            </div>
            <div id="bulk-search" class="row search-div" style="display:none;">
                <div class="col-sm-5">
                    <select name="grade_level" id="grade_level" class="form-control"
                        data-url="{{ route('sms.searchWithGradeLevel') }}">
                        <option value="">-- Select Grade Level --</option>
                        <option value="all">All Grade Levels</option>
                        @foreach ($gls as $i => $gl)
                            <option value="{{ $gl->id }}">{{ $gl->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-5">
                    <select name="section" id="section" class="form-control">
                        <option value="">-- Select Section --</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-success" id="parent-btn-bulk" type="button"
                        data-url="{{ route('sms.sendBulk') }}">Select</button>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-8">
                    <div id="" class="sms-search-table card" style="display: none; max-height: 30vh; overflow: scroll">
                        <table class="table table-bordered table-hover table-sm">
                            <thead class="thead-default">
                                <tr>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Parents Contact #</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-12" style="" id="msg-alert">
                </div>
            </div>
            <form action="" id="form" class="row">
                <div class="col-md-12" style="margin-bottom:10px;">
                    <input type="text" placeholder="Numbers (if multiple, separate by comma)" id="numbers"
                        class="form-control">
                </div>
                <br>
                <div class="col-md-12" style="margin-bottom:24px;">
                    <textarea name="message" id="message" id="" cols="30" rows="10"
                        class="form-control">{{ $request->body ?? '' }}</textarea>
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
    <script>
        $('#btn-student').click(function(e) {
            $('#student-search').show();
            $('#parent-search').hide();
            $('#bulk-search').hide();
        });
        $('#btn-parent').click(function(e) {
            $('#parent-search').show();
            $('#student-search').hide();
            $('#bulk-search').hide();
        });
        $('#btn-bulk').click(function(e) {
            $('#bulk-search').show();
            $('#parent-search').hide();
            $('#student-search').hide();
        });

        $('#grade_level').change(function(e) {
            var url = $(this).data('url');
            var data = $(this).val();
            $.ajax({
                url: url,
                data: {
                    grade_level: data
                },
                success: function(data) {
                    var section = $('#section');
                    section.empty();
                    section.append('<option value="">-- Select Section --</option>')
                    $.each(data, function(key, value) {
                        section.append('<option value="' +
                            value.id + '">' +
                            value.name + '</option>')
                    });
                }
            });
        });

        $('#parent-btn-bulk').click(function(e) {
            var url = $(this).data('url');
            var grade_level = $('#grade_level').val();
            var section = $('#section').val();
            $('#numbers').val('');
            $.ajax({
                url: url,
                data: {
                    grade_level: grade_level,
                    section: section
                },
                success: function(data) {
                    console.log(data);
                    $('#numbers').val(data);
                }
            });
        });

        $('#search-student').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.data('search-url');
            var auto = $('.sms-search-table');
            auto.show();

            var table = auto.find('table');
            table.find('tbody').empty();

            $.ajax({
                url: url,
                data: form.serialize(),
                success: function(data) {
                    if (data.length > 0) {
                        $.each(data, function(i, item) {

                            var row = $('<tr class="add-phone-number" data-phone_number="' +
                                item.phone + '" style="cursor:pointer;">');

                            row.append('<td class="" ' + '>' + item.lname + '</td>');
                            row.append('<td class="" ' + '>' + item.fname + '</td>');
                            row.append('<td class="" ' + '>' + item.mname + '</td>');
                            row.append('<td class="" ' + '>' + item.phone + '</td>');
                            row.append('</tr>');

                            table.find('tbody').append(row);
                        });
                    } else {

                        table.find('tbody').empty();
                        var row = $('<tr>');

                        row.append(
                            '<td colspan="5" class="text-center">Voter Not Found / Voter does not have a phone number</td>'
                        );
                        row.append('</tr>');

                        table.find('tbody').append(row);
                    }
                },
                error: function() {
                    table.find('tbody').empty();
                    console.log('Item not found!');
                }
            });
        });

        $(document).on('click', '.add-phone-number', function() {
            var phone_number = $(this).data('phone_number');
            var current = $('#numbers').val();

            if (current == '') {
                var mixed = phone_number;
            } else {
                var mixed = current + ',' + phone_number;
            }

            $('.sms-search-table').hide();
            $('#numbers').val(mixed);
        })

    </script>
@endsection
