<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Approved</title>
</head>
<body>
    <p>Hi, {{ $details['name'] }}!</p>
    <p>
        Your order {{ $details['invoice_no'] }} has been approved.<br>
        Delivery date is on {{ $details['delivery_date'] }}. <br>
        Thank you. Please see your account for more info
    </p>
    <br>
    <br>
    Best regards,<br>
    Charpling Square Enterprise<br>
    Creamline Authorized Distributor
</body>
</html>