<?php
//Modelo Usuario para gestionar la logica relacionada con el registro de los usuarios
require_once __DIR__ . '/../models/Usuario.php';

class RegistroController {
    private $usuarioModel; // Variable para almacenar el modelo Usuario

    //Instancia el modelo Usuario
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    /*Método para registrar un nuevo usuario, recogiendo los datos ingresados y
    guardandolos en la base de datos, verifica si el correo ya existe*/
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre_usuario'];
            $email = $_POST['email'];
            $direccion = $_POST['direccion'];
            $numero_telefono = $_POST['numero_telefono'];
            $contrasenia = password_hash($_POST['contrasenia'], PASSWORD_BCRYPT);
            $nombre_rol = 'cliente'; // Asignar automáticamente el rol de cliente
    
            try {
                $usuarioModel = new Usuario();
                if ($usuarioModel->verificarEmail($email)) {
                    // Si el correo ya está registrado
                    header("Location: /Transportes_Barahona/public/index.php?action=registro&error=email_exists");
                    exit();
                }
                if ($usuarioModel->registrarUsuario($nombre, $email, $direccion, $numero_telefono, $contrasenia, $nombre_rol)) {
                    // Mostrar mensaje de éxito en la página de inicio de sesión
                    header("Location: /Transportes_Barahona/public/index.php?action=iniciar_sesion&success=registered");
                    exit();
                } else {
                    echo "Error al registrar el usuario.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Método no permitido.";
        }
    }
   
}