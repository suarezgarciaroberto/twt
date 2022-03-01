<div class="tab-pane fade" id="datos" role="tabpanel" aria-labelledby="datos-tab">
  <div class="tab-block double-input-col">
    <div class="input-col">
      <div class="form" id="editUserDetailForm">
        <h3 class="data-section">Editar Datos Personales</h3>
        <input type="hidden" name="user_action" value="changePersonalData">
        <div class="form-group">
          <label for="Nombre"><b>Nombre</b></label>
          <input type="text" name="nombre" class="form-control" id="edit-nombre" value="<?php echo $preloaded_data['user_data'][0]['nombre']; ?>">
        </div>
        <div class="form-group">
          <label for="Apellidos"><b>Apellidos</b></label>
          <input type="text" name="apellidos" class="form-control" id="edit-apellidos" value="<?php echo $preloaded_data['user_data'][0]['apellidos']; ?>">
        </div>
        <div class="form-group">
          <label for="Telefono"><b>Telefono</b></label>
          <input type="text" name="telefono" class="form-control" id="edit-telefono" value="<?php echo $preloaded_data['user_data'][0]['telefono']; ?>">
        </div>
        <div class="input-error"></div>
        <button class="btn btn-primary user-add-or-modify-button" type="button">Guardar</button>
      </div>
    </div>
    <div class="input-col">
      <div class="form" id="editUserMainDataForm">
        <h3 class="data-section">Cambiar Contraseña</h3>
        <input type="hidden" name="user_action" value="changePassword">
        <div class="form-group">
          <label for="Telefono"><b>Contraseña actual</b></label>
          <input type="password" name="old_pass" class="form-control" id="edit-old-pass">
        </div>
        <div class="form-group">
          <label for="Telefono"><b>Contraseña nueva</b></label>
          <input type="password" name="new_pass" class="form-control" id="edit-new-pass">
        </div>
        <div class="form-group">
          <label for="Email"><b>Repetir Contraseña</b></label>
          <input type="password" name="repeat_new_pass" class="form-control" id="repeat-new-pass">
        </div>
        <div class="input-error"></div>
        <button class="btn btn-primary user-add-or-modify-button" type="button">Guardar</button>
      </div>
    </div>
  </div>
</div>