<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">
    <title>Registro de Usuario</title>
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
    <!-- mensaje de error, email registrado-->
    <?php if (isset($_GET['error']) && $_GET['error'] === 'email_exists'): ?>
    <div class="alerta error">
        Este correo electrónico ya está registrado. Por favor, utiliza otro correo.
    </div>
<?php endif; ?>

    <div class= "texto-formulario">
        <h1>Crear cuenta</h1> 
    </div>
        <!--Formulario de registro-->
        <form action="/Transportes_Barahona/public/index.php?action=registrar" method="POST" class="formulario-estilizado">
            <label for="nombre_usuario">Nombre:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email"  id="email" name="email" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="numero_telefono">Número de Teléfono:</label>
            <input type="text"  id="numero_telefono" name="numero_telefono" required>

            <label for="contrasenia">Contraseña:</label>
            <div class="input-container">
            <input type="password" id="contrasenia" name="contrasenia" required>
            <span id="togglePassword" class="eye-icon" onclick="togglePasswordVisibility()">👁️</span>
            </div>

            <div class="form-buttons">
                <button type="submit">Registrar</button>
                <span> o </span>
                <a href="/Transportes_Barahona/public/index.php?action=iniciar_sesion" class="btn-link">Iniciar Sesión</a>
            </div>
        </form>
    </main>
    <!-- footer para todas las paginas -->
    <?php include __DIR__ . '/../includes/piepagina.php'; ?>
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>

</body>
</html>
