<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AI Interview Invitation</title>
</head>

<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:30px 0;">
    <tr>
        <td align="center">

            <table width="650" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;">

                <tr>
                    <td style="background:#0d6efd;color:#fff;padding:20px;text-align:center;">
                        <h2 style="margin:0;">LANXERS AI Interview</h2>
                    </td>
                </tr>

                <tr>
                    <td style="padding:30px;">

                        <p>Hi <strong>{{ $user_name }}</strong>,</p>

                        <p>
                            Thank you for applying for the position of
                            <strong>{{ $job_title }}</strong>.
                        </p>

                        <p>
                            The next step is to complete your AI Interview.
                        </p>

                        <table cellpadding="8" cellspacing="0" width="100%" style="background:#f8f8f8;border:1px solid #ddd;">
                            <tr>
                                <td><strong>Job Title</strong></td>
                                <td>{{ $job_title }}</td>
                            </tr>

                            <tr>
                                <td><strong>Estimated Time</strong></td>
                                <td>{{ $duration }} Minutes</td>
                            </tr>

                            <tr>
                                <td><strong>Total Questions</strong></td>
                                <td>{{ $questions }}</td>
                            </tr>
                        </table>

                        <p style="margin-top:25px;">
                            Click the button below to begin your interview.
                        </p>

                        <p align="center">

                            <a href="{{ $interview_url }}"
                               style="background:#0d6efd;
                                      color:#fff;
                                      text-decoration:none;
                                      padding:14px 28px;
                                      border-radius:5px;
                                      display:inline-block;">

                                Start AI Interview

                            </a>

                        </p>

                        <p>
                            Please complete your interview before the deadline.
                        </p>

                        <p>
                            Best Regards,<br>
                            <strong>LANXERS Team</strong>
                        </p>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>