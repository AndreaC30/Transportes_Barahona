<?php
//Modelo Usuario necesario para la autenticacion y manejo de usuarios.
require_once __DIR__ . '/../models/Usuario.php';

class LoginController {
    private $usuarioModel; // Variable para almacenar el modelo Usuario

    //Instancia el modelo usuario
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    //Método para inicio de sesión, verificar solicitud, recupera el email y contraseña
    //Verifica si el usuario existe.
    public function iniciarSesion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $contrasenia = $_POST['contrasenia'];

            try {
                $usuario = $this->usuarioModel->obtenerUsuarioPorEmail($email);

                if ($usuario && $this->usuarioModel->verificarContrasena($email, $contrasenia)) {
                    // Iniciar sesión
                    $_SESSION['usuario_id'] = $usuario['usuario_id'];
                    $_SESSION['nombre_usuario'] = $usuario['nombre'];
                    $_SESSION['nombre_rol'] = $usuario['nombre_rol'];

                    // Redirige según el rol
                    $this->redirigirSegunRol($_SESSION['nombre_rol']);
                } else {
                    //Mensaje de error
                    header("Location: /Transportes_Barahona/public/index.php?action=iniciar_sesion&error=credenciales_invalidas");
                    exit();
                }
            } catch (Exception $e) {
                // Mensaje de error general
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Método no permitido.";
        }
    }

    //Método para redirigir al usuario al area correcta según el rol.
    private function redirigirSegunRol($rol) {
        switch ($rol) {
            case 'administrador':
                header("Location: /Transportes_Barahona/public/index.php?action=area_administrativa");
                break;
            case 'cliente':
                header("Location: /Transportes_Barahona/public/index.php?action=area_personal");
                break;
            default:
                header("Location: /Transportes_Barahona/public/index.php");
                break;
        }
        exit();
    }
}
