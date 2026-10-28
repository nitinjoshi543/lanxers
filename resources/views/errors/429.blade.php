<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>429 - Too Many Requests</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f4f7fb;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            padding:20px;
        }

        .error-container{
            background:#fff;
            max-width:600px;
            width:100%;
            padding:60px 40px;
            border-radius:12px;
            text-align:center;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
        }

        .error-code{
            font-size:110px;
            font-weight:700;
            color:#dc3545;
            line-height:1;
            margin-bottom:15px;
        }

        h1{
            font-size:34px;
            color:#222;
            margin-bottom:15px;
        }

        p{
            color:#666;
            font-size:16px;
            line-height:1.8;
            margin-bottom:35px;
        }

        .btn{
            display:inline-block;
            background:#dc3545;
            color:#fff;
            text-decoration:none;
            padding:14px 35px;
            border-radius:6px;
            font-weight:600;
            transition:.3s;
        }

        .btn:hover{
            background:#bb2d3b;
        }

        @media(max-width:576px){

            .error-container{
                padding:40px 25px;
            }

            .error-code{
                font-size:80px;
            }

            h1{
                font-size:28px;
            }

        }
    </style>
</head>
<body>

<div class="error-container">

    <div class="error-code">429</div>

    <h1>Too Many Requests</h1>

    <p>
        You've made too many requests in a short period.
        Please wait a moment before trying again.
    </p>

    <a href="{{ route('home') }}" class="btn">
        Back to Home
    </a>

</div>

</body>
</html>