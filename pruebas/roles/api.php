<?php
/**
 * api.php (para roles) - Adaptado para usar la lógica SQL directa como index.php
 *
 * API para manejar las operaciones CRUD (Crear, Leer, Actualizar, Borrar) de roles.
 * Responde en formato JSON.
 */

// Incluir la configuración y la clase de conexión a la base de datos
require_once '../lib/conf.php';
require_once '../lib/conexionDB.php';

// Establecer el encabezado para indicar que la respuesta es JSON
header('Content-Type: application/json');

// Inicializar la conexión a la base de datos
$conex = new ConexionDB();
$conex->conectar();
$con = $conex->conex; // Obtener el objeto mysqli de la conexión

// Verificar si la conexión a la base de datos fue exitosa
if ($con->connect_error) {
    echo json_encode([
        'rows' => 0,
        'data' => [],
        'msg' => 'Error de conexión a la base de datos: ' . $con->connect_error,
        'status' => 'FAIL'
    ]);
    exit();
}

// Obtener la acción de la petición
$action = $_REQUEST['action'] ?? ''; // Usamos $_REQUEST para GET y POST

// Inicializar la respuesta con la estructura deseada
$response = [
    'rows' => 0,
    'data' => [],
    'msg' => '',
    'status' => 'FAIL'
];

switch ($action) {
    case 'list':
        // GET Request: action=list
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
        break;

    case 'get':
        // GET Request: action=get&id=?
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
        break;

    case 'del':
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
        break;

    case 'new':
        // POST Request: action=new
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $con->real_escape_string($_POST['nombre'] ?? '');
            $descripcion = $con->real_escape_string($_POST['descripcion'] ?? '');

            if (empty($nombre)) {
                $response['msg'] = 'El nombre del rol es obligatorio.';
            } else {
                $sql = "INSERT INTO roles (nombre, descripcion) VALUES ('$nombre', '$descripcion')";
                $rs = $con->query($sql);
                if ($rs) {
                    $lastId = $con->insert_id;
                    // Intentar leer el rol recién creado para devolverlo
                    $sqlNew = "SELECT * FROM roles WHERE id = $lastId";
                    $rsNew = $con->query($sqlNew);
                    $newRol = $rsNew->fetch_assoc();
                    $response['status'] = 'OK';
                    $response['msg'] = 'Rol creado con éxito.';
                    $response['data'] = $newRol;
                    $response['rows'] = 1;
                } else {
                    $response['msg'] = 'Error al crear el rol: ' . $con->error;
                }
            }
        } else {
            $response['msg'] = 'Método no permitido para esta acción. Use POST.';
        }
        break;

    case 'update':
        // POST Request: action=update
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $nombre = $con->real_escape_string($_POST['nombre'] ?? '');
            $descripcion = $con->real_escape_string($_POST['descripcion'] ?? '');

            if ($id == 0) {
                $response['msg'] = 'ID de rol no proporcionado para la actualización.';
            } elseif (empty($nombre)) {
                $response['msg'] = 'El nombre del rol no puede estar vacío en la actualización.';
            } else {
                $id = intval($id); // Asegurarse de que el ID sea un entero
                $sql = "UPDATE roles SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = $id";
                $rs = $con->query($sql);
                if ($rs) {
                    if ($con->affected_rows > 0 || $con->info) { // Check affected_rows or info for "Rows matched: 1 Changed: 0 Warnings: 0"
                        // Intentar leer el rol actualizado para devolverlo
                        $sqlUpdate = "SELECT * FROM roles WHERE id = $id";
                        $rsUpdate = $con->query($sqlUpdate);
                        $updatedRol = $rsUpdate->fetch_assoc();
                        $response['status'] = 'OK';
                        $response['msg'] = 'Rol actualizado con éxito.';
                        $response['data'] = $updatedRol;
                        $response['rows'] = 1;
                    } else {
                        // Podría ser que el rol no se encontró o no hubo cambios
                        $response['status'] = 'OK'; // Si no hay cambios, no es un FAIL
                        $response['msg'] = 'No se realizaron cambios en el rol o el rol no existe.';
                        $response['rows'] = 0;
                    }
                } else {
                    $response['msg'] = 'Error al actualizar el rol: ' . $con->error;
                }
            }
        } else {
            $response['msg'] = 'Método no permitido para esta acción. Use POST.';
        }
        break;

    default:
        $response['msg'] = 'Acción no reconocida o no válida.';
        break;
}

// Enviar la respuesta JSON
echo json_encode($response);

// Cerrar la conexión a la base de datos
$conex->cerrarConexion();
?>
