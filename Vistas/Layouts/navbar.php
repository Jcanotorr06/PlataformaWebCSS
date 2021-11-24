<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/offcanvas.php'
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">Plataforma Web Css</a>
        <button type="button" class="navbar-toggler border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav ms-auto d-none d-lg-flex" id="nav">
            <a href="/" class="nav-item nav-link">Inicio</a>
            <a href="/agendar" class="nav-item nav-link">Agendar Cita</a>
            <a href="/logout" class="nav-item nav-link">Cerrar Sesión</a>
        </div>
    </div>
</nav>
<script>
    var target
    switch(window.location.pathname){
        case '/' || '':
            target = 0;
            break;
        case '/agendar':
            target = 1;
            break;
    }
    document.getElementById('nav').getElementsByTagName('a')[target].classList.add("fw-bold");
    document.getElementById('nav').getElementsByTagName('a')[target].classList.add("text-dark");
    document.getElementById('menu').getElementsByTagName('a')[target].classList.add("fw-bold");
    document.getElementById('menu').getElementsByTagName('a')[target].classList.add("text-dark");
</script>