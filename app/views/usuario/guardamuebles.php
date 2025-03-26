<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudanzas</title>
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">
</head>
<body class="guardamuebles">
     <!-- Encabezado-->
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
        <h1>Servicio de guardamuebles</h1>
        <p>Espacio seguro para tus pertenencias</p>  
    </div>
    <!-- Formulario de servicio de guardamuebles-->
    <form action="/Transportes_Barahona/public/index.php?action=guardar_solicitud_servicio" method="POST" class="formulario-estilizado">
    <h2>Cuéntanos que necesitas</h2>
   
    <label for="duracion">Duración del Almacenamiento:</label>
    <select id="duracion" name="duracion" required>
        <option value="1_mes">1 Mes</option>
        <option value="3_meses">3 Meses</option>
        <option value="6_meses">6 Meses</option>
    </select>

    <label for="tamano">Tamaño del Espacio Requerido:</label>
    <select id="tamano" name="tamano" required>
        <option value="pequeno">Pequeño</option>
        <option value="mediano">Mediano</option>
        <option value="grande">Grande</option>
    </select>

    <label for="fecha_inicio">Fecha de Inicio:</label>
    <input type="date" id="fecha_inicio" name="fecha" required>

    <label for="telefono_contacto">Teléfono de Contacto:</label>
    <input type="text" id="telefono_contacto" name="telefono_contacto" pattern="\d{9}" placeholder="Ingrese su número de contacto" maxlength="9" required>


    <label for="objetos">Objetos a Almacenar (Opcional):</label>
    <textarea id="objetos" name="descripcion" placeholder="Describa los objetos a almacenar"></textarea>

    <input type="hidden" name="servicio_id" value="3"> <!-- ID para Guardamuebles -->
    <button type="submit">Solicitar Presupuesto</button>
</form>
</main>

 <!-- footer para todas las paginas -->
 <?php include __DIR__ . '/../includes/piepagina.php'; ?>
 
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>

</body>
</html>
