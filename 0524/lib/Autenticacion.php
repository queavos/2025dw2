<?php
class Autenticacion
{
    // el correo valido para ingresar
    private $correo = "usuario@mail.com";
    // el password valido para ingresar
    private $password = "password123";
    /**
     * ?
     * @param mixed $usuario 
     * @param mixed $contrasena
     * @return boolean 
     * si es correcto es true sino el false
     */
    public function autenticar($usuario, $contrasena)
    {
        if (($usuario == $this->correo) && ($contrasena == $this->password)) {
            $this->iniciarSesion($usuario);
            return true;
        } else {
            return false;
        }
    }

    private function iniciarSesion($usuario) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['usuario']=$usuario;
        $_SESSION['autenticado'] =true;
    }
    public function autorizar($pagina) {
        if ($_SESSION['autenticado']!=true)
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
