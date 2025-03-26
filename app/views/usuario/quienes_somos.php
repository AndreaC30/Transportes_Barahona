
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Transportes_Barahona/public/libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Transportes_Barahona/public/css/style.css">
    <title>Quiénes Somos</title>
</head>
<body>
     <!-- Encabezado -->
     <?php include __DIR__ . '/../includes/encabezado.php'; ?>
<!-- Menú de Navegación -->
    <nav>
        <?php include __DIR__ . '/../includes/menu.php'; ?>
    </nav>
<main>
    <!-- Contenido principal informacion de la empresa-->
    <div>
    <button id="btn-regresar"> Regresar </button>
    </div>   
    <div class= "texto-formulario">
        <h1>Quiénes Somos</h1>
        <p>Transportes Barahona ofrece servicios de mudanzas, paquetería en frío, guardamuebles y embalaje. Nos destacamos por nuestra atención al cliente y compromiso con la calidad.</p>
    </div>
    <div id="quienes-somos">
        <div class="vision-mision-valores">
            <div>
                <h2>Visión</h2>
                <p>Ser la empresa líder en transporte y servicios de mudanza, destacándonos por nuestra innovación y atención al cliente.</p>
            </div>
            <div>
                <h2>Misión</h2>
                <p>Facilitar soluciones de transporte seguras, eficientes y personalizadas para nuestros clientes.</p>
            </div>
            <div>
                <h2>Valores</h2>
                <ul>
                    <li>Compromiso</li>
                    <li>Confianza</li>
                    <li>Innovación</li>
                    <li>Responsabilidad</li>
                </ul>
            </div>
        </div>
    </div>
</main>
     <!-- footer para todas las paginas -->
     <?php include __DIR__ . '/../includes/piepagina.php'; ?>
     
    <script src="/Transportes_Barahona/public/libs/js/bootstrap.bundle.min.js"></script>
    <script src="/Transportes_Barahona/public/js/main.js"></script>

</body>
</html>
