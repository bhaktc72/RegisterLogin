<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h2>{{ $status }}</h2>

    @if ($status === 'Email verified successfully!')
        <p>You can now log in to your account.</p>
    @endif

    <p>Thank you!</p>
    <p>
        <button type="button" onclick="location.href='{{ route('admin.login.form') }}'">Admin Login</button>
        <button type="button" onclick="location.href='{{ route('customer.login.form') }}'" >Customer Login</button>
    </p>

</body>
</html>
