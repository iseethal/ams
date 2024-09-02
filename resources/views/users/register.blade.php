<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<br><br>

<div class="container">
    <h4>Register Form</h4> <br>
    <form action="{{ route('register.save') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label"> Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="name">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
            <input type="text" name="user_name" class="form-control" id="user_name" placeholder="user name">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
