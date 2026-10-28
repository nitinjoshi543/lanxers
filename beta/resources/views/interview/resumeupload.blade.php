<!DOCTYPE html>
<html>
<head>
    <title>Resume ATS</title>
</head>
<body>

<h2>Resume ATS Checker</h2>

<form action="{{ route('resume.upload') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div>
        <label>Resume (PDF)</label><br>
        <input type="file" name="resume" required>
    </div>

    <br>

    <div>
        <label>Job Description</label><br>
        <textarea
            name="job_description"
            rows="10"
            cols="80"
            required></textarea>
    </div>

    <br>

    <button type="submit">
        Check ATS Score
    </button>

</form>

</body>
</html>