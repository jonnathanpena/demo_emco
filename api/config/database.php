<?php
class Database{

    /*ESTA CLASE ES UNIVERSAL, SOLO SE DEBE MODIFICAR SON LOS DATOS
    DE BASE DE DATOS, USUARIO Y CLAVE, EL RESTO QUEDA IGUALITO*/
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "proco389_demo_emco";
    private $username = "proco389_demo";
    private $password = "Demo2018";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>