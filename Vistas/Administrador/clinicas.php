<head>
    <title>Modificar Clinica | Plataforma Web Css</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<main class="min-h-100 container-lg d-flex flex-column align-items-center justify-content-start flex-grow-1 py-3">
    <h2 class="text-center fw-normal text-black-50 my-5 h1">Clinicas</h2>
    <div class="w-100 overflow-x">
        <button class="btn btn-secondary" id="btnAñadir" data-toggle="modal" data-target="#añadirClinica">Añadir</button>
        <table class="table display nowrap min-w-900" id="example">
            <thead class="table-head">
                <tr>
                    <th>Id</th>
                    <th>Clinica</th>
                    <th>Corregimiento</th>
                    <th>Distrito</th>
                    <th>Provincia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clinicas as $clinica):?>
                    <?php echo '<tr data-bs-toggle="modal" data-bs-target="#modalOpcion" data-bs-id="'.$clinica['id'].'" data-bs-clinica="'.$clinica['clinica'].'" data-bs-corregimiento="'.$clinica['id_corregimiento'].'" data-bs-distrito="'.$clinica['id_distrito'].'" data-bs-provincia="'.$clinica['id_provincia'].'">'?>
                        <td><?php echo $clinica['id']?></td>
                        <td><?php echo $clinica['clinica']?></td>
                        <td><?php echo $clinica['corregimiento']?></td>
                        <td><?php echo $clinica['distrito'] ?></td>
                        <td><?php echo $clinica['provincia'] ?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/añadirClinica.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/editarClinica.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/Administrador/Modales/eliminarClinica.php' ?>

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
        let clinica = e.relatedTarget
        let id = clinica.getAttribute('data-bs-id');
        let nombre = clinica.getAttribute('data-bs-clinica');
        let id_corregimiento = clinica.getAttribute('data-bs-corregimiento');
        let id_distrito = clinica.getAttribute('data-bs-distrito');
        let id_provincia = clinica.getAttribute('data-bs-provincia');

        document.getElementById('editarId').value = id
        document.getElementById('eliminarId').value = id
        document.getElementById('editarNombre').value = nombre
        document.getElementById('editarCorregimiento').value = id_corregimiento
        document.getElementById('editarDistrito').value = id_distrito
        document.getElementById('editarProvincia').value = id_provincia

    })

    $('#btnAñadir').click(() => {
        $('#añadirClinica').modal('toggle');
    })
    $('#btnEditar').click(() =>{
        $('#modalOpcion').modal('toggle');
        $('#editarClinica').modal('toggle')
    })
    $('#btnEliminar').click(() =>{
        $('#modalOpcion').modal('toggle');
        $('#eliminarClinica').modal('toggle')
    })
</script>