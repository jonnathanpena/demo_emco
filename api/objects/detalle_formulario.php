<?php
class DetalleFormulario {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $de_id_det_for;
    public $de_formulario_id;
    public $de_ruta_adjunto;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener datos por id formulario
     function readById(){
    
        // select all query
        $query = "SELECT `de_id_det_for`, `de_formulario_id`, `de_ruta_adjunto` 
                    FROM `de_detalle_formularios` 
                    WHERE `de_formulario_id` = ".$this->de_formulario_id;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // insertar un formulario
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `de_detalle_formularios`(`de_formulario_id`, `de_ruta_adjunto`) VALUES (                        
                        ".$this->de_formulario_id.",
                        '".$this->de_ruta_adjunto."')";
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query); 

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return false;
        }           
        
    }

    
}
?>
