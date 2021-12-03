<div class="modal" id="añadirClinica" tabindex="-1" role="dialog">
        <div class="modal-dialog">   
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Añadir Clinica</h4>
              <button type="button" class="btn btn-light" id="cerrar_añadir" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
                <div class="main">
                    <div class="col-xs-6 col-sm-12">
                       <div class="login-form">
                          <form method="post">
                                <div class="form-group py-2">
                                    <label>Nombre de la Clinica</label>
                                    <input required type="text" name="clinica" class="form-control" placeholder="Nombre de la Clinica">
                                </div>
                                <div class="form-group py-2">
                                    <label>Provincia</label>
                                   <select required class="form-control" id="añadirProvincia" name="provincia" onchange="activarDistritos(this.value)">
                                       <option value="" disabled selected hidden>Provincia</option>
                                       <?php 
                                            foreach($provincias as $provincia){
                                                echo '<option value="'.$provincia['id'].'">'.$provincia['provincia'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group py-2">
                                    <label>Distrito</label>
                                   <select required disabled class="form-control" id="añadirDistrito" name="distrito" onchange="activarCorregimientos(this.value)">
                                       <option value="" disabled selected hidden>Distrito</option>
                                       <?php 
                                            foreach($distritos as $distrito){
                                                echo '<option value="'.$distrito['id'].'" data-provincia="'.$distrito['id_provincia'].'">'.$distrito['distrito'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group py-2">
                                   <label>Corregimiento</label>
                                   <select required disabled class="form-control" id="añadirCorregimiento" name="corregimiento">
                                       <option value="" disabled selected hidden>Corregimiento</option>
                                       <?php 
                                            foreach($corregimientos as $corregimiento){
                                                echo '<option value="'.$corregimiento['id'].'" data-distrito="'.$corregimiento['id_distrito'].'">'.$corregimiento['corregimiento'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group py-3">
                                    <button type="submit" name="añadir" class="btn btn-dark">Añadir</button>
                                </div>
                          </form>
                       </div>
                    </div>
                </div>
            </div>

          </div>
          
        </div>
    </div>

    <script>
        $('#cerrar_añadir').click(() => {
            $('#añadirClinica').modal('hide')
        })

        //Se ejecuta cada vez que se selecciona una opcion del campo provincia
        //Toma como parametro el id de la provincia seleccionada
        const activarDistritos = (id_provincia)=>{

        //En estos bloques se "reinician" los siguientes campos para indicar el camnbio de provincia
            document.getElementById('añadirDistrito').disabled = false;
            document.getElementById('añadirDistrito').selectedIndex = 0;

            document.getElementById('añadirCorregimiento').disabled = true;
            document.getElementById('añadirCorregimiento').selectedIndex = 0;

            //Se inicializa un arreglo con los distritos y se itera a travez de este
            let distritos = Array.from(document.getElementById('añadirDistrito').getElementsByTagName('option'))
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
            document.getElementById('añadirCorregimiento').disabled = false;
            document.getElementById('añadirCorregimiento').selectedIndex = 0;


            //Se inicializa un arreglo con los corregimientos y se itera a travez de este
            let corregimientos = Array.from(document.getElementById('añadirCorregimiento').getElementsByTagName('option'))
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
    </script>