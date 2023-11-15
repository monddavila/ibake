<!DOCTYPE html>
<html>
<head>
  <title>Verify Your Email Address</title>
</head>
<body>
  <h1>Welcome to iBake Tiers of Joy!</h1>

  <p>Hi {{ session('registration_data.firstname') }},</p>

  <p>Thank you for signing up for iBake Tiers of Joy!</p>

  <p>To complete your account registration, please verify your email address by clicking the following link:</p>

  <a href="{{route('activate-account', $token)}}" style="background-color: #007BFF; color: #fff; padding: 10px 20px; text-decoration: none;">Verify Email</a>

  <p>This link will expire in 2 hours.</p>

  <p>Once you've verified your email address, you'll be able to log in to your account and start enjoying all that iBake Tiers of Joy has to offer.</p>

  <p>Thanks,</p>
  <p>The iBake's Tiers of Joy Team</p>
</body>
</html>