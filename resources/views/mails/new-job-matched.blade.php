<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>New Job Matching Your Skills</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:30px;">

    <div style="
        max-width:600px;
        margin:auto;
        background:#ffffff;
        padding:30px;
        border-radius:10px;
    ">

        <h2 style="margin-top:0;">
            Hello {{ $user->name ?? 'Freelancer' }},
        </h2>

        <p>
            We found a new job that matches your skills.
        </p>

        <h3>
            {{ $job->title }}
        </h3>

        <p>
            {{ \Illuminate\Support\Str::limit(strip_tags($job->description), 300) }}
        </p>

        <p>
            <strong>Matched Skills:</strong>
            {{ $matchedSkills }}
        </p>

        @if($job->budget_min || $job->budget_max)
            <p>
                <strong>Budget:</strong>
                ₹{{ $job->budget_min }} - ₹{{ $job->budget_max }}
            </p>
        @endif

        @if($job->duration)
            <p>
                <strong>Duration:</strong>
                {{ $job->duration }}
            </p>
        @endif

        <br>

        <a href="{{ route ('jobseekers.find.work') }}#job-{{ $job->id }}"
           style="
               display:inline-block;
               background:#00A148;
               color:white;
               text-decoration:none;
               padding:12px 20px;
               border-radius:6px;
           ">
            View Job
        </a>

        <br><br>

        <p>
            Regards,<br>
            Lanxers Team
        </p>

    </div>

</body>
</html>