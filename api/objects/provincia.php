<?php
class Provincia {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $id_intprov;
    public $nombre_intprov;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener datos provincia
    function read(){
    
        // select all query
        $query = "SELECT `id_intprov`, `nombre_intprov` FROM `de_provincias` ORDER BY nombre_intprov ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por id provincia
    function readById(){
    
        // select all query
        $query = "SELECT `id_intprov`, `nombre_intprov` FROM `de_provincias` 
                WHERE id_intprov = ".$this->id_intprov;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    
}
?>
