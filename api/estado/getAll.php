<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/estado.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$estado = new Estado($db);
 
// query de lectura
$stmt = $estado->read();
$num = $stmt->rowCount();

//estado array
$estado_arr=array();
$estado_arr["data"]=array();
 
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
        $estado_item=array(
            "de_id_estado"=>$de_id_estado, 
            "de_nombre_estado"=>$de_nombre_estado
        );
 
        array_push($estado_arr["data"], $estado_item);
    }
 
    echo json_encode($estado_arr);
}
 
else{
    echo json_encode($estado_arr);
}
?>