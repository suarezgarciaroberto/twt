<div class="tab-pane fade" id="noticias" role="tabpanel" aria-labelledby="noticias-tab">
  <div class="tab-block">
    <div class="element-list-col">
      <h3>Noticias</h3>
      <ul id="noticias-list" class="element-list">
      <?php 
        for($i=0;$i<count($preloaded_data["noticias"]);$i++){
          ?>
          <li class="element-list-option" id="noticias-<?php echo $preloaded_data["noticias"][$i]["id"] ;?>" data-element-info='<?php echo json_encode($preloaded_data['noticias'][$i]); ?>'><?php echo $preloaded_data["noticias"][$i]["titular"] ;?></li>
          <?php
        }
        ?>
      </ul>
    </div>
    <div class="inputs-col">
      <div class="form" id="noticias-form">
        <h3 data-default-text="Nueva Noticia" data-editing-text="Modificar Noticia">Nueva Noticia</h3>
        <input type="hidden" name="element_id">
        <input type="hidden" name="table" value="noticias">
        <div class="form-group" id="titular-group">
          <label for="titular">Titular</label>
          <input type="text" id="titular-input" class="form-control projects-input" name="titular">
        </div>
        <div class="form-group" id="fecha-group">
          <label for="fecha">Fecha</label>
          <input type="text" id="fecha-input" class="form-control projects-input" name="fecha">
        </div>
        <div class="form-group" id="resumen-group">
          <label for="resumen">Resumen</label>
          <textarea id="resumen-input" class="form-control projects-input" name="resumen"></textarea>
        </div>
        <div class="form-group" id="contenido-group">
          <label for="contenido">Contenido</label>
          <textarea id="contenido-input" class="form-control projects-input" name="contenido"></textarea>
        </div>
        <div class="input-error"></div>
        <div class="form-group save-group" id="noticias-save-group">
          <button class="btn btn-danger delete-form-button hide">Eliminar</button>
          <button class="btn btn-warning reset-form-button">Limpiar</button>
          <button class="btn btn-primary admin-add-or-modify-button">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>