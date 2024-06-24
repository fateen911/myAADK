<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Email</title>
</head>
<body>
<h1>Your Custom Message</h1>
<p>{{ $messageContent }}</p>
<h2>Your QR Code</h2>
<img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
</body>
</html>
