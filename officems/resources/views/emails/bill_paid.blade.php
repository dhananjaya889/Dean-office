<!DOCTYPE html>
<html>
<head>
    <title>Bill Payment Completed</title>
</head>
<body>
    <p>Dear Admin,</p>
    <p>The bill ID: {{ $data['bill_id'] }} has been paid by {{$data['user']}}.</p>
    <p>Amout is <b>{{$data['amount']}}</b></p>
    <p>Ref id  <b>{{$data['ref_id']}}</b></p>
    <p>Best regards,</p>
    <p>Your System</p>
</body>
</html>
