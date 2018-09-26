<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/detalle_formulario.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$detFormulario = new DetalleFormulario($db);

// get posted data
$data = json_decode(file_get_contents('php://input'), true);

$info = array($data);

// configura los valores recibidos en post de la app
$detFormulario->de_formulario_id= $info[0]["de_formulario_id"];

// query de lectura
$stmt = $detFormulario->readById();
$num = $stmt->rowCount();

//detFormulario array
$detFormulario_arr=array();
$detFormulario_arr["data"]=array();
 
// check if more than 0 record found
if($num>0){ 
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        //Los nombres acá son iguales a los de la clase iguales a las columnas de la BD
        $detFormulario_item=array(
            "de_id_det_for"=>$de_id_det_for, 
            "de_formulario_id"=>$de_formulario_id, 
            "de_ruta_adjunto"=>$de_ruta_adjunto
        );
 
        array_push($detFormulario_arr["data"], $detFormulario_item);
    }
 
    echo json_encode($detFormulario_arr);
}
 
else{
    echo json_encode($detFormulario_arr);
}
?>