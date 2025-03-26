<?php

if (!isset($_SESSION['usuario_id']) || $_SESSION['nombre_rol'] !== 'cliente') {
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

    <title>Estado de Solicitudes</title>
</head>
<body>
        <!-- Encabezado -->
    <?php include __DIR__ . '/../includes/encabezado.php'; ?>
<!-- Menú de Navegación -->
    <nav>
        <?php include __DIR__ . '/../includes/menu.php'; ?>
    </nav>
   <!-- mensaje de alerta para confirmar -->
<main>
<div>
    <button id="btn-regresar"> Regresar </button>
    </div>
    <?php if (isset($_GET['success']) && $_GET['success'] === 'cancelado'): ?>
    <div class="alerta" data-tipo="cancelacion">¡Solicitud cancelada exitosamente!</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'cancelar'): ?>
    <div class="alerta" data-tipo="error">Error al intentar cancelar la solicitud.</div>
<?php endif; ?>

    <div class= "texto-formulario">
    <h1>Estado de Solicitudes</h1>
    </div> 
<table class="tabla-solicitudes">
    <thead>
        <tr>
            <th>Fecha del Servicio</th>
            <th>Tipo de Servicio</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($solicitudes as $solicitud): ?>
        <tr>
            <td><?= htmlspecialchars($solicitud['fecha'] ?? 'No especificada') ?></td>
            <td><?= htmlspecialchars($solicitud['tipo_servicio'] ?? 'No disponible') ?></td>
            <td><?= htmlspecialchars($solicitud['estado'] ?? 'Pendiente') ?></td>
            <td>
                <div class="accion">
                    <?php if ($solicitud['cancelable'] ?? false): ?>
                        <form action="/Transportes_Barahona/public/index.php?action=cancelar_solicitud" method="POST">
                            <input type="hidden" name="pedido_id" value="<?= htmlspecialchars($solicitud['pedido_id']) ?>">
                            <button type="submit" class="btn-cancelar">Cancelar</button>
                        </form>
                    <?php else: ?>
                        <span class="no-cancelable">No cancelable</span>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class= "politica-cancelacion">
    <p > Política de Cancelación:
    <br>Puedes cancelar tu servicio si faltan más de 5 días para la fecha programada.
    <br>Si quedan 5 días o menos, la cancelación no será posible debido a la planificación necesaria para garantizar un servicio óptimo.
    Para cualquier duda, estamos aquí para ayudarte.
    <br>Gracias por tu comprensión. </p>
</div>

<div class="area-opciones" >
       <a href="/Transportes_Barahona/public/index.php?action=cerrar_sesion" class="btn btn-danger">Cerrar Sesión</a>
    </div>
        </main>
     <!-- footer para todas las paginas -->
     <?php include __DIR__ . '/../includes/piepagina.php'; ?>
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>

</body>
</html>