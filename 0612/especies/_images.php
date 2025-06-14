
    <div class="container">
    <row>
        <h3>Imagenes de Especies: <?php echo $nombre."(".$nombre_cientifico.")"; ?>  </h3>
        <p>Esta página muestra las imágenes de las especies cargadas en el sistema.</p>
    </row>
        <row>
        <h4>Subir Imagen</h4>
        <form action="index.php?accion=imgsave" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control" required />
            </div>
            <button type="submit" class="btn btn-primary">Subir Imagen</button>
        </form>
    </row>
    <row>
        <h4>Imágenes Cargadas</h4>
        <div class="row">
            <?php
            $sql = "SELECT * FROM espe_imagenes WHERE espe_id = $id";
            $rs = $con->query($sql);
            while ($dato = $rs->fetch_assoc()) {
                include '_image.php';
                } ?>
        </div>
    </div>