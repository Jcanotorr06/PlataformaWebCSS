<!-- Esta vista corresponde a la pagina de inicio compartida entre las vistas de paciente y medico -->
<?php
    $citas_json = json_encode($citas);
?>

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
                    <?php echo '<tr data-bs-toggle="modal" data-bs-target="#modalCita" data-bs-id="'.$cita['id'].'" data-bs-paciente="'.$cita['nombre_paciente'].'" data-bs-cedula="'.$cita['cedula_paciente'].'" data-bs-medico="'.$cita['nombre_medico'].'" data-bs-cedula-medico="'.$cita['cedula_medico'].'" data-bs-especialidad="'.$cita['especialidad'].'" data-bs-fecha="'.$cita['fecha'].'" data-bs-hora="'.$cita['hora'].'" data-bs-clinica="'.$cita['clinica'].'" data-bs-corregimiento="'.$cita['corregimiento'].'" data-bs-distrito="'.$cita['distrito'].'" data-bs-provincia="'.$cita['provincia'].'">'?>
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

<!-- Modal de detalles de cita -->
<div class="modal fade" id="modalCita" tabindex="-1" aria-labelledby="labelModalCita" aria-hidden="true">
  <div class="modal-dialog modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-blue text-white">
            <h5 class="modal-title" id="exampleModalLabel">Detalles de la Cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body container text-center flex-column justify-content-center align-items-center">
        <div class="row row-cols-1 gx-0">
            <div class="col row row-cols-2 gx-0">
                <div class="col text-left">
                    <h5 class=" text-black-50">Paciente</h5>
                    <p class="modal-paciente"></p>
                </div>
                <div class="col text-left">
                    <h5 class=" text-black-50">Cédula</h5>
                    <p class="modal-cedula"></p>
                </div>
            </div>
            <div class="col row row-cols-2 gx-0">
                <div class="col text-left">
                    <h5 class=" text-black-50">Medico</h5>
                    <p class="modal-medico"></p>
                </div>
                <div class="col text-left">
                    <h5 class=" text-black-50">Especialidad</h5>
                    <p class="modal-especialidad"></p>
                </div>
            </div>
            <div class="col row row-cols-2 gx-0">
                <div class="col text-left">
                    <h5 class=" text-black-50">Fecha</h5>
                    <p class="modal-fecha"></p>
                </div>
                <div class="col text-left">
                    <h5 class=" text-black-50">Hora</h5>
                    <p class="modal-hora"></p>
                </div>
            </div>
            <div class="col text-left">
                <h5 class=" text-black-50">Direccion</h5>
                <p class="modal-direccion"></p>
            </div>
        </div>
      </div>
        <div class="modal-footer flex-md-nowrap">
            <div class="w-100">
                <button type="button" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalCancelar" name="cancelar" class="btn btn-danger rounded-pill w-100 py-2">Cancelar</button>
            </div>
            <div class="w-100">
                <a href="/reprogramar"  class="btn text-white btn-primary rounded-pill w-100 py-2">Reprogramar</a>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Modal de cancelacion de cita -->
<div class="modal fade" id="modalCancelar" tabindex="-1" aria-labelledby="labelModalError" aria-hidden="true">
  <div class="modal-dialog modal-dialog">
    <div class="modal-content p-lg-5 p-3">
      <div class="modal-body d-flex text-center flex-column justify-content-center align-items-center">
        <h5>¿Está seguro que desea cancelar su cita?</h5>
        <div class="w-100 d-flex">
            <form action="" method="post" class="w-100">
                <input type="hidden" name="id_cita" id="modal-id-cita">
                <input type="hidden" name="cedula_paciente" id="modal-ced-pac">
                <input type="hidden" name="nombre_paciente" id="modal-nom-pac">
                <input type="hidden" name="cedula_medico" id="modal-ced-med">
                <input type="hidden" name="nombre_medico" id="modal-nom-med">
                <input type="hidden" name="fecha" id="modal-fecha">
                <input type="hidden" name="especialidad" id="modal-esp">
                <button type="submit" name="cancelar" class="btn btn-danger rounded-pill w-100 py-2">Si</button>
            </form>
            <button type="button" class="btn btn-secondary rounded-pill w-100 py-2" data-bs-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
    let citas = (<?php echo($citas_json)?>)
    let modal = document.getElementById('modalCita')
    modal.addEventListener('show.bs.modal', (e) =>{
        let cita = e.relatedTarget
        let id = cita.getAttribute('data-bs-id')
        let paciente = cita.getAttribute('data-bs-paciente')
        let cedula = cita.getAttribute('data-bs-cedula')
        let medico = cita.getAttribute('data-bs-medico')
        let cedula_medico = cita.getAttribute('data-bs-cedula-medico')
        let especialidad = cita.getAttribute('data-bs-especialidad')
        let fecha = cita.getAttribute('data-bs-fecha')
        let hora = cita.getAttribute('data-bs-hora')
        let clinica = cita.getAttribute('data-bs-clinica')
        let corregimiento = cita.getAttribute('data-bs-corregimiento')
        let distrito = cita.getAttribute('data-bs-distrito')
        let provincia = cita.getAttribute('data-bs-provincia')
        
        document.getElementById('modal-id-cita').value = id
        document.getElementById('modal-ced-pac').value = cedula
        document.getElementById('modal-nom-pac').value = paciente
        document.getElementById('modal-ced-med').value = cedula_medico
        document.getElementById('modal-nom-med').value = medico
        document.getElementById('modal-fecha').value = fecha
        document.getElementById('modal-esp').value = especialidad
        modal.querySelector('.modal-paciente').textContent = paciente
        modal.querySelector('.modal-cedula').textContent = cedula
        modal.querySelector('.modal-medico').textContent = medico
        modal.querySelector('.modal-especialidad').textContent = especialidad
        modal.querySelector('.modal-fecha').textContent = fecha
        modal.querySelector('.modal-hora').textContent = hora
        modal.querySelector('.modal-direccion').textContent = `${provincia}, ${distrito}, ${corregimiento}, ${clinica}`
    })

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