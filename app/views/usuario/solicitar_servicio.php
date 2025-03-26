
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">
    <title>Solicitar Servicio</title>
</head>
<body>
      <!-- Encabezado -->
      <?php include __DIR__ . '/../includes/encabezado.php'; ?>
<!-- Menú de Navegación -->
    <nav>
        <?php include __DIR__ . '/../includes/menu.php'; ?>
    </nav>
   <!-- Sección de Selección de Servicios -->
   <main>
     <div>
    <button id="btn-regresar"> Regresar </button>
    </div>
   <div class= "texto-formulario">
        <h1>Solicitar Servicio</h1>
        <p>Seleccione uno de los servicios disponibles para continuar:</p>
    </div>
        <div class="servicios-grid">
            <div class="servicio">
                <a href="/Transportes_Barahona/public/index.php?action=mudanzas">
                    <h2>Mudanzas</h2>
                </a>
            </div>
            <div class="servicio">
                <a href="/Transportes_Barahona/public/index.php?action=embalaje">
                    <h2>Embalaje</h2>
                </a>
            </div>
            <div class="servicio">
                <a href="/Transportes_Barahona/public/index.php?action=guardamuebles">
                    <h2>Guardamuebles</h2>
                </a>
            </div>
            <div class="servicio">
                <a href="/Transportes_Barahona/public/index.php?action=paqueteria_frio">
                    <h2>Paquetería en Frío</h2>
                </a>
            </div>
        </div>
    </main>
    <!-- footer para todas las paginas -->
    <?php include __DIR__ . '/../includes/piepagina.php'; ?>
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
<script src="/Transportes_Barahona/public/js/main.js"></script>

</body>
</html>
