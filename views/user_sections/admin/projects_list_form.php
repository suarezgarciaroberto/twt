<div class="tab-pane fade" id="proyectos" role="tabpanel" aria-labelledby="proyectos-tab">
  <div class="tab-block">
    <div class="element-list-col">
      <h3>Proyectos</h3>
      <ul id="proyectos-list" class="element-list">
      <?php 
        for($i=0;$i<count($preloaded_data["proyectos"]);$i++){
          ?>
          <li class="element-list-option" id="proyectos-<?php echo $preloaded_data["proyectos"][$i]["id"] ;?>" data-element-info='<?php echo json_encode($preloaded_data['proyectos'][$i]); ?>'><?php echo $preloaded_data["proyectos"][$i]["titulo"] ;?></li>
          <?php
        }
        ?>
      </ul>
    </div>
    <div class="inputs-col">
      <div class="form" id="proyectos-form">
        <h3 data-default-text="Nuevo Proyecto" data-editing-text="Modificar Proyecto">Nuevo Proyecto</h3>
        <input type="hidden" name="element_id">
        <input type="hidden" name="table" value="proyectos">
        <div class="form-group" id="titulo-group">
          <label for="titulo">Título</label>
          <input type="text" id="titulo-input" class="form-control projects-input" name="titulo">
        </div>
        <div class="form-group" id="descripcion-group">
          <label for="descripcion">Descripción</label>
          <textarea id="project-descripcion-input" class="form-control projects-input" name="descripcion"></textarea>
        </div>
        <div class="form-group">
          <label for="tecnologias" id="tecnologias-group">Tecnologías</label>
          <div class="techs-container" id="tecnologias-container">
            <div class="checkbox-group">
              <input type="checkbox" name="android" id="tech-android" class="tech-checkbox">
              <label for="tech-android"><i class="fab fa-android"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="css3" id="tech-css3" class="tech-checkbox">
              <label for="tech-css3"><i class="fab fa-css3-alt"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="github" id="tech-github" class="tech-checkbox">
              <label for="tech-github"><i class="fab fa-github"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="html5" id="tech-html5" class="tech-checkbox">
              <label for="tech-html5"><i class="fab fa-html5"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="apple" id="tech-apple" class="tech-checkbox">
              <label for="tech-apple"><i class="fab fa-apple"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="java" id="tech-java" class="tech-checkbox">
              <label for="tech-java"><i class="fab fa-java"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="js" id="tech-js" class="tech-checkbox">
              <label for="tech-js"><i class="fab fa-js-square"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="node" id="tech-node" class="tech-checkbox">
              <label for="tech-node"><i class="fab fa-node-js"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="php" id="tech-php" class="tech-checkbox">
              <label for="tech-php"><i class="fab fa-php"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="python" id="tech-python" class="tech-checkbox">
              <label for="tech-python"><i class="fab fa-python"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="react" id="tech-react" class="tech-checkbox">
              <label for="tech-react"><i class="fab fa-react"></i></label>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" name="wordpress" id="tech-wordpress" class="tech-checkbox">
              <label for="tech-wordpress"><i class="fab fa-wordpress"></i></label>
            </div>
          </div>
        </div>
        <div class="form-group" id="tiempo-group">
          <label for="tiempo">Tiempo</label>
          <input type="text" id="tiempo-input" class="form-control projects-input" name="tiempo">
        </div>
        <div class="input-error"></div>
        <div class="form-group save-group" id="proyectos-save-group">
          <button class="btn btn-danger delete-form-button hide">Eliminar</button>
          <button class="btn btn-warning reset-form-button">Limpiar</button>
          <button class="btn btn-primary admin-add-or-modify-button">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>