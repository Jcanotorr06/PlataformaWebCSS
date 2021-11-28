<!-- Esta vista corresponde a la pagina de inicio compartida entre las vistas de paciente y medico -->
<head>
    <title>Inicio | Plataforma Web CSS</title>
</head>
<main class="min-h-100 container-lg d-flex flex-column align-items-center justify-content-start flex-grow-1 py-3">
    <h2 class="text-center fw-normal text-black-50 my-5 h1">Mis Citas</h2>
    <div class="w-100 overflow-x">
        <table class="table table-striped table-hover min-w-900" id="example">
            <thead class="table-head text-white">
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Clínica</th>
                    <th>Medico</th>
                    <th>Especialidad</th>
                    <th>Cédula del Paciente</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($citas as $cita):?>
                    <tr>
                        <td><?php echo $cita['fecha']?></td>
                        <td><?php echo $cita['hora']?></td>
                        <td><?php echo $cita['clinica']?></td>
                        <td><?php echo $cita['nombre_medico'] ?></td>
                        <td><?php echo $cita['especialidad'] ?></td>
                        <td><?php echo $cita['cedula_paciente']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</main>
<footer class="w-100 fixed-bottom navbar-dark bg-dark">
    <nav class="container py-3">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <div >
                    <p class=" navbar-text">Caja de Seguro Social © 2021. Todos los derechos reservados.</p>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <a href="https://w3.css.gob.pa/">
                    <img src="https://w3.css.gob.pa/wp-content/uploads/2020/09/cropped-cajalogo-2.png" alt="logo css" id="footerLogo">
                </a>
            </div>
        </div>
    </nav>
</footer>
<script>
    let table = new DataTable('#example', {
        "pageLength": 10,
        "searching": false,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": false,
        "info": false,
        "scrollX": true,
        "language": {
            "paginate": {
                "previous": "← anterior",
                "next": "siguiente →"
            }
        }
    });
/*     document.getElementById('example_paginate').getElementsByClassName('previous')[0].innerHTML = "← anterior"
    document.getElementById('example_paginate').getElementsByClassName('next')[0].innerHTML = "siguiente →" */
</script>