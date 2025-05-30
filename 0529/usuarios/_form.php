<?php
$roles= $con->query("select * from roles");
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
<!--         <p>
            <label for="nombre">nombre</label><br>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control" required>  
        </p>
        <p>
            <label for="descripcion">descripcion</label><br>
            <textarea name="descripcion" class="form-control" ><?php echo $descripcion; ?></textarea>
        </p> -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo $nombre; ?>">
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required value="<?php echo $apellido; ?>">
            </div>
            <div class="mb-3 form-check">
                 <input type="hidden" name="activo" value="0">
                <input type="checkbox" class="form-check-input" id="activo" name="activo"   <?php //echo $activo ? 'checked' : ''; ?>  value="1">
                <label class="form-check-label" for="activo" >Activo</label>
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">Rol</label>
                <select class="form-select" id="role_id" name="role_id" required>
                    <option >Seleccione el Rol</option>
                    <?php
            while ($dato = $roles->fetch_assoc()) {
            ?>
                    <option value="<?php echo $dato['id']; ?>" <?php if ($dato['id'] == $role_id) echo 'selected'; ?>>
                        <?php echo $dato['nombre']; ?>
            <?php } ?>
                    </option>
                </select>
            </div>
       
       
        <button type="submit" class="btn btn-outline-success">Enviar</button>
        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
    </form>
    </div>