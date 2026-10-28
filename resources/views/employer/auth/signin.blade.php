<!DOCTYPE html>
<html>
<head>
    <title>Employer Sign In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card">

                <div class="card-header text-center">
                    <h3>Employer Sign In</h3>
                </div>

                <div class="card-body">

                    <form action="{{ route('employer.signin.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-success w-100">
                            Sign In
                        </button>

                    </form>

                    <hr>

                    <p class="text-center">
                        Don't have an account?
                        <a href="{{ route('employer.signup') }}">
                            Sign Up
                        </a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>