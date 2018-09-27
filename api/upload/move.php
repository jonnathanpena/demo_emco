<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get posted data
$data = json_decode(file_get_contents('php://input'), true);

$info = array($data);

// configura los valores recibidos en post de la app
$archivo = $info[0]["archivo"];

// Specifies the path to the file
$path_to_file = "../documentos/".$archivo;
$viejo_archivo = "temp/".$archivo;
move_uploaded_file($viejo_archivo, $path_to_file);
unlink($viejo_archivo);

echo true;

?>
