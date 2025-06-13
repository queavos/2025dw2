<?php

$error = "";
if (isset($_POST)) {
    require_once './lib/conexionDB.php';
    require_once './lib/Autenticacion.php';
    $conex = new ConexionDB();
    $conex->conectar();
    $con = $conex->conex;
    $auth = new Autenticacion($con);

    if ($auth->autenticar($_POST['usuario'], $_POST['contrasena'])) {
        //echo "Ingreso";
        header("Location: index.php");
    } else {
        $error = "No Ingreso";
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
    <?php if ($error != "") { ?>
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
            <input type="password" name="contrasena">
        </p>
        <p>
            <button type="submit">Ingresar</button>
        </p>
    </form>
</body>

</html>