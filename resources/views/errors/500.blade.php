<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error</title>

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
            color:#ff6b35;
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

        .buttons{
            display:flex;
            justify-content:center;
            gap:15px;
            flex-wrap:wrap;
        }

        .btn{
            display:inline-block;
            padding:14px 35px;
            border-radius:6px;
            text-decoration:none;
            font-weight:600;
            transition:.3s;
        }

        .btn-home{
            background:#0d6efd;
            color:#fff;
        }

        .btn-home:hover{
            background:#0b5ed7;
        }

        .btn-back{
            background:#6c757d;
            color:#fff;
        }

        .btn-back:hover{
            background:#5c636a;
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

            .buttons{
                flex-direction:column;
            }

            .btn{
                width:100%;
            }
        }
    </style>
</head>
<body>

<div class="error-container">

    <div class="error-code">500</div>

    <h1>Internal Server Error</h1>

    <p>
        Sorry, something went wrong on our server.
        Our team has been notified and is working to resolve the issue.
        Please try again in a few minutes.
    </p>

    <div class="buttons">
        <a href="{{ route('home') }}" class="btn btn-home">
            Back to Home
        </a>

        <a href="{{ url()->previous() }}" class="btn btn-back">
            Go Back
        </a>
    </div>

</div>

</body>
</html>