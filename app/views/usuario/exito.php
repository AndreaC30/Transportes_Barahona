<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
<link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">

    <title>Registro Exitoso</title>
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
        <h1>¡Registro Completado!</h1>
    </div>
    <p>Tu cuenta ha sido creada exitosamente. Ahora puedes iniciar sesión en el sistema.</p>
    <a href="/Transportes_Barahona/public/index.php?action=iniciar_sesion">Ir a la página de inicio</a></body>
</main>
     <!-- footer para todas las paginas -->
    <?php include __DIR__ . '/../includes/piepagina.php'; ?>
   
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>

</html>