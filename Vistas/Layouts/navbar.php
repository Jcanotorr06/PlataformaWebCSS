<header>
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/offcanvas.php'//Se incluye el elemento de navegacion offcanvas para dispositivos moviles
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
        var target//Variable que almacena el indice del link activo en el navbar
        switch(window.location.pathname){//Dependiendo de la ruta actual se actualiza la varibale target
            case '/' || '':
                target = 0;
                break;
            case '/agendar':
                target = 1;
                break;
        }
        document.getElementById('nav').getElementsByTagName('a')[target].classList.add("fw-bold");//Se cambia la intensidad del link activo en la barra de navegacion a negrita
        document.getElementById('nav').getElementsByTagName('a')[target].classList.add("text-dark");//Se cambia el color del link en la barra de navegacion activo a negro
        document.getElementById('menu').getElementsByTagName('a')[target].classList.add("fw-bold");//Se cambia la intensidad del link activo en el menu offcanvas a negrita
        document.getElementById('menu').getElementsByTagName('a')[target].classList.add("text-dark");//Se cambia el color del link activo en el menu offcanvas a negro
    </script>
</header>