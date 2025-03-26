
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudanzas</title>
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">
</head>
<body class="mudanzas">
    <!-- Encabezado -->

    <?php include __DIR__ . '/../includes/encabezado.php'; ?>

    <!-- Menú de Navegación -->
    <nav>
    <?php include __DIR__ . '/../includes/menu.php'; ?>
    </nav>
    <div>
    <button id="btn-regresar"> Regresar </button>
    </div>
    <main>
       
    <div class= "texto-formulario">
        <h1>Mudanzas</h1>
        <p>Ofrecemos servicios de mudanzas seguras, rápidas y responsables. Perfecto para tu hogar o empresa.</p>
    </div>
    <!-- Formulario del servicio de mudanzas-->
    <form action="/Transportes_Barahona/public/index.php?action=guardar_solicitud_servicio" method="POST" class="formulario-estilizado">
    <h2>Cuéntanos que necesitas</h2>
  
    <label for="origen">Dirección de Origen:</label>
    <input type="text" id="origen" name="origen" placeholder="Ingrese la dirección de origen" required>

    <label for="destino">Dirección de Destino:</label>
    <input type="text" id="destino" name="destino" placeholder="Ingrese la dirección de destino" required>

    <label for="fecha">Fecha de Mudanza:</label>
    <input type="date" id="fecha" name="fecha" required>

    <label for="tamano">Tamaño Aproximado:</label>
    <select id="tamano" name="tamano" required>
        <option value="pequeno">Pequeño</option>
        <option value="mediano">Mediano</option>
        <option value="grande">Grande</option>
    </select>
    <label for="piso">Piso o Nivel (Opcional):</label>
    <input type="text" id="piso" name="piso" placeholder="Ej.: Planta baja, 2º piso">

    <label for="telefono_contacto">Teléfono de Contacto:</label>
    <input type="text" id="telefono_contacto" name="telefono_contacto" pattern="\d{9}" placeholder="Ingrese su número de contacto" maxlength="9" required>

    <label for="descripcion">Descripción Adicional (Opcional):</label>
    <textarea id="descripcion" name="descripcion" placeholder="Ingrese detalles adicionales"></textarea>

    <input type="hidden" name="servicio_id" value="1"> <!-- ID para Mudanzas -->
    <button type="submit">Solicitar Presupuesto</button>
</form>

</main>
 <!-- footer para todas las paginas -->
 <?php include __DIR__ . '/../includes/piepagina.php'; ?>
 
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>

</body>
</html>
