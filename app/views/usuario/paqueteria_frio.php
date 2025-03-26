
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudanzas</title>
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">
</head>
<body class="paqueteria_frio">
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
        <h1>Paquetería en Frío</h1>
        <p>Transporte de productos refrigerados.</p> 
    </div>
        <!-- Formulario de servicio de paqueteria en frio--> 
    <form action="/Transportes_Barahona/public/index.php?action=guardar_solicitud_servicio" method="POST" class="formulario-estilizado">
    <h2>Cuéntanos que necesitas</h2>
  
    <label for="tipo_mercancia">Tipo de Mercancía:</label>
<select id="tipo_mercancia" name="descripcion" required>
    <option value="Productos farmacéuticos">Productos farmacéuticos</option>
    <option value="Vacunas">Vacunas</option>
    <option value="Cosmética">Cosmética</option>
    <option value="Alimentación">Alimentación</option>
</select>

    <label for="direccion_recogida">Dirección de Recogida:</label>
    <input type="text" id="direccion_recogida" name="direccion_recogida" placeholder="Ingrese la dirección de recogida" required>

    <label for="direccion_entrega">Dirección de entrega:</label>
    <input type="text" id="direccion_entrega" name="direccion_entrega" placeholder="Ingrese la dirección de recogida" required>


    <label for="fecha_envio">Fecha de Envío:</label>
    <input type="date" id="fecha_envio" name="fecha" required>

    <label for="telefono_contacto">Teléfono de Contacto:</label>
        <input type="text" id="telefono_contacto" name="telefono_contacto" pattern="\d{9}" placeholder="Ingrese su número de contacto" maxlength="9" required>


    <input type="hidden" name="servicio_id" value="4"> <!-- ID para Paquetería en Frío -->
    <button type="submit">Solicitar Presupuesto</button>
    </form>
</main>
    <!-- footer para todas las paginas -->
    <?php include __DIR__ . '/../includes/piepagina.php'; ?>
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>

</body>
</html>
