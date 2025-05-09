<?php
class ConexionDB {

    public $conex;
    private $host="127.0.0.1";
    private $usr='root';
    private $pass='';
    private $bdatos="dw2_minizoo";
    private $port="3306";
    private $error;

public function conectar(){
    $this->conex=new mysqli($this->host, $this->usr, $this->pass, $this->bdatos);
    }
}

?>