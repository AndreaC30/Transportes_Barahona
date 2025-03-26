<?php
require_once __DIR__ . '/../core/Database.php';

class Pedido {
    private $db;
    

    /*Método que asegura que cada modelo tenga acceso directo a la conexión 
    con la base de datos sin necesidad de repetir la lógica de conexión.
    */ 
    public function __construct() {
        $this->db = (new Database())->obtenerConexion();
    }

     /* Método para exponer la conexión al exterior, quiere decir que permite
     que otras clases usen la conexión inicializada en Pedido.php en lugar de
     crear una nueva instancia de Database en este caso en ClienteController.php
     que es donde se usa.
     */
    public function obtenerConexion() {
        return $this->db;
    }

    //Método para relacionar los pedidos que realicen los usuarios con la tabla servicios
    //Llamado en ClienteController.php
    public function crearPedidoConServicios($usuario_id, $estado_pedido, $fecha, $detalles) {
        try {

            $this->db->beginTransaction();
            $stmt = $this->db->prepare("INSERT INTO Pedido (usuario_id, estado_pedido, fecha) VALUES (?, ?, ?)");
            $stmt->execute([$usuario_id, $estado_pedido, $fecha]);
            $pedido_id = $this->db->lastInsertId();
            $stmtDetalle = $this->db->prepare(
                "INSERT INTO Detalle_de_Pedido (pedido_id, servicio_id, descripcion, cantidad, telefono_contacto) 
                 VALUES (?, ?, ?, ?, ?)"
            );
            foreach ($detalles as $detalle) {
                $stmtDetalle->execute([
                    $pedido_id,                    
                    $detalle['servicio_id'],       
                    $detalle['descripcion'],       
                    $detalle['cantidad'],          
                    $detalle['telefono_contacto']  
                ]);
            }
            // Confirma la transacción
            $this->db->commit();
            return $pedido_id;
        } catch (Exception $e) {
            // Revierte la transacción en caso de error
            $this->db->rollBack();
            throw new Exception("Error al guardar el pedido: " . $e->getMessage());
        }
    }
    
     //Método para crear un pedido con estado de "presupuesto" y los detalles del pedido, solo para solicitar.
    //Llamado en ClienteController.php
    public function crearPresupuesto($usuario_id, $servicio, $descripcion, $fecha) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO Pedido (usuario_id, estado_pedido, fecha) 
                VALUES (?, 'presupuesto', ?)
            ");
            $stmt->execute([$usuario_id, $fecha]);
            $pedido_id = $this->db->lastInsertId();
            // Inserta el detalle del presupuesto
            $stmtDetalle = $this->db->prepare("
                INSERT INTO Detalle_de_Pedido (pedido_id, servicio_id, cantidad) 
                VALUES (?, (SELECT servicio_id FROM Servicio WHERE nombre_servicio = ?), 1, 0)
            ");
            $stmtDetalle->execute([$pedido_id, $servicio]);
            return $pedido_id;
        } catch (Exception $e) {
            throw new Exception("Error al crear el presupuesto: " . $e->getMessage());
        }
    }

    // Método adicional para crear un pedido con su detalle
    // Llamado en ClienteController.php
    public function crearPedidoConDetalle($usuario_id, $servicio_id, $estado_pedido, $fecha, $cantidad) {
    try {
        // Inicia una transacción
        $this->db->beginTransaction();

        // Crea el pedido usando el método existente y obtener su ID
        $pedido_id = $this->crearPedido($usuario_id, $estado_pedido, $fecha);

        // Inserta directamente el detalle del pedido
        $stmt = $this->db->prepare("INSERT INTO Detalle_de_Pedido (pedido_id, servicio_id, cantidad) VALUES (?, ?, ?)");
        $stmt->execute([$pedido_id, $servicio_id, $cantidad]);

        // Confirma la transacción
        $this->db->commit();
        return true;

    } catch (Exception $e) {
        // Revierte la transacción en caso de error
        $this->db->rollBack();
        echo "Error al guardar la solicitud de servicio: " . $e->getMessage();
        return false;
    }
}

    //Método para obtener las solicitudes de un usuario en especifico
    //Llamado en ClienteController.php
    public function obtenerSolicitudesPorUsuario($usuario_id) {
        $stmt = $this->db->prepare("
            SELECT Pedido.fecha, Pedido.estado_pedido AS estado, Servicio.nombre_servicio AS tipo_servicio, Pedido.pedido_id
            FROM Pedido
            JOIN Detalle_de_Pedido ON Pedido.pedido_id = Detalle_de_Pedido.pedido_id
            JOIN Servicio ON Detalle_de_Pedido.servicio_id = Servicio.servicio_id
            WHERE Pedido.usuario_id = ?
            ORDER BY Pedido.fecha DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
     //Método para cancelar un pedido si el usuario asi lo desea
    //Llamado en ClienteController.php
    public function cancelarPedido($pedido_id) {
        try {
            // Iniciar transacción
            $this->db->beginTransaction();
    
            // Eliminar detalles del pedido
            $stmtDetalles = $this->db->prepare("DELETE FROM Detalle_de_Pedido WHERE pedido_id = ?");
            $stmtDetalles->execute([$pedido_id]);
    
            // Eliminar el pedido
            $stmtPedido = $this->db->prepare("DELETE FROM Pedido WHERE pedido_id = ?");
            $stmtPedido->execute([$pedido_id]);
    
            // Confirmar la transacción
            $this->db->commit();
    
            return true;
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $this->db->rollBack();
            return false;
        }
    }


 
    
}