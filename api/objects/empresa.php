<?php
class Empresa {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $de_id_empresa;
    public $de_nombre_emp;
    public $de_ruc_emp;
    public $de_correo_emp;
    public $de_convencional_emp;
    public $de_web_emp;
    public $de_creadaBy_emp;
    public $de_fecha_creacion_emp;
    
    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener datos por id provincia
    function read(){
    
        // select all query
        $query = "SELECT `de_id_empresa`, `de_nombre_emp`, `de_ruc_emp`, `de_correo_emp`, `de_convencional_emp`, 
                    `de_web_emp`, `de_creadaBy_emp`, `de_fecha_creacion_emp` 
                FROM `de_empresa` ";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
