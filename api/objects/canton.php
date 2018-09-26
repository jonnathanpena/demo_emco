<?php
class Canton {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $id_intcant;
    public $prov_canton_id;
    public $nombre_intcant;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener datos por id provincia
    function readById(){
    
        // select all query
        $query = "SELECT `id_intcant`, `prov_canton_id`, `nombre_intcant` FROM `de_cantones`
                WHERE prov_canton_id = ".$this->prov_canton_id."
                ORDER BY nombre_intcant ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    
}
?>
