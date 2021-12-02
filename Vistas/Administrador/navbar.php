<header>
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/offcanvas.php'//Se incluye el elemento de navegacion offcanvas para dispositivos moviles
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-dark">
        <div class="container-fluid">
            <a href="/" class="navbar-brand fw-bold">Plataforma Web Css</a>
            <button type="button" class="navbar-toggler border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav ms-auto d-none d-lg-flex" id="nav">
                <a href="/" class="nav-item nav-link">Inicio</a>
                <a href="/medicos" class="nav-item nav-link">Modificar Medicos</a>
                <a href="/clinicas" class="nav-item nav-link">Modificar Clinicas</a>
                <a href="/especialidades" class="nav-item nav-link">Modificar Especialidades</a>
                <a href="/pacientes" class="nav-item nav-link">Modificar Pacientes</a>
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
            case '/medicos':
                target = 1;
                break;
            case '/clinicas':
                target = 2;
                break;
            case '/especialidades':
                target = 3;
                break;
            case '/pacientes':
                target = 4;
                break;
        }
        document.getElementById('nav').getElementsByTagName('a')[target].classList.add("fw-bold");//Se cambia la intensidad del link activo en la barra de navegacion a negrita
        document.getElementById('nav').getElementsByTagName('a')[target].classList.add("text-dark");//Se cambia el color del link en la barra de navegacion activo a negro
        document.getElementById('menu').getElementsByTagName('a')[target].classList.add("fw-bold");//Se cambia la intensidad del link activo en el menu offcanvas a negrita
        document.getElementById('menu').getElementsByTagName('a')[target].classList.add("text-dark");//Se cambia el color del link activo en el menu offcanvas a negro
    </script>
</header>