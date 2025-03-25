<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Password Reset Request</h2>
    <p>Click the link below to reset your password:</p>
    <a href="{{ route('reset.password.get', $token) }}">Reset Password</a>
    <br><br>
    <p>If you did not request a password reset, no further action is required.</p>
</body>
</html>