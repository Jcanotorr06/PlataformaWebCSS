<input type="text" class="d-none" id="dateInput" required name="fecha">
<div class="app">
    <div class="app__main">
        <div class="calendar">
            <div id="calendar"></div>
        </div>
    </div>
</div>
<script>
    <?php 
        include_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/Calendario/calendario.js'
    ?>
</script>