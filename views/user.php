<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){ ?>
<div id="session-data" hidden>
  <input type="hidden" name="user_id" id="user-id" value="<?php echo $_SESSION['id']; ?>">
  <input type="hidden" name="user_name" id="user-name" value="<?php echo $_SESSION['user']; ?>">
  <input type="hidden" name="user_role" id="user-role" value="<?php echo $_SESSION['role']; ?>">
</div>
<?php
  include_once "./controllers/user_controller.php";
  $controller = new UserController();
  $preloaded_data = $controller->loadInitialContent($_SESSION['id'],$_SESSION['role']);
  if($_SESSION['role'] == "admin"){
?>
<div class="container" id="userMainBlock">
  <ul class="nav nav-tabs" id="admin-nav" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="true">Usuarios</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="proyectos-tab" data-toggle="tab" href="#proyectos" role="tab" aria-controls="proyectos" aria-selected="false">Proyectos</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="citas-tab" data-toggle="tab" href="#citas" role="tab" aria-controls="citas" aria-selected="false">Citas</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="noticias-tab" data-toggle="tab" href="#noticias" role="tab" aria-controls="noticias" aria-selected="false">Noticias</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="mis-datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="false">Modificar mis datos</a>
    </li>
  </ul>
  <div class="tab-content" id="admin-tabs-content">
    <?php 
    include_once "user_sections/admin/users_list_form.php";
    include_once "user_sections/admin/projects_list_form.php";
    include_once "user_sections/admin/dates_list_form.php";
    include_once "user_sections/admin/news_list_form.php";
    include_once "user_sections/personal_data.php";
    ?>
  </div>
</div>
<?php }else if($_SESSION['role'] == "user"){ ?>
<div class="container" id="userMainBlock">
  <ul class="nav nav-tabs" id="user-nav" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="citas-tab" data-toggle="tab" href="#citas" role="tab" aria-controls="citas" aria-selected="true">Solicitar Cita</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-selected="false">Modificar mis datos</a>
    </li>
  </ul>
  <div class="tab-content" id="user-tabs-content">
    <?php 
    include_once "user_sections/citas.php";
    include_once "user_sections/personal_data.php";
    ?>
  </div>
</div>
<?php } }else{ ?>
<script>
  window.location.href = "index.php";
</script>
<?php } ?>
