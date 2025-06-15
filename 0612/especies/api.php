<?php
/**
 * especies/api.php
 *
 * API para gestionar la tabla especies.
 */

//require_once '../lib/conf.php';
require_once '../lib/conexionDB.php';

header('Content-Type: application/json');

$conex = new ConexionDB();
$conex->conectar();
$con = $conex->conex;
$con->set_charset("utf8");

if ($con->connect_error) {
    echo json_encode([
        'rows' => 0,
        'data' => [],
        'msg' => 'Error de conexión a la base de datos: ' . $con->connect_error,
        'status' => 'FAIL'
    ]);
    exit();
}

$accion = $_GET['accion'] ?? 'list';

$response = [
    'rows' => 0,
    'data' => [],
    'msg' => '',
    'status' => 'FAIL'
];

switch ($accion) {
    case 'list':
        $sql = "SELECT * FROM especies";
        $rs = $con->query($sql);

        if ($rs) {
            $especies = [];

            while ($fila = $rs->fetch_assoc()) {
                $espe_id= $fila['id'];
                $img_sql="select * from espe_imagenes where espe_id=".$espe_id ;
                $irs = $con->query($img_sql);
                $imagenes = [];
                if ($irs) {
                    while ($img_fila = $irs->fetch_assoc()) {
                        $imagenes[] = [
                            'id' => $img_fila['id'],
                            'archivo' => $img_fila['archivo'],
                            'descripcion' => $img_fila['descripcion']
                        ];
                    }
                    $irs->free();

                } else {
                    $response['msg'] = 'Error al obtener imágenes: ' . $con->error;
                }
                $fila['imagenes'] = $imagenes;
                $especies[] = $fila;
            }
            $rs->free();
            //print_r($especies);
            $response['status'] = 'OK';
            $response['data'] = $especies;
            $response['rows'] = count($especies);
            $response['msg'] = 'Lista de especies obtenida con éxito.';
        } else {
            $response['msg'] = 'Error al leer especies: ' . $con->error;
        }
        break;

    case 'get':
        $id = $_GET['id'] ?? 0;

        if ($id > 0) {
            $id = intval($id);
            $sql = "SELECT * FROM especies WHERE id = $id";
            $rs = $con->query($sql);

            if ($rs) {
                if ($rs->num_rows > 0) {
                    $especie = $rs->fetch_assoc();
                    // Obtener imágenes asociadas a la especie
                    $img_sql = "SELECT * FROM espe_imagenes WHERE espe_id = " . $especie['id'];
                    $irs = $con->query($img_sql);
                    $imagenes = [];
                    if ($irs) {
                        while ($img_fila = $irs->fetch_assoc()) {
                            $imagenes[] = [
                                'id' => $img_fila['id'],
                                'archivo' => $img_fila['archivo'],
                                'descripcion' => $img_fila['descripcion']
                            ];
                        }
                        $irs->free();
                    } else {
                        $response['msg'] = 'Error al obtener imágenes: ' . $con->error;
                    }
                    $especie['imagenes'] = $imagenes;
                    //
                    $response['status'] = 'OK';
                    $response['data'] = $especie;
                    $response['rows'] = 1;
                    $response['msg'] = 'Especie obtenida con éxito.';
                } else {
                    $response['msg'] = 'Especie no encontrada.';
                }
                $rs->free();
            } else {
                $response['msg'] = 'Error al obtener especie: ' . $con->error;
            }
        } else {
            $response['msg'] = 'ID de especie no proporcionado o inválido.';
        }
        break;

    default:
        $response['msg'] = 'Acción no reconocida o no válida.';
        break;
}

echo json_encode($response);
?>