<?php
//Clase Database creada para gestionar la conexión a la base de datos
class Database {
    private $pdo; //variable privada para almacenar la conexión

    //Crea la conexión con la base de datos
    public function __construct() {
        $config = require __DIR__ . '/../../config/config.php';
        $dsn = "mysql:host=" . $config['host'] . ";dbname=" . $config['database'];
        $this->pdo = new PDO($dsn, $config['username'], $config['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /*Método para guardar la instancia de conexión PDO,
    PDO es PHP Data Object se utiliza para interactuar
    con la base de datos, ofreciendo una interfaz segura*/
    public function obtenerConexion() {
        return $this->pdo;
    }
}
