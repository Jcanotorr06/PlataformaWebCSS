<head>
    <title>Modificar Especialidades | Plataforma Web Css</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<main class="min-h-100 container-lg d-flex flex-column align-items-center justify-content-start flex-grow-1 py-3">
    <h2 class="text-center fw-normal text-black-50 my-5 h1">Especialidades</h2>
    <div class="w-100 overflow-x">
        <table class="table display min-w-900" id="example">
            <thead class="table-head">
                <tr>
                    <th>Id</th>
                    <th>Especialidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($especialidades as $especialidad):?>
                    <?php echo '<tr data-bs-toggle="modal" data-bs-target="#modalEditar" data-bs-id="'.$especialidad['id'].'" data-bs-especialidad="'.$especialidad['especialidad'].'">'?>
                        <td><?php echo $especialidad['id']?></td>
                        <td><?php echo $especialidad['especialidad']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</main>
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
</script>