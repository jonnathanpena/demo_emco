<?php
class UserDpto {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $de_id_user_dpto;
    public $de_user_id;
    public $de_dpto_id;
    public $de_nombre_dpto;
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

    // obtener datos usuario y dpto
    function read(){
    
        // select all query
        $query = "SELECT ud.`de_id_user_dpto`, ud.`de_user_id`, ud.`de_dpto_id`, dpt.`de_nombre_dpto`, 
                    us.`de_id_user`, us.`de_usuario`, us.`de_clave`, per.`de_id_persona`,
                        per.`de_nombre_per`, per.`de_apellido_per`, per.`de_celular_per`, per.`de_correo_per`, 
                        per.`de_canton_per`, can.`nombre_intcant`, can.prov_canton_id, pro.`nombre_intprov`
                FROM `de_user` as us
                LEFT JOIN  `de_user_dpto` as ud  on (ud.`de_user_id` =  us.`de_id_user`)
                LEFT JOIN `de_departamento` as dpt ON (ud.`de_dpto_id` = dpt.`de_id_departamento`)
                LEFT JOIN `de_persona` as per on (us.`de_persona_id` =  per.`de_id_persona`)
                LEFT JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant)
                LEFT JOIN `de_provincias` as pro ON (can.prov_canton_id = pro.`id_intprov`)";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por id user_dpto
    function readById(){
    
        // select all query
        $query = "SELECT ud.`de_id_user_dpto`, ud.`de_user_id`, ud.`de_dpto_id`, dpt.`de_nombre_dpto`, 
                    us.`de_id_user`, us.`de_usuario`, us.`de_clave`, per.`de_id_persona`,
                        per.`de_nombre_per`, per.`de_apellido_per`, per.`de_celular_per`, per.`de_correo_per`, 
                        per.`de_canton_per`, can.`nombre_intcant`, can.prov_canton_id, pro.`nombre_intprov`
                FROM `de_user` as us
                LEFT JOIN  `de_user_dpto` as ud  on (ud.`de_user_id` =  us.`de_id_user`)
                LEFT JOIN `de_departamento` as dpt ON (ud.`de_dpto_id` = dpt.`de_id_departamento`)
                LEFT JOIN `de_persona` as per on (us.`de_persona_id` =  per.`de_id_persona`)
                LEFT JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant)
                LEFT JOIN `de_provincias` as pro ON (can.prov_canton_id = pro.`id_intprov`)
                WHERE ud.`de_id_user_dpto` = ".$this->de_id_user_dpto;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
    // insertar un user_dpto
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `de_user_dpto`(`de_user_id`, `de_dpto_id`) VALUES (      
                        ".$this->de_user_id.",
                        ".$this->de_dpto_id."
                    )";
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query); 

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return false;
        }           
        
    }

    // actualizar datos de user_dpto
    function update(){
    
        // query         
        $query = "UPDATE `de_user_dpto` SET 
                    `de_dpto_id`= ".$this->de_dpto_id."
                    WHERE `de_id_user_dpto` = ".$this->de_id_user_dpto;       
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
