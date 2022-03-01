<div class="tab-pane fade show active" id="citas" role="tabpanel" aria-labelledby="citas-tab">
  <div class="tab-block">
    <div class="element-list-col">
      <h3>Mis Citas</h3>
      <ul class="element-list" id="current-user-dates">
        <?php
          if(gettype($preloaded_data['user_dates']) == "array"){
            for($i=0;$i<count($preloaded_data['user_dates']);$i++){
              ?>
              <li class="element-list-option" id="cita-<?php echo $preloaded_data['user_dates'][$i]["id"]; ?>" data-element-info='<?php echo json_encode($preloaded_data['user_dates'][$i]); ?>'><?php echo $preloaded_data['user_dates'][$i]["asunto"]; ?></li>
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
          <label><b>Asunto</b></label>
          <small>(máx. 150 caracteres)</small>
          <input type="text" name="asunto" class="form-control" id="form-asunto">
        </div>
        <div class="form-group">
          <label><b>Fecha</b></label>
          <small>(Horario de atención: L a V de 9:30 a 13:00h)</small>
          <input class="datePicker form-control" id="form-fecha" type="text" name="fecha" data-toggle="collapse" data-target="#calendario" aria-haspopup="true" aria-expanded="false" placeholder="Click para desplegar calendario" readonly>
          <div class="collapse mt-2" id="calendario">
            <div id="date-Picker"></div>
          </div>
        </div>
        <div class="form-group">
          <label><b>Hora</b></label>
          <select name="hora" class="form-control hour-select" id="hora-select"></select>
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
          <button class="btn btn-danger delete-form-button hide">Cancelar Cita</button>
          <button class="btn btn-warning reset-form-button">Limpiar</button>
          <button class="btn btn-primary user-add-or-modify-button" data-default-text="Solicitar" data-editing-text="Modificar">Solicitar</button>
        </div>
        <small id="user-dates-advice">Sólo se podrán modificar los datos de la cita hasta 72h antes de la misma.</small>
      </div>
    </div>
    
  </div>
</div>
