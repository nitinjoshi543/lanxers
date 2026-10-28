@extends('adminend/layouts.main')

@section('main-section')
<style>
    .check_list {
        flex-wrap: wrap;
    }

    .document-editor,
    .document-editor2,
    .document-editor3 {
        border: 1px solid #ccc;
        /* max-width: 900px; */
        margin: auto;
        padding: 20px;
        background: #f9f9f9;
    }

    .document-editor__toolbar,
    .document-editor__toolbar2,
    .document-editor__toolbar3 {
        border-bottom: 1px solid #ddd;
        background: #fff;
        padding: 10px;
    }

    .document-editor__editable-container,
    .document-editor__editable-container2,
    .document-editor__editable-container3 {
        padding: 10px;
        background: white;
    }

    #editor,
    #editor2,
    #editor3 {
        height: 300px !important;
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Cashback Module</h5>
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
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="main-content">
            <div class="row">
                <div class="col-12">
                    <div class="card stretch stretch-full">
                        <form id="cashbackUploadForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label">Upload CSV <span class="text-danger">*</span></label>
                                        <input type="file" name="file" class="form-control" accept=".csv" required>

                                        <small class="text-muted d-block mt-2">CSV Format Example:</small>
                                        <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/68d631a15e8b5.jpg" alt="CSV format demo" class="img-fluid border mt-2" style="max-width: 400px;">
                                    </div>
                                </div>

                                <hr class="my-0"> <br />
                                <button type="submit" class="btn btn-primary">Upload Cashback CSV</button>
                            </div>
                        </form>
                        <div class="progress mt-3" style="height: 25px; display: none;" id="progressWrapper">
                            <div id="uploadProgress" class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar" style="width: 0%">0%</div>
                        </div>
                        <div id="uploadMessage" class="mt-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#cashbackUploadForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.cashbacks.upload') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            xhr: function() {
                let xhr = new window.XMLHttpRequest();

                // Progress event
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $("#progressWrapper").show();
                        $("#uploadProgress")
                            .css("width", percentComplete + "%")
                            .text(percentComplete + "%");
                    }
                }, false);

                return xhr;
            },
            beforeSend: function() {
                $('#uploadMessage').html('');
                $("#progressWrapper").show();
                $("#uploadProgress").css("width", "0%").text("0%");
            },
            success: function(response) {
                if (response.success) {
                    let skippedHtml = "";
                    if (response.skipped_records && response.skipped_records.length > 0) {
                        skippedHtml = "<br><strong>Skipped Emails:</strong><ul>";
                        response.skipped_records.forEach(function(email) {
                            skippedHtml += "<li>" + email + "</li>";
                        });
                        skippedHtml += "</ul>";
                    }

                    $('#uploadMessage').html(
                        '<div class="alert alert-success">' + response.message + skippedHtml + '</div>'
                    );
                } else {
                    $('#uploadMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
                $("#uploadProgress").removeClass("progress-bar-animated");
            },
            error: function(xhr) {
                let err = xhr.responseJSON?.message || "Something went wrong!";
                $('#uploadMessage').html('<div class="alert alert-danger">' + err + '</div>');
                $("#uploadProgress").removeClass("progress-bar-animated").addClass("bg-danger").text("Failed");
            }
        });
    });
</script>
@endsection