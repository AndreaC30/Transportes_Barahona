<?php
require_once '../app/models/Administrador.php';

class AdministradorController {
    private $administradorModel; // Instancia del modelo Administrador

    // Inicialización del modelo Administrador
    public function __construct() {
        $this->administradorModel = new Administrador();
    }

    // Gestiona todos los usuarios pasando los datos a la vista
    public function gestionarUsuarios() {
        try {
            $usuarios = $this->administradorModel->obtenerTodosLosUsuarios(); 
            require_once '../app/views/admin/gestionar_usuarios.php';
        } catch (Exception $e) {
            echo "Error en gestionarUsuarios: " . $e->getMessage();
        }
    }
    
    // Convierte a un usuario en administrador
    public function convertirEnAdministrador() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_POST['usuario_id'];
            try {
                if ($this->administradorModel->cambiarRol($usuario_id, 'administrador')) {
                    header("Location: /Transportes_Barahona/public/index.php?action=gestionar_usuarios&success=convertido");
                    exit();
                } else {
                    echo "Error al cambiar el rol.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    // Elimina un usuario
    public function eliminarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_POST['usuario_id'];
            try {
                // Intentar eliminar el usuario
                $resultado = $this->administradorModel->eliminarUsuario($usuario_id);
    
                if ($resultado) {
                    header("Location: /Transportes_Barahona/public/index.php?action=gestionar_usuarios&success=eliminado");
                } else {
                    header("Location: /Transportes_Barahona/public/index.php?action=gestionar_usuarios&error=No se pudo eliminar el usuario.");
                }
            } catch (PDOException $e) {
                if ($e->getCode() === '23000') {
                    $mensajeError = "El usuario no se puede eliminar porque tiene pedidos asociados.";
                } else {
                    $mensajeError = "Error al eliminar el usuario: " . $e->getMessage();
                }
                header("Location: /Transportes_Barahona/public/index.php?action=gestionar_usuarios&error=" . urlencode($mensajeError));
            }
            exit();
        }
    }
    
    
   
    // Genera diferentes tipos de reportes
    public function generarReporte() {
        $filtro = $_POST['filtro'] ?? '';
        $fecha_inicio = $_POST['fecha_inicio'] ?? null;
        $fecha_fin = $_POST['fecha_fin'] ?? null;
        $reporte = [];
    
        try {
            switch ($filtro) {
                case 'servicios':
                    $reporte = $this->administradorModel->obtenerServiciosMasSolicitados($fecha_inicio, $fecha_fin);
                    break;
                case 'estado':
                    $reporte = $this->administradorModel->obtenerEstadoSolicitudes($fecha_inicio, $fecha_fin);
                    break;
                case 'usuarios':
                    $reporte = $this->administradorModel->obtenerUsuariosActivos($fecha_inicio, $fecha_fin);
                    break;
                default:
                    $reporte = "Seleccione un filtro válido.";
            }
    
            if (empty($reporte)) {
                $mensaje = "No hay reportes que mostrar por el momento.";
            }
    
        } catch (Exception $e) {
            $reporte = ["error" => "Error al generar el reporte: " . $e->getMessage()];
        }
    
        require '../app/views/admin/visualizar_reportes.php';
    }
    
    
    // Revisa las solicitudes pasadas por filtro de estado
    public function revisarSolicitudes() {
        $filtro_estado = $_GET['filtro_estado'] ?? null;
        try {
            $solicitudes = $this->administradorModel->obtenerSolicitudes($filtro_estado);
            require '../app/views/admin/revisar_solicitudes.php';
        } catch (Exception $e) {
            echo "Error al revisar solicitudes: " . $e->getMessage();
        }
    }
    
    // Cambia el estado de un pedido
    public function cambiarEstado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pedido_id = $_POST['pedido_id'];
            $nuevo_estado = $_POST['nuevo_estado'];
   
            try {
                if ($this->administradorModel->actualizarEstadoPedido($pedido_id, $nuevo_estado)) {
                    header("Location: /Transportes_Barahona/public/index.php?action=revisar_solicitudes&success=updated");
                    exit();
                } else {
                    echo "Error al actualizar el estado.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Método no permitido.";
        }
    }
    //Formulario para añadir mas detalles al pedido
    public function mostrarFormularioAgregarDetalle() {
        $pedido_id = $_GET['pedido_id'] ?? null;
    
        if ($pedido_id) {
            require '../app/views/admin/agregar_detalle.php'; // Cargar la vista
        } else {
            echo "ID de pedido no especificado.";
        }
    }
    
    
}
