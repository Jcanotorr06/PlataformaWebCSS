<head>
    <title>Inicio Administrador | Plataforma Web Css</title>
    <script src="https://kit.fontawesome.com/f0dfed3350.js" crossorigin="anonymous"></script>
</head>
<main class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
</div>

<div class="row">


    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-5">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Medicos
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $datos['cant_medicos']?></div>
                        <a class="h5 mb-0 font-weight-bold text-gray-800" href="/medicos">Ver detalles</a>
                    </div>
                    <div class="col-auto">
                        <a class="block-profile" href="/medicos">
                            <i class="fas fa-user-md fa-7x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-5">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Clinicas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $datos['cant_clinicas']?></div>
                        <a class="h5 mb-0 font-weight-bold text-gray-800" href="/clinicas">Ver detalles</a>
                    </div>
                    <div class="col-auto">
                        <a class="block-profile" href="/clinicas">
                            <i class="fas fa-hospital fa-7x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-5">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Especialidades
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $datos['cant_especialidades']?></div>
                        <a class="h5 mb-0 font-weight-bold text-gray-800" href="/especialidades">Ver detalles</a>
                    </div>
                    <div class="col-auto">
                        <a class="block-profile" href="/especialidades">
                            <i class="fas fa-address-card fa-7x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-5">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pacientes
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $datos['cant_pacientes']?></div>
                        <a class="h5 mb-0 font-weight-bold text-gray-800" href="/pacientes">Ver detalles</a>
                    </div>
                    <div class="col-auto">
                        <a class="block-profile" href="/pacientes">
                            <i class="fas fa-user-injured fa-7x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    

    
</div>
</main>