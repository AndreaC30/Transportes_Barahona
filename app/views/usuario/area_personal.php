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
    <title>Área Personal</title>
</head>
<body>
    <!-- Encabezado -->
    <?php include __DIR__ . '/../includes/encabezado.php'; ?>
    <!-- Menú de Navegación -->
    <nav>
        <?php include __DIR__ . '/../includes/menu.php'; ?>
    </nav>
    <main>
    <div>
    <button id="btn-regresar"> Regresar </button>
    </div>
    <!-- Esto declara una variable nombreUsuario en JavaScript con el valor de la sesión PHP.-->
    <script>
    const nombreUsuario = "<?= htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Invitado') ?>";
</script>
    <div class="contenido">
    <div id="mensaje-bienvenida"></div>
    </div>

    <!-- Opciones disponibles para el area del usuario --> 
    <div class="servicios-grid">
            <div class="servicio">
                <a href="/Transportes_Barahona/public/index.php?action=solicitar_servicio">
                    <h2>Solicitar Servicio</h2>
                </a>
            </div>
            <div class="servicio">
                <a href="/Transportes_Barahona/public/index.php?action=consultar_estado">
                    <h2>Consultado Estado de Solicitud</h2>
                </a>
            </div>
            <div class="servicio">
                <a href="/Transportes_Barahona/public/index.php?action=actualizar_perfil">
                    <h2>Actualizar Perfil</h2>
                </a>
            </div>
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