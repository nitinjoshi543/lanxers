<!DOCTYPE html>
<html>

<head>
    <title>Freelancer Sign In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card">

                <div class="card-header text-center">
                    <h3>Freelancer Sign In</h3>
                </div>

                <div class="card-body">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Validation / Login Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                required
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required
                            >

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Sign In
                        </button>

                    </form>

                    <hr>

                    <p class="text-center mb-0">
                        Don't have an account?
                        <a href="{{ route('freelancer.signup') }}">
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