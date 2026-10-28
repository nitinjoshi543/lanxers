@extends('adminend/layouts.main')

@section('main-section')
<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">User Module</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">List</li>
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
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <!-- <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            <i class="feather-bar-chart"></i>
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 12" data-bs-auto-close="outside">
                                <i class="feather-filter"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-eye me-3"></i>
                                    <span>All</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-send me-3"></i>
                                    <span>Sent</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-book-open me-3"></i>
                                    <span>Open</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-archive me-3"></i>
                                    <span>Draft</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-bell me-3"></i>
                                    <span>Revised</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-shield-off me-3"></i>
                                    <span>Declined</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-check me-3"></i>
                                    <span>Accepted</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-briefcase me-3"></i>
                                    <span>Leads</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-wifi-off me-3"></i>
                                    <span>Expired</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-users me-3"></i>
                                    <span>Customers</span>
                                </a>
                            </div>
                        </div> -->
                        <!-- <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 12" data-bs-auto-close="outside">
                                <i class="feather-paperclip"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-pdf me-3"></i>
                                    <span>PDF</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-csv me-3"></i>
                                    <span>CSV</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-xml me-3"></i>
                                    <span>XML</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-txt me-3"></i>
                                    <span>Text</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-exe me-3"></i>
                                    <span>Excel</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-printer me-3"></i>
                                    <span>Print</span>
                                </a>
                            </div>
                        </div> -->
                    </div>
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
                                <table class="table table-hover" id="proposalList">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Amount</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="proposalBody">
                                        @foreach ($tbl_self_withdrawl_request as $request)

                                        <tr class="single-item">
                                            <td>{{ $request->name }}</td>
                                            <td>{{ $request->email }}</td>
                                            <td>{{ $request->amount }}</td>
                                            <td>{{ $request->created_on }}</td>
                                            <td>
                                                <div id="status" class="d-flex gap-3">
                                                    <button class="btn btn-sm btn-info" onclick="setUserToRequestForm({{ $request->id }}, 0, '{{ $request->admin_email }}')">Approve</button> |
                                                    <button class="btn btn-sm btn-danger" onclick="StatusAjax(this, 2, {{ $request->id }});">Disapprove</button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="vd_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Self Payout Request</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" id="details-form" action="{{ route('approve.self.pay.status') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_request">
                    <input type="hidden" name="status" id="id_request_status">
                    <div class="form-group" style="margin-bottom:8px;">
                        <!-- <input type="hidden" placeholder="Enter Mobile Number" id="getnumber" required class="form-control" name="mobile"> -->
                        <input type="hidden" placeholder="Enter Email ID" id="getnumber" required class="form-control" name="email">
                    </div>
                    <div class="form-group fSty" style="margin-bottom:8px;">
                        <input type="text" placeholder="OTP" required class="form-control" name="otp">
                        <i class="regenerate_otp btn btn-success">Generate OTP</i>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#details-form').submit(function(e) {
            // Prevent the default form submission
            e.preventDefault();

            // Check if the button is disabled
            if ($('#submit-btn').prop('disabled')) {
                // If already disabled, return false to prevent multiple submissions
                return false;
            }

            // Disable the submit button to prevent multiple submissions
            $('#submit-btn').prop('disabled', true);

            // Show loader if needed
            //   $('#loader').show();

            // Submit the form
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                }
            });
        });
    });

    function StatusAjax(e, status, id) {
        var url = "{{ route('disapprove.self.pay.status') }}?status=" + status + "&id=" + id;

        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                var html = '';
                if (data === '1') {
                    html = `<button class="btn btn-sm btn-info">Approved</button>`;
                } else if (data === '2') {
                    html = `<button class="btn btn-sm btn-danger">Disapproved</button>`;
                }
                // Ensure correct parent div is updated
                $(e).closest('div').html(html);
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }

    function setUserToRequestForm(id, status, mobile) {
        // alert(status);
        $('#id_request').val(id);
        $('#id_request_status').val(status);
        $('#getnumber').val(mobile);

        $('#vd_popup').modal('show');
    }

    $(".regenerate_otp").click(function() {
        var whatsapp = $("#getnumber").val();
        var id = $("#id_request").val();

        var url = "{{ url('admin/self-pay-otp') }}/" + encodeURIComponent(whatsapp) + "/" + id;

        $.ajax({
            url: url,
            success: function(result) {
                if (result == 0) {
                    alert("Username/Email not found.");
                } else if (result == 1) {
                    alert("OTP sended to super admin mail id");
                }
            }
        });
    });
</script>

@endsection