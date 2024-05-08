<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="desciption" content="Regulatory Compliance Management System">
    <title>IRCMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-position: bottom;
        }

        .w-100 {
            width: 100%;
        }

        .h-100 {
            height: 100%;
        }

        a,
        a:hover {
            text-decoration: none;
            color: white;
        }

        .main-card {
            padding: 30px;
            width: 400px;
            backdrop-filter: blur(2px);
            background: #428cd926;
        }

        .head {
            font-size: 1.6rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .logo-block {
            display: flex;
            justify-content: center;
            margin-bottom: 50px;
        }

        .logo {
            width: 250px;
        }

        .link {
            text-align: center;
        }

        .link a {
            display: inline-block;
            transition: all 0.2s ease-in;
            position: relative;
            overflow: hidden;
            z-index: 1;
            color: #090909;
            padding: 0.7em 1.7em;
            border-radius: 0.5em;
            background: #e8e8e8;
            border: 1px solid #e8e8e8;
            box-shadow: 6px 6px 12px #c5c5c5,
                -6px -6px 12px #ffffff;
        }

        .link a:before {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%) scaleY(1) scaleX(1.25);
            top: 100%;
            width: 140%;
            height: 180%;
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 50%;
            display: block;
            transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
            z-index: -1;
        }

        .link a:after {
            content: "";
            position: absolute;
            left: 55%;
            transform: translateX(-50%) scaleY(1) scaleX(1.45);
            top: 180%;
            width: 160%;
            height: 190%;
            background-color: #006fbf;
            border-radius: 50%;
            display: block;
            transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
            z-index: -1;
        }

        .link a:hover {
            color: #ffffff;
            border: 1px solid #006fbf;
        }

        .link a:hover:before {
            top: -35%;
            background-color: #006fbf;
            transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
        }

        .link a:hover:after {
            top: -45%;
            background-color: #006fbf;
            transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
        }
    </style>
</head>

<body style="background-image: url('{{ asset('user/images/main-bg.jpg') }}')">

    <div class="main-card">
        <div class="logo-block">
            <div class="logo">
                <img src="{{ asset('user/images/logo.png') }}" alt="...." class="w-100 h-100">
            </div>
        </div>
        <div class="head">
            Regulatory Compliance Management System
        </div>
        <div class="link">
            <a href="{{ url('rcms/rcms_login') }}">
                Login to IRCMS
            </a>
        </div>
    </div>

</body>

</html>
