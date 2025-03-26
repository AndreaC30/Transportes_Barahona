<?php
// Verifica si el usuario tiene una sesión activa y si es administrador. Si no es admin redirige al inicio de sesión
if (!isset($_SESSION['usuario_id']) || $_SESSION['nombre_rol'] !== 'administrador') {
    header("Location: /Transportes_Barahona/public/index.php?action=iniciar_sesion");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">
    <title>Visualizar Reportes</title>
</head>
<body>
    <!-- encabezado común de la página-->
    <?php include __DIR__ . '/../includes/encabezado.php'; ?>

    <!-- menú de Navegación -->
    <nav>
        <?php include __DIR__ . '/../includes/menu.php'; ?>
    </nav>
    <main>
        <!-- botón para regresar -->  
        <div>
            <button id="btn-regresar"> Regresar </button>
        </div>      

        <div class="texto-formulario">
            <h1>Visualizar Reportes</h1>
        </div>

        <!-- Mostrar alerta si existe un mensaje -->
        <?php if (isset($mensaje)): ?>
            <div class="alerta <?php echo isset($reporte['error']) ? 'error' : 'exito'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <!-- formulario para filtrar los reportes -->  
        <form action="/Transportes_Barahona/public/index.php?action=generar_reporte" method="POST" class="formulario-estilizado">
            <label for="filtro">Seleccione el reporte:</label>
            <select name="filtro" id="filtro" required>
                <option value="servicios">Servicios más solicitados</option>
                <option value="estado">Estado de solicitudes</option>
                <option value="usuarios">Usuarios activos</option>
            </select>
            <label for="fecha_inicio">Fecha Inicio (opcional):</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio">
            <label for="fecha_fin">Fecha Fin (opcional):</label>
            <input type="date" name="fecha_fin" id="fecha_fin">
            <button type="submit" class="btn-accion">Generar Reporte</button>
        </form>

        <!-- tabla que muestra los reportes generados -->  
        <div id="reporte">
        <?php if (isset($reporte)): ?>
    <?php if (is_array($reporte) && !empty($reporte)): ?>
        <div class="texto-formulario">
            <h3>Reporte Generado:</h3> 
        </div>
        <table class="tabla-solicitudes">
            <thead>
                <tr>
                    <?php if (is_array(current($reporte))): ?>
                        <?php foreach (array_keys(current($reporte)) as $campo): ?>
                            <th><?= htmlspecialchars($campo) ?></th>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reporte as $fila): ?>
                    <tr>
                        <?php foreach ($fila as $dato): ?>
                            <td><?= is_array($dato) ? htmlspecialchars(json_encode($dato)) : htmlspecialchars($dato) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <!-- Si no hay datos en el reporte -->
        <p class="text-danger">No hay datos disponibles para mostrar.</p>
    <?php endif; ?>
<?php else: ?>
    <!-- Mensaje default si no se ha generado ningún reporte -->
    <p>No se ha generado ningún reporte.</p>
<?php endif; ?>


        </div>

        <!-- botón para cerrar sesión -->
        <div class="area-opciones">
            <a href="/Transportes_Barahona/public/index.php?action=cerrar_sesion" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </main>

    <!-- footer pie de pagina -->
    <?php include __DIR__ . '/../includes/piepagina.php'; ?>

    <!-- Scripts de JavaScript -->
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/Transportes_Barahona/public/js/main.js"></script>
</body>
</html>
