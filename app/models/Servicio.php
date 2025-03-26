<?php
require_once __DIR__ . '/../core/Database.php';

class Servicio {
    private $db;
    
    
    /*Método que segura que cada modelo tenga acceso directo a la conexión 
    con la base de datos sin necesidad de repetir la lógica de conexión.
    */     public function __construct() {
        $this->db = (new Database())->obtenerConexion();
    }

    //Método para mostrar la lista de servicios disponibles al cliente
    //Retorna un arreglo asociativo que tiene los registros de la tabla
    //Llamado en el controlador ClienteController.php
    public function obtenerTodosLosServicios() {
        $stmt = $this->db->prepare("SELECT * FROM Servicio");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
}