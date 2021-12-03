<div class="modal" id="añadirEspecialidad" tabindex="-1" role="dialog">
        <div class="modal-dialog">   
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Añadir Especialidad</h4>
              <button type="button" class="btn btn-light" id="cerrar_añadir" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
                <div class="main">
                    <div class="col-xs-6 col-sm-12">
                       <div class="login-form">
                          <form method="post">
                                <div class="form-group py-2">
                                    <label>Especialidad</label>
                                    <input required type="text" class="form-control" name="especialidad" placeholder="Especialidad">
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
            $('#añadirEspecialidad').modal('hide')
        })
    </script>