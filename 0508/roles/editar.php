<?php
require_once '../lib/conexionDB.php';
$conex = new ConexionDB();
$conex->conectar();
$con = $conex->conex;
if (isset($_GET['id'])) {
    $sql = "select * from roles where id=" . $_GET['id'];
    $rs = $con->query($sql);
    $dato = $rs->fetch_assoc();
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
    <h1>Formulario</h1>
    <form action="guardar.php" method="post">
        <input type="text" name='id' value="<?php echo $dato['id']; ?>">
        <p>
            <label for="nombre">nombre</label>
            <input type="text" name="nombre" value="<?php echo $dato['nombre']; ?>">
        </p>
        <p>
            <label for="descripcion">descripcion</label>
            <input type="text" name="descripcion" value="<?php echo $dato['descripcion']; ?>">
        </p>
        <button type="submit">Enviar</button>
    </form>


</body>

</html>