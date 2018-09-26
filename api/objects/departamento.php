<?php
class Departamento {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $de_id_departamento;
    public $de_nombre_dpto;
    
    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener datos por id provincia
    function read(){
    
        // select all query
        $query = "SELECT `de_id_departamento`, `de_nombre_dpto` FROM `de_departamento`
                ORDER BY de_nombre_dpto ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
