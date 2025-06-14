<?php
require_once '../lib/conf.php';
require_once '../lib/conexionDB.php';
$conex = new ConexionDB();
$conex->conectar();
$con = $conex->conex;
$errores = array();

$response = [
    'rows' => 0,
    'data' => [],
    'msg' => '',
    'status' => 'FAIL'
];

header('Content-Type: application/json');

?>
    
<?php
    if (!isset($_GET['accion'])) {
$sql = "SELECT * FROM roles";
        $rs = $con->query($sql);
        if ($rs) {
            $roles = [];
            while ($fila = $rs->fetch_assoc()) {
                $roles[] = $fila;
            }
            $rs->free();
            $response['status'] = 'OK';
            $response['data'] = $roles;
            $response['rows'] = count($roles);
            $response['msg'] = 'Lista de roles obtenida con éxito.';
        } else {
            $response['msg'] = 'Error al leer roles: ' . $con->error;
        }
    }

    if (($_GET['accion']== 'leer')) {
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            $id = intval($id); // Asegurarse de que el ID sea un entero
            $sql = "SELECT * FROM roles WHERE id = $id";
            $rs = $con->query($sql);
            if ($rs) {
                if ($rs->num_rows > 0) {
                    $rol = $rs->fetch_assoc();
                    $response['status'] = 'OK';
                    $response['data'] = $rol;
                    $response['rows'] = 1;
                    $response['msg'] = 'Rol obtenido con éxito.';
                } else {
                    $response['msg'] = 'Rol no encontrado.';
                }
                $rs->free();
            } else {
                $response['msg'] = 'Error al obtener rol: ' . $con->error;
            }
        } else {
            $response['msg'] = 'ID de rol no proporcionado o inválido.';
        }
    }
    if (($_GET['accion']== 'borrar')) {
        // GET Request: action=del&id=?
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            $id = intval($id); // Asegurarse de que el ID sea un entero
            $sql = "DELETE FROM roles WHERE id = $id";
            $rs = $con->query($sql);
            if ($rs) {
                if ($con->affected_rows > 0) {
                    $response['status'] = 'OK';
                    $response['msg'] = 'Rol eliminado con éxito.';
                    $response['rows'] = 1;
                } else {
                    $response['msg'] = 'Rol no encontrado para eliminar.';
                }
            } else {
                $response['msg'] = 'Error al eliminar el rol: ' . $con->error;
            }
        } else {
            $response['msg'] = 'ID de rol no proporcionado o inválido para eliminar.';
        }
    }
    if (($_GET['accion']== 'guardar')) {
        //include '_list.php';
        //echo "guardar <br>";
        if ((($_POST['id']==0))) 
            {
      
              $sql = "insert into roles (nombre,descripcion) values ('".$_POST['nombre']."','". $_POST['descripcion']."')";
                //$rs = $con->query($sql);
                 $rs = $con->query($sql);
            header("Location: index.php");
                
            } elseif ((isset($_POST['id'])) && ($_POST['id']>0) ) { { 
               $sql= "update roles set descripcion='". $_POST['descripcion']."', nombre='". $_POST['nombre']."' where id=". $_POST['id'];
                //$rs = $con->query($sql);
                 $rs = $con->query($sql);
            header("Location: index.php");
            }
            $rs = $con->query($sql);
            header("Location: index.php");
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