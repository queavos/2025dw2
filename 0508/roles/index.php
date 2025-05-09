<?php
require_once '../lib/conexionDB.php';
$conex = new ConexionDB();
$conex->conectar();
$con = $conex->conex;
$rs = $con->query("select * from roles");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="nuevo.php">Nuevo</a><br>
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>nombre</td>
                <td>desc</td>
                <td>acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($dato = $rs->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $dato['id']; ?></td>
                    <td><?php echo $dato['nombre']; ?></td>
                    <td><?php echo $dato['descripcion']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $dato['id']; ?>">Editar</a>
                        <a href="borrar.php?id=<?php echo $dato['id']; ?>">Borrar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>