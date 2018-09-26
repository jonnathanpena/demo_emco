<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/canton.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$canton = new Canton($db);

// get posted data
$data = json_decode(file_get_contents('php://input'), true);

$info = array($data);

// configura los valores recibidos en post de la app
$canton->prov_canton_id= $info[0]["prov_canton_id"];

// query de lectura
$stmt = $canton->readById();
$num = $stmt->rowCount();

// canton array
$canton_arr=array();
$canton_arr["data"]=array();
 
// check if more than 0 record found
if($num>0){ 
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        $canton_item=array(
            "id_intcant"=>$id_intcant, 
            "prov_canton_id"=>$prov_canton_id,
            "nombre_intcant"=>$nombre_intcant
        );
 
        array_push($canton_arr["data"], $canton_item);
    }
 
    echo json_encode($canton_arr);
}
 
else{
    echo json_encode($canton_arr);
}
?>