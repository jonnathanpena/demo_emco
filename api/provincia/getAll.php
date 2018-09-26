<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/provincia.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$provincia = new Provincia($db);
 
// query de lectura
$stmt = $provincia->read();
$num = $stmt->rowCount();

//provincia array
$provincia_arr=array();
$provincia_arr["data"]=array();
 
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
        $provincia_item=array(
            "id_intprov"=>$id_intprov, 
            "nombre_intprov"=>$nombre_intprov
        );
 
        array_push($provincia_arr["data"], $provincia_item);
    }
 
    echo json_encode($provincia_arr);
}
 
else{
    echo json_encode($provincia_arr);
}
?>