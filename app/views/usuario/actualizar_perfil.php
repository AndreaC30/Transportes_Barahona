<?php
// Proteger acceso solo para usuarios autenticados como clientes
if (!isset($_SESSION['usuario_id']) || $_SESSION['nombre_rol'] !== 'cliente') {
    header("Location: /Transportes_Barahona/public/index.php?action=iniciar_sesion");
    exit();
}

// Variables `$usuario` deben estar disponibles desde el controlador
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">
    <title>Actualizar Perfil</title>
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
    <h1>Actualizar Perfil</h1>
    </div> 
    
    <?php if (isset($_GET['success'])): ?>
    <div class="alerta" data-tipo="perfil">
        <?php if ($_GET['success'] === 'perfil'): ?>
            ¡El perfil se ha actualizado exitosamente!
        <?php endif; ?>
    </div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="alerta error">
        <?php if ($_GET['error'] === 'perfil'): ?>
            Ocurrió un error al actualizar el perfil. Inténtalo nuevamente.
        <?php endif; ?>
    </div>
<?php endif; ?>

    <!-- Alertas dinámicas -->
    <div class="alertas">
        <div class="alerta" data-tipo="telefono"></div>
        <div class="alerta" data-tipo="direccion"></div>
        <div class="alerta" data-tipo="contrasena"></div>
    </div>
   

    <!-- Email (solo lectura) -->
    <div class="campo-container centrado">
    <label for="email" class="campo-label">Correo Electrónico:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" readonly class="campo-email">
</div>

    
    <!-- Formulario para actualizar dirección y teléfono -->
    <form action="/Transportes_Barahona/public/index.php?action=actualizar_perfil" method="POST" class="formulario-estilizado">
        <h3>Datos de Contacto</h3>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>" required>

        <label for="numero_telefono">Número de Teléfono:</label>
        <input type="text" name="numero_telefono" value="<?= htmlspecialchars($usuario['numero_telefono']) ?>" required>

        <button type="submit">Actualizar Perfil</button>
    </form>

    <!-- Formulario separado para cambiar contraseña -->
    <form action="/Transportes_Barahona/public/index.php?action=cambiar_contrasena" method="POST" class="formulario-estilizado">
        <h3>Cambiar Contraseña</h3>
        <label for="contrasena_actual">Contraseña Actual:</label>
        <input type="password" name="contrasena_actual" required>

        <label for="nueva_contrasena">Nueva Contraseña:</label>
        <input type="password" name="nueva_contrasena" required>

        <button type="submit">Actualizar Contraseña</button>
    </form>

    <!-- Mensaje de error -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($_SESSION['error']); ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    
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
