<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VidyaGxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
        * {
            font-family: 'Noto Sans', serif;
        }
        /* 120deg, #87b2f8 0%, #a1c4fd 100%); middle */  
        /* 120deg, #2c73e6d1 0%, #2d72d899 100%); bottom */
        body {
           /* background-image:linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%); */
            margin: 0;
            padding: 0;
            width: 100vw;
            height: 100vh;
        }

        img {
            width: 100%;
            height: 100%;
        }

        a {
            text-decoration: none;
        }

        ::placeholder {
            color: white;
        }

        .w-100 {
            width: 100%;
        }

        .h-100 {
            height: 100%;
        }

        #preloader {
            backdrop-filter: blur(20px);
            z-index: 20;
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #preloader .loader {
            width: 150px;
            height: 150px;
            background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            border-radius: 50%;
            position: relative;
            box-shadow: 0 0 30px 4px rgba(0, 0, 0, 0.5) inset,
                0 5px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        #preloader .loader:before,
        #preloader .loader:after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 45%;
            top: -40%;
            background-color: #fff;
            animation: wave 5s linear infinite;
        }

        #preloader .loader:before {
            border-radius: 30%;
            background: rgba(255, 255, 255, 0.4);
            animation: wave 5s linear infinite;
        }

        @keyframes wave {
            0% {
                transform: rotate(0);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #rcms_login_block {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            background-size: cover;
            background-position: center;
        }

        /* #rcms_login_block .login-form-block {
            width: 800px;
    background: #eee;
    border-radius: 20px;
    background-size: cover;
    background-position: center;
        } */

        #rcms_login_block .login-form-block .top-block {
            padding: 10px 10px 15px;
            /* border-bottom: 2px solid white; */
            display: flex;
    align-items: center;
    justify-content: center;
        }

        #rcms_login_block .login-form-block .logo {
            width: 280px;
            margin: 0 auto 0px;
            /* margin-top: 151px; */
            display: flex;
    flex-direction: column;
        }

        #rcms_login_block .login-form-block .logo img {
            filter: brightness(0) invert(1);
        }

        #rcms_login_block .login-form-block .head {
            font-size: 1.6rem;
            font-weight: bold;
            /* text-transform: uppercase; */
            text-align: center;
            color: rgb(43, 41, 41);
            letter-spacing: 2px
        }

        #rcms_login_block .login-form-block form {
            padding: 30px;
        }

        #rcms_login_block .group-input {
            margin-bottom: 20px;
    display: grid;
    grid-template-columns: 70px 1fr;
    align-items: center;
    background: white;
    border: 1px solid rgba(106, 137, 229, 0.5);
    padding: 5px;
    border-radius: 5px;
        }

        #rcms_login_block label {
            font-size: 1.2rem;
            margin-bottom: 3px;
            color: #494545;
            display: block;
            font-weight: bold;
            text-align: center;
        }

        #rcms_login_block input{
            border: 0;
            outline: none;
            background: white;
    color: black;
        }
        #rcms_login_block select {
            border: 0;
            outline: none;
            /* background: #162e67; */
            color: rgb(40, 38, 38);
        }

        #rcms_login_block input[type="submit"] {
            display: block;
            text-align: center;
            width: 100%;
            padding: 9px;
            /* background: linear-gradient(180deg, rgba(255, 255, 255, .15) 0%, rgba(255, 255, 255, 0) 100%), #bec0c2; */
            /* color: black; */
            /* background-image: linear-gradient(120deg, #ea8900 0%, #ff9c4594 100%); */
            background-image: linear-gradient(120deg, #317bf2 0%, #317bf2 100%);

            /* linear-gradient(120deg, #ea8900 0%, #ff9c4594 100%) */
    color: white;
            margin-left: auto;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s linear;
            cursor: pointer;
        }
        #rcms_login_block input[type="submit"]:hover {
           letter-spacing: 2px; 
        }
        .black-placeholder::placeholder {
        color: black;
        opacity: 1; /* Necessary to ensure the color is not translucent */
    }
    .main_image-side{
        margin-left:74px;
    }

    body {
        background: url('user/images/login_backgorund.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: top right;
    }

    @media (max-width: 768px) {
        body {
            background: none;
        }    
    }

    .field-error{
    color:#dc3545;
    font-size:14px;
    margin-top:-12px;
    margin-bottom:15px;
    margin-left:75px;
    font-weight:500;
}

input.is-invalid,
select.is-invalid{
    border:1px solid #dc3545 !important;
}
    </style>
</head>

<body>

    {{-- ======================================
                    PRELOADER
    ======================================= --}}
    <div id="preloader">
        <span class="loader"></span>
    </div>

    {{-- ======================================
                    LOGIN FORM
    ======================================= --}}
    <div id="rcms_login_block" style="background-image: url('{{ asset('user/images/main-bg.jg') }}')">
        <div class="login-form-block" style="background-image: url('{{ asset('user/images/rcms-login-bg2.p') }}')">
            <div style="display: flex" class="main-block ">
            
                <div style="padding: 24px; margin-top: 34px;" class="col-lg-6">
                     <div class="logo" style="display: flex display: flex;flex-direction: row; gap: 65px;">
                     <img src="{{ asset('user/images/agio-removebg-preview.png') }}" alt="..." style="filter: none; scale: 0.7; max-width: 100px; margin: auto; margin-bottom: 14px;">


                     <img  src="{{ asset('user/images/vidhyaGxp.png') }}" alt="..." style="filter: none; scale: 1.8; max-width: 100px; margin: auto">


                    </div> 
                      <div class="head animated-header">
                        Welcome To <span style="color: #317bf2;">VidyaGxP</span>
                   </div>
                    <form action="{{ url('rcms_check') }}" method="POST">
                        @csrf
                       <div class="group-input">
                            <label for="username">
                                <i class="fa-solid fa-envelope" style="color:#317bf2;"></i>
                            </label>

                            <input
                                type="text"
                                name="emp_code"
                                value="{{ old('emp_code') }}"
                                placeholder="Enter Your Employee Code"
                                class="black-placeholder">

                        </div>

                        @error('emp_code')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror
                                            
                                                <div class="group-input">
                            <label for="password">
                                <i class="fa-solid fa-lock" style="color:#317bf2;"></i>
                            </label>

                            <input
                                type="password"
                                name="password"
                                placeholder="Enter Your Password"
                                class="black-placeholder">

                        </div>

                        @error('password')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="group-input">
                            <label for="timezone"><i class="fa-solid fa-calendar-check" style="color: #317bf2;"></i></label>
                            <select name="timezone">
                               
                                <option value="Asia/India">
                                    (GMT+05:30) Kolkata, New Delhi, Chennai, Mumbai

                                </option>
                              
                            </select>
                        </div>
                        <div>
                            <input type="submit" value="Login">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

<style>
    .image_login{
        width: 100%;
        height: 580px;
        margin: auto;
    }
</style>

    {{-- ======================================
                    SCRIPT TAGS
    ======================================= --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js" integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.onload = async function() {
            document.querySelector("#preloader").style.display = "none";

            async function getTimeZone()
            {
                try {
                    const clientIp = await axios.get('https://ipecho.net/plain');
                    const ipInfo = await axios.get(`http://ip-api.com/json/${clientIp.data}`)
                    const timeZone = ipInfo.data?.timezone;

                    // Unselect all
                    $('select[name=timezone]').find('option').attr('selected', false)
                    
                    $('select[name=timezone]').find(`option[value="${timeZone}"]`).attr('selected', true)

                } catch (err) {
                    console.log('Cannot getTimeZone', err.message)
                }
            }
            
            await getTimeZone();
        }
    </script>

</body>

</html>

