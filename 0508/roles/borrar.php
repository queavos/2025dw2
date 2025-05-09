<?php
require_once '../lib/conexionDB.php';
$conex = new ConexionDB();
$conex->conectar();
$con = $conex->conex;
if (isset($_GET['id'])) {
    $sql = "delete from roles where id=". $_GET['id'];
    $rs = $con->query($sql);
}
header("Location: index.php");
