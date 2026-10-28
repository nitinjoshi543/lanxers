<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Service Unavailable</title>

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
            max-width:620px;
            width:100%;
            padding:60px 40px;
            border-radius:12px;
            text-align:center;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
        }

        .error-code{
            font-size:110px;
            font-weight:700;
            color:#17a2b8;
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
            background:#0d6efd;
            color:#fff;
            text-decoration:none;
            padding:14px 35px;
            border-radius:6px;
            font-weight:600;
            transition:.3s;
        }

        .btn:hover{
            background:#0b5ed7;
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

            .btn{
                width:100%;
            }

        }
    </style>
</head>
<body>

<div class="error-container">

    <div class="error-code">Coming Soon</div>

    <h1>Something <span>exciting</span> is on the way</h1>

    <p>
         We're building a smarter way for talent and employers to connect —
        jobs, freelance projects, and internships, all in one place.
        We'll be live shortly. Leave your email and we'll notify you the moment we launch.
    </p>

    <a href="{{ route('home') }}" class="btn">
        Return to Home
    </a>

</div>

</body>
</html>