<?php
class AreaPersonalController {

    /*Gestiona y muestra el area personal de un usuario, verifica si existe una sesión activa
    si el usuario tiene rol de cliente, si no hay sesión activa. */
    public function mostrarAreaPersonal() {
        // Validar si el usuario tiene sesión activa
        if (isset($_SESSION['usuario_id'])) {
            if ($_SESSION['nombre_rol'] === 'cliente') {
                require '../app/views/usuario/area_personal.php'; // Vista para clientes
            } elseif ($_SESSION['nombre_rol'] === 'administrador') {
                header("Location: /Transportes_Barahona/public/index.php?action=area_administrativa");
            } else {
                echo "Rol no reconocido.";
            }
        } else {
            header("Location: /Transportes_Barahona/public/index.php?action=iniciar_sesion");
            exit();
        }
    }

    /*Gestiona y muestra el area personal de un administrador, verifica si es administrador
    si hay sesion activa*/
    public function mostrarAreaAdministrativa() {
        // Validar si el usuario tiene sesión activa y es administrador
        if (isset($_SESSION['usuario_id']) && $_SESSION['nombre_rol'] === 'administrador') {
            require '../app/views/admin/area_administrativa.php'; // Cargar vista del administrador
        } else {
            header("Location: /Transportes_Barahona/public/index.php?action=iniciar_sesion");
            exit();
        }
    }
}
