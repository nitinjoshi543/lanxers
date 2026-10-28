@extends('adminend/layouts.main')

@section('main-section')
@php
$userData = session('user_data');
@endphp

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">User</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Details</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                    <!-- <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('sunday.blockbuster.add') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>&nbsp;&nbsp;
                            <span> Add New </span>
                        </a>
                    </div> -->
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <form action="" id="userForm">
                                    @csrf
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Name</th>
                                            <td>
                                                <span class="details">{{ $user->name }}</span>
                                                <input type="hidden" name="user_id" value="{{ $user->users_id }}">
                                                <input type="text" class="inputtext" name="name" value="{{ $user->name }}" style="display:none;">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td>
                                                <span class="details">{{ $user->email }}</span>
                                                <input type="text" class="inputtext" name="email" value="{{ $user->email }}" style="display:none;">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Phone</th>
                                            <td>
                                                <span class="details">{{ $user->phone }}</span>
                                                <input type="text" class="inputtext" name="phone" value="{{ $user->phone }}" style="display:none;">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="details">Sponser Name</th>
                                            <th class="inputtext" style="display:none;">Affiliate Promocode</th>
                                            <td>
                                                <span class="details">{{ $sponser_detail->name }} ({{ $sponser_detail->email }})</span>
                                                <span class="inputtext" style="display:none;">
                                                    <input type="text" name="sponser" value="{{ $sponser_detail->affiliate }}">
                                                </span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Created On</th>
                                            <td>
                                                {{ $user->created_on }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Action</th>
                                            <td>
                                                <button class="btn btn-sm btn-success" type="button" id="editDetails"> Edit</button>
                                                <button class="btn btn-sm btn-success inputwraper" type="button" id="submitDetails" style="display: none;">Submit</button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Password Re-Genrate</th>
                                            <td>
                                                <button class="btn btn-sm btn-success" id="passwordUpdate">Generate Password</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#passwordUpdate').click(function(event) {
            var users_id = "<?php echo $user->users_id; ?>";

            $.ajax({
                url: "{{ route('find.user.passwordupdate') }}",
                type: 'POST',
                data: {
                    '_token' : '{{ csrf_token() }}',
                    'users_id': users_id
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.status == 'success') {
                        alert('Password Updated. Password is 123456');
                    } else {
                        alert('Error: ' + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error submitting the form');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#submitDetails').click(function(event) {
            event.preventDefault();
            var formData = $('#userForm').serialize();

            $.ajax({
                url: "{{ route('find.users.update.details') }}", // Replace with your server-side script
                type: 'POST',
                data: formData,
                success: function(response) {
                    var data = JSON.parse(response); // Parse the JSON response
                    if (data.status == 'success') {
                        alert('Form submitted successfully');
                        location.reload();
                    } else {
                        alert('Error: ' + data);
                    }

                    // Optionally, handle the response from the server
                },
                error: function() {
                    alert('Error submitting the form');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#viewNumber').click(function() {
            var users_id = <?= $user->users_id; ?>;
            $.ajax({
                url: "{{ route('viewNumber') }}",
                type: 'POST',
                data: {
                    users_id: users_id
                },
                success: function(response) {
                    $('#phoneNumber').text(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#editDetails').click(function() {
            $(".inputtext").show();
            $('.details').hide();
            $(this).hide();
            $('#submitDetails').show();
        });
    });
</script>
@endsection