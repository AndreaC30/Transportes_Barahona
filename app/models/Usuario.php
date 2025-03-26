<?php
require_once __DIR__ . '/../core/Database.php';

class Usuario {
    private $db;
    

    /*Método que segura que cada modelo tenga acceso directo a la conexión 
    con la base de datos sin necesidad de repetir la lógica de conexión.
    */
    public function __construct() {
        $this->db = (new Database())->obtenerConexion();
    }

    //Método para registrar usuarios nuevos
    //Llamado en RegistroController.php
    public function registrarUsuario($nombre, $email, $direccion, $numero_telefono, $contrasenia, $nombre_rol) {
        $stmt = $this->db->prepare("INSERT INTO Usuario (nombre, email, direccion, numero_telefono, contrasenia, nombre_rol) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $email, $direccion, $numero_telefono, $contrasenia, $nombre_rol]);
    }

    //Método para validar contraseñas al iniciar sesión.
    //Llamado en LoginController.php
    public function verificarContrasena($email, $contrasena) {
        $stmt = $this->db->prepare("SELECT contrasenia FROM Usuario WHERE email = ?");
        $stmt->execute([$email]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado && password_verify($contrasena, $resultado['contrasenia'])) {
            return true; //contraseña coincide
        }

        return false; // Contraseña incorrecta o email no encontrado
    }

    //Método para verificar si el email ya esta registrado.
    //Llamado en RegistroController.php
    public function verificarEmail($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM Usuario WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    //Método para obtener información del usuario  
    //Llamado en LoginController.php y RegistroController.php  
    public function obtenerUsuarioPorEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM Usuario WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Método para obtener información del usuario
    //Llamado en ClienteController.php
    public function obtenerUsuarioPorId($usuario_id) {
        $stmt = $this->db->prepare("SELECT * FROM Usuario WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Método para guardar cambios en el perfil
    //Llamado en ClienteController.php
    public function actualizarPerfil($usuario_id, $direccion, $numero_telefono) {
        $stmt = $this->db->prepare("UPDATE Usuario SET direccion = ?, numero_telefono = ? WHERE usuario_id = ?");
        return $stmt->execute([$direccion, $numero_telefono, $usuario_id]);
    }
    
    //Método para cambiar la contraseña del usuario
    //Llamado en ClienteController.php
    public function cambiarContrasena($usuario_id, $contrasena_actual, $nueva_contrasena) {
        $stmt = $this->db->prepare("SELECT contrasenia FROM Usuario WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($contrasena_actual, $usuario['contrasenia'])) {
            $nueva_contrasena_hash = password_hash($nueva_contrasena, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE Usuario SET contrasenia = ? WHERE usuario_id = ?");
            return $stmt->execute([$nueva_contrasena_hash, $usuario_id]);
        }
        return false;
    } 

  
   
      
}