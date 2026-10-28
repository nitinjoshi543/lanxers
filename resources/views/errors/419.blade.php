<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Page Expired</title>

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
            align-items:center;
            justify-content:center;
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
            color:#f59e0b;
            line-height:1;
            margin-bottom:15px;
        }

        h1{
            font-size:34px;
            color:#222;
            margin-bottom:15px;
        }

        p{
            font-size:16px;
            color:#666;
            line-height:1.8;
            margin-bottom:35px;
        }

        .btn{
            display:inline-block;
            padding:14px 35px;
            background:#f59e0b;
            color:#fff;
            text-decoration:none;
            border-radius:6px;
            font-weight:600;
            transition:.3s ease;
        }

        .btn:hover{
            background:#d97706;
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

    <div class="error-code">419</div>

    <h1>Page Expired</h1>

    <p>
        Your session has expired or the security token is no longer valid.
        Please refresh the page and try again.
    </p>

    <!-- Laravel -->
    <a href="{{ url()->previous() }}" class="btn">
        Go Back
    </a>

    <!-- Plain HTML -->
    <!-- <a href="/" class="btn">Back to Home</a> -->

</div>

</body>
</html>