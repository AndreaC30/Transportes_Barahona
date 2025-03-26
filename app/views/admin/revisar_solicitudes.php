<?php

//Verifica si el usuario tiene una sesión activa y si es administrador. Si no es admin redirige al inicio de sesion
if (!isset($_SESSION['usuario_id']) || $_SESSION['nombre_rol'] !== 'administrador') {
    header("Transportes_Barahona/public/index.php?action=iniciar_sesion");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/Transportes_Barahona/public/css/style.css">   
    <title>Revisar Solicitudes</title>
</head>
<body>
    <!-- encabezado común de la página -->
    <?php include __DIR__ . '/../includes/encabezado.php'; ?>

    <!-- menú de Navegación -->
    <nav><?php include __DIR__ . '/../includes/menu.php'; ?></nav>

    <main>
    <!-- botón para regresar --> 
    <div>
        <button id="btn-regresar"> Regresar </button>
    </div> 

    <!-- mensaje para mostrar que se ha actualizado el estado del pedido correctamente-->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'updated'): ?>
    <div class="alerta" data-tipo="success">
        ¡Estado actualizado correctamente!
    </div>
    <?php endif; ?>

    <!-- Filtrar por solicitud de pedidos por estados --> 
    <div class= "texto-formulario">
               <h1>Revisar Solicitudes</h1>
    <form method="GET" action="/Transportes_Barahona/public/index.php">
        <input type="hidden" name="action" value="revisar_solicitudes">
            <label for="filtro_estado">Filtrar por estado:</label>
                <select name="filtro_estado" id="filtro_estado" onchange="this.form.submit()">
                    <option value="">Todos</option>
                    <option value="pendiente" <?= isset($_GET['filtro_estado']) && $_GET['filtro_estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="en_transito" <?= isset($_GET['filtro_estado']) && $_GET['filtro_estado'] === 'en_transito' ? 'selected' : '' ?>>En Tránsito</option>
                    <option value="entrega_completada" <?= isset($_GET['filtro_estado']) && $_GET['filtro_estado'] === 'entrega_completada' ? 'selected' : '' ?>>Entrega Completada</option>
                </select>
    </form>
    </div>

    <!-- tabla que muestra las solicitudes filtradas, según hayan sido elegidas arriba--> 
    <table class="tabla-solicitudes">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Teléfono de contacto</th>
            <th>Tipo de Servicio</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($solicitudes as $solicitud): ?>
            <tr>
                <td><?= htmlspecialchars($solicitud['pedido_id']) ?></td>
                <td><?= htmlspecialchars($solicitud['fecha']) ?></td>
                <td><?= htmlspecialchars($solicitud['cliente']) ?></td>
                <td><?= htmlspecialchars($solicitud['numero_telefono']) ?></td>
                <td><?= htmlspecialchars($solicitud['tipo_servicio']) ?></td>
                <td><?= htmlspecialchars($solicitud['estado']) ?></td>
                <td>
                    <form action="/Transportes_Barahona/public/index.php?action=cambiar_estado" method="POST">
                       <input type="hidden" name="pedido_id" value="<?= $solicitud['pedido_id'] ?>">
                        <select name="nuevo_estado">
                            <option value="pendiente" <?= $solicitud['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="en_transito" <?= $solicitud['estado'] === 'en_transito' ? 'selected' : '' ?>>En Tránsito</option>
                            <option value="entrega_completada" <?= $solicitud['estado'] === 'entrega_completada' ? 'selected' : '' ?>>Entrega Completada</option>
                        </select>
                        <button type="submit" class="btn-accion">Actualizar</button>
                    </form>
                </td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

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
