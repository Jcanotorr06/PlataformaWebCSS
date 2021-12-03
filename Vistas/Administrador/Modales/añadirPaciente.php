<div class="modal" id="añadirPaciente" tabindex="-1" role="dialog">
        <div class="modal-dialog">   
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Añadir Paciente</h4>
              <button type="button" class="btn btn-light" id="cerrar_añadir" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
                <div class="main">
                    <div class="col-xs-6 col-sm-12">
                       <div class="login-form">
                          <form method="post">
                               <div class="row">
                                   <div class="form-group py-2 col-md-6">
                                      <label>Nombre</label>
                                      <input required type="text" name="nombre" class="form-control" placeholder="Nombre">
                                   </div>
                                   <div class="form-group py-2 col-md-6">
                                      <label>Apellido</label>
                                      <input required type="text" name="apellido" class="form-control" placeholder="Apellido">
                                   </div>
                                </div>
                                <div class="form-group py-2">
                                    <label>Correo electrónico</label>
                                    <input required type="email" name="email" class="form-control" placeholder="correo@email.com">
                                </div>
                                <div class="form-group py-2">
                                    <label>Cédula</label>
                                    <input required type="text" class="form-control" name="cedula" placeholder="00-0000-00000">
                                </div>
                                <div class="form-group py-2">
                                    <label>Contraseña</label>
                                    <input required type="password" class="form-control" name="contraseña" placeholder="Contraseña">
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
            $('#añadirPaciente').modal('hide')
        })
    </script>