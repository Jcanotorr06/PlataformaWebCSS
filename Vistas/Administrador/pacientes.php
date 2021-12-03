<head>
    <title>Modificar Pacientes | Plataforma Web Css</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<main class="min-h-100 container-lg d-flex flex-column align-items-center justify-content-start flex-grow-1 py-3">
    <h2 class="text-center fw-normal text-black-50 my-5 h1">Pacientes</h2>
    <div class="w-100 overflow-x">
        <button class="btn btn-secondary" id="btnAñadir" data-toggle="modal" data-target="#añadirPaciente">Añadir</button>
        <table class="table display min-w-900 nowrap" id="example">
            <thead class="table-head">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cedula</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pacientes as $paciente):?>
                    <?php echo '<tr data-bs-toggle="modal" data-bs-target="#modalOpcion" data-bs-id="'.$paciente['id'].'" data-bs-nombre="'.$paciente['nombre'].'" data-bs-cedula="'.$paciente['cedula'].'" data-bs-apellido="'.$paciente['apellido'].'" data-bs-email="'.$paciente['email'].'" data-bs-contraseña="'.$paciente['contraseña'].'">'?>
                        <td><?php echo $paciente['nombre']?></td>
                        <td><?php echo $paciente['apellido']?></td>
                        <td><?php echo $paciente['cedula']?></td>
                        <td><?php echo $paciente['email'] ?></td>
                        <td><?php echo $paciente['contraseña'] ?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/añadirPaciente.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/editarPaciente.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/eliminarPaciente.php' ?>

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
                        <button class="btn btn-dark mr-5" id="btnEditar" data-toggle="modal" data-dismiss="modal" data-target="#editarPaciente">Editar</button>
                        <button class="btn btn-dark" id="btnEliminar" data-toggle="modal" data-dismiss="modal" data-target="#eliminarPaciente">Eliminar</button>
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
        let paciente = e.relatedTarget
        let id = paciente.getAttribute('data-bs-id');
        let nombre = paciente.getAttribute('data-bs-nombre');
        let apellido = paciente.getAttribute('data-bs-apellido');
        let cedula = paciente.getAttribute('data-bs-cedula');
        let email = paciente.getAttribute('data-bs-email');

        document.getElementById('editar_id').value = id
        document.getElementById('eliminar_id').value = id
        document.getElementById('editar_nombre').value = nombre
        document.getElementById('editar_apellido').value = apellido
        document.getElementById('editar_email').value = email
        document.getElementById('editar_cedula').value = cedula
    })

    $('#btnAñadir').click(() => {
        $('#añadirPaciente').modal('toggle');
    })
    $('#btnEditar').click(() =>{
        $('#modalOpcion').modal('toggle');
        $('#editarPaciente').modal('toggle')
    })
    $('#btnEliminar').click(() =>{
        $('#modalOpcion').modal('toggle');
        $('#eliminarPaciente').modal('toggle')
    })
</script>