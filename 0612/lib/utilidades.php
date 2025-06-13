<?php
function obternerCampo($tabla,$id,$campo,$conex)
{
$sql = "select ". $campo." from ".$tabla." where  id=". $id;
    $rs = $conex->query($sql);
    $dato = $rs->fetch_assoc();
    return $dato[$campo];
}
?>