<?php
//Modelos requeridos para gestionar usuarios y pedidos.
require_once __DIR__ .'/../models/Pedido.php';
require_once __DIR__ . '/../models/Usuario.php';

class ClienteController {
    private $pedidoModel; 
    private $usuarioModel; 

    //Inicializa los modelos Pedido y Usuario
    public function __construct() {
        $this->pedidoModel = new Pedido(); 
        $this->usuarioModel = new Usuario(); 
    }

    //Muestra el área personal del cliente
    public function areaCliente() {
        $usuario_id = $_SESSION['usuario_id'] ?? null;
    
        if ($usuario_id) {
            $nombre_usuario = $_SESSION['nombre_usuario']; 
            $mensaje = "¡Bienvenido, $nombre_usuario! Nos alegra verte aquí.";
            include '../app/views/usuario/area_cliente.php'; 
        } else {
            header("Location: /Transportes_Barahona/public/index.php?action=iniciar_sesion");
            exit();
        }
    }

    //Actualiza el perfil del usuario
    public function actualizarPerfil() {
        $usuario_id = $_SESSION['usuario_id'];
        $usuario = $this->usuarioModel->obtenerUsuarioPorId($usuario_id);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $direccion = $_POST['direccion'];
            $numero_telefono = $_POST['numero_telefono'];
    
            if ($this->usuarioModel->actualizarPerfil($usuario_id, $direccion, $numero_telefono)) {
                // Redirigir con un mensaje de éxito
                header("Location: /Transportes_Barahona/public/index.php?action=actualizar_perfil&success=perfil");
                exit();
            } else {
                // Redirigir con un mensaje de error
                header("Location: /Transportes_Barahona/public/index.php?action=actualizar_perfil&error=perfil");
                exit();
            }
        }
    
        require '../app/views/usuario/actualizar_perfil.php';
    }

    // Cambia la contraseña del usuario
    public function cambiarContrasena() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_SESSION['usuario_id'];
            $contrasena_actual = $_POST['contrasena_actual'];
            $nueva_contrasena = $_POST['nueva_contrasena'];

            if ($this->usuarioModel->cambiarContrasena($usuario_id, $contrasena_actual, $nueva_contrasena)) {
                // Guardar mensaje en una variable temporal
                $mensaje = "Contraseña cambiada exitosamente. Por favor, inicia sesión nuevamente.";
                
                // Destruir la sesión
                session_destroy();
    
                // Redirigir con el mensaje en la URL
                header("Location: /Transportes_Barahona/public/index.php?action=iniciar_sesion&mensaje=" . urlencode($mensaje));
                exit();
            } else {
                // Redirigir con un mensaje de error
                $_SESSION['error'] = "Error al cambiar la contraseña. Verifique su contraseña actual.";
                header("Location: /Transportes_Barahona/public/index.php?action=actualizar_perfil");
                exit();
            }
        } else {
            echo "Método no permitido.";
            exit();
        }
    }


    //Guarda una solicitud de servicio
    public function guardarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_servicio = $_POST['servicio'];
            $detalles = $_POST['detalles'] ?? '';
            $usuario_id = $_SESSION['usuario_id'];
            $cantidad = 1;  
            $precio_total = 100.00;
            $estado_pedido = 'pendiente';
            $fecha = date('Y-m-d');

            // Obtener el ID del servicio a partir del nombre
            $stmt = $this->pedidoModel->obtenerConexion()->prepare("SELECT servicio_id FROM Servicio WHERE nombre_servicio = ?");
            $stmt->execute([$nombre_servicio]);
            $servicio = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($servicio) {
                $servicio_id = $servicio['servicio_id'];
                if ($this->pedidoModel->crearPedidoConDetalle($usuario_id, $servicio_id, $estado_pedido, $fecha, $cantidad, $precio_total)) {
                    echo "Solicitud de servicio guardada exitosamente.";
                } else {
                    echo "Error al guardar la solicitud de servicio.";
                }
            } else {
                echo "Servicio no encontrado.";
            }
        } else {
            header("Location: /Transportes_Barahona/public/index.php?action=solicitar_servicio");
        }
        exit();
    }

    //Consulta el estado de los pedidos del cliente
    public function consultarEstado() {
        $usuario_id = $_SESSION['usuario_id'];
        $solicitudes = $this->pedidoModel->obtenerSolicitudesPorUsuario($usuario_id);
    
        // Calcular si la solicitud se puede cancelar
        foreach ($solicitudes as &$solicitud) {
            $fecha_solicitud = new DateTime($solicitud['fecha']);
            $hoy = new DateTime();
            $diferencia = $hoy->diff($fecha_solicitud)->days;
    
            // Añadimos un indicador de si se puede cancelar
            $solicitud['cancelable'] = ($fecha_solicitud > $hoy && $diferencia >= 5);
        }
    
        require '../app/views/usuario/consultar_estado.php';
    }
    
    //Cancela una solicitud de servicio
    public function cancelarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pedido_id = $_POST['pedido_id'] ?? null;
    
            if (!$pedido_id) {
                header("Location: /Transportes_Barahona/public/index.php?action=consultar_estado&error=cancelar");
                exit();
            }
    
            try {
                if ($this->pedidoModel->cancelarPedido($pedido_id)) {
                    header("Location: /Transportes_Barahona/public/index.php?action=consultar_estado&success=cancelado");
                } else {
                    header("Location: /Transportes_Barahona/public/index.php?action=consultar_estado&error=cancelar");
                }
            } catch (Exception $e) {
                header("Location: /Transportes_Barahona/public/index.php?action=consultar_estado&error=cancelar");
            }
            exit();
        }
    }
    
    /*Valida la solicitud del pedido que realiza el usuario,
    ademas añade los detalles a la tabla Detalle_de_Pedido */
    public function guardarSolicitudServicio() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario_id = $_SESSION['usuario_id'] ?? null; // Permitir solicitudes de usuarios no registrados
        $telefono_contacto = $_POST['telefono_contacto'];

        // Validar el número de teléfono (exactamente 9 dígitos)
        if (!preg_match('/^[0-9]{9}$/', $telefono_contacto)) {
            echo "Error: El teléfono debe tener exactamente 9 dígitos.";
            exit();
        }

        // Capturar otros datos del formulario
        $fecha = $_POST['fecha'] ?? null;
        $descripcion = $_POST['descripcion'] ?? null;
        $servicio_id = $_POST['servicio_id'] ?? null;
        $estado_pedido = 'pendiente';

        try {
            // Crear arreglo para detalles del pedido
            $pedidoModel = new Pedido();
            $detalle = [
                'servicio_id' => $servicio_id,
                'descripcion' => $descripcion,
                'cantidad' => 1, // Cantidad fija, ajustable según necesidad
                'precio_total' => 0, // Por ahora, valor predeterminado
                'telefono_contacto' => $telefono_contacto
            ];

            $detalles = [$detalle];

            // Guardar el pedido y sus detalles en la base de datos
            $pedido_id = $pedidoModel->crearPedidoConServicios($usuario_id, $estado_pedido, $fecha, $detalles);

            if ($pedido_id) {
                // Redirigir a la página de confirmación
                header("Location: /Transportes_Barahona/public/index.php?action=confirmacion_presupuesto");
                exit();
            } else {
                echo "Error al guardar el pedido.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Método no permitido.";
    }
}
    //Guarda la solicitud de presupuesto solicitado por el usuario
    public function guardarPresupuesto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_SESSION['usuario_id'];
            $servicio = $_POST['servicio'];
            $descripcion = $_POST['descripcion'];
            $fecha = $_POST['fecha'];
    
            $pedidoModel = new Pedido();
    
            try {
                $pedido_id = $pedidoModel->crearPresupuesto($usuario_id, $servicio, $descripcion, $fecha);
                header("Location: /Transportes_Barahona/public/index.php?action=confirmacion_presupuesto&pedido_id={$pedido_id}");
                exit();
            } catch (Exception $e) {
                echo "Error al guardar el presupuesto: " . $e->getMessage();
            }
        } else {
            echo "Método no permitido.";
        }
    }

    /*Recupera la lista de servicios disponibles, se usa el modelo Servicio.php 
    y se instancia solamente en este metodo porque no es requirido en ningun otro*/
    public function mostrarServicios() {
        require_once '../app/models/Servicio.php';
        $servicioModel = new Servicio();
        $servicios = $servicioModel->obtenerTodosLosServicios();
    
        // Cargar la vista con los datos de los servicios
        require '../app/views/usuario/solicitar_servicio.php';
    }

    
    
    
}