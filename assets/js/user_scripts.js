/**
 * Todas las peticiones AJAX deben llevar los
 * headers 'user-id' y 'user-role' por defecto
 */
$.ajaxSetup({
  beforeSend: function(xhr){
     xhr.setRequestHeader("user-id",$("#user-id").val());
     xhr.setRequestHeader("user-role",$("#user-role").val());
  }
});

/**
 * Funciones y Listeners que deben cargar al inicio
 */
$(document).ready(function(){
  getDisabledDatesForDatePicker();
  
  // Mostrar de nuevo el datePicker tras seleccionar una fecha
  $("#form-fecha").click(function(){
    $("#calendario").toggle("collapse")
  })

  $(".element-list-option").click(function(event){
    var form = $(event.target).parents(".tab-block").find(".form");
    var data = $(event.target).data("element-info");
    displayElementInfo(form,data);
  });

  // Listeners de citas
  $(".user-add-or-modify-button").click(function(event){ 
    userAddOrModifyData($(event.target).parents(".form"))
  });
  $(".reset-form-button").click(function(event){ 
    cleanForm($(event.target).parents(".form"));
  });
  $(".delete-form-button").click(function(event){ 
    deleteReg($(event.target).parents(".form"));
  });
});

// GENERAL FUNCTIONS

// Obtener las fechas que no están disponibles
function getDisabledDatesForDatePicker(){
  $.ajax({
    url: "controllers/user_controller.php",
    type: "GET",
    headers: { 
      "action": "getDisabledDates" 
    },
    success: (data)=>{
      createDatePicker(data)
    },
    error: (error)=>{
      console.log(error)
    }
  })
}

// Crea el calendario con las fechas disponibles
function createDatePicker(disabled_days){
  $('#date-Picker').datepicker({
    minDate: new Date(),
    maxDate: "+1Y",
    dateFormat: "yy-mm-dd",
    firstDay: 1,
    monthNames: ['Enero', 'Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    dayNamesMin: ['D','L','M','X','J','V','S'],
    onSelect: (date)=>{
      $('#form-fecha').val(date)
      $("#calendario").toggle("collapse")
      getAvailableHours(date)
    },
    beforeShowDay: function(date){
      var day = date.getDay();
      var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
      var isDisabled = (disabled_days.indexOf(string)) != -1;
      return [day != 0 && day != 6 && !isDisabled];
    }
  })
}

// Mostrar la información de las citas en el formulario
function displayElementInfo(form,data){
  cleanForm(form);
  $(form).find("input[name=element_id]").val(data["id"]);
  $(form).find(".form-control").each(function(i,input){
    $(input).val(data[$(input).attr("name")]);
  });
  if($(form).attr("id") == "proyectos-form"){
    readTechsCheckboxes(form,data);
  }
  if($(form).attr("id") == "citas-form"){
    $(form).find("input[type=radio][value="+data["lugar"]+"]").prop("checked",true);
    getAvailableHours(data["fecha"],data["hora"].slice(0,-3));
  }
  switchTexts(form,"editing");
  $(form).find(".delete-form-button").removeClass("hide");
}

// Añade al select las horas disponibles para el día seleccionado
function getAvailableHours(date,selectedHour){
  $.ajax({
    url: "controllers/user_controller.php",
    type: "POST",
    data: {"fecha": date },
    headers: { 
      "action": "getDisabledHours" 
    },
    success: (data)=>{
      var hoursArr = JSON.parse(data)
      $(".hour-select").empty()
      if(selectedHour){
        hoursArr.push(selectedHour)
        hoursArr.sort()
        addOptions(hoursArr,selectedHour)
      }else{
        addOptions(hoursArr)
      }
    }
  })
}

// añadir opciones al select
function addOptions(hoursArr,selectedHour){
  if(selectedHour){
    hoursArr.forEach(function(opt){
      if(opt == selectedHour){
        $(".hour-select").append('<option value="'+opt+'" selected="true">'+opt+'</option>')
      }else{
        $(".hour-select").append('<option value="'+opt+'">'+opt+'</option>')
      }
    })
  }else{
    $(".hour-select").append('<option id="default-option" value="" disabled="disabled" selected="true">---</option>')
    hoursArr.forEach(function(opt){
      $(".hour-select").append('<option value="'+opt+'">'+opt+'</option>')
    })
  }
}

// READ, WRITE AND DELETE FUNCTIONS

/**
 * Escribir o modificar datos en la DB
 * 
 * Lógica de los headers y formData:
 * - Si existe un input[name=user_action]:
 *    El usuario está cambiando sus datos o la contraseña
 *    formData recoge todos los inputs del formulario
 * - Si existe un input[name=element_id]:
 *    El usuario está modificando una cita
 *    formData debe agregar el nombre del cliente y el lugar
 * - Si no existe el input[name=user_action] y
 * el valor del input[name=element_id] está vacío:
 *    El usuario está solicitando una nueva cita
 *    formData debe agregar el nombre del cliente y el lugar
 */
 function userAddOrModifyData(form){
  var userAction = $(form).find("input[name=user_action]").val();
  var elementId = $(form).find("input[name=element_id]").val();
  if(userAction != "" && userAction != undefined){
    var headers = { "action": userAction };
    var formData = getDataFromInputs(form);
  }else{
    if(elementId != "" && elementId != undefined){
      var headers = {
        "action": "modifyDate",
        "date-id": elementId
      }
      var formData = formDataUserDates(form);
    }else{
      var headers = { "action": "addDate" };
      var formData = formDataUserDates(form);
      formData["clientid"] = $("#user-id").val();
    }
  }
  basicWriteAJAX(headers,formData,form);
}

function getDataFromInputs(form){
  var formData = {};
  $(form).find(".form-control").each(function(i,input){
    formData[$(input).attr("name")] = $(input).val();
  });
  return formData;
}

function formDataUserDates(form){
  var formData = getDataFromInputs(form);
  formData["client"] = $("#user-name").val();
  formData["lugar"] = $(form).find("input[type=radio]:checked").val();
  return formData;
}

function basicWriteAJAX(headers,formData,form){
  $.ajax({
    url: "controllers/user_controller.php",
    type: "POST",
    data: formData,
    headers: headers,
    success: (data)=>{
      if(data == 1 || data == true){
        location.reload();
      }else{
        $(form).find(".input-error").text(data)
      }
    }
  });
}

// Limpiar cualquier formulario
function cleanForm(form){
  $(form).find("input[name=element_id]").val("");
  $(form).find(".form-control").each(function(i,input){
    $(input).val("");
  });
  $(form).find("input[type=checkbox],input[type=radio]").each(function(i,input){
    $(input).prop("checked",false);
  });
  if($(form).attr("id") == "citas-form"){
    $(form).find(".hour-select").empty();
  }
  $(".delete-form-button").addClass("hide");
  switchTexts(form,"default");
}

// Borrar un registro en la DB
function deleteReg(form){
  $.ajax({
    url: "controllers/user_controller.php",
    type: "GET",
    headers: {
      "table": $(form).find("input[name=table]").val(),
      "element-id": $(form).find("input[name=element_id]").val(),
      "action": "deleteReg" 
    },
    success: (data)=>{
      if(data == 1){
        location.reload()
      }else{
        console.log(data)
      }
    }
  })
}


function switchTexts(form,mode){
  var h3 = $(form).find("h3")
  var saveBtn = $(form).find(".user-add-or-modify-button")
  if(mode == "default"){
    $(h3).text($(h3).data("default-text"))
    $(saveBtn).text($(saveBtn).data("default-text"))
  }else if(mode == "editing"){
    $(h3).text($(h3).data("editing-text"))
    $(saveBtn).text($(saveBtn).data("editing-text"))
  }
}
