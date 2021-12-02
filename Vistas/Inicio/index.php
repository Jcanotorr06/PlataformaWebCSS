<head>
    <title>
        Iniciar Sesion | Plataforma Virtual CSS
    </title>
</head>
<main class="container-fluid vh-100">
    <section class="row h-100">
        <div class="col-lg-6 d-none d-lg-block bg-css">
            <h2 class="text-center h1 text-white fw-bold mt-7">Plataforma Virtual CSS</h2>
        </div>
        <div class="col-lg-6 h-100 py-5 d-flex flex-column justify-content-center align-items-center">
            <h1 class="text-center my-4 px-3 d-lg-none">Plataforma Virtual CSS</h1>
            <h5 class="text-center my-4 text-muted d-lg-none">Inicio de Sesion</h5><!-- Titulo invisible en pantallas grandes -->
            <h2 class="text-center my-4 text-muted d-none d-lg-block">Inicio de Sesion</h2><!-- Titulo invisible en pantallas pequeñas -->
            
            <!-- Formulario de inicio invisible en pantallas grandes -->
                <form method="post" class="w-100 d-flex flex-column align-items-center px-3 d-md-none">
                    <div class="form-floating my-4 w-100">
                        <input name="usuario" required type="text" class="form-control" placeholder="00-0000-00000">
                        <label>Usuario</label>
                    </div>
                    <div class="form-floating my-4 w-100">
                        <input name="contraseña" required type="password" class="form-control" placeholder="Contraseña">
                        <label>Contraseña</label>
                    </div>
                    <button type="submit" name="iniciar" class="btn btn-lg btn-primary rounded-pill fw-bold w-100 my-4">Iniciar Sesion</button>
                </form>

            <!-- Formulario de inicio invisible en pantallas pequeñas -->
                <form method="post" class="w-100 d-flex flex-column align-items-center px-3 d-none d-md-flex">
                    <div class="form-floating my-4 w-75">
                        <input name="usuario" required type="text" class="form-control" placeholder="00-0000-00000">
                        <label>Usuario</label>
                    </div>
                    <div class="form-floating my-4 w-75">
                        <input name="contraseña" required type="password" class="form-control" placeholder="Contraseña">
                        <label>Contraseña</label>
                    </div>
                    <button type="submit" name="iniciar" class="btn btn-lg btn-primary rounded-pill fw-bold w-50 my-4 py-3">Iniciar Sesion</button>
                </form>


            <h6><b><a href="/recuperar">¿Olvidó su contraseña?</a></b></h6>
            <h6>¿Primera vez aquì? <b><a href="/registro">Registrarse</a></b></h6>
        </div>
    </section>
</main>