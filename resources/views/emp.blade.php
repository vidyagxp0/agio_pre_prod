<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <style>
        body,
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lora', serif;
        }

        #main-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #main-container .notification-container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            backdrop-filter: blur(10px);
            background: #00000027;
            border-top: 10px solid #1558af;
        }

        #main-container .logo {
            width: 120px;
            aspect-ratio: 1/0.35;
            margin-bottom: 30px;
        }

        #main-container .logo img {
            width: 100%;
            height: 100%;
        }

        #main-container .mail-content {
            text-align: justify;
            margin-bottom: 20px;
        }

        #main-container .bar {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div id="main-container">
        <div class="notification-container">
            <div class="inner-block">
                <div class="logo">
                    <img src="{{ asset('user/images/logo.png') }}" alt="...">
                </div>
                <div class="mail-content">
                    <a href="{{ url('TMS') }}"> Click here to view the status</a>.
                </div>
                <div class="slogan">
                    <small>You can see all of your tasks on your DMS Dashboard.</small>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


