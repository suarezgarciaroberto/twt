$(document).ready(function(){
  // Listeners de botón save de admin
  $(".admin-add-or-modify-button").click(function(event){ 
    adminAddOrModifyData($(event.target).parents(".form"))
  });
  $(".date-client-name").click(function(event){
    event.stopPropagation()
    var form = $(event.target).parents(".tab-block").find(".form");
    var data = $(event.target).parent().data("element-info");
    displayElementInfo(form,data);
  })
});

function adminAddOrModifyData(form){
  if($(form).find("input[name=element_id]").val() != ""){
    var headers = {
      "action": "edit",
      "table": $(form).find("input[name=table]").val(),
      "element-id": $(form).find("input[name=element_id]").val()
    };
  }else{
    var headers = { 
      "action": "add",
      "table": $(form).find("input[name=table]").val()
    };
  }
  if($(form).attr("id") == "proyectos-form"){
    var formData = formDataProjects(form);
  }else if($(form).attr("id") == "citas-form"){
    var formData = formDataAdminDates(form);
  }else{
    var formData = getDataFromInputs(form);
  }
  basicWriteAJAX(headers,formData);
}

function formDataAdminDates(form){
  var formData = getDataFromInputs(form);
  formData["client"] = $(form).find(".client-select").val();
  formData["clientid"] = $(form).find(".client-select").find(":selected").data("client-id");
  formData["lugar"] = $(form).find("input[type=radio]:checked").val();
  return formData;
}

function formDataProjects(form){
  var formData = getDataFromInputs(form);
  var checked = $(form).find("input[type=checkbox]:checked");
  var techs = [];
  $(checked).each(function(i,cb){
    techs.push($(cb).attr("name"))
  });
  formData["tecnologias"] = techs.join("|");
  return formData;
}

function readDataFromDB(form,data){
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
}

function readTechsCheckboxes(form,data){
  var techs = data["tecnologias"].split("|")
  $(techs).each(function(i,techName){
    $(form).find("input[type=checkbox][name="+techName+"]").prop("checked",true)
  })
}