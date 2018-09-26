<?php
class User {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $de_id_user;
    public $de_usuario;
    public $de_clave;
    public $de_persona_id;
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

    // obtener datos usuario
    function read(){
    
        // select all query
        $query = "SELECT us.`de_id_user`, us.`de_usuario`, us.`de_clave`, per.`de_id_persona`,
                     per.`de_nombre_per`, per.`de_apellido_per`, per.`de_celular_per`, per.`de_correo_per`, 
                     per.`de_canton_per`, can.`nombre_intcant`, can.prov_canton_id, pro.`nombre_intprov`
                FROM `de_user` as us
                INNER JOIN `de_persona` as per on (us.`de_persona_id` =  per.`de_id_persona`)
                INNER JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant)
                INNER JOIN `de_provincias` as pro ON (can.prov_canton_id = pro.`id_intprov`)";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por id usuario
    function readById(){
    
        // select all query
        $query = "SELECT us.`de_id_user`, us.`de_usuario`, us.`de_clave`, per.`de_id_persona`,
                        per.`de_nombre_per`, per.`de_apellido_per`, per.`de_celular_per`, per.`de_correo_per`, 
                        per.`de_canton_per`, can.`nombre_intcant`, can.prov_canton_id, pro.`nombre_intprov`
                FROM `de_user` as us
                INNER JOIN `de_persona` as per on (us.`de_persona_id` =  per.`de_id_persona`)
                INNER JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant)
                INNER JOIN `de_provincias` as pro ON (can.prov_canton_id = pro.`id_intprov`)
                WHERE us.`de_id_user` = ".$this->de_id_user;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
    // insertar un persona
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `de_user`(`de_usuario`, `de_clave`, `de_persona_id`) VALUES  (                        
                        '".$this->de_usuario."',
                        '".$this->de_clave."',
                        ".$this->de_persona_id."
                    )";
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query); 

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return false;
        }           
        
    }


    function cambioClave() {
        $query = "UPDATE `de_user` SET `de_clave`= '".$this->de_clave."' WHERE `de_id_user` = ".$this->de_id_user;
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }    

    
}
?>
