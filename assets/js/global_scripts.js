$(document).ready(function(){
  $("#error-login-alert").hide()
  checkNavLinkActive();
  $("#log-in").click(function(){
    login()
  })
  $("#login-pass").keydown(function(e){
    if(e.keyCode == 13){
      login()
    }
  })
  $("#register-new-user").click(function(){
    registerNewUser()
  })
  $("#log-out").click(function(){
    logout()
  })
  $("#howtogo").click(function(){
    howToGo();
  })
  $(".news-link").click(function(){
    displayNew(this)
  })
  $(".close-notice").click(function(){
    closeNotice()
  })
  $(".alert-close").click(function(){
    location.reload()
  })
})
function checkNavLinkActive(){
  $("#page-nav .nav-link").removeClass("active");
  const url = new URLSearchParams(window.location.search);
  var page = url.get('page');
  if(page == null){
    $("#nav-link-home").addClass("active");
  }else{
    $("#nav-link-"+page).addClass("active");
  }
}

/**
 * Iniciar sesión en el sitio web.
 * 
 * Se comprobará que los campos email y password no estén vacíos.
 */
function login(){
  if($("#login-email").val() != "" && $("#login-pass").val() != ""){
    $.ajax({
      url: "controllers/session_controller.php",
      type: "POST",
      data: {
        "email": $("#login-email").val(),
        "password": $("#login-pass").val()
      },
      headers: { "session-action": "login" },
      success: function(response){
        if(response == 1){
          location.reload()
        }else{
          $("#error-text").text(response)
          $("#error-login-alert").show()
        }
      },
      error: function(error){
        console.log(error)
      }
    })
  }else{
    alert("Los campos de email y/o contraseña no pueden estar vacíos.")
  }
}

/**
 * Cerrar sesión en el sitio web.
 */
function logout(){
  $.ajax({
    url: "controllers/session_controller.php",
    type: "POST",
    headers: { "session-action": "logout" },
    success: function(){
      document.location.href = "index.php";
    }
  })
}

/**
 * Registrar nuevo usuario.
 */
 function registerNewUser(){
  var formData = {}
  $("#newuserform").find(".form-control").each(function(i,input){
    formData[$(input).attr("name")] = $(input).val()
  })
  $.ajax({
    url: "controllers/session_controller.php",
    type: "POST",
    data: formData,
    headers: { "session-action": "register" },
    success: function(response){
      console.log(response)
      if(response == 1 || response == ""){
        location.reload()
      }else{
        $("#error-text").text(response)
        $("#error-login-alert").show()
      }
    },
    error: (error)=>{
      console.log(error)
    }
  })
}

/**
 * Index/home.php
 */
function displayNew(el){
  var id = $(el).data('id')
  $("#whoweare-card").addClass("hide")
  $(".notice-container").addClass("hide")
  $("#notice-"+id).removeClass("hide")
}
function closeNotice(){
  $(".notice-container").addClass("hide")
  $("#whoweare-card").removeClass("hide")
}

/**
 * index/contact.php
 */
 function howToGo(){
  if($("#howtogo").attr("status") == "ruta"){
    if(navigator.geolocation){
      navigator.geolocation.getCurrentPosition(function(position){
        if(position == undefined) {alert("¿Es posible que estés en MacOs y el sistema no tenga habilitada la localización en Google Chrome?")}
        var apiKey = "AIzaSyBa6fFAMxU0zvkFh42UvUgRyaid6JKYjI8" 
        var url = "https://www.google.com/maps/embed/v1/directions?key=" + apiKey + 
        "&origin=" + position.coords.latitude + "," + position.coords.longitude + 
        "&destination=28.4561009,-16.2535407"
        var iframe = "<iframe class='mapiframe' src='"+url+"'></iframe>"
        $('#map').html(iframe)
        $("#howtogo").text("Ver ubicación").attr("status","ubicacion")
      },function (error){
        if(error.code == error.PERMISSION_DENIED){
          alert("Necesitamos que nos permitas saber tu ubicación para mostrarte la ruta hacia nuestro negocio.")
        }
      });
    }else{
      $('#map').html("Geolocation is not supported by this browser.")
    }
  }else{
    var ubication = '<iframe class="mapiframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3507.766719733832!2d-16.254916684701218!3d28.456447798778914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc41cc9f282ed0b9%3A0xcf69b6fcf9ef5f7e!2sAv%20la%20Constituci%C3%B3n%2C%2038003%20Santa%20Cruz%20de%20Tenerife%2C%20Espa%C3%B1a!5e0!3m2!1ses!2sus!4v1610382409567!5m2!1ses!2sus" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>'
    $('#map').html(ubication)
    $("#howtogo").text("Cómo llegar").attr("status","ruta")
  }
}
