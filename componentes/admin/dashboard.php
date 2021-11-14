<?php
    $datos = getDatosgenerales();
?>
<main>
    <h1>Bienvenido</h1>
    <section>
        <div>
            <h3>Pacientes: <?php echo($datos['cant_pacientes']) ?></h3>
        </div>
        <div>
            <h3>Medicos: <?php echo($datos['cant_medicos']) ?></h3>
        </div>
        <div>
            <h3>Clinicas: <?php echo($datos['cant_clinicas']) ?></h3>
        </div>
        <div>
            <h3>Especialidades: <?php echo($datos['cant_especialidades']) ?></h3>
        </div>
    </section>
</main>