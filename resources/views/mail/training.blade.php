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
            aspect-ratio: 1/0.3;
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


                    <h6> Hello TMS Admin</h6>
                    <br>
                    <p>The Following staged library item is available.</p>
                    <br>
                    <ul>
                        <li><strong>Training Name :</strong> {{ $document->train->traning_plan_name }}</li><br>
                        @php
                            $division = DB::table('divisions')->find($document->division_id);
                            $doctype = DB::table('document_types')->find($document->document_type_id);
                            $year = Carbon\Carbon::parse($document->created_at)->format('Y');
                            $num = str_pad($document->train->id , 5, '0', STR_PAD_LEFT);
                            $originator = DB::table('users')->find($document->originator_id);
                        @endphp
                        <li><strong>Training Number :</strong> Training-{{ $num }}</li>

                        <br>
                        <p>Please release ths library item.</p>
                    </ul>
                        <a href="#"> Thank You</a>.

                </div>

                <div class="slogan">
                    <small>You can see all of your tasks on your Dashboard.</small>
                </div>
            </div>
        </div>
    </div>

</body>

</html>


