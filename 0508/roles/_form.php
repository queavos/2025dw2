<?php

?>
<h3><?php echo $titulo; ?></h3>
    <form action="index_new.php?accion=<?php echo $accion; ?>" method="post">
        <input type="hidden" name='id' value="<?php echo $id; ?>">
        <p>
            <label for="nombre">nombre</label><br>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>">
        </p>
        <p>
            <label for="descripcion">descripcion</label><br>
            <textarea name="descripcion" ><?php echo $descripcion; ?></textarea>
        </p>
        <button type="submit">Enviar</button>
    </form>