<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia la sesión si aún no está activa
}
?>

<nav>
    <ul>
        <!-- Opciones disponibles para todos los usuarios -->
        <li><a href="/Transportes_Barahona/public/index.php">Inicio</a></li>
        <li><a href="/Transportes_Barahona/public/index.php?action=quienes_somos">Quiénes Somos</a></li>
        <li><a href="/Transportes_Barahona/public/index.php?action=solicitar_servicio">Solicitar Servicio</a></li>
        
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <?php if ($_SESSION['nombre_rol'] === 'cliente'): ?>
                <!-- Opciones adicionales para clientes -->
                <li><a href="/Transportes_Barahona/public/index.php?action=consultar_estado">Consultar Estado de Solicitud</a></li>
                <li><a href="/Transportes_Barahona/public/index.php?action=actualizar_perfil">Actualizar Perfil</a></li>
            <?php endif; ?>
            
            <?php if ($_SESSION['nombre_rol'] === 'administrador'): ?>
                <!-- Opciones adicionales para administradores -->
                <li><a href="/Transportes_Barahona/public/index.php?action=gestionar_usuarios">Gestionar Usuarios</a></li>
                <li><a href="/Transportes_Barahona/public/index.php?action=visualizar_reportes">Visualizar Reportes</a></li>
                <li><a href="/Transportes_Barahona/public/index.php?action=revisar_solicitudes">Revisar Solicitudes</a></li>
            <?php endif; ?>
        <?php else: ?>
        <?php endif; ?>
    </ul>
</nav>
