<?php

?>

    <h1>Formulario de Roles</h1>
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
        <p>
            <label for="nombre">nombre</label><br>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control" required>  
        </p>
        <p>
            <label for="descripcion">descripcion</label><br>
            <textarea name="descripcion" class="form-control" ><?php echo $descripcion; ?></textarea>
        </p>
        <button type="submit" class="btn btn-outline-success">Enviar</button>
        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
    </form>
    </div>