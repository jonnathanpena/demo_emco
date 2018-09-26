<?php
class Estado {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $de_id_estado;
    public $de_nombre_estado;
    
    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener datos por id provincia
    function read(){
    
        // select all query
        $query = "SELECT `de_id_estado`, `de_nombre_estado` FROM `de_estado` ORDER BY `de_id_estado` ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
