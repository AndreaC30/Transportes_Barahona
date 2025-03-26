
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportes Barahona</title>
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">
</head>
<body>
  <!-- Encabezado -->
  <?php include __DIR__ . '/../includes/encabezado.php'; ?>
<!-- Menú de Navegación -->
    <nav>
        <?php include __DIR__ . '/../includes/menu.php'; ?>
    </nav>
<main>
<div class= "texto-formulario">
    <br>
        <h1>Nuestros Servicios</h1>
    </div>
    <!-- Sección de Servicios-->
    <section id="servicios">
    
    <div class="servicios-grid">
        <div class="servicio">
            <h3><a href="/Transportes_Barahona/public/index.php?action=mudanzas">Mudanzas</a></h3>
        </div>
        <div class="servicio">
            <h3><a href="/Transportes_Barahona/public/index.php?action=embalaje">Embalaje</a></h3>
        </div>
        <div class="servicio">
            <h3><a href="/Transportes_Barahona/public/index.php?action=guardamuebles">Guardamuebles</a></h3>
        </div>
        <div class="servicio">
            <h3><a href="/Transportes_Barahona/public/index.php?action=paqueteria_frio">Paquetería en Frío</a></h3>
        </div>
    </div> 
    
    <!-- Mensaje de calidad-->
    <p class="mensaje-calidad">
    En Transportes Barahona, ofrecemos un servicio 
    <br>integral de mudanzas,
    paquetería en frío, embalaje y guardamuebles.
    <br>Nos comprometemos a garantizar seguridad,
    rápidez y responsabilidad al mejor precio.
    </p>
    <p class="disponibilidad">Disponibilidad 24/7
    <br>¡Contáctanos hoy mismo y deja que nos encarguemos de todo!
    </p>
</section>

</main>   
    <!-- footer para todas las paginas -->
    <?php include __DIR__ . '/../includes/piepagina.php'; ?>
   <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>

</body>
</html>
