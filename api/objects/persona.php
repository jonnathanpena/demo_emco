<?php
class Persona {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $de_id_persona;
    public $de_nombre_per;
    public $de_apellido_per;
    public $de_celular_per;
    public $de_correo_per;
    public $de_canton_per;
    public $nombre_intcant;
    public $nombre_intprov;
    public $prov_canton_id;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener persona
    function read(){
    
        // select all query
        $query = "SELECT per.`de_id_persona`, per.`de_nombre_per`, per.`de_apellido_per`, per.`de_celular_per`, 
                    per.`de_correo_per`, per.`de_canton_per`, can.`nombre_intcant`, can.prov_canton_id, pro.`nombre_intprov`
                FROM `de_persona` as per
                INNER JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant)
                INNER JOIN `de_provincias` as pro ON (can.prov_canton_id = pro.`id_intprov`)";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener por id persona
    function readById(){
    
        // select all query
        $query = "SELECT per.`de_id_persona`, per.`de_nombre_per`, per.`de_apellido_per`, per.`de_celular_per`, 
                    per.`de_correo_per`, per.`de_canton_per`, can.`nombre_intcant`, can.prov_canton_id, pro.`nombre_intprov`
                FROM `de_persona` as per
                INNER JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant)
                INNER JOIN `de_provincias` as pro ON (can.prov_canton_id = pro.`id_intprov`) 
                WHERE per.`de_id_persona` = ".$this->de_id_persona;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
    // insertar un persona
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `de_persona`(`de_nombre_per`, `de_apellido_per`, `de_celular_per`, `de_correo_per`, 
                    `de_canton_per`) VALUES  (                        
                        '".$this->de_nombre_per."',
                        '".$this->de_apellido_per."',
                        '".$this->de_celular_per."',
                        '".$this->de_correo_per."',
                        ".$this->de_canton_per."
                    )";
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query); 

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return false;
        }           
        
    }

    // actualizar datos de persona
    function update(){
    
        // query         
        $query = "UPDATE `de_persona` SET 
                    `de_nombre_per`= '".$this->de_nombre_per."',
                    `de_apellido_per`= '".$this->de_apellido_per."',
                    `de_celular_per`= '".$this->de_celular_per."',
                    `de_correo_per`= '".$this->de_correo_per."',
                    `de_canton_per`= ".$this->de_canton_per."
                    WHERE `de_id_persona` = ".$this->de_id_persona;       
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }       
        
    }

    
}
?>