<head>
    <title>Modificar Medicos | Plataforma Web Css</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<main class="min-h-100 container-lg d-flex flex-column align-items-center justify-content-start flex-grow-1 py-3">
    <h2 class="text-center fw-normal text-black-50 my-5 h1">Medicos</h2>
    <div class="w-100 overflow-x">
        <button class="btn btn-secondary" id="btnAñadir" data-toggle="modal" data-target="#añadirMedico">Añadir</button>
        <table class="table display min-w-900 nowrap" id="example">
            <thead class="table-head">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cedula</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th>Clinica</th>
                    <th>Especialidad</th>
                    <th>Duracion de Citas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($medicos as $medico):?>
                    <?php echo '<tr data-bs-toggle="modal" data-bs-target="#modalOpcion" data-bs-id="'.$medico['id'].'" data-bs-nombre="'.$medico['nombre'].'" data-bs-cedula="'.$medico['cedula'].'" data-bs-apellido="'.$medico['apellido'].'" data-bs-email="'.$medico['email'].'" data-bs-id-especialidad="'.$medico['id_especialidad'].'" data-bs-id-clinica="'.$medico['id_clinica'].'" data-bs-contraseña="'.$medico['contraseña'].'" data-bs-duracion="'.$medico['duracion_citas'].'">'?>
                        <td><?php echo $medico['nombre']?></td>
                        <td><?php echo $medico['apellido']?></td>
                        <td><?php echo $medico['cedula']?></td>
                        <td><?php echo $medico['email'] ?></td>
                        <td><?php echo $medico['contraseña'] ?></td>
                        <td><?php echo $medico['clinica'] ?></td>
                        <td><?php echo $medico['especialidad']?></td>
                        <td><?php echo $medico['duracion_citas']?> Minutos</td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/añadirMedico.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/editarMedico.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/eliminarMedico.php' ?>

<div class="modal" id="modalOpcion" tabindex="-1" role="dialog" aria-labelledby="modal_opcion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-body">
            <h4 class="text-center">¿Qué desea realizar?</h4>
        </div>
        <div class="modal-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 header2">
                        <button class="btn btn-dark mr-5" id="btnEditar" data-toggle="modal" data-dismiss="modal" data-target="#editarMedico">Editar</button>
                        <button class="btn btn-dark" id="btnEliminar" data-toggle="modal" data-dismiss="modal" data-target="#eliminarMedico">Eliminar</button>
                    </div>   
                </div>    
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    let table = new DataTable('#example', {
        "autoWidth": false,
        "scrollX": true,
        "pagingType": 'numbers',
        "language": {
            "search": 'Buscar:  ',
            "lengthMenu": "Mostrar _MENU_ filas",
            "info": "Mostrando pagina _PAGE_ de _PAGES_"
        }
    });

    let modal = document.getElementById('modalOpcion')
    modal.addEventListener('show.bs.modal', (e) =>{
        let medico = e.relatedTarget
        let id = medico.getAttribute('data-bs-id');
        let nombre = medico.getAttribute('data-bs-nombre');
        let apellido = medico.getAttribute('data-bs-apellido');
        let cedula = medico.getAttribute('data-bs-cedula');
        let email = medico.getAttribute('data-bs-email');
        let id_especialidad = medico.getAttribute('data-bs-id-especialidad');
        let id_clinica = medico.getAttribute('data-bs-id-clinica');
        let duracion_citas = medico.getAttribute('data-bs-duracion');

        document.getElementById('editar_id').value = id
        document.getElementById('eliminar_id').value = id
        document.getElementById('editar_nombre').value = nombre
        document.getElementById('editar_apellido').value = apellido
        document.getElementById('editar_email').value = email
        document.getElementById('editar_clinica').value = id_clinica
        document.getElementById('editar_especialidad').value = id_especialidad
        document.getElementById('editar_cedula').value = cedula
        document.getElementById('editar_duracion_citas').value = duracion_citas
    })

    $('#btnAñadir').click(() => {
        $('#añadirMedico').modal('toggle');
    })
    $('#btnEditar').click(() =>{
        $('#modalOpcion').modal('toggle');
        $('#editarMedico').modal('toggle')
    })
    $('#btnEliminar').click(() =>{
        $('#modalOpcion').modal('toggle');
        $('#eliminarMedico').modal('toggle')
    })
</script>