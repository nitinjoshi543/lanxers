@extends('layouts.main')

@section('main-section')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">

                        <h4 class="mb-0">
                            AI Interview
                        </h4>

                        <span class="badge bg-primary">
                            Question {{ $currentQuestion }} of {{ $interview->total_questions }}
                        </span>

                    </div>

                </div>

                <div class="card-body">

                    {{-- Progress Bar --}}

                    @php
                    $progress = ($currentQuestion / $interview->total_questions) * 100;
                    @endphp

                    <div class="progress mb-4" style="height:10px;">

                        <div class="progress-bar"
                            role="progressbar"
                            style="width: {{ $progress }}%">

                        </div>

                    </div>


                    <h5 class="mb-4">

                        {{ $question->question }}

                    </h5>


                    <form method="POST"
                        action="{{ route('ai.interview.answer') }}">

                        @csrf

                        <input type="hidden" name="interview_id" id="interview_id" value="{{ $interview->id }}">

                        <input type="hidden" name="question_id" id="question_id" value="{{ $question->id }}">

                        <input type="hidden" name="question_order" id="question_order" value="{{ $currentQuestion }}">

                        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">

                        <div class="mb-3">

                            <textarea
                                class="form-control"
                                rows="8"
                                name="answer" id="answer"
                                required
                                placeholder="Type your answer here...">{{ old('answer') }}</textarea>

                        </div>

                        <div class="d-flex justify-content-between">

                            <span class="text-muted">

                                Please answer honestly.

                            </span>

                            <button
                                class="btn btn-primary">

                                @if($currentQuestion == $interview->total_questions)

                                Finish Interview

                                @else

                                Next Question

                                @endif

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        fetch("{{ route('ai.interview.init') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.getElementById("csrf_token").value
                },
                body: JSON.stringify({
                    interview_id: document.getElementById("interview_id").value,
                })
            })
            .then(res => res.json())
            .then(data => console.log(data))
            .catch(err => console.error(err));

    });

    function logViolation(type, remarks = '') {

        fetch("{{ route('ai.interview.log') }}", {

            method: "POST",

            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.getElementById("csrf_token").value
            },

            body: JSON.stringify({

                interview_id: document.getElementById("interview_id").value,

                type: type,

                remarks: remarks

            })

        });

    }

    function autoSave() {

        fetch("{{ route('ai.interview.autosave') }}", {

            method: "POST",

            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.getElementById("csrf_token").value
            },

            body: JSON.stringify({

                interview_id: document.getElementById("interview_id").value,

                question_id: document.getElementById("question_id").value,

                answer: document.getElementById("answer").value

            })

        });

    }

    setInterval(autoSave, 5000);

    document.addEventListener("visibilitychange", function() {

        if (document.hidden) {

            logViolation("TAB_SWITCH", "Candidate switched tab");

        }

    });

    window.addEventListener("blur", function() {

        logViolation("WINDOW_BLUR");

    });

    document.addEventListener("contextmenu", function(e) {

        e.preventDefault();

        logViolation("RIGHT_CLICK");

    });

    document.addEventListener("copy", function(e) {

        e.preventDefault();

        logViolation("COPY");

    });

    document.addEventListener("paste", function(e) {

        e.preventDefault();

        logViolation("PASTE");

    });

    window.addEventListener("beforeunload", function() {

        navigator.sendBeacon(
            "{{ route('ai.interview.log') }}",
            new Blob([JSON.stringify({

                interview_id: document.getElementById("interview_id").value,

                type: "REFRESH"

            })], {
                type: "application/json"
            })
        );

    });
</script>

@endsection