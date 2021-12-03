<div class="modal" id="editarEspecialidad" tabindex="-1" role="dialog">
        <div class="modal-dialog">   
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Especialidad</h4>
              <button type="button" class="btn btn-light" id="cerrar_editar" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
                <div class="main">
                    <div class="col-xs-6 col-sm-12">
                       <div class="login-form">
                          <form method="post">
                              <input type="hidden" name="id" id="editar_id">
                                <div class="form-group py-2">
                                    <label>Especialidad</label>
                                    <input required type="text" class="form-control" name="especialidad" placeholder="Especialidad" id="editar_especialidad">
                                </div>
                                <div class="form-group py-3">
                                    <button type="submit" name="editar" class="btn btn-dark">Añadir</button>
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
        $('#cerrar_editar').click(() => {
            $('#editarEspecialidad').modal('hide')
        })
    </script>