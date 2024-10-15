<!DOCTYPE html>
<html>
<head>
    <title>Your Employee Credentials</title>
</head>
<body>
    <h1></h1>
    <p>Dear {{ $employee->employee_name }},</p>
    <p>Here are your login credentials:</p>
    <ul>
        <li><strong>Employee Code :</strong> {{ $employee->full_employee_id }}</li>
        <li><strong>Password:</strong> {{ $randomPassword }}</li>
    </ul>
    <p>You can use this employee code and password to log in to your account.</p>
    <p>Thank you!</p>
</body>
</html>
