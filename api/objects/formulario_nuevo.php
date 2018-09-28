<?php
class FormularioNuevo {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $de_id_for_nue;
    public $de_formulario_id;
    public $de_tipo_documento;
    public $de_num_documento;
    public $de_prioridad;
    public $de_id_formulario;
    public $de_id_usuario;
    public $de_fecha_creacion;
    public $de_transaccion;
    public $de_valor_solicitud;
    public $de_justificacion;
    public $de_adjunto;
    public $de_estado_id;
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

    // obtener datos formulario
    function read(){
    
        // select all query
        $query = "SELECT fm.`de_id_formulario`, fm.`de_id_usuario`, fm.`de_fecha_creacion`, fm.`de_transaccion`, 
                    fm.`de_valor_solicitud`, fm.`de_justificacion`, fm.`de_adjunto`, fm.`de_estado_id`, 
                    fn.`de_tipo_documento`, fn.`de_num_documento`, fn.`de_prioridad`,
                    ud.`de_id_user_dpto`, ud.`de_user_id`, ud.`de_dpto_id`, dpt.`de_nombre_dpto`, 
                    us.`de_id_user`, us.`de_usuario`, us.`de_clave`, per.`de_id_persona`,
                    per.`de_nombre_per`, per.`de_apellido_per`, per.`de_celular_per`, per.`de_correo_per`, 
                    per.`de_canton_per`, can.`nombre_intcant`, can.prov_canton_id, pro.`nombre_intprov` 
                FROM `de_formulario` as fm
                INNER JOIN `de_user` as us ON (us.`de_id_user` = fm.`de_id_usuario`)
                LEFT JOIN `de_formulario_nuevo`as fn ON (fn.`de_formulario_id` = fm.`de_id_formulario`)
                LEFT JOIN  `de_user_dpto` as ud  on (ud.`de_user_id` =  us.`de_id_user`)
                LEFT JOIN `de_departamento` as dpt ON (ud.`de_dpto_id` = dpt.`de_id_departamento`)
                LEFT JOIN `de_persona` as per on (us.`de_persona_id` =  per.`de_id_persona`)
                LEFT JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant) 
                LEFT JOIN `de_provincias` as pro ON (can.prov_canton_id = pro.`id_intprov`)
                ORDER BY fm.`de_fecha_creacion` DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

     // obtener datos por id formulario
     function readById(){
    
        // select all query
        $query = "SELECT fm.`de_id_formulario`, fm.`de_id_usuario`, fm.`de_fecha_creacion`, fm.`de_transaccion`, 
                    fm.`de_valor_solicitud`, fm.`de_justificacion`, fm.`de_adjunto`, fm.`de_estado_id`, 
                    fn.`de_tipo_documento`, fn.`de_num_documento`, fn.`de_prioridad`,
                    ud.`de_id_user_dpto`, ud.`de_user_id`, ud.`de_dpto_id`, dpt.`de_nombre_dpto`, 
                    us.`de_id_user`, us.`de_usuario`, us.`de_clave`, per.`de_id_persona`,
                    per.`de_nombre_per`, per.`de_apellido_per`, per.`de_celular_per`, per.`de_correo_per`, 
                    per.`de_canton_per`, can.`nombre_intcant`, can.prov_canton_id, pro.`nombre_intprov` 
                FROM `de_formulario` as fm
                INNER JOIN `de_user` as us ON (us.`de_id_user` = fm.`de_id_usuario`)
                LEFT JOIN `de_formulario_nuevo`as fn ON (fn.`de_formulario_id` = fm.`de_id_formulario`)
                LEFT JOIN  `de_user_dpto` as ud  on (ud.`de_user_id` =  us.`de_id_user`)
                LEFT JOIN `de_departamento` as dpt ON (ud.`de_dpto_id` = dpt.`de_id_departamento`)
                LEFT JOIN `de_persona` as per on (us.`de_persona_id` =  per.`de_id_persona`)
                LEFT JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant) 
                LEFT JOIN `de_provincias` as pro ON (can.prov_canton_id = pro.`id_intprov`)
                WHERE fm.`de_id_formulario`= ".$this->de_id_formulario." 
                ORDER BY fm.`de_fecha_creacion` DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por id formulario
    function readByIdUser(){
    
        // select all query
        $query = "SELECT fm.`de_id_formulario`, fm.`de_id_usuario`, fm.`de_fecha_creacion`, fm.`de_transaccion`, 
                    fm.`de_valor_solicitud`, fm.`de_justificacion`, fm.`de_adjunto`, fm.`de_estado_id`, 
                    fn.`de_tipo_documento`, fn.`de_num_documento`, fn.`de_prioridad`,
                    ud.`de_id_user_dpto`, ud.`de_user_id`, ud.`de_dpto_id`, dpt.`de_nombre_dpto`, 
                    us.`de_id_user`, us.`de_usuario`, us.`de_clave`, per.`de_id_persona`,
                    per.`de_nombre_per`, per.`de_apellido_per`, per.`de_celular_per`, per.`de_correo_per`, 
                    per.`de_canton_per`, can.`nombre_intcant`, can.prov_canton_id, pro.`nombre_intprov` 
                FROM `de_formulario` as fm
                INNER JOIN `de_user` as us ON (us.`de_id_user` = fm.`de_id_usuario`)
                LEFT JOIN `de_formulario_nuevo`as fn ON (fn.`de_formulario_id` = fm.`de_id_formulario`)
                LEFT JOIN  `de_user_dpto` as ud  on (ud.`de_user_id` =  us.`de_id_user`)
                LEFT JOIN `de_departamento` as dpt ON (ud.`de_dpto_id` = dpt.`de_id_departamento`)
                LEFT JOIN `de_persona` as per on (us.`de_persona_id` =  per.`de_id_persona`)
                LEFT JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant) 
                LEFT JOIN `de_provincias` as pro ON (can.prov_canton_id = pro.`id_intprov`)
                WHERE fm.`de_id_usuario`= ".$this->de_id_usuario." 
                ORDER BY fm.`de_fecha_creacion` DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
    // insertar un formulario
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `de_formulario_nuevo`(`de_formulario_id`, `de_tipo_documento`, `de_num_documento`, 
                    `de_prioridad`) VALUES  (                        
                        ".$this->de_formulario_id.",
                        '".$this->de_tipo_documento."',
                        '".$this->de_num_documento."',
                        '".$this->de_prioridad."')";
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
