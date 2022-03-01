<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-5">
      <div class="card">
        <div class="card-body">
        <h2 class="card-title"><u>Nuevo Usuario</u></h2>
          <div id="newuserform">
            <div class="form-group">
              <label for="Nombre">Nombre</label>
              <input type="text" name="nombre" class="form-control" id="form-nombre">
            </div>
            <div class="form-group">
              <label for="Apellidos">Apellidos</label>
              <input type="text" name="apellidos" class="form-control" id="form-apellidos">
            </div>
            <div class="form-group">
              <label for="Telefono">Telefono</label>
              <input type="text" name="telefono" class="form-control" id="form-telefono">
            </div>
            <div class="form-group">
              <label for="Email">Email</label>
              <input type="email" name="email" class="form-control" id="form-email">
            </div>
            <div class="form-group">
              <label for="Password">Contraseña</label>
              <input type="password" name="password" class="form-control" id="form-password">
            </div>
            <div class="form-group">
              <label for="RepeatPassword">Repetir contraseña</label>
              <input type="password" name="repeat_password" class="form-control" id="form-repeat-password">
            </div>
            <div class="form-check mt-2">
              <input class="form-check-input" type="checkbox" value="" id="privacyPolicyCheckbox" required>
              <label class="form-check-label" for="privacypolicycheckbox">
                He leído y estoy conforme con la <a href="" id="priv-pol">Política de privacidad</a>
              </label>
            </div>
            <button id="register-new-user" class="btn btn-primary">Registrarse</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
