<div class="tab-pane fade" id="citas" role="tabpanel" aria-labelledby="citas-tab">
  <div class="tab-block">
    <div class="element-list-col">
      <h3>Citas</h3>
      <ul id="citas-list" class="element-list">
      <?php
        if(gettype($preloaded_data['citas']) == "array"){
          for($i=0;$i<count($preloaded_data["citas"]);$i++){
            ?>
            <li class="element-list-option" id="citas-<?php echo $preloaded_data["citas"][$i]["id"] ;?>" data-element-info='<?php echo json_encode($preloaded_data['citas'][$i]); ?>'><?php echo $preloaded_data["citas"][$i]["asunto"] ;?> | <span class="date-client-name"><?php echo $preloaded_data["citas"][$i]["client"] ;?></span></li>
            <?php
          }
        }else{
          ?>
          <li class="element-list-option no-element-list">No hay citas programadas</li>
          <?php
        }
        ?>
      </ul>
    </div>
    <div class="inputs-col">
      <div class="form" id="citas-form">
        <h3 data-default-text="Nueva Cita" data-editing-text="Modificar Cita">Nueva Cita</h3>
        <input type="hidden" name="element_id">
        <input type="hidden" name="table" value="citas">
        <div class="form-group">
          <label for="cliente">Cliente</label>
          <select name="client" class="form-control client-select">
            <option id="default-client-option" value="" disabled="disabled" selected="true">---</option>
            <?php 
            for($i=0;$i<count($preloaded_data["usuarios"]);$i++){
              ?>
              <option value="<?php echo $preloaded_data['usuarios'][$i]['nombre']; ?>" data-client-id="<?php echo $preloaded_data['usuarios'][$i]['id']; ?>"><?php echo $preloaded_data['usuarios'][$i]['nombre']; ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="asunto">Asunto</label>
          <input type="text" id="asunto-input" class="form-control projects-input" name="asunto">
        </div>
        <div class="form-group">
          <label>Fecha</label>
          <input class="datePicker form-control" id="form-fecha" type="text" name="fecha" data-toggle="collapse" data-target="#calendario" aria-haspopup="true" aria-expanded="false" placeholder="Click para desplegar calendario" readonly>
          <div class="collapse mt-2" id="calendario">
            <div id="date-Picker"></div>
          </div>
        </div>
        <div class="form-group">
          <label>Hora</label>
          <select name="hora" class="form-control hour-select"></select>
        </div>
        <div class="form-group">
          <label class="d-block">Lugar de la cita</label>
          <div class="radios-container">
            <div class="radio-group">
              <input class="" type="radio" name="lugar" id="telematica" value="telematica" >
              <label class="" for="date-3">Telemática</label>
            </div>
            <div class="radio-group">
              <input class="" type="radio" name="lugar" id="oficina" value="oficina" >
              <label class="" for="date-3">Presencial</label>
            </div>
          </div>
        </div>
        <div class="input-error"></div>
        <div class="save-group">
          <button class="btn btn-danger delete-form-button hide">Eliminar</button>
          <button class="btn btn-warning reset-form-button">Limpiar</button>
          <button class="btn btn-primary admin-add-or-modify-button">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>