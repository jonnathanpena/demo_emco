<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// incluye la configuración de la base de datos y la conexión
include_once '../config/database.php';
include_once '../objects/kpi.php';
 
// inicia la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
 
// inicia el objeto
$kpi = new Kpi($db);
 
// query de lectura
$stmt = $kpi->readCantCiudad();
$num = $stmt->rowCount();

//kpi array
$kpi_arr=array();
$kpi_arr["data"]=array();
 
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
        $kpi_item=array(
            /*"formularios"=>$formularios, 
            "de_nombre_dpto"=>$de_nombre_dpto,
            "nombre_intcant"=>$nombre_intcant*/
            "nombre_intcant"=>$nombre_intcant, 
            "pendiente"=>$pendiente,
            "aprobado"=>$aprobado,
            "rechazado"=>$rechazado
        );
 
        array_push($kpi_arr["data"], $kpi_item);
    }
 
    echo json_encode($kpi_arr);
}
 
else{
    echo json_encode($kpi_arr);
}
?>