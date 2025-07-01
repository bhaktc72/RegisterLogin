<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>
<body>
    <p>Hi {{ $user->name }},</p>

    <p>Click the link below to verify your email:</p>

    <p><a href="{{ $verificationUrl }}">Verify Email</a></p>

    <p>Thank you!</p>
</body>
</html>
