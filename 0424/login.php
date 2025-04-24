<?php
$error = "";
if (isset($_POST)) {
require_once '../0424/lib/Autenticacion.php';
$auth = new Autenticacion();

if ($auth->autenticar($_POST['usuario'], $_POST['contrasena'])) {
    //echo "Ingreso";
    header("Location: index.php");
} else {
    $error= "No Ingreso";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php   if ($error!="" ) { ?>
    <a> <?php echo $error; ?> </a>
    <?php 
    }
    ?>
    <h1>Ingresar</h1>
    <form action="login.php" method="post">
        <p>
            <label>Usuario:</label> <br />
            <input type="text" name="usuario">
        </p>
        <p>
            <label>Cotraseña:</label> <br />
            <input type="text" name="contrasena">
        </p>
        <p>
            <button type="submit">Ingresar</button>
        </p>
    </form>
</body>

</html>