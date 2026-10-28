<!DOCTYPE html>
<html>
<head>
    <title>Employer Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card">

                <div class="card-header text-center">
                    <h3>Employer Sign Up</h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('employer.signup.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Create Employer Account
                        </button>

                    </form>

                    <hr>

                    <p class="text-center">
                        Already have an account?
                        <a href="{{ route('employer.signin') }}">
                            Sign In
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>