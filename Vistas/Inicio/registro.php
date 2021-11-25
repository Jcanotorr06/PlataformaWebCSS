<?php 
    if($query = isset(parse_url($_SERVER['REQUEST_URI'])['query']) ? parse_url($_SERVER['REQUEST_URI'])['query'] : false){//Si hay un query en la url, se almacena el en la variable query y...
        parse_str($query, $query_array);
        $errorNum = $query_array['err'];//Se extrae el codigo de error
        switch($errorNum){//Dependiendo del codigo de error...
            default:
                $mensaje_error = "Esta cédula ya se encuentra en uso. Por favor intente de nuevo";//Mensaje de error a mostrar en el modal
                require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Layouts/modalError.php';//Se importa elm modal
                break;
        }
    }
?>

<head>
    <title>
        Registro | Plataforma Virtual CSS
    </title>
</head>
<main class="container-fluid min-vh-100">
    <section class="row min-vh-100">
        <div class="col-lg-6 d-none d-lg-block bg-blue">

        </div>
        <div class="col-lg-6 min-vh-100 py-5 d-flex flex-column justify-content-center align-items-center">
            <h1 class="text-center my-4 px-3 d-lg-none">Plataforma Virtual CSS</h1>
            <h5 class="text-center my-4 text-muted d-lg-none">Registro</h5><!-- Titulo invisible en pantallas grandes -->
            <h2 class="text-center my-4 text-muted d-none d-lg-block">Registro</h2><!-- Titulo invisible en pantallas pequeñas -->

            <!-- Formulario de inicio invisible en pantallas grandes -->
                <form method="post" class="w-100 d-flex flex-column align-items-center px-md-5 px-3 d-lg-none">
                    <div class="form-floating my-3 w-100">
                        <input name="nombre" required type="text" class="form-control" placeholder="Nombre">
                        <label>Nombre</label>
                    </div>
                    <div class="form-floating my-3 w-100">
                        <input name="apellido" required type="text" class="form-control" placeholder="Apellido">
                        <label>Apellido</label>
                    </div>
                    <div class="form-floating my-3 w-100">
                        <input name="email" required type="email" class="form-control" placeholder="ejemplo@email.com">
                        <label>Email</label>
                    </div>
                    <div class="form-floating my-3 w-100">
                        <input name="cedula" required type="text" class="form-control" placeholder="00-0000-00000">
                        <label>Cedula</label>
                    </div>
                    <div class="form-floating my-3 w-100">
                        <input name="contraseña" required type="password" class="form-control" placeholder="Contraseña">
                        <label>Contraseña</label>
                    </div>
                    <button type="submit" name="registro" class="btn btn-lg btn-primary rounded-pill fw-bold w-100 my-4 d-md-none">Registrarse</button>
                    <button type="submit" name="registro" class="btn btn-lg btn-primary rounded-pill fw-bold w-50 my-4 py-3 d-none d-md-block">Registrarse</button>
                </form>

            <!-- Formulario de inicio invisible en pantallas pequeñas -->
                <form method="post" class="w-75 flex-column align-items-center px-3 d-none d-lg-flex">
                    <div class="row w-100">
                        <div class="col px-2">
                            <div class="form-floating my-3 w-100">
                                <input name="nombre" required type="text" class="form-control" placeholder="Nombre">
                                <label>Nombre</label>
                            </div>
                        </div>
                        <div class="col px-2">
                            <div class="form-floating my-3 w-100">
                                <input name="apellido" required type="text" class="form-control" placeholder="Apellido">
                                <label>Apellido</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating my-3 w-100">
                        <input name="email" required type="email" class="form-control" placeholder="ejemplo@email.com">
                        <label>Email</label>
                    </div>
                    <div class="form-floating my-3 w-100">
                        <input name="cedula" required type="text" class="form-control" placeholder="00-0000-00000">
                        <label>Cedula</label>
                    </div>
                    <div class="form-floating my-3 w-100">
                        <input name="contraseña" required type="password" class="form-control" placeholder="Contraseña">
                        <label>Contraseña</label>
                    </div>
                    <button type="submit" name="registro" class="btn btn-lg btn-primary rounded-pill fw-bold w-50 my-4 py-3">Registrarse</button>
                </form>


            <h6>¿Ya tiene una cuenta? <b><a href="/">Iniciar Sesion</a></b></h6>
        </div>
    </section>
</main>