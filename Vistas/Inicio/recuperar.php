<head>
    <title>
        Recuperar Contraseña | Plataforma Virtual CSS
    </title>
</head>
<main class="container-fluid min-vh-100">
    <section class="row min-vh-100">
        <div class="col-lg-6 d-none d-lg-block bg-css">

        </div>
        <div class="col-lg-6 min-vh-100 py-5 d-flex flex-column justify-content-center align-items-center">
            <h1 class="text-center my-4 px-3 d-lg-none">Plataforma Virtual CSS</h1>
            <h5 class="text-center my-4 text-muted d-lg-none">Recuperar Contraseña</h5><!-- Titulo invisible en pantallas grandes -->
            <h2 class="text-center my-4 text-muted d-none d-lg-block">Recuperar Contraseña</h2><!-- Titulo invisible en pantallas pequeñas -->
            
            <?php if(isset($usuario)): ?>
                <!-- Formulario de cambio de contraseña invisible en pantallas grandes -->
                <form method="post" class="w-100 d-flex flex-column align-items-center px-md-5 px-3 d-lg-none">
                    <?php echo '<input name="cedula" required type="hidden" value="'.$usuario.'">' ?>
                    <div class="form-floating my-3 w-100">
                        <input name="cedula" required type="text" disabled class="form-control" placeholder="00-0000-00000">
                        <label><?php echo $usuario ?></label>
                    </div>
                    <div class="form-floating my-3 w-100">
                        <input name="contraseña" required type="password" disabled class="form-control" placeholder="Nuva Contraseña">
                        <label>Nueva Contraseña</label>
                    </div>
                    <button type="submit" name="cambiarr" class="btn btn-lg btn-primary rounded-pill fw-bold w-100 my-4 d-md-none">Cambiar Contraseña</button>
                    <button type="submit" name="cambiar" class="btn btn-lg btn-primary rounded-pill fw-bold w-50 my-4 py-3 d-none d-md-block">Cambiar Contraseña</button>
                </form>

            <!-- Formulario de cambio de contraseña invisible en pantallas pequeñas -->
                <form method="post" class="w-75 flex-column align-items-center px-3 d-none d-lg-flex">
                    <?php echo '<input name="cedula" required type="hidden" value="'.$usuario.'">' ?>
                    <div class="form-floating my-3 w-100">
                        <input required type="text" disabled class="form-control" placeholder="00-0000-00000">
                        <label><?php echo $usuario ?></label>
                    </div>
                    <div class="form-floating my-3 w-100">
                        <input name="contraseña" required type="password" class="form-control" placeholder="Nuva Contraseña">
                        <label>Nueva Contraseña</label>
                    </div>
                    <button type="submit" name="cambiar" class="btn btn-lg btn-primary rounded-pill fw-bold w-50 my-4 py-3">Cambiar Contraseña</button>
                </form>

            <?php else: ?>
            <!-- Formulario de recuperacion invisible en pantallas grandes -->
                <form method="post" class="w-100 d-flex flex-column align-items-center px-md-5 px-3 d-lg-none">
                    <div class="form-floating my-3 w-100">
                        <input type="text" name="cedula" class="form-control" placeholder="00-0000-00000">
                        <label>Cedula</label>
                    </div>
                    <button type="submit" name="recuperarr" class="btn btn-lg btn-primary rounded-pill fw-bold w-100 my-4 d-md-none">Enviar</button>
                    <button type="submit" name="recuperar" class="btn btn-lg btn-primary rounded-pill fw-bold w-50 my-4 py-3 d-none d-md-block">Enviar</button>
                </form>

            <!-- Formulario de recuperacion invisible en pantallas pequeñas -->
                <form method="post" class="w-75 flex-column align-items-center px-3 d-none d-lg-flex">
                    <div class="form-floating my-3 w-100">
                        <input name="cedula" required type="text" class="form-control" placeholder="00-0000-00000">
                        <label>Cedula</label>
                    </div>
                    <button type="submit" name="recuperar" class="btn btn-lg btn-primary rounded-pill fw-bold w-50 my-4 py-3">Enviar</button>
                </form>

            <?php endif?>
            <h6><b><a href="/">Volver al Inicio</a></b></h6>
        </div>
    </section>
</main>