
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">

    <title>Cerrar Sesión</title>
    <script>
        // Redirige automáticamente después de 3 segundos
        setTimeout(function() {
            window.location.href = "/Transportes_Barahona/public/index.php?action=registrar";
        }, 3000);
    </script>
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
    <div class= "texto-formulario">
       <h1>Sesión Cerrada</h1>
    </div>
        <!-- Confirmación de cerrar sesión-->
    <p>Has cerrado sesión exitosamente. Serás redirigido a la página de registro en unos segundos...</p>
    <p>Si no eres redirigido, haz clic <a href="/Proyecto_DAW_Transportes_Barahona/public/index.php?action=registrar">aquí</a>.</p>
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>
    </main>
 <!-- footer para todas las paginas -->
 <?php include __DIR__ . '/../includes/piepagina.php'; ?>
</body>
</html>