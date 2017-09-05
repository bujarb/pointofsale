@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- Centered Pills -->
            <ul class="nav nav-pills nav-justified">
                <li><a href="{{route('users-index')}}">Users</a></li>
                <li><a href="#">Sales</a></li>
                <li><a href="#">Menu 2</a></li>
                <li><a href="#">Menu 3</a></li>
            </ul>
        </div>
    </div>
@endsection