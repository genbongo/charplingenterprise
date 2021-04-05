<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Store Approval</title>
</head>
<body>
    <p>Hi, {{ $details['name'] }}!</p>
    <p>
        @if ($details['status'] == 'accept')
            Your new store named {{$details['store_name']}} located
            in {{$details['store_address']}} has been approved. 
            <br>
            Please visit your
            account for more info.
            @else
            Your store named {{$details['store_name']}} located in
            {{$details['store_address']}} has been declined. 
            <br>
            Please contact us or
            your sales agent to discuss the problem.
        @endif
        
    </p>
    <br>
    <br>
    Best regards,<br>
    Charpling Square Enterprise<br>
    Creamline Authorized Distributor
</body>
</html>