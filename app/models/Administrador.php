<?php
require_once __DIR__ . '/../core/Database.php';

class Administrador {
    private $db;
    

    /*Método que segura que cada modelo tenga acceso directo a la conexión 
    con la base de datos sin necesidad de repetir la lógica de conexión.
    */
    public function __construct() {
        $this->db = (new Database())->obtenerConexion();
    }

    //Metodos para obtener todos los usuarios
    //llamado en AdministradorController.php
    public function obtenerTodosLosUsuarios() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM Usuario");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al obtener usuarios: " . $e->getMessage();
            return [];
        }
    }

    //Método para obtener los servicios mas solicitados.
    //Llamado en AdministradorController.php
    public function obtenerServiciosMasSolicitados($fecha_inicio = null, $fecha_fin = null) {
        $query = "SELECT s.nombre_servicio, COUNT(dp.servicio_id) AS cantidad
                  FROM Detalle_de_Pedido dp
                  INNER JOIN Servicio s ON dp.servicio_id = s.servicio_id
                  INNER JOIN Pedido p ON dp.pedido_id = p.pedido_id
                  WHERE (:fecha_inicio IS NULL OR p.fecha >= :fecha_inicio)
                  AND (:fecha_fin IS NULL OR p.fecha <= :fecha_fin)
                  GROUP BY s.nombre_servicio
                  ORDER BY cantidad DESC";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'fecha_inicio' => $fecha_inicio ?: null,
            'fecha_fin' => $fecha_fin ?: null,
        ]);
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result ?: [];
    }
    

    //Método para obtener estados de solicitudes en el rol de administrador
    //Llamado en AdministradorController.php
    public function obtenerEstadoSolicitudes($fecha_inicio = null, $fecha_fin = null) {
        $query = "SELECT p.estado_pedido, COUNT(*) AS cantidad
                  FROM Pedido p
                  WHERE (:fecha_inicio IS NULL OR p.fecha >= :fecha_inicio)
                  AND (:fecha_fin IS NULL OR p.fecha <= :fecha_fin)
                  GROUP BY p.estado_pedido";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'fecha_inicio' => $fecha_inicio ?: null, // Convertir valores vacíos a null
            'fecha_fin' => $fecha_fin ?: null,
        ]);
        
        // Si no hay resultados, devolver un array vacío
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result ?: [];
    }
    
   
    //Método para ver que usuarios estan activos
    //Lamado en AdministradorController.php 
    public function obtenerUsuariosActivos($fecha_inicio = null, $fecha_fin = null) {
        $query = "SELECT 'Total Usuarios' AS tipo, COUNT(*) AS cantidad
                  FROM Usuario
                  UNION ALL
                  SELECT 'Usuarios Activos', COUNT(DISTINCT p.usuario_id)
                  FROM Pedido p
                  WHERE (:fecha_inicio IS NULL OR p.fecha >= :fecha_inicio)
                  AND (:fecha_fin IS NULL OR p.fecha <= :fecha_fin)";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'fecha_inicio' => $fecha_inicio ?: null, // Convertir valores vacíos a null
            'fecha_fin' => $fecha_fin ?: null,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Método para ver las solicitudes pendientes de los pedidos
    //Llamado en AdministradorController.php
    public function obtenerSolicitudes($filtro_estado = null) {
        $query = "
            SELECT 
                p.pedido_id,
                p.fecha,
                COALESCE(u.nombre, 'Usuario no registrado') AS cliente,
                COALESCE(u.numero_telefono, dp.telefono_contacto) AS numero_telefono,
                s.nombre_servicio AS tipo_servicio,
                p.estado_pedido AS estado
            FROM Pedido p
            LEFT JOIN Usuario u ON p.usuario_id = u.usuario_id
            INNER JOIN Detalle_de_Pedido dp ON p.pedido_id = dp.pedido_id
            INNER JOIN Servicio s ON dp.servicio_id = s.servicio_id
        ";
   
        // Si se pasa un filtro de estado, agregar la cláusula WHERE
        if ($filtro_estado) {
            $query .= " WHERE p.estado_pedido = :estado";
        }
    
        $query .= " ORDER BY p.fecha DESC"; // Ordenar por fecha
    
        $stmt = $this->db->prepare($query);
    
        // Si hay un filtro de estado, ejecutarlo con el parámetro
        if ($filtro_estado) {
            $stmt->execute(['estado' => $filtro_estado]);
        } else {
            $stmt->execute();
        }
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //Método para actualizar el estado del pedido
    //Llamado en AdmnistradorController.php
    public function actualizarEstadoPedido($pedido_id, $nuevo_estado) {
        $query = "UPDATE Pedido SET estado_pedido = :nuevo_estado WHERE pedido_id = :pedido_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['nuevo_estado' => $nuevo_estado, 'pedido_id' => $pedido_id]);
    }
    
    //Método para convertir usuarios en administradores
    //Llamado en AdministradorController.php
    public function cambiarRol($usuario_id, $nuevo_rol) {
        $stmt = $this->db->prepare("UPDATE Usuario SET nombre_rol = ? WHERE usuario_id = ?");
        return $stmt->execute([$nuevo_rol, $usuario_id]);
    }
    //Método para eliminar usuarios
    //Llamado en AdministradorController.php
    public function eliminarUsuario($usuario_id) {
        $stmt = $this->db->prepare("DELETE FROM Usuario WHERE usuario_id = ?");
        return $stmt->execute([$usuario_id]);
    }
      
}