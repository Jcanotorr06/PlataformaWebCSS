<head>
    <title>Modificar Especialidades | Plataforma Web Css</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<main class="min-h-100 container-lg d-flex flex-column align-items-center justify-content-start flex-grow-1 py-3">
    <h2 class="text-center fw-normal text-black-50 my-5 h1">Especialidades</h2>
    <div class="w-100 overflow-x">
        <button class="btn btn-secondary" id="btnAñadir" data-toggle="modal" data-target="#añadirClinica">Añadir</button>
        <table class="table display min-w-900" id="example">
            <thead class="table-head">
                <tr>
                    <th>Id</th>
                    <th>Especialidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($especialidades as $especialidad):?>
                    <?php echo '<tr data-bs-toggle="modal" data-bs-target="#modalOpcion" data-bs-id="'.$especialidad['id'].'" data-bs-especialidad="'.$especialidad['especialidad'].'">'?>
                        <td><?php echo $especialidad['id']?></td>
                        <td><?php echo $especialidad['especialidad']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/añadirEspecialidad.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/editarEspecialidad.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/eliminarEspecialidad.php' ?>

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
        let especialidad = e.relatedTarget
        let id = especialidad.getAttribute('data-bs-id');
        let nombre_especialidad = especialidad.getAttribute('data-bs-especialidad');

        document.getElementById('editar_id').value = id
        document.getElementById('eliminar_id').value = id
        document.getElementById('editar_especialidad').value = nombre_especialidad
    })

    $('#btnAñadir').click(() => {
        $('#añadirEspecialidad').modal('toggle');
    })
    
    $('#btnEditar').click(() =>{
        $('#modalOpcion').modal('toggle');
        $('#editarEspecialidad').modal('toggle')
    })
    
    $('#btnEliminar').click(() =>{
        $('#modalOpcion').modal('toggle');
        $('#eliminarEspecialidad').modal('toggle')
    })
</script>