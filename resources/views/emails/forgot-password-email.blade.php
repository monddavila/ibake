<!DOCTYPE html>
<html>
<head>
    <title>Recover your Account</title>
</head>
<body>
    <h1>Reset your password</h1>

    <p>Hi there,</p>

    <p>We've received a request to reset your password for iBake.</p>

    <p>To reset your password, please click on the following link:</p>

    <a href="{{route('resetPassword', $token)}}" style="background-color: #007BFF; color: #fff; padding: 10px 20px; text-decoration: none;">Reset Password</a>

    <p>If you didn't request a password reset, please ignore this email.</p>

    <p>Thanks,</p>
    <p>The iBake's Tiers of Joy Team</p>
</body>
</html>