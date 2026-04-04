<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 600px;
        margin: auto;
        background: #ffffff;
        padding: 20px;
    }

    .header {
        text-align: center;
    }

    .header img {
        max-width: 120px;
        height: auto;
    }

    h2 {
        color: #6c7ae0;
        font-size: 20px;
        margin: 20px 0;
    }

    p {
        font-size: 14px;
        color: #333;
        line-height: 1.6;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
        font-size: 14px;
    }

    th {
        background-color: #6c7ae0;
        color: white;
    }

    .btn {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 20px;
        background-color: #6c7ae0;
        color: #ffffff !important;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
    }

    .footer {
        margin-top: 20px;
        font-size: 12px;
        color: #777;
        text-align: center;
    }

    /* MOBILE RESPONSIVE */
    @media screen and (max-width: 600px) {
        .container {
            padding: 15px;
        }

        h2 {
            font-size: 18px;
        }

        p, td, th {
            font-size: 13px;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
</head>

<body>

<div class="container">

    <div class="header">
        <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt="Logo">
        <h2>User Account Created</h2>
    </div>

    <p>Dear <strong>{{ $user->name }}</strong>,</p>

    <p>Your account has been successfully created. Below are your login details:</p>

    <table>
        <tr>
            <th>Field</th>
            <th>Details</th>
        </tr>
        <tr>
            <td>Employee Code</td>
            <td>{{ $user->emp_code }}</td>
        </tr>
        <tr>
            <td>Password</td>
            <td>{{ $plainPassword ?? '********' }}</td>
        </tr>
    </table>

    <div style="text-align:center;">
        <a href="{{ url('/login') }}" class="btn">Login Now</a>
    </div>

    <p>Thank you for being part of our system.</p>

    <p>Regards,<br><strong>VidyaGxP Team</strong></p>

    <div class="footer">
        This is an automated email. Please do not reply.
    </div>

</div>

</body>

</html>
