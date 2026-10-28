<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f5f7fb;
            display:flex;
            align-items:center;
            justify-content:center;
            height:100vh;
        }

        .error-box{
            width:90%;
            max-width:550px;
            background:#fff;
            border-radius:12px;
            padding:50px 40px;
            text-align:center;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
        }

        h1{
            font-size:90px;
            color:#dc3545;
            margin-bottom:10px;
        }

        h2{
            font-size:30px;
            color:#333;
            margin-bottom:15px;
        }

        p{
            color:#666;
            line-height:1.7;
            margin-bottom:30px;
        }

        .btn{
            display:inline-block;
            background:#0d6efd;
            color:#fff;
            text-decoration:none;
            padding:14px 35px;
            border-radius:6px;
            transition:.3s;
        }

        .btn:hover{
            background:#0b5ed7;
        }
    </style>
</head>
<body>

<div class="error-box">
    <h1>403</h1>

    <h2>Access Denied</h2>

    <p>
        Sorry, you don't have permission to access this page.
    </p>

    <a href="/" class="btn">Go Home</a>
</div>

</body>
</html>