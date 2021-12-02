<head>
    <title>Modificar Pacientes | Plataforma Web Css</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<main class="min-h-100 container-lg d-flex flex-column align-items-center justify-content-start flex-grow-1 py-3">
    <h2 class="text-center fw-normal text-black-50 my-5 h1">Pacientes</h2>
    <div class="w-100 overflow-x">
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
                    <?php echo '<tr data-bs-toggle="modal" data-bs-target="#modalEditar" data-bs-id="'.$paciente['id'].'" data-bs-nombre="'.$paciente['nombre'].'" data-bs-cedula="'.$paciente['cedula'].'" data-bs-apellido="'.$paciente['apellido'].'" data-bs-email="'.$paciente['email'].'" data-bs-contraseña="'.$paciente['contraseña'].'">'?>
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