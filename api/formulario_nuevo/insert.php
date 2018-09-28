<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/formulario_nuevo.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$formulario = new FormularioNuevo($db);
 
// get posted data
$data = json_decode(file_get_contents('php://input'), true);

$info = array($data);

// configura los valores recibidos en post de la app
$formulario->de_formulario_id= $info[0]["de_formulario_id"];
$formulario->de_tipo_documento= $info[0]["de_tipo_documento"];
$formulario->de_num_documento= $info[0]["de_num_documento"];
$formulario->de_prioridad= $info[0]["de_prioridad"];

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