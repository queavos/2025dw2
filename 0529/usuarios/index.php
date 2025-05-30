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
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../../node_modules/font-awesome/css/font-awesome.min.css" />
   <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" />
</head>
<body>
  <!-- ENCABEZADO -->
  <?php include '../fragmentos/header.php'; ?><br>
  <?php include '../fragmentos/adm_menu.php'; ?>

  <!-- SECCIÓN PRINCIPAL -->
<div class="container">

    <?php
    if (!isset($_GET['accion'])) {
        include '_list.php';
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
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
            $sql = "select * from usuarios where id=" . $_GET['id'];
            $rs = $con->query($sql);
            
            $dato = $rs->fetch_assoc();
            $id=$dato['id'];
            $nombre=$dato['nombre'];
            $apellido=$dato['apellido'];
            $email=$dato['email'];
            $activo=$dato['activo'];
            $role_id=$dato['role_id'];
            $accion="guardar";
            $titulo="Editar Rol - ".$nombre;    
            include '_form.php'; }
        else {
            $errores->push("No se ha indicado el id del rol a editar");
            $e=http_build_query($errores);
            $url="index.php?errores=".$e;
            header("Location: $url");
        }
    }
    if (($_GET['accion']== 'borrar')) {
        //include '_list.php';
        if (isset($_GET['id'])) {
            $sql = "delete from usuarios where id=". $_GET['id'];
            $rs = $con->query($sql);
            $url="index.php";   
            header("Location: $url");   
        } else {
            $errores->push("No se ha indicado el id del rol a borrar");
            $e=http_build_query($errores);
            $url="index.php?errores=".$e;  
        }
        header("Location: $url");
    }
    if (($_GET['accion']== 'guardar')) {
        //include '_list.php';
        //echo "guardar <br>";
        if ((($_POST['id']==0))) 
            {
              $password=password_hash($_POST['email'], PASSWORD_DEFAULT);
              //$activo = true;
              //$role_id = 4; // Asignar un rol por defecto, por ejemplo, "Usuario"
               $sql = "insert into usuarios (apellido,nombre,email,password,activo, role_id) values ('".$_POST['apellido']."','". $_POST['nombre']."','".$_POST['email']."','".$password."',".$_POST['activo'].", ".$_POST['role_id'].")";
            $rs = $con->query($sql);

             $sql;
                  header("Location: index.php");
                
            } elseif ((isset($_POST['id'])) && ($_POST['id']>0) ) { { 
                //$role_id = 4; // Asignar un rol por defecto, por ejemplo, "Usuario"
                print_r($_POST);
                $activo = ($_POST['activo']=='on') ? true : false; // Verificar si el checkbox está marcado
                  $email = isset($_POST['email']) ? $_POST['email'] : '';
                  $sql = "update usuarios set apellido='" . $_POST['apellido'] . "', nombre='" . $_POST['nombre'] . "', email='" . $_POST['email'] . "', activo=" . $_POST['activo'] . ", role_id=" . $_POST['role_id']. " where id=" . $_POST['id'];

            $rs = $con->query($sql);
            header("Location: index.php");
                }

            /*
            if ($rs) {
                header("Location: index.php");
            } else {
                echo "Error al guardar el rol";
            }*/
    }
    }
    ?>
</div>
      <!-- PIE DE PÁGINA -->
  <?php 
  include '../fragmentos/footer.php';
  
  ?>

  <!-- JavaScript -->
  


<script src="../js/page.js"></script>
<script src="../js/script.js"></script>
</body>

</html>