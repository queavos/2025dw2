<?php
require_once '../lib/conexionDB.php';
$conex = new ConexionDB();
$conex->conectar();
$con = $conex->conex;
if (isset($_POST))
{
    if (isset($_POST['id'])){
       $sql= "update roles set descripcion='". $_POST['descripcion']."', nombre='". $_POST['nombre']."' where id=". $_POST['id'];
        $rs = $con->query($sql);

    } else {    $sql = "insert into roles (nombre,descripcion) values ('".$_POST['nombre']."','". $_POST['descripcion']."')";
    $rs = $con->query($sql);
    }
}
header("Location: index.php");


?>
