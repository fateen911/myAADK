<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name', 'SistemAADK') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
    QR Code: {!! QrCode::size(250)->generate('www.google.com'); !!} <br>
    Link: <a href="www.google.com">www.google.com</a>


</body>
</html>
<?php
phpinfo();

