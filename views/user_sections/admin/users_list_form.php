<div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
  <div class="tab-block">
    <div class="element-list-col">
      <h3>Usuarios</h3>
      <ul id="usuarios-list" class="element-list">
        <?php 
        for($i=0;$i<count($preloaded_data["usuarios"]);$i++){
          ?>
          <li class="element-list-option" id="usuarios-<?php echo $preloaded_data["usuarios"][$i]["id"] ;?>" data-element-info='<?php echo json_encode($preloaded_data['usuarios'][$i]); ?>'><?php echo $preloaded_data["usuarios"][$i]["nombre"] ;?></li>
          <?php
        }
        ?>
      </ul>
    </div>
    <div class="inputs-col">
      <div class="form" id="usuarios-form">
        <h3 data-default-text="Nuevo Usuario" data-editing-text="Modificar Usuario">Nuevo Usuario</h3>
        <input type="hidden" name="element_id">
        <input type="hidden" name="table" value="usuarios">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre-input" class="form-control user-input" name="nombre">
        </div>
        <div class="form-group">
          <label for="apellidos">Apellidos</label>
          <input type="text" id="apellidos-input" class="form-control user-input" name="apellidos">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email-input" class="form-control user-input" name="email">
        </div>
        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input type="tel" id="telefono-input" class="form-control user-input" name="telefono">
        </div>
        <div class="form-group">
          <label for="role">Rol</label>
          <input type="text" id="role-input" class="form-control user-input" name="role">
        </div>
        <div class="input-error"></div>
        <div class="form-group save-group">
          <button class="btn btn-danger delete-form-button hide">Eliminar</button>
          <button class="btn btn-warning reset-form-button">Limpiar</button>
          <button class="btn btn-primary admin-add-or-modify-button">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>