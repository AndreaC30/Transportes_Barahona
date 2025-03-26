<!-- Header -->
<header>
    <div class="logo">
        <img src="/Transportes_Barahona/public/img/logotipo.png" alt="Logo de la Empresa" />
    </div>
    <div class="imagen-central">
        <img src="/Transportes_Barahona/public/img/camiones.png" alt="Imagen Central" />
    </div>
    <div class="area-cliente">
        <a href="/Transportes_Barahona/public/index.php?action=area_personal" class="btn-area-cliente">Área Personal</a>
        <?php if (!isset($_SESSION['usuario_id'])): ?>
            <br>
            <a href="/Transportes_Barahona/public/index.php?action=registrar" class="link-registrar">¿Aún no eres cliente?</a>
        <?php endif; ?>
    </div>
</header>
