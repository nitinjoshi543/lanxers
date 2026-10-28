<!DOCTYPE html>
<html>

<head>
    <title>ATS Result</title>
</head>

<body>

    <h2>ATS Result</h2>

    <p>Final Score: {{ $ai_result['final_score'] }}%</p>

    <p>Semantic Score: {{ $ai_result['semantic_score'] }}%</p>

    <p>Skill Score: {{ $ai_result['skill_score'] }}%</p>

    <p>Experience Score: {{ $ai_result['experience_score'] }}%</p>

    <p>Education Score: {{ $ai_result['education_score'] }}%</p>

    <p>Recommendation: {{ $ai_result['recommendation'] }}</p>

    <h4>Matching Skills</h4>

    <ul>
        @foreach($ai_result['matching_skills'] as $skill)
        <li>{{ $skill }}</li>
        @endforeach
    </ul>

    <h4>Missing Skills</h4>

    <ul>
        @foreach($ai_result['missing_skills'] as $skill)
        <li>{{ $skill }}</li>
        @endforeach
    </ul>

</body>

</html>