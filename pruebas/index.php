<?php
include_once('./lib/phpqrcode/qrlib.php');

$ruta='./qr.png';
$url='https://www.unae.edu.py';
QRcode::png($url,$ruta, QR_ECLEVEL_L,10);
//echo "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="./qr.png" />
</body>
</html>
