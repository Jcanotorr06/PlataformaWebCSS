<head>
    <title>Modificar Medicos | Plataforma Web Css</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<main class="min-h-100 container-lg d-flex flex-column align-items-center justify-content-start flex-grow-1 py-3">
    <h2 class="text-center fw-normal text-black-50 my-5 h1">Medicos</h2>
    <div class="w-100 overflow-x">
        <table class="table display min-w-900 nowrap" id="example">
            <thead class="table-head">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cedula</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th>Especialidad</th>
                    <th>Duracion de Citas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($medicos as $medico):?>
                    <?php echo '<tr data-bs-toggle="modal" data-bs-target="#modalEditar" data-bs-id="'.$medico['id'].'" data-bs-nombre="'.$medico['nombre'].'" data-bs-cedula="'.$medico['cedula'].'" data-bs-apellido="'.$medico['apellido'].'" data-bs-email="'.$medico['email'].'" data-bs-especialidad="'.$medico['especialidad'].'" data-bs-contraseña="'.$medico['contraseña'].'" data-bs-duracion="'.$medico['duracion_citas'].'">'?>
                        <td><?php echo $medico['nombre']?></td>
                        <td><?php echo $medico['apellido']?></td>
                        <td><?php echo $medico['cedula']?></td>
                        <td><?php echo $medico['email'] ?></td>
                        <td><?php echo $medico['contraseña'] ?></td>
                        <td><?php echo $medico['especialidad']?></td>
                        <td><?php echo $medico['duracion_citas']?> Minutos</td>
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