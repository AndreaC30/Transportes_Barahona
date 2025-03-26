
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
<link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">

    <title>Inicio de Sesión</title>
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
    <?php if (isset($_GET['success']) && $_GET['success'] === 'registered'): ?>
    <div class="alerta" >
        ¡Cuenta creada con éxito! Por favor, inicie sesión para continuar.
    </div>
<?php endif; ?>
    <?php if (isset($_GET['mensaje'])): ?>
    <div class="alert alert-success" role="alert">
        <?= htmlspecialchars($_GET['mensaje']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($_SESSION['error']); ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class= "texto-formulario">
      <h1>Inicio de Sesión</h1> 
      <!-- Alerta para contraseñas incorrectas -->
<?php if (isset($_GET['error']) && $_GET['error'] === 'credenciales_invalidas'): ?>
    <div class="alerta" data-tipo="error">
        Contraseña incorrecta. Por favor, intente nuevamente.
    </div>
<?php endif; ?>  
    </div>
    
      <!-- Formulario de inicio de sesión--> 
    <form action="/Transportes_Barahona/public/index.php?action=iniciar_sesion" method="POST" class="formulario-estilizado">
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>

        <label for="contrasenia">Contraseña:</label>
        <div class="input-container">
        <input type="password" id="contrasenia" name="contrasenia" required>
        <span id="togglePassword" class="eye-icon" onclick="togglePasswordVisibility()">👁️</span>
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>

</main>
    <!-- footer para todas las paginas -->
    <?php include __DIR__ . '/../includes/piepagina.php'; ?>

    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>

</body>
</html>