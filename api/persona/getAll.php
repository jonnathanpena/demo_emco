<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/persona.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$persona = new Persona($db);
 
// query de lectura
$stmt = $persona->read();
$num = $stmt->rowCount();

//persona array
$persona_arr=array();
$persona_arr["data"]=array();
 
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
        $persona_item=array(
            "de_id_persona"=>$de_id_persona, 
            "de_nombre_per"=>$de_nombre_per, 
            "de_apellido_per"=>$de_apellido_per, 
            "de_celular_per"=>$de_celular_per, 
            "de_correo_per"=>$de_correo_per, 
            "de_canton_per"=>$de_canton_per, 
            "nombre_intcant"=>$nombre_intcant, 
            "prov_canton_id"=>$prov_canton_id,
            "nombre_intprov"=>$nombre_intprov
        );
 
        array_push($persona_arr["data"], $persona_item);
    }
 
    echo json_encode($persona_arr);
}
 
else{
    echo json_encode($persona_arr);
}
?>