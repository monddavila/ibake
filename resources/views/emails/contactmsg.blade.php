<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iBake Contact</title>
</head>
<body>
    <h1>iBake Contact Form Submission</h1>
    <p>Name: {{ $data['username'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Message: {{ $data['message'] }}</p>

</body>
</html>