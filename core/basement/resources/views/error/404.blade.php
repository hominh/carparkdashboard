@extends('carparkdashboard-base::layout')
@section('title', 'Error')
@section('page')
        <div class="content-wrapper">
        <div class="col-md-10">
            <h3>Page could not be found</h3>
            <p>This may have occurred because of several reasons</p>
            <ul>
                The page you requested does not exist.
                        The link you clicked is no longer.
                        The page may have moved to a new location.
                        An error may have occurred.
                        You are not authorized to view the requested resource.
            </ul>

            <p>Please try again in a few minutes, or alternatively return to the homepage by <a href="#">clicking here</a>.</p>
        </div>
    </div>
@endsection
