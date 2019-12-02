<?php


class Conexion {
    private $host;
    private $username;
    private $passwd;
    private $dbname;
    private $port;
    
    function __construct() {
        $this->host = "localhost";
        $this->username = "root";
        $this->passwd = "";
        $this->dbname = "gana";
        $this->port = "3306";
    }

    public function conectar(){
        try {
            $con = new mysqli($this->host, $this->username, $this->passwd, $this->dbname, $this->port);
            $con->set_charset("utf8");
            return $con;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function desconectar() {
        $this->conectar()->close();
    }
}
