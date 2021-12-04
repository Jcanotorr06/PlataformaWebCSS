<head>
    <script>
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/Vistas/General/Calendario/calendario.js"?>
    </script>
    <style>
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/Vistas/General/Calendario/calendario.css"?>
    </style>
</head>

<input type="hidden" id="dateInput" required name="fecha" value="">
<div id="myCalendar" class="vanilla-calendar"></div>

<script>
    $('#dateInput').change(() => {
        alert('VALUE CHANGED')
    })
    const dias_habiles_json = (<?php echo $dias_habiles_json?>)

    let pastDates = false, availableDates = false, availableWeekDays = true
    let days = [{day: 'sunday'},{day:'monday'},{day:'tuesday'},{day:'wednesday'},{day:'thursday'},{day:'friday'},{day:'saturday'},{day:'sunday'}]
    //let workdays = FILTRAR EL ARREGLO days COMPARANDO CON LOS DÍAS HABILES DEL MEDICO EN LA DB
    let filteredDays = [];
    Object.keys(dias_habiles_json).map(id_dia=>{
        filteredDays.push(days[id_dia-1])
    })


    
    
</script>