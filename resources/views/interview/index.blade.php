@extends('layouts.main')

@section('main-section')

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header">
            <h3>AI Interview</h3>
        </div>

        <div class="card-body">

            <h4>Welcome!</h4>

            <p>
                Please complete your AI interview before your application is reviewed.
            </p>

            <table class="table table-bordered">

                <tr>
                    <th>Total Questions</th>
                    <td>{{ $interview->total_questions }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($interview->status) }}</td>
                </tr>

            </table>

            <a href="{{ route('ai.interview.start', $interview->id) }}"
               class="btn btn-primary">

                Start Interview

            </a>

        </div>

    </div>

</div>

<noscript>
    <div class="alert alert-danger text-center mt-5">
        <h4>JavaScript Required</h4>
        <p>
            JavaScript is required to complete the AI Interview.
            Please enable JavaScript in your browser and reload the page.
        </p>
    </div>

    <style>
        body * {
            display: none !important;
        }

        noscript,
        noscript * {
            display: block !important;
        }
    </style>
</noscript>
@endsection