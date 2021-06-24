@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h4> {{ __('Update Announcement') }}</h4>
                            <a href="{{ route('announcements.index') }}" class="btn btn-primary ml-auto">
                                Go Back
                            </a> 
                        </div>
                        <form action="{{ route('announcements.update',$announcement->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <label for="title">Title</label>
                                <input type="text" class="form-control mb-3" id="title" placeholder="Title" name="title" value="{{ $announcement->title ?? '' }}">

                                <div class="d-flex mb-3">
                                    <select name="status" class="form-control">
                                        <option value="">-- Select Status --</option>
                                        <option value="1" {{ $announcement->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $announcement->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <select name="priority" class="form-control">
                                        <option value="">-- Select Priority --</option>
                                        <option value="1" {{ $announcement->priority == 1 ? 'selected' : '' }}>Top Priority</option>
                                        <option value="2" {{ $announcement->priority == 2 ? 'selected' : '' }}>High Priority</option>
                                        <option value="3" {{ $announcement->priority == 3 ? 'selected' : '' }}>Normal Priority</option>
                                    </select>
                                </div>

                                <label for="body">Content</label>
                                <textarea name="body" id="body" cols="30" rows="10" class="form-control mb-3">{{ $announcement->body ?? '' }}</textarea>

                                <div class="d-flex">
                                    <div class="ml-auto">
                                        <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Cancel</a>
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
@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection