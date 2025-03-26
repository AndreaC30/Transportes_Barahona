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
    <title>Gestionar Usuarios</title>
</head>
<body>
    <!-- encabezado común de la página -->
    <?php include __DIR__ . '/../includes/encabezado.php'; ?>
   
    <!-- menú de navegación -->
     <nav><?php include __DIR__ . '/../includes/menu.php'; ?></nav>
       <!-- botón para regresar --> 
 
     <div>
    <button id="btn-regresar"> Regresar </button>
    </div>

    <main class="container my-5">
    <div class= "texto-formulario">
    <h1>Gestionar Usuarios</h1>
    </div>

   <!-- Mensaje dinámico, confirmando los cambios realizados por el administrador -->
<?php if (isset($_GET['success'])): ?>
    <div class="alerta" data-tipo="exito">
        <?php if ($_GET['success'] === 'convertido'): ?>
            El usuario ha sido convertido en administrador exitosamente.
        <?php elseif ($_GET['success'] === 'eliminado'): ?>
            El usuario ha sido eliminado exitosamente.
        <?php endif; ?>
    </div>
<?php endif; ?>

<!-- Mensaje dinámico para errores -->
<?php if (isset($_GET['error'])): ?>
    <div class="alerta" data-tipo="error">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>


    <!-- area para gestionar los usuarios-->
            <?php if (isset($usuarios) && count($usuarios) > 0): ?>
            <div class="table-responsive">
                <table class="tabla-solicitudes">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                            <td><?= htmlspecialchars($usuario['usuario_id']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre_rol']) ?></td>
                            <td>
                                <div class="d-flex justify-content-evenly">
                                    <?php if ($usuario['nombre_rol'] !== 'administrador'): ?>
                                    <!-- Botón para convertir en administrador -->
                                        <form action="/Transportes_Barahona/public/index.php?action=convertir_administrador" method="POST" class="d-inline">
                                            <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
                                            <button type="submit" class="btn btn-warning btn-sm">Convertir en Administrador</button>
                                        </form>
                                    <?php endif; ?>

                                    <!-- Botón para eliminar usuario -->
                                    <form action="/Transportes_Barahona/public/index.php?action=eliminar_usuario" method="POST" class="d-inline">
                                        <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                </div>
                            </td>
                            </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-muted">No hay usuarios registrados.</p>
        <?php endif; ?>
    
    <!-- botón para cerrar sesión -->
    <div class="area-opciones">
       <a href="/Transportes_Barahona/public/index.php?action=cerrar_sesion" class="btn btn-danger">Cerrar Sesión</a>
    </div>

    </main>

    <!-- footer pie de pagina -->
    <?php include __DIR__ . '/../includes/piepagina.php'; ?>

    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/Transportes_Barahona/public/js/main.js"></script>
</body>
</html>
