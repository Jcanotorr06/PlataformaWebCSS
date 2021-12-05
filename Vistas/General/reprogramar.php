<head>
    <title>Agendar Cita | Plataforma Web Css</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<main class=" container-fluid h-100 flex-grow-1">
    <form method="post">
        <?php echo'<input type="hidden" name="id_cita" value="'.$id_cita.'">'?>
        <?php echo'<input type="hidden" name="id_medico" value="'.$id_medico.'">'?>
        <section class="row">
            <div class="col-lg-6 bg-blue h-test">
                <div class="row row-cols-1 h-100">
                    <div class="col p-x-2 py-4">
                        <button class="btn bg-transparent border-0 back" onclick="window.history.back()"><i class="bi bi-arrow-return-left text-white-50 h2 fw-bold"></i></button>
                    </div>
                    <div class="col d-flex flex-column justify-content-center align-items-center text-center">
                        <div>
                            <h2 class=" text-white-50 fw-normal h1 mt-4">Reprogramar Cita</h2>
                        </div>
                        <div>
                            <h5 class="fw-bold text-white">Fecha Agendada: <?php echo $fecha?> </h5>
                            <h5 class="fw-bold text-white">Hora Agendada: <?php echo date('h:i a', strtotime($hora))?></h5>
                        </div>
                    </div>
                    <div class="col h-100 flex-grow-1">
                        
                        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/Vistas/General/Calendario/index.php'?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 h-test">
                <div class="row h-100 row-cols-1 align-items-center">
                    <div class="col">
                        <h5 class="fw-bold py-3">Duración de la Cita</h5>
                        <div class="p-3 text-secondary bg-light">
                            <h6 class="text-center"><?php echo $duracion/60?> hora</h6>
                        </div>
                    </div>
                    <div class="col max-h-50 flex-grow-1 overflow-auto" id="listaHoras">
                        <h5 class="fw-bold py-3">Hora</h5>
                        <input type="text" id="timeInput" name="hora" required class="d-none">
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="1" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="1" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="2" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="2" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="3" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="3" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="4" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="4" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="5" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="5" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="6" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="6" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="7" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="7" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="8" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="8" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="9" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="9" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="10" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="10" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="11" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="11" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="12" class="radioLabel"></label>
                            <input type="radio" class="d-none radioButton" name="12" value="" onclick="selectTime(this.value, this.name)">
                        </label>
                    </div>
                    <div class="col d-flex justify-content-center" onclick="errorSubmit()">
                        <button type="submit"  disabled name="reprogramar" class="sbmt btn btn-secondary btn-lg text-white fw-bold rounded-pill py-3 w-50 d-md-block d-none">Agendar</button>
                        <button type="submit"  disabled name="reprogramar2" class="sbmt btn btn-secondary btn-lg text-white fw-bold rounded-pill px-3 d-md-none w-100">Agendar</button>
                    </div>    
                </div>
            </div>
        </section>
    </form>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    const activarSubmit = () => {
        if(document.getElementById('timeInput').value && document.getElementById('dateInput').value){
            Array.from(document.getElementsByClassName('sbmt')).map(boton => {
                if(boton.hasAttribute('disabled')){
                    boton.removeAttribute('disabled')
                    boton.classList.remove('btn-secondary')
                    boton.classList.add('btn-primary')
                }
            })
        }
    }

    document.getElementById('timeInput').addEventListener('change', () =>{
        console.log(document.getElementById('timeInput').value)
    })
    document.getElementById('dateInput').addEventListener('change', () =>{
        console.log(document.getElementById('dateInput').value)
    })


    const selectTime = (val, name) =>{
        if(document.getElementsByClassName('radioButton')[0].value){
            Array.from(document.getElementsByClassName('timeSelect')).map((input, i) => {
                if(i+1 == name){
                    document.getElementById('timeInput').value = val
                    input.classList.add('bg-blue')
                    input.getElementsByTagName('label')[0].classList.add('text-white')
                }else{
                    input.classList.remove('bg-blue')
                    input.getElementsByTagName('label')[0].classList.remove('text-white')
                }
            })
            activarSubmit()
        }
    }
    
    const listaHoras = document.getElementById('listaHoras')

    //Inicializa el calendario
    let calendar = new VanillaCalendar({
        selector: "#myCalendar",
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Outubre", "Noviembre", "Diciembre"],
        shortWeekday: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sáb'],
        onSelect: (data) => {
            let date = new Date(data.date).toLocaleDateString('fr-CA')
            document.getElementById('dateInput').value = date;
            let idSelectedDay = days.map( day => (day.day)).indexOf(data.data.day)+1;
            Object.keys(dias_habiles_json).map(id_dia=>{
                if(id_dia == idSelectedDay) {
                    dias_habiles_json[id_dia].map((hora, i) =>{
                        document.getElementsByClassName("radioButton")[i].value = hora
                        let horaFormat = moment(hora, 'hh:mm A').format('hh:mm A')
                        document.getElementsByClassName('radioLabel')[i].innerHTML = horaFormat
                    })
                }
                
            })
        },
        pastDates: false,
        availableWeekDays: filteredDays,
        datesFilter: true
    })

    //Muestra una alerta si se intenta reprogramar sin haber seleccioando una fecha y hora
    const errorSubmit = () =>{
        if(!document.getElementById('timeInput').value || !document.getElementById('dateInput').value){
            alert("Debe seleccionar una fecha")
        }
    }
</script>