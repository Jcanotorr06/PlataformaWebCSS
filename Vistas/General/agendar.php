<head>
    <title>Agendar Cita | Plataforma Web Css</title>
</head>
<?php
    if(isset($this->test)):
?>
    Agendar 2
    <?php echo $this->test->nombre?>
<?php else:?>
    <main class="min-h-100 container-lg d-flex flex-column align-items-center justify-content-start flex-grow-1 py-3">
        <h2 class=" text-black-50 fw-normal h1 mt-5">Agendar Cita</h2>
        <h5 class="fw-bold">1. Detalles de la Cita</h5>
        <form method="post" class="container w-100 d-flex flex-column align-items-center justify-content-center min-h-100">
            <?php echo '<input type="hidden" name="id_usuario" value="'.$_SESSION['id'].'">'?>
            <div class="row g-md-5 g-4 mb-3 justify-content-between">


                <div class="col-sm-3 form-floating p-0">
                    <select name="provincia" id="provincia" required type="text" class="form-select w-100" placeholder="Provincia" onchange="activarDistritos(this.value)">
                        <option value="" disabled selected hidden>Provincia</option>
                        <?php 
                            foreach($provincias as $provincia){
                                echo '<option value="'.$provincia['id'].'">'.$provincia['provincia'].'</option>';
                            }
                        ?>
                        </select>
                    <label>Provincia</label>
                </div>


                <div class="col-sm-3 form-floating p-0">
                    <select name="distrito" id="distrito" required type="text" class="form-select w-100" disabled placeholder="Distrito" onchange="activarCorregimientos(this.value)">
                        <option value="" disabled selected hidden>Distrito</option>
                        <?php 
                            foreach($distritos as $distrito){
                                echo '<option value="'.$distrito['id'].'" data-provincia="'.$distrito['id_provincia'].'">'.$distrito['distrito'].'</option>';
                            }
                        ?>
                    </select>
                    <label>Distrito</label>
                </div>


                <div class="col-sm-3 form-floating p-0">
                    <select name="corregimiento" id="corregimiento" required type="text" class="form-select w-100" disabled placeholder="Corregimiento" onchange="activarClinicas(this.value)">
                        <option value="" disabled selected hidden>Corregimiento</option>
                        <?php 
                            foreach($corregimientos as $corregimiento){
                                echo '<option value="'.$corregimiento['id'].'" data-distrito="'.$corregimiento['id_distrito'].'">'.$corregimiento['corregimiento'].'</option>';
                            }
                        ?>
                    </select>
                    <label>Corregimiento</label>
                </div>


                <div class="col-12 form-floating p-0">
                    <select name="clinica" id="clinica" required type="text" class="form-select w-100" disabled placeholder="Clinica" onchange="activarEspecialidades(this.value)">
                        <option value="" disabled selected hidden>Clinica</option>
                        <?php 
                            foreach($clinicas as $clinica){
                                echo '<option value="'.$clinica['id'].'" data-corregimiento="'.$clinica['id_corregimiento'].'">'.$clinica['clinica'].'</option>';
                            }
                        ?>
                    </select>
                    <label>Clinica</label>
                </div>


                <div class="col-sm-5 form-floating p-0">
                    <select name="especialidad" id="especialidad" required type="text" class="form-select w-100" disabled placeholder="Especialidad" onchange="activarMedicos(this.value)">
                        <option value="" disabled selected hidden>Especialidad</option>
                        <?php 
                            foreach($especialidades as $especialidad){
                                echo '<option value="'.$especialidad['id'].'" data-clinica="'.$especialidad['id_clinica'].'">'.$especialidad['especialidad'].'</option>';
                            }
                        ?>
                    </select>
                    <label>Especialidad</label>
                </div>


                <div class="col-sm-5 form-floating p-0">
                    <select name="medico" id="medico" required type="text" class="form-select w-100" disabled placeholder="Medico">
                        <option value="" disabled selected hidden>Medico</option>
                        <?php 
                            foreach($medicos as $medico){
                                echo '<option value="'.$medico['id'].'" data-clinica="'.$medico['id_clinica'].'" data-especialidad="'.$medico['id_especialidad'].'">'.$medico['nombre'].'</option>';
                            }
                        ?>
                    </select>
                    <label>Medico</label>
                </div>
            </div>


            <button type="submit" name="siguiente" class="btn px-3 px-lg-5 py-lg-3 btn-lg btn-primary text-white rounded-pill my-3">Siguiente</button>
            
        </form>
    </main>
    <script>

        //Al cargar la pagina se verifica si el campo provincia tiene un valor seleccionado
        //Si es el caso, se ejecuta la funcion activarDistritos
        window.addEventListener('load', () => {
            if(id_provincia = document.getElementById('provincia').value){
                activarDistritos(id_provincia)
            }
        })

        //Se ejecuta cada vez que se selecciona una opcion del campo provincia
        //Toma como parametro el id de la provincia seleccionada
        const activarDistritos = (id_provincia)=>{

            //En estos bloques se "reinician" los siguientes campos para indicar el camnbio de provincia
            document.getElementById('distrito').disabled = false;
            document.getElementById('distrito').selectedIndex = 0;

            document.getElementById('corregimiento').disabled = true;
            document.getElementById('corregimiento').selectedIndex = 0;

            document.getElementById('clinica').disabled = true;
            document.getElementById('clinica').selectedIndex = 0;

            document.getElementById('especialidad').disabled = true;
            document.getElementById('especialidad').selectedIndex = 0;

            document.getElementById('medico').disabled = true;
            document.getElementById('medico').selectedIndex = 0;

            //Se inicializa un arreglo con los distritos y se itera a travez de este
            let distritos = Array.from(document.getElementById('distrito').getElementsByTagName('option'))
            distritos.map(distrito => {
                //Si el id de la provincia seleccionada es igual al id de la provincia a la que pertenece el distrito...
                //...se desactivan los atributos hidden y disabled para ese distrito 
                if(id_provincia !== distrito.dataset.provincia){
                    distrito.disabled = true
                    distrito.hidden = true
                }else{
                    distrito.disabled = false
                    distrito.hidden = false
                }
            })
        }

        //Se ejecuta cada vez que se selecciona una opcion del campo distrito
        //Toma como parametro el id del distrito seleccionada
        const activarCorregimientos = (id_distrito)=>{

            //En estos bloques se "reinician" los siguientes campos para indicar el camnbio de distrito
            document.getElementById('corregimiento').disabled = false;
            document.getElementById('corregimiento').selectedIndex = 0;

            document.getElementById('clinica').disabled = true;
            document.getElementById('clinica').selectedIndex = 0;

            document.getElementById('especialidad').disabled = true;
            document.getElementById('especialidad').selectedIndex = 0;

            document.getElementById('medico').disabled = true;
            document.getElementById('medico').selectedIndex = 0;

             //Se inicializa un arreglo con los corregimientos y se itera a travez de este
            let corregimientos = Array.from(document.getElementById('corregimiento').getElementsByTagName('option'))
            corregimientos.map(corregimiento => {
                //Si el id del distrito9 seleccionada es igual al id del distrito9 a la que pertenece el corregimiento...
                //...se desactivan los atributos hidden y disabled para ese corregimiento
                if(id_distrito !== corregimiento.dataset.distrito){
                    corregimiento.disabled = true
                    corregimiento.hidden = true
                }else{
                    corregimiento.disabled = false
                    corregimiento.hidden = false
                }
            })
        }

        //Se ejecuta cada vez que se selecciona una opcion del campo corregimiento
        //Toma como parametro el id del corregimiento seleccionada
        const activarClinicas = (id_corregimiento)=>{

            //En estos bloques se "reinician" los siguientes campos para indicar el camnbio de corregimiento
            document.getElementById('clinica').disabled = false;
            document.getElementById('clinica').selectedIndex = 0;

            document.getElementById('especialidad').disabled = true;
            document.getElementById('especialidad').selectedIndex = 0;

            document.getElementById('medico').disabled = true;
            document.getElementById('medico').selectedIndex = 0;

             //Se inicializa un arreglo con los corregimientos y se itera a travez de este
            let clinicas = Array.from(document.getElementById('clinica').getElementsByTagName('option'))
            clinicas.map(clinica => {
                //Si el id del corregimiento seleccionado es igual al id del corregimiento al que pertenece la clinica...
                //...se desactivan los atributos hidden y disabled para esa clinica
                if(id_corregimiento !== clinica.dataset.corregimiento){
                    clinica.disabled = true
                    clinica.hidden = true
                }else{
                    clinica.disabled = false
                    clinica.hidden = false
                }
            })
        }

        //Se ejecuta cada vez que se selecciona una opcion del campo clinica
        //Toma como parametro el id de la clinica seleccionada         
        const activarEspecialidades = (id_clinica)=>{

            //En estos bloques se "reinician" los siguientes campos para indicar el camnbio de clinica   
            document.getElementById('especialidad').disabled = false;
            document.getElementById('especialidad').selectedIndex = 0;

            document.getElementById('medico').disabled = true;
            document.getElementById('medico').selectedIndex = 0;

            //Se inicializa un arreglo con las especialidades y se itera a travez de este
            let especialidades = Array.from(document.getElementById('especialidad').getElementsByTagName('option'))
            especialidades.map(especialidad => {
                //Si el id de la clinica seleccionada es igual al id de la clinica en la que existen medicos con la especialidad...
                //...se desactivan los atributos hidden y disabled para esa especialidad
                if(id_clinica !== especialidad.dataset.clinica){
                    especialidad.disabled = true
                    especialidad.hidden = true
                }else{
                    especialidad.disabled = false
                    especialidad.hidden = false
                }
            })
        }

        
        //Se ejecuta cada vez que se selecciona una opcion del campo medico
        //Toma como parametro el id de la especialidad seleccionada         
        const activarMedicos = (id_especialidad)=>{

            //Se activa el campo medico
            document.getElementById('medico').disabled = false;

            id_clinica = document.getElementById('clinica').value
            
            //Se inicializa un arreglo con medicos y se itera a travez de este
            let medicos = Array.from(document.getElementById('medico').getElementsByTagName('option'))
            medicos.map(medico => {
                //Si los id de la clinica y la especialidad corresponden a los id de clinica y especialidad del medico
                //...se desactivan los atributos hidden y disabled para ese medico
                if(id_clinica !== medico.dataset.clinica || id_especialidad !== medico.dataset.especialidad){
                    medico.disabled = true
                    medico.hidden = true
                }else{
                    medico.disabled = false
                    medico.hidden = false
                }
            })
        }
    </script>
<?php endif?>
