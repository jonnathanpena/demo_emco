<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/user.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$user = new User($db);
 
// query de lectura
$stmt = $user->read();
$num = $stmt->rowCount();

//user array
$user_arr=array();
$user_arr["data"]=array();
 
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
        $user_item=array(
            "de_id_user"=>$de_id_user, 
            "de_usuario"=>$de_usuario, 
            "de_clave"=>$de_clave, 
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
 
        array_push($user_arr["data"], $user_item);
    }
 
    echo json_encode($user_arr);
}
 
else{
    echo json_encode($user_arr);
}
?>