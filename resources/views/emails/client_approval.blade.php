<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creamline Registration Update</title>
</head>
<body>
    <p>Hi, {{ $details['name'] }}!</p>
    <p>
        @if ($details['status'] == 'accept')
            Welcome to Creamline! We are glad
            to inform you that you are now one of
            our retailers. 
            <br>
            you can now login <a href="http://localhost:8000/login">here</a>
        @else
        @if ($details['status'] == 'admin_approve')
                Welcome to Creamline! We are glad
                to inform you that you are now one of
                our retailers. 
                <br>Please click this <a href="http://localhost:8000/login">link</a> for
                account confirmation and to change
                your password: {{ $details['password'] }}

            @else
            We are sorry to inform you that you
            did not passed the qualification as our
            retailer based on the documents you
            submitted. 
            <br>Please contact your sales
            agent or the administration for more
            details. 
            <br>
            You can still register in our
            website once you finalized the
            requirements we needed.
        @endif
       
        @endif
    </p>
    <br>
    <br>
    Best regards,<br>
    Charpling Square Enterprise<br>
    Creamline Authorized Distributor
</body>
</html>