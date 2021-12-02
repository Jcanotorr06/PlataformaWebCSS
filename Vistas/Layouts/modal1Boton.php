<!-- Boton que ejecuta el modal de error -->
<button type="button" id="modal_trigger" class="d-none" data-bs-toggle="modal" data-bs-target="#modalError">
  Mostrar Modal
</button>

<!-- Modal -->
<div class="modal fade" id="modalError" tabindex="-1" aria-labelledby="labelModalError" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-lg-5 p-3">
      <div class="modal-body d-flex text-center flex-column justify-content-center align-items-center">
       
        <?php if(isset($mensaje_error)): ?><!-- Si hay un mensaje de error se muestra un boton rojo -->
            <h5><?php echo $mensaje_error?></h5>
            <button type="button" class="btn btn-lg btn-danger rounded-pill py-lg-2 px-lg-5" data-bs-dismiss="modal">Aceptar</button>
        
            <?php elseif(isset($mensaje_exito)): ?><!-- Si hay un mensaje de exito se muestra un boton verde -->
            <h5><?php echo $mensaje_exito?></h5>
            <button type="button" class="btn btn-lg btn-success rounded-pill py-lg-2 px-lg-5" data-bs-dismiss="modal">Aceptar</button>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById('modal_trigger').click();//Simula un clic al boton #modal_trigger para mostrar el modal al cargar la pagina
</script>