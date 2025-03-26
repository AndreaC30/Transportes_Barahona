<?php

class LogoutController {
    
    //Método para cerrar sesión
    public function cerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
        // Redirige a la vista de confirmación de cierre de sesión
        header("Location: /Transportes_Barahona/public/index.php?action=iniciar_sesion");
        exit();
    }
}