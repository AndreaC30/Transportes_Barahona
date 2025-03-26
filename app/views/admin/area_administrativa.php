<?php
//Verifica si el usuario tiene una sesión activa y si es administrador. Si no es admin redirige al inicio de sesion

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
    <link rel="stylesheet" type="text/css" href="/Transportes_Barahona/public/css/style.css">
    <title>Área Administrativa</title>
</head>
<body>
    <!-- encabezado común de la página -->
    <?php include __DIR__ . '/../includes/encabezado.php'; ?>

    <!-- menú de navegación -->
    <nav><?php include __DIR__ . '/../includes/menu.php'; ?></nav>

    <main>
    <!-- botón para regresar -->  
    <div>
    <button id="btn-regresar"> Regresar </button>
    </div>  

    <!-- Mensaje de bienvenida dinamico, mostrando el nombre del administrador desde la sesion-->
    <script>
        const nombreUsuario = "<?= htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Invitado') ?>";
    </script>
    <div class="contenido">
        <div id="mensaje-bienvenida"></div>
    </div>

   
    <!-- Opciones disponibles para el area del usuario --> 
    <div class="servicios-grid">
            <div class="servicio">
                <a href="/Transportes_Barahona/public/index.php?action=gestionar_usuarios">
                    <h2>Gestionar Usuarios</h2>
                </a>
            </div>
            <div class="servicio">
                <a href="/Transportes_Barahona/public/index.php?action=revisar_solicitudes">
                    <h2>Revisar Solicitudes</h2>
                </a>
            </div>
            <div class="servicio">
                <a href="/Transportes_Barahona/public/index.php?action=visualizar_reportes">
                    <h2>Visualizar Reportes</h2>
                </a>
            </div>
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
