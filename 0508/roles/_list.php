<?php
$rs = $con->query("select * from roles");
?>
<?php
if (isset($_GET['errores'])) {
    $errores = explode("&", $_GET['errores']);
    foreach ($errores as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}

?>
<a href="index_new.php?accion=nuevo">Nuevo</a><br>
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
                        <a href="index_new.php?accion=editar&id=<?php echo $dato['id']; ?>">Editar</a>
                        <a href="index_new.php?accion=borrar&id=<?php echo $dato['id']; ?>">Borrar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>