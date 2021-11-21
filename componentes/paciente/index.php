<?php
    require_once './DB.php';
    cancelarCita();
    $citas = listarCitasPaciente($_SESSION['id']);
    if(is_string($citas)):
?>
    <h3><?php echo($citas)?></h3>
    <a href="/css/agendar.php">Agendar Cita</a>
<?php else:
    ?>
    <table>
            <tr>
                <th>Id</th>
                <th>Nombre del Paciente</th>
                <th>Cedula del Paciente</th>
                <th>Nombre del Medico</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Provincia</th>
                <th>Distrito</th>
                <th>Corregimiento</th>
                <th>Clinica</th>

            </tr>
            <?php while($row = $citas->fetch_assoc()): ?>
                <tr>
                    <td><?php echo($row['id']) ?></td>
                    <td><?php echo($row['nombre_paciente']) ?></td>
                    <td><?php echo($row['cedula_paciente']) ?></td>
                    <td><?php echo($row['nombre_medico']) ?></td>
                    <td><?php echo($row['especialidad']) ?></td>
                    <td><?php echo($row['fecha']) ?></td>
                    <td><?php echo($row['hora']) ?></td>
                    <td><?php echo($row['provincia']) ?></td>
                    <td><?php echo($row['distrito']) ?></td>
                    <td><?php echo($row['corregimiento']) ?></td>
                    <td><?php echo($row['clinica']) ?></td>
                    <td>
                        <form action="./index.php" method="post">
                            <?php echo("<input name='id_cita' hidden value='".$row['id']."'/>")?>
                            <input type="submit" value="Cancelar" name="cancelar">
                        </form>
                    </td>
                </tr>
            <?php endwhile ?>
        </table>
<?php
    endif
?>
