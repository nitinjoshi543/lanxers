@extends('adminend/layouts.main')

@section('main-section')
@php
$userData = session('user_data');
@endphp
<style>
    .dataTables_filter {
        display: none !important;
    }

    .dataTables_length {
        display: none !important;
    }

    #searchQuery {
        width: 300px;
        /* Adjust the width of the input field */
        height: 40px;
        /* Set the height of the input */
        padding: 5px 10px;
        /* Add padding inside the input */
        font-size: 16px;
        /* Adjust font size */
    }

    #searchBtn {
        height: 40px;
        /* Match the height of the button to the input field */
        padding: 0 20px;
        /* Add horizontal padding to the button */
        font-size: 16px;
        /* Adjust font size */
        background-color: #007bff;
        /* Set the button background color */
        color: white;
        /* Set the text color of the button */
        border: none;
        /* Remove default border */
        cursor: pointer;
        /* Change the cursor to pointer on hover */
    }

    #searchBtn:hover {
        background-color: #0056b3;
        /* Change the button color on hover */
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        border-radius: 5px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    /* Range Slider Styles */
    .range {
        margin: 20px 0;
        padding: 0 15px;
        max-width: 600px; /* Ensure slider doesn't stretch too wide */
    }

    .range-slider {
        height: 5px;
        position: relative;
        background-color: #e1e9f6;
        border-radius: 2px;
        margin-bottom: 20px;
    }

    .range-selected {
        height: 100%;
        position: absolute;
        border-radius: 2px;
        background-color: #1b53c0;
        z-index: 1; /* Ensure selected range is above track */
    }

    .range-input {
        position: relative;
        height: 5px;
    }

    .range-input input {
        position: absolute;
        width: 100%;
        height: 5px;
        top: -7px;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        z-index: 2;
    }

    .range-input input::-webkit-slider-thumb {
        height: 20px;
        width: 20px;
        border-radius: 50%;
        border: 3px solid #1b53c0;
        background-color: #fff;
        pointer-events: auto;
        -webkit-appearance: none;
        cursor: pointer;
        z-index: 3;
    }

    .range-input input::-moz-range-thumb {
        height: 15px;
        width: 15px;
        border-radius: 50%;
        border: 3px solid #1b53c0;
        background-color: #fff;
        pointer-events: auto;
        -moz-appearance: none;
        cursor: pointer;
        z-index: 3;
    }

    .range-price {
        margin: 10px 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .range-price label {
        margin-right: 5px;
        font-size: 14px;
    }

    .range-price input {
        width: 100px;
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .range-price input[type="date"] {
        width: 150px;
    }

    .range-price input[type="button"] {
        padding: 8px 20px;
        font-size: 14px;
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Achievement</h5>
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
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
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
                                <div style="margin-top: 10px;">
                                    <input type="text" id="searchQuery" name="searchQuery" placeholder="Enter email">
                                    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                                    <button id="searchBtn">Search</button>
                                </div>
                                <!-- Range Slider -->
                                <div class="range">
                                    <div class="range-slider">
                                        <span class="range-selected"></span>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="min" min="50000" max="10000000" value="50000" step="10000">
                                        <input type="range" class="max" min="100000" max="10000000" value="100000" step="10000">
                                    </div>
                                    <div class="range-price">
                                        <label for="min">Min</label>
                                        <input type="number" name="min" value="50000" id="min">
                                        <label for="max">Max</label>
                                        <input type="number" name="max" value="100000" id="max">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date">
                                        <label>&nbsp;&nbsp;</label>
                                        <input type="button" class="btn btn-warning" id="search" value="Search">
                                    </div>
                                </div>
                                <table class="table table-hover" id="userList">
                                    <thead>
                                        <tr>
                                            <th>UID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date of Last Earning</th>
                                            <th>Earning</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="proposalBody">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Would you like to mark this achievement as done?</p>
            <input type="hidden" id="update_users_id">
            <input type="hidden" id="update_amount">
            <button class="btn btn-sm btn-success" id="updateAchievement">Yes</button>
            <button class="btn btn-sm btn-secondary" id="cancelModal">No</button>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var baseUrl = "{{ url('/') }}";
        var table = $('#userList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get.achievement.list') }}", // Route to fetch data
                type: "GET",
                data: function(d) {
                    d.searchQuery = $('#searchQuery').val(); // Pass search value manually
                    d.min = $('#min').val();
                    d.max = $('#max').val();
                    d.date = $('#date').val();
                }
            },
            columns: [{
                    data: 'users_id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'date'
                },
                {
                    data: 'balance_money'
                },
                /*{
                    data: null,
                    render: function(data, type, row, meta) {
                        var index = meta.row + 1; // DataTable row index (1-based for unique IDs)
                        return `
                            <button class="btn btn-sm btn-info markAsDone" 
                                    data-id="${row.users_id}" 
                                    data-name="${row.name}" 
                                    data-amount="${row.balance_money}" 
                                    data-index="${index}">
                                Mark as Done
                            </button>
                            <input type="hidden" id="users_id${index}" value="${row.users_id}">
                            <input type="hidden" id="name${index}" value="${row.name}">
                            <input type="hidden" id="amount${index}" value="${row.balance_money}">
                        `;
                    }
                }*/
            ]
        });

        // Handle Search Button Click
        $('#searchBtn').click(function() {
            var searchQuery = $('#searchQuery').val();
            if (searchQuery.length >= 2) {
                table.ajax.reload(); // Reload DataTable with new search filter
            } else {
                alert('Please enter at least 2 characters to search.');
            }
        });

        // Handle Range Slider Search Button Click
        $('#search').click(function() {
            var min = $('#min').val();
            var max = $('#max').val();
            var date = $('#date').val();
            if (min && max && parseInt(max) >= parseInt(min)) {
                table.ajax.reload();
            } else {
                alert('Please ensure the max amount is greater than or equal to the min amount.');
            }
        });

        // Range Slider JavaScript
        let rangeMin = 50000;
        const range = document.querySelector(".range-selected");
        const rangeInput = document.querySelectorAll(".range-input input");
        const rangePrice = document.querySelectorAll(".range-price input");

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minRange = parseInt(rangeInput[0].value);
                let maxRange = parseInt(rangeInput[1].value);
                if (maxRange - minRange < rangeMin) {
                    if (e.target.className === "min") {
                        rangeInput[0].value = maxRange - rangeMin;
                    } else {
                        rangeInput[1].value = minRange + rangeMin;
                    }
                } else {
                    rangePrice[0].value = minRange;
                    rangePrice[1].value = maxRange;
                    range.style.left = (minRange / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxRange / rangeInput[1].max) * 100 + "%";
                }
            });
        });

        rangePrice.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(rangePrice[0].value);
                let maxPrice = parseInt(rangePrice[1].value);
                if (maxPrice - minPrice >= rangeMin && maxPrice <= rangeInput[1].max) {
                    if (e.target.name === "min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else if (e.target.name === "max") {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        // Modal handling
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        var cancelBtn = document.getElementById("cancelModal");

        // Open modal on "Mark as Done" click
        $(document).on('click', '.markAsDone', function(e) {
            e.preventDefault();
            var users_id = $(this).data('id');
            var name = $(this).data('name');
            var amount = $(this).data('amount');

            $.ajax({
                type: "POST",
                url: "{{ route('setAchievementRecord') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    users_id: users_id,
                    name: name,
                    amount: amount
                },
                success: function(result) {
                    if (result == 1) {
                        $("#update_users_id").val(users_id);
                        $("#update_amount").val(amount);
                        modal.style.display = "block";
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                    alert('An error occurred while processing the request.');
                }
            });
        });

        // Confirm "Mark as Done" in modal
        $('#updateAchievement').click(function(e) {
            e.preventDefault();
            var users_id = $("#update_users_id").val();
            var amount = $("#update_amount").val();

            $.ajax({
                type: "POST",
                url: "{{ route('updateAchievementRecords') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    users_id: users_id,
                    amount: amount
                },
                success: function(result) {
                    modal.style.display = "none";
                    table.ajax.reload(); // Refresh DataTable
                    alert('Achievement marked as done successfully.');
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                    alert('An error occurred while updating the record.');
                }
            });
        });

        // Close modal on "No" or "X"
        span.onclick = function() {
            modal.style.display = "none";
        };
        cancelBtn.onclick = function() {
            modal.style.display = "none";
        };

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    });
</script>
@endsection