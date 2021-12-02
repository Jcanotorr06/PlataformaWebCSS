<head>
    <title>Modificar Clinica | Plataforma Web Css</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<main class="min-h-100 container-lg d-flex flex-column align-items-center justify-content-start flex-grow-1 py-3">
    <h2 class="text-center fw-normal text-black-50 my-5 h1">Clinicas</h2>
    <div class="w-100 overflow-x">
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
                    <?php echo '<tr data-bs-toggle="modal" data-bs-target="#modalEditar" data-bs-id="'.$clinica['id'].'" data-bs-clinica="'.$clinica['clinica'].'" data-bs-corregimiento="'.$clinica['corregimiento'].'" data-bs-distrito="'.$clinica['distrito'].'" data-bs-provincia="'.$clinica['provincia'].'">'?>
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