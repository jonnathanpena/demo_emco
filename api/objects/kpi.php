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
    public $total;
    public $pendiente;
    public $aprobado;
    public $rechazado;

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
                    group by edo.`de_nombre_estado`
                    order by formularios ASC";
                
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por cantidad y estado
    function readValorEdo(){
    
        // select all query
        $query = "SELECT sum(`de_valor_solicitud`) as valor, edo.`de_nombre_estado`, 
                    (select sum(de_valor_solicitud) FROM `de_formulario`) total
        FROM `de_formulario` as fm
        INNER JOIN `de_estado` AS edo ON (fm.`de_estado_id` = edo.de_id_estado)
        group by edo.`de_nombre_estado`";
        
        //        WHERE fm.`de_fecha_creacion` BETWEEN NOW() - INTERVAL 30 DAY AND NOW()

        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por cantidad y estado
    function readCantCiudad(){
    
        // select all query
       /* $query = "SELECT count(fm.`de_id_formulario`) as formularios, dpto.`de_nombre_dpto`,  can.`nombre_intcant`
                    FROM `de_formulario` as fm
                    INNER JOIN `de_estado` AS edo ON (fm.`de_estado_id` = edo.de_id_estado)
                    INNER JOIN `de_user_dpto` AS ud ON (ud.de_user_id = fm.`de_id_usuario`)
                    INNER JOIN `de_user` AS us ON (us.de_id_user = ud.de_user_id)
                    INNER JOIN `de_persona` AS per ON (us.de_persona_id = per.de_id_persona)
                    LEFT JOIN  `de_departamento` dpto ON (dpto.de_id_departamento = ud.de_dpto_id) 
                    LEFT JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant)
                    WHERE fm.`de_fecha_creacion` BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
                    group by  dpto.`de_nombre_dpto`,  can.`nombre_intcant`";
         */
        $query = "SELECT  can.`nombre_intcant`,
        (SELECT count(pe.`de_id_formulario`) FROM `de_formulario` pe 
         INNER JOIN `de_estado` AS edo ON (pe.`de_estado_id` = edo.de_id_estado)
                            INNER JOIN `de_user_dpto` AS ud ON (ud.de_user_id = pe.`de_id_usuario`)
                            INNER JOIN `de_user` AS us ON (us.de_id_user = ud.de_user_id)
                            INNER JOIN `de_persona` AS per ON (us.de_persona_id = per.de_id_persona)
                            LEFT JOIN  `de_departamento` dpto ON (dpto.de_id_departamento = ud.de_dpto_id) 
                            LEFT JOIN `de_cantones` as cant ON (per.`de_canton_per` = cant.id_intcant)
         WHERE pe.`de_estado_id` = 1 and cant.id_intcant = can.id_intcant) pendiente,
        (SELECT count(ap.`de_id_formulario`) FROM `de_formulario` ap 
         INNER JOIN `de_estado` AS edo ON (ap.`de_estado_id` = edo.de_id_estado)
                            INNER JOIN `de_user_dpto` AS usd ON (usd.de_user_id = ap.`de_id_usuario`)
                            INNER JOIN `de_user` AS usu ON (usu.de_id_user = usd.de_user_id)
                            INNER JOIN `de_persona` AS pers ON (usu.de_persona_id = pers.de_id_persona)
                            LEFT JOIN  `de_departamento` dptos ON (dptos.de_id_departamento = usd.de_dpto_id) 
                            LEFT JOIN `de_cantones` as canto ON (pers.`de_canton_per` = canto.id_intcant)
         WHERE ap.`de_estado_id` = 2 and canto.id_intcant = can.id_intcant) aprobado,
        (SELECT count(re.`de_id_formulario`) FROM `de_formulario` re 
         INNER JOIN `de_estado` AS edo ON (re.`de_estado_id` = edo.de_id_estado)
                            INNER JOIN `de_user_dpto` AS ud ON (ud.de_user_id = re.`de_id_usuario`)
                            INNER JOIN `de_user` AS us ON (us.de_id_user = ud.de_user_id)
                            INNER JOIN `de_persona` AS per ON (us.de_persona_id = per.de_id_persona)
                            LEFT JOIN  `de_departamento` dpto ON (dpto.de_id_departamento = ud.de_dpto_id) 
                            LEFT JOIN `de_cantones` as cant ON (per.`de_canton_per` = cant.id_intcant)
         WHERE re.`de_estado_id` = 3 and cant.id_intcant = can.id_intcant) rechazado
                            FROM `de_formulario` as fm
                            INNER JOIN `de_estado` AS edo ON (fm.`de_estado_id` = edo.de_id_estado)
                            INNER JOIN `de_user_dpto` AS ud ON (ud.de_user_id = fm.`de_id_usuario`)
                            INNER JOIN `de_user` AS us ON (us.de_id_user = ud.de_user_id)
                            INNER JOIN `de_persona` AS per ON (us.de_persona_id = per.de_id_persona)
                            LEFT JOIN  `de_departamento` dpto ON (dpto.de_id_departamento = ud.de_dpto_id) 
                            LEFT JOIN `de_cantones` as can ON (per.`de_canton_per` = can.id_intcant)
                            group by  can.`nombre_intcant`
                            order by aprobado ASC";
        
        //WHERE fm.`de_fecha_creacion` BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
        //
        
        // prepare query statement

        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
