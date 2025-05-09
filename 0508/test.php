<?php
require_once './lib/conexionDB.php';
$conex= new ConexionDB();
$conex->conectar();
$con= $conex->conex;

$sql = "insert into roles (nombre) values ('miron') ";
//$rs = $con->query($sql);
 
$sql2= "update roles set descripcion='solo puede ver' where id=3";
//$rs = $con->query($sql2);

$sql3="delete from roles where id>3";
$rs = $con->query($sql3);

 $rs= $con->query("select * from roles");
//$dato=$rs->fetch_assoc();
while ($dato = $rs->fetch_assoc()){
print_r($dato);
echo "<br>";

}
?>
