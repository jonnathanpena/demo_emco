<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/persona.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$persona = new Persona($db);
 
// get posted data
$data = json_decode(file_get_contents('php://input'), true);

$info = array($data);

// configura los valores recibidos en post de la app
$persona->de_nombre_per= $info[0]["de_nombre_per"];
$persona->de_apellido_per= $info[0]["de_apellido_per"];
$persona->de_celular_per= $info[0]["de_celular_per"];
$persona->de_correo_per = $info[0]["de_correo_per"];
$persona->de_canton_per = $info[0]["de_canton_per"];
$persona->de_id_persona = $info[0]["de_id_persona"];

// insert persona
$response = $persona->update();
if($response == true){
    echo json_encode(true); 
}else{
    // Error en caso de que no se pueda modificar
    echo json_encode(false); 
}
?>