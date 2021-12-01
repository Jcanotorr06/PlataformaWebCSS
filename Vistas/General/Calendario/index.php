<head>
    <script>
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/Vistas/General/Calendario/calendario.js"?>
    </script>
    <style>
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/Vistas/General/Calendario/calendario.css"?>
    </style>
</head>

<input type="text" class="d-none" id="dateInput" required name="fecha">
<div id="myCalendar" class="vanilla-calendar"></div>

<script>

    let pastDates = false, availableDates = false, availableWeekDays = true
    
    let calendar = new VanillaCalendar({
        selector: "#myCalendar",
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Outubre", "Noviembre", "Diciembre"],
        shortWeekday: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sáb'],
        onSelect: (data) => {
            document.getElementById('dateInput').value = data.date
        },
        pastDates: false,
        availableWeekDays: [
        {day: 'monday'},
        {day: 'tuesday'}
        ],
        datesFilter: true
    })
</script>