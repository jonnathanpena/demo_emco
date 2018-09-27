<?php
class Kpi {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $formularios;
    public $de_nombre_estado;
    public $de_nombre_dpto;
    public $nombre_intcant;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener datos por cantidad y estado
     function readCantEdo(){
    
        // select all query
        $query = "SELECT count(fm.`de_id_formulario`) as formularios, edo.`de_nombre_estado`
                    FROM `de_formulario` as fm
                    INNER JOIN `de_estado` AS edo ON (fm.`de_estado_id` = edo.de_id_estado)
                    WHERE fm.`de_fecha_creacion` BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
                    group by edo.`de_nombre_estado`";
                
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por cantidad y estado
    function readValorEdo(){
    
        // select all query
        $query = "SELECT sum(`de_valor_solicitud`) as valor, edo.`de_nombre_estado`
                    FROM `de_formulario` as fm
                    INNER JOIN `de_estado` AS edo ON (fm.`de_estado_id` = edo.de_id_estado)
                    WHERE fm.`de_fecha_creacion` BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
                    group by edo.`de_nombre_estado`";
                
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por cantidad y estado
    function readCantCiudad(){
    
        // select all query
        $query = "SELECT count(fm.`de_id_formulario`) as formularios, dpto.`de_nombre_dpto`,  can.`nombre_intcant`
                    FROM `de_formulario` as fm
                    INNER JOIN `de_estado` AS edo ON (fm.`de_estado_id` = edo.de_id_estado)
                    INNER JOIN `de_user_dpto` AS ud ON (ud.de_user_id = fm.`de_id_usuario`)
                    INNER JOIN `de_user` AS us ON (us.de_id_user = ud.de_user_id)
                    INNER JOIN `de_persona` AS per ON (us.de_persona_id = per.de_id_persona)
                    LEFT JOIN  `de_departamento` dpto ON (dpto.de_id_departamento = ud.de_dpto_id) 
                    LEFT JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant)
                    WHERE fm.`de_fecha_creacion` BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
                    group by  dpto.`de_nombre_dpto`,  can.`nombre_intcant`";
                
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
