<?php
require_once "utilidades.php";
class Autenticacion
{
    // el correo valido para ingresar
    private $correo = "usuario@mail.com";
    // el password valido para ingresar
    private $password = "password123";
    private $conex;    /**
     * ?
     * @param mixed $usuario 
     * @param mixed $contrasena
     * @return boolean 
     * si es correcto es true sino el false
     */
    public function __construct(mysqli $conex)
    {
        /*
        $this->correo= $usuario;
        $this->password= $password;
        */
        $this->conex= $conex;
    }
     public function autenticar($usuario, $password)
    {
        $sql="select * from usuarios where email='". $usuario."'";
        $rs= $this->conex->query($sql);
        if ($rs->num_rows==1) 
        {
            $usr=$rs->fetch_assoc();
            if ( password_verify($password,$usr['password'])) {
                $this->iniciarSesion($usr);
                return true;
            } else {
                return false;
            }
        }
        
  
    }

    private function iniciarSesion($usuario) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['email']=$usuario['email'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['apellido'] = $usuario['apellido'];
        $_SESSION['role_id'] = $usuario['role_id'];
        $_SESSION['rol'] = obternerCampo("roles",$usuario['role_id'],"nombre",$this->conex);
        $_SESSION['autenticado'] =true;
    }
    public function autorizar($rol) {
        if ($_SESSION['autenticado']!=true || $_SESSION['rol']!= "Administrador")
            {
            header("Location: login.php");   
            } 
    }

    public function cerrarSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
