<?php
    //Verifica que la sesion no este iniciada, si es correcto la inicia.
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //Dirige las rutas de la aplicación
class Router {

    //Función principal que determina que acción realizar segun el parametro action en la URL
    public function route() {

        // si no se especifica el parametro en action usa default
        $action = $_GET['action'] ?? 'default';

        // Realiza el enrrutamiento basado en la acción solicitada
        switch ($action) {

            //case para mostrar formulario de registro
            case 'registro':
                    require '../app/views/usuario/registro.php';
                    break;
                    
           //case para registrar a un nuevo usuario
            case 'registrar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    require_once '../app/controllers/RegistroController.php';
                    $controller = new RegistroController();
                    $controller->registrar();
                } else {
                    require '../app/views/usuario/registro.php';
                }
                break;

           //case para mostrar el iniciar sesión
            case 'iniciar_sesion':
                    require_once '../app/controllers/LoginController.php';
                    $controller = new LoginController();
                    
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $controller->iniciarSesion();
                } else {
                        require '../app/views/usuario/login.php'; 
                }
                break;

            //case para mostrar el cerrar sesión    
            case 'cerrar_sesion':
                    require_once '../app/controllers/LogoutController.php';
                    $controller = new LogoutController();
                    $controller->cerrarSesion();
                break;

            //case para mostrar al usuario el area personal
            case 'area_personal':
                    require_once '../app/controllers/AreaPersonalController.php';
                    $controller = new AreaPersonalController();
                    $controller->mostrarAreaPersonal();
                break;

            //case para mostrar al administrador el area administrativa   
            case 'area_administrativa':
                    require_once '../app/controllers/AreaPersonalController.php';
                    $controller = new AreaPersonalController();
                    $controller->mostrarAreaAdministrativa();
                break;

            //case para actualizar el perfil del usuario cliente
            case 'actualizar_perfil':
                if (isset($_SESSION['usuario_id']) && $_SESSION['nombre_rol'] === 'cliente') {
                    require_once '../app/controllers/ClienteController.php';
                    $controller = new ClienteController();
                    $controller->actualizarPerfil();
                } else {
                        echo "Acceso denegado.";
                }
                break;

            //case para cambiar la contraseña del usuario cliente.         
            case 'cambiar_contrasena':
                if (isset($_SESSION['usuario_id']) && $_SESSION['nombre_rol'] === 'cliente') {
                    require_once '../app/controllers/ClienteController.php';
                    $controller = new ClienteController();
                    $controller->cambiarContrasena();
                } else {
                         echo "Acceso denegado.";
                }
                break;
    

            //Case para mostrar la vista de solicitar_servicio.
            case 'solicitar_servicio':
                    require '../app/views/usuario/solicitar_servicio.php';
                break;

            //case para guardar una solicitud de servicio
            case 'guardar_solicitud_servicio':
                    require_once '../app/controllers/ClienteController.php';
                    $controller = new ClienteController();
                    $controller->guardarSolicitudServicio();
                break;

            //Case para consultar el estado de los servicios
            case 'consultar_estado':
                if (isset($_SESSION['usuario_id']) && $_SESSION['nombre_rol'] === 'cliente') {
                    require_once '../app/controllers/ClienteController.php';
                        $controller = new ClienteController();
                        $controller->consultarEstado();
                } else {
                    echo "Acceso denegado.";
                }
                break;

            //case para cancelar una solicitud de servicio.
            case 'cancelar_solicitud':
                    require_once '../app/controllers/ClienteController.php';
                    $controller = new ClienteController();
                    $controller->cancelarSolicitud();
                break;

            //cases para mostrar distintas paginas de forma estatica.
            case 'quienes_somos':
                    require '../app/views/usuario/quienes_somos.php';
                break;
            case 'mudanzas':
                    require '../app/views/usuario/mudanzas.php';
                break;
                    
            case 'embalaje':
                    require '../app/views/usuario/embalaje.php';
                break;
                    
            case 'guardamuebles':
                    require '../app/views/usuario/guardamuebles.php';
                break;
                    
            case 'paqueteria_frio':
                    require '../app/views/usuario/paqueteria_frio.php';
                break;

            //case para guardar un presupuesto        
            case 'guardar_presupuesto':
                    require_once '../app/controllers/ClienteController.php';
                    $controller = new ClienteController();
                    $controller->guardarPresupuesto();
                break;

            //case para confirmacion de presupuesto    
            case 'confirmacion_presupuesto':
                    require_once '../app/views/usuario/confirmacion_presupuesto.php';
                break;

            //cases para el area administrativa
            // case para gestionar usuarios
            case 'gestionar_usuarios':
                if (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] === 'administrador') {
                    require_once '../app/controllers/AdministradorController.php';
                    $controller = new AdministradorController();
                    $controller->gestionarUsuarios();
                } else {
                        echo "Acceso denegado.";
                }
                break;
                
            //case para convertir aun usuario cliente en administrador       
            case 'convertir_administrador':
                if ($_SESSION['nombre_rol'] === 'administrador') {
                    require_once '../app/controllers/AdministradorController.php';
                    $controller = new AdministradorController();
                    $controller->convertirEnAdministrador();
                } else {
                        echo "Acceso denegado.";
                }
                break;

           //case para eliminar a un usuario         
            case 'eliminar_usuario':
                if ($_SESSION['nombre_rol'] === 'administrador') {
                    require_once '../app/controllers/AdministradorController.php';
                    $controller = new AdministradorController();
                    $controller->eliminarUsuario();
                } else {
                        echo "Acceso denegado.";
                }
                break;

            //case para revisar las solicitudes realizadas por los usuarios clientes    
            case 'revisar_solicitudes':
                if ($_SESSION['nombre_rol'] === 'administrador') {
                    require_once '../app/controllers/AdministradorController.php';
                    $controller = new AdministradorController();
                    $controller->revisarSolicitudes();
                } else {
                        echo "Acceso denegado.";
                }
                break;

            //case para visualizar los reportes    
            case 'visualizar_reportes':
                if ($_SESSION['nombre_rol'] === 'administrador') {
                    require '../app/views/admin/visualizar_reportes.php';
                } else {
                        echo "Acceso denegado.";
                }
                break;

            //case para generar reportes       
            case 'generar_reporte':
                if (isset($_SESSION['usuario_id']) && $_SESSION['nombre_rol'] === 'administrador') {
                    require_once '../app/controllers/AdministradorController.php';
                    $controller = new AdministradorController();
                    $controller->generarReporte();
                } else {
                        header("Location: /Transportes_Barahona/public/index.php?action=iniciar_sesion");
                 exit();
                }
                break;

            // case para cambiar el estado de un pedido
            case 'cambiar_estado':
                if ($_SESSION['nombre_rol'] === 'administrador') {
                    require_once '../app/controllers/AdministradorController.php';
                    $controller = new AdministradorController();
                    $controller->cambiarEstado();
                } else {
                        echo "Acceso denegado.";
                }
                break;
               
            // case para cargar la pagina de inicio        
            case 'default':
                // Cargar una página de inicio o redirigir a la acción de registro
                require '../app/views/usuario/inicio.php';
                break;

            //case para acciones no validas 
            default:
                        echo "Página no encontrada o acción no válida.";
                break;
        }
    }
}