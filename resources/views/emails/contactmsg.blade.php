<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iBake Contact</title>
</head>
<body>
    <h2>iBake Contact Form Submission</h2>
    <hr>
    <p>Name: {{ $data['username'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Message:<br><hr><br> {{ $data['message'] }}</p>
    <hr>
    <p>Date and Time (GMT+8): {{ \Carbon\Carbon::parse($data['dateTime'])->timezone('Asia/Singapore')->format('Y-m-d H:i:s') }}</p>

</body>
</html>