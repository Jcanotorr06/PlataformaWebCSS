<?php
    require './session.php';
?>
<header>
    <?php if($_SESSION['rol'] == 'admin'): ?>
        <nav>
            <h1>Administrador</h1>
            <a href="/css/index.php">Inicio</a>
            <a href="/css/administrarPacientes.php">Administrar Pacientes</a>
            <a href="/css/administrarMedicos.php">Administrar Medicos</a>
            <a href="/css/administrarClinicas.php">Administrar Clinicas</a>
            <a href="/css/administrarEspecialidades.php">Administrar Especialidades</a>
        </nav>
    <?php else: ?>
        <nav>
            <h1>Usuario</h1>
            <a href="/css/index.php">Inicio</a>
            <a href="/css/agendar.php">Agendar Cita</a>
        </nav>
    <?php endif ?>
    <form action="./index.php" method="POST">
        <input type="submit" value="Cerrar Sesion" name="logout">
    </form>
</header>