<?php
$roles = $con->query("select * from roles");
?>

<h1>Formulario de Usuarios</h1>
<?php
if (isset($errores)) {
    foreach ($errores as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>
<h3><?php echo $titulo; ?></h3>
<form action="index.php?accion=<?php echo $accion; ?>" method="post">
    <input type="hidden" name='id' value="<?php echo $id; ?>" class="form-control">
    <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" required value="<?php echo $nombre; ?>">
    </div>

    <div class="col-md-6">
        <label for="nombre_alternativo" class="form-label">Nombre Alternativo:</label>
        <input type="text" id="nombre_alternativo" name="nombre_alternativo" class="form-control" value="<?php echo $nombre_alternativo; ?>">
    </div>

    <div class="col-md-6">
        <label for="nombre_cientifico" class="form-label">Nombre Científico:</label>
        <input type="text" id="nombre_cientifico" name="nombre_cientifico" class="form-control" value="<?php echo $nombre_cientifico; ?>">
    </div>

    <div class="col-md-6">
        <label for="cantidad" class="form-label">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" class="form-control" value="<?php echo $cantidad; ?>">
    </div>

    <div class="col-md-6">
        <label for="orden" class="form-label">Orden:</label>
        <input type="text" id="orden" name="orden" class="form-control" value="<?php echo $orden; ?>">
    </div>

    <div class="col-md-6">
        <label for="familia" class="form-label">Familia:</label>
        <input type="text" id="familia" name="familia" class="form-control" value="<?php echo $familia; ?>">
    </div>

    <div class="col-md-12">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea id="descripcion" name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>
    </div>

    <div class="col-md-12">
        <label for="ecologia" class="form-label">Ecología:</label>
        <textarea id="ecologia" name="ecologia" class="form-control"><?php echo $ecologia; ?></textarea>
    </div>

    <div class="col-md-12">
        <label for="distribucion" class="form-label">Distribución:</label>
        <textarea id="distribucion" name="distribucion" class="form-control"><?php echo $distribucion; ?></textarea>
    </div>

    <div class="col-md-6">
        <label for="link_url" class="form-label">URL:</label>
        <input type="text" id="link_url" name="link_url" class="form-control" value="<?php echo $link_url; ?>">
    </div>

    <div class="col-md-6">
        <label for="link_qr" class="form-label">Link QR:</label>
        <input type="text" id="link_qr" name="link_qr" class="form-control" value="<?php echo $link_qr; ?>">
    </div>


    <button type="submit" class="btn btn-outline-success">Enviar</button>
    <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
</form>
</div>