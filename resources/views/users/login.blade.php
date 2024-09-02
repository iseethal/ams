<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<br><br>

<div class="container">
    <h4>Login Form</h4> <br>

    @if (Session::has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong> {{ session::get('error') }}</strong>
        </div>
    @endif

    <form action="{{ route('user.check-login') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">User Name</label>
            <input type="text" name="user_name" class="form-control" placeholder="user name">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="password">
        </div>
        <div class="mb-3 form-check">
            <a href="{{ route('user.register') }}">Register</a>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
