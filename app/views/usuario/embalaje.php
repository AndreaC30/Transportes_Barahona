<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudanzas</title>
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">
</head>
<body class="embalaje">
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
        <h1>Servicio de embalaje</h1>
        <p>Embalaje profesional para todo tipo de objetos.</p>
    </div>
      <!-- Formulario de servicio de embalaje--> 
    <form action="/Transportes_Barahona/public/index.php?action=guardar_solicitud_servicio" method="POST" class="formulario-estilizado">
    <h2>Cuéntanos que necesitas</h2>    
    <label for="tipo_objetos">Tipo de Objetos a Embalar:</label>
    <select id="tipo_objetos" name="tipo_objetos" required>
        <option value="muebles">Muebles</option>
        <option value="electronicos">Electrodomésticos</option>
        <option value="ropa">Ropa</option>
        <option value="ropa">Cristalería</option>

    </select>
    <label for="fecha">Fecha de Embalaje:</label>
    <input type="date" id="fecha" name="fecha" required>

    <label for="telefono_contacto">Teléfono de Contacto:</label>
    <input type="text" id="telefono_contacto" name="telefono_contacto" pattern="\d{9}" placeholder="Ingrese su número de contacto" maxlength="9" required>


    <label for="comentarios">Comentarios Adicionales (Opcional):</label>
    <textarea id="comentarios" name="descripcion" placeholder="Ingrese detalles adicionales"></textarea>

    <input type="hidden" name="servicio_id" value="2"> <!-- ID para Embalaje -->
    <button type="submit">Solicitar Presupuesto</button>
</form>

</main>
 <!-- footer para todas las paginas -->
 <?php include __DIR__ . '/../includes/piepagina.php'; ?>
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>

</body>
</html>
