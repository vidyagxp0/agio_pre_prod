<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
</head>

<body>

    {{-- ======================================
                    LOGIN FORM
    ======================================= --}}

    <section id="login-form">
        <div class="form-area">
            <div class="logo">
                <img src="{{ asset('user/images/logo.png') }}" alt="..." class="w-100 h-100">
            </div>
            <form action="" method="POST">

                <div class="login-fields">
                    <div class="head">Enter Your E-Mail</div>

                    <div class="group-input">
                        <label for="email">Email</label>
                        <input type="email" name="email">
                    </div>

                    <div class="head">Enter Your OTP</div>

                    <div class="group-input">
                        <label for="otp">Enter OTP</label>
                        <input type="number" name="otp">
                    </div>

                    <div class="group-input">
                        <input type="submit" value="Login">
                    </div>

                </div>
            </form>
        </div>
    </section>


    {{-- ======================================
                    SCRIPT TAGS
    ======================================= --}}
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="{{ asset('user/js/index.js') }}"></script>

</body>

</html>
