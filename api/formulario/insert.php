<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/formulario.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$formulario = new Formulario($db);
 
// get posted data
$data = json_decode(file_get_contents('php://input'), true);

$info = array($data);

// configura los valores recibidos en post de la app
$formulario->de_id_usuario= $info[0]["de_id_usuario"];
$formulario->de_fecha_creacion= $info[0]["de_fecha_creacion"];
$formulario->de_transaccion= $info[0]["de_transaccion"];
$formulario->de_valor_solicitud= $info[0]["de_valor_solicitud"];
$formulario->de_justificacion= $info[0]["de_justificacion"];
$formulario->de_adjunto= $info[0]["de_adjunto"];
$formulario->de_estado_id= $info[0]["de_estado_id"];

// insert formulario
$response = $formulario->insert();
if($response != false){
    $response = $response * 1;
    echo json_encode($response); 
}else{
    // Error en caso de que no se pueda modificar
    echo json_encode(false); 
}
?>