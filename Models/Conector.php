<?php
/**
 *
 *@author Wilber Tobar
 */
 //creo una clase para coneccion a la DB
 class Conector {
    private $dns ="mysql:host=localhost;dbname=pruebapdo";
    private $user = "root";
    private $pass = "";
    private $con = null;
    function __construct() {
        try {
            $this->con = new PDO($this->dns, $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $exc) {
            echo "Error= ".$exc->getTraceAsString();
        }    
    }
    public function getConexion() {
        return $this->con;
    }
    public function __destruct() {
        $this->con = null;
    }
}
?>