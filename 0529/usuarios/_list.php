<?php
require_once '../lib/Paginacion.php';
require_once '../lib/utilidades.php';
//$rs = $con->query("select * from roles");
$paginacion = new Paginacion($con, 'usuarios', isset($_GET['pagina']) ? $_GET['pagina'] : 1, 2);
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
            <th>Apellido</th>
            <th>Nombre</rh>
            <th>Email</th>
            <th>Roles</th>
            <th>Activo</th>
            <th>acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($dato = $rs->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $dato['apellido']; ?></td>
                <td><?php echo $dato['nombre']; ?></td>
                <td><?php echo $dato['email']; ?></td>
                <td><?php echo obternerCampo("roles",$dato['role_id'],"nombre",$con); ?></td>
                <td><?php echo $dato['activo']; ?></td>
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