<div class="modal" id="eliminarClinica" tabindex="-1" role="dialog" aria-labelledby="eliminarClinica" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-body">
            <h4 class="text-center">¿Esta seguro que desea eliminar esta clinica?</h4>
        </div>
        <div class="modal-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 header2">
                        <form method="post" class=" d-inline-block">
                            <input type="hidden" name="id" id="eliminarId">
                            <button class="btn btn-dark mr-5 opciones" type="submit" name="eliminar">Sí</button>
                        </form>
                        <button class="btn btn-dark opciones" data-dismiss="modal" id="cerrar_eliminar">No</button>
                    </div>   
                </div>    
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    $('#cerrar_eliminar').click(()=>{
        $('#eliminarClinica').modal('toggle');
    })
</script>