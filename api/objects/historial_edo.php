<?php
class HistorialEdo {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $de_edo_id_hist;
    public $de_formulario_id_hist;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }
    
    // insertar historia edo
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `de_historial_edo`(`de_edo_id_hist`, `de_formulario_id_hist`, de_historial_edo) VALUES (                        
                        ".$this->de_edo_id_hist.",
                        ".$this->de_formulario_id_hist.",
                        '".$this->de_historial_edo."')";
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
