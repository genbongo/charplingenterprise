<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creamline Registration Password</title>
</head>
<body>
    <p>Hi, {{ $details['name'] }}!</p>
    <p>
        Welcome to Creamline! We are glad
        to inform you that you are now one of
        our retailers. 
        <br>Please click this <a href="http://localhost:8000/login">link</a> for
        account confirmation and to change
        your password: {{ $details['password'] }}
    </p>
    <br>
    <br>
    Best regards,<br>
    Charpling Square Enterprise<br>
    Creamline Authorized Distributor
</body>
</html>