<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@php
    $user = session()->get('user');
    $user_id = $user->user_id;

@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="dashboard">AMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.list') }}">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('attendance.data') }}">Attendance data</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('attendance.report') }}">Attendance Report</a>
            </li>

            <li class="nav-item">

                <form id="logout-form" action="{{ route('user.logout') }}" method="POST">
                    @csrf

                    <input type="hidden" name="user_id" value="{{ $user_id }}">


                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>

            </li>

        </ul>

    </div>
</nav>
