<?php
class LogLogin {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $de_usuario_log;
    public $de_fecha_log;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }
    
    // insertar log de login
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `de_log_login`(`de_usuario_log`, `de_fecha_log`) VALUES (                        
                        ".$this->de_usuario_log.",
                        '".$this->de_fecha_log."'
                    )";
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
