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
$formulario->de_id_formulario= $info[0]["de_id_formulario"];

// query de lectura
$stmt = $formulario->readById();
$num = $stmt->rowCount();

//formulario array
$formulario_arr=array();
$formulario_arr["data"]=array();
 
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
        $formulario_item=array(
            "de_id_formulario"=>$de_id_formulario, 
            "de_id_usuario"=>$de_id_usuario, 
            "de_fecha_creacion"=>$de_fecha_creacion, 
            "de_transaccion"=>$de_transaccion, 
            "de_valor_solicitud"=>$de_valor_solicitud, 
            "de_justificacion"=>$de_justificacion, 
            "de_adjunto"=>$de_adjunto, 
            "de_estado_id"=>$de_estado_id,
            "de_id_user_dpto"=>$de_id_user_dpto, 
            "de_user_id"=>$de_user_id, 
            "de_dpto_id"=>$de_dpto_id, 
            "de_nombre_dpto"=>$de_nombre_dpto,
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
 
        array_push($formulario_arr["data"], $formulario_item);
    }
 
    echo json_encode($formulario_arr);
}
 
else{
    echo json_encode($formulario_arr);
}
?>