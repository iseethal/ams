@include('template')

@php
    $user = session()->get('user');
    $name = $user->name;

@endphp


<div class="container" style="padding-top: 30px">


    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{ session::get('success') }}</strong>
        </div>
    @endif

    <h3>Welcome {{ $name }}</h3>
</div>
