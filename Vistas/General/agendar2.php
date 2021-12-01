<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<main class=" container-fluid h-100 flex-grow-1">
    <form method="post">
        <section class="row">
            <div class="col-lg-6 bg-blue h-test">
                <div class="row row-cols-1 h-100">
                    <div class="col p-x-2 py-4">
                        <button class="btn bg-transparent border-0 back" onclick="window.history.back()"><i class="bi bi-arrow-return-left text-white-50 h2 fw-bold"></i></button>
                    </div>
                    <div class="col d-flex flex-column justify-content-center align-items-center text-center">
                        <div>
                            <h2 class=" text-white-50 fw-normal h1 mt-5">Agendar Cita</h2>
                        </div>
                        <div>
                            <h5 class="fw-bold text-white">2. Fecha y Hora</h5>
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
                            <h6 class="text-center">1 hora</h6>
                        </div>
                    </div>
                    <div class="col max-h-50 flex-grow-1 overflow-auto">
                        <h5 class="fw-bold py-3">Hora</h5>
                        <input type="text" id="timeInput" name="hora" required class="d-none">
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="1">11:00 a.m</label>
                            <input type="radio" class="d-none" name="1" value="11:00 a.m" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="2">12:00 p.m</label>
                            <input type="radio" class="d-none" name="2" value="12:00 p.m" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="2">12:00 p.m</label>
                            <input type="radio" class="d-none" name="2" value="12:00 p.m" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="2">12:00 p.m</label>
                            <input type="radio" class="d-none" name="2" value="12:00 p.m" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="2">12:00 p.m</label>
                            <input type="radio" class="d-none" name="2" value="12:00 p.m" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="2">12:00 p.m</label>
                            <input type="radio" class="d-none" name="2" value="12:00 p.m" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="2">12:00 p.m</label>
                            <input type="radio" class="d-none" name="2" value="12:00 p.m" onclick="selectTime(this.value, this.name)">
                        </label>
                        <label class="border p-3 my-1 d-block timeSelect text-center">
                            <label for="2">12:00 p.m</label>
                            <input type="radio" class="d-none" name="2" value="12:00 p.m" onclick="selectTime(this.value, this.name)">
                        </label>
                    </div>
                    <div class="col d-flex justify-content-center" onclick="errorSubmit()">
                        <button type="submit"  disabled name="agendar" class="sbmt btn btn-secondary btn-lg text-white fw-bold rounded-pill py-3 w-50 d-md-block d-none">Agendar</button>
                        <button type="submit"  disabled name="agendar2" class="sbmt btn btn-secondary btn-lg text-white fw-bold rounded-pill px-3 d-md-none w-100">Agendar</button>
                    </div>    
                </div>
            </div>
        </section>
    </form>
</main>
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

    

    const errorSubmit = () =>{
        if(!document.getElementById('timeInput').value || !document.getElementById('dateInput').value){
            alert("Debe seleccionar una fecha")
        }
    }
</script>