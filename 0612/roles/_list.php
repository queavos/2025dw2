<?php
require_once '../lib/Paginacion.php';
//$rs = $con->query("select * from roles");
$paginacion = new Paginacion($con, 'roles', isset($_GET['pagina']) ? $_GET['pagina'] : 1, 2);  
$rs = $paginacion->obtenerDatos();
?>
<?php
if (isset($_GET['errores'])) {
    $errores = explode("&", $_GET['errores']);
    foreach ($errores as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}

?>

<a href="index.php?accion=nuevo" class="btn btn-outline-primary">Nuevo</a><br>
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>nombre</rh>
                <th>desc</th>
                <th>acciones</th>
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
                        <a href="index.php?accion=editar&id=<?php echo $dato['id']; ?>" class="btn btn-outline-warning">Editar</a>
                        <a href="index.php?accion=borrar&id=<?php echo $dato['id']; ?>" class="btn btn-outline-danger">Borrar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<div>
                <?php

              $totalPaginas = $paginacion->totalPaginas();
                if ($totalPaginas > 1) {
                    echo $paginacion->mostrarBarrasNavegacion();
                }   
                ?>
                <p>Total de registros: <?php echo $paginacion->totalRegistros; ?></p>       

</div>