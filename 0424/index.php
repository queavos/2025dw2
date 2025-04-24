<?php
session_start();
require_once '../0424/lib/Autenticacion.php';
$auth = new Autenticacion();
$auth->autorizar("index.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Index</h1>
    <h3>Hola <?php echo $_SESSION['usuario']; ?></h3>
    <a href="logout.php">Salir</a>
</body>

</html>