<?php
require_once '../lib/conf.php';
require_once '../lib/conexionDB.php';
$conex = new ConexionDB();
$conex->conectar();
$con = $conex->conex;
$errores = array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (!isset($_GET['accion'])) {
        include '_list.php';
    }
    if (($_GET['accion']== 'nuevo')) {
        $id=0;
        $nombre="";
        $descripcion="";
        $accion="guardar";
        $titulo="Crear Nuevo Rol";   
        include '_form.php';
    }
    if (($_GET['accion']== 'editar')) {
         if (isset($_GET['id'])) {
            $sql = "select * from roles where id=" . $_GET['id'];
            $rs = $con->query($sql);
            $dato = $rs->fetch_assoc();
            $id=$dato['id'];
            $nombre=$dato['nombre'];
            $descripcion=$dato['descripcion'];
            $accion="guardar";
            $titulo="Editar Rol - ".$nombre;    
            include '_form.php'; }
        else {
            $errores->push("No se ha indicado el id del rol a editar");
            $e=http_build_query($errores);
            $url="index_new.php?errores=".$e;
            header("Location: $url");
        }
    }
    if (($_GET['accion']== 'borrar')) {
        //include '_list.php';
        if (isset($_GET['id'])) {
            $sql = "delete from roles where id=". $_GET['id'];
            $rs = $con->query($sql);    
        } else {
            $errores->push("No se ha indicado el id del rol a borrar");
            $e=http_build_query($errores);
            $url="index_new.php?errores=".$e;
            header("Location: $url");
            
        }
    }
    if (($_GET['accion']== 'guardar')) {
        //include '_list.php';
        echo "guardar <br>";
        if ((($_POST['id']==0))) 
            {
                
                $sql = "insert into roles (nombre,descripcion) values ('".$_POST['nombre']."','". $_POST['descripcion']."')";
                $rs = $con->query($sql);
                
            } elseif ((isset($_POST['id'])) && ($_POST['id']>0) ) { { 
                echo $sql= "update roles set descripcion='". $_POST['descripcion']."', nombre='". $_POST['nombre']."' where id=". $_POST['id'];
                $rs = $con->query($sql);
            }
            //$rs = $con->query($sql);
            /*
            if ($rs) {
                header("Location: index_new.php");
            } else {
                echo "Error al guardar el rol";
            }*/
    }
    }
    ?>
</body>

</html>