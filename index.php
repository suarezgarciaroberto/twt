<?php 
  include_once "controllers/index_controller.php";
  $index_controller = new IndexController();
  session_start();
  if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
    $logged = true;
    $role = $_SESSION['role'];
  }else{
    $logged = false;
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TWT</title>
  <link rel="icon" type="image/svg+xml" href="./assets/images/logo.svg">
  <link rel="stylesheet" href="assets/css/styles.css">
<?php if($logged == true && $role == "admin"){ ?>
  <link rel="stylesheet" href="assets/css/user_styles.css">
  <link rel="stylesheet" href="assets/css/admin_styles.css">
<?php }else if($logged == true && $role = "user"){ ?>
  <link rel="stylesheet" href="assets/css/user_styles.css">
<?php } ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="assets/js/jquery_ui/jquery-ui.js"></script>
  <script src="assets/js/global_scripts.js"></script>
<?php if($logged == true && $role == "admin"){ ?>
  <script src="assets/js/user_scripts.js"></script>
  <script src="assets/js/admin_scripts.js"></script>
<?php }else if($logged == true && $role = "user"){ ?>
  <script src="assets/js/user_scripts.js"></script>
<?php } ?>
</head>
<body>
  <nav id="page-nav" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a id="logo-img" class="navbar-brand" href="?page=home"><img src="./assets/images/logo.svg" id="logo" alt="logo">The Worker Tree</a>
    <button class="navbar-toggler" id="nav-collapse-button" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" id="nav-link-home" href="?page=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="nav-link-projects" href="?page=projects">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="nav-link-contact" href="?page=contact">Contact</a>
        </li>
<?php if($logged == true){ ?>
        <li class="nav-item">
          <a class="nav-link" id="nav-link-user" href="?page=user"><?php echo $_SESSION["user"]; ?></a>
        </li>
      </ul>
      <span>
        <button class="btn btn-dark float-right" id="log-out">Cerrar sesión</button>
      </span>
<?php }else{ ?>
      </ul>
      <span>
        <div class="dropdown dropleft">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="login-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>
          <div class="dropdown-menu p-2" id="login-form">
            <div class="form-group">
              <label for="Email">Email address</label>
              <input type="email" class="form-control" id="login-email" name="usuario" placeholder="email@example.com">
            </div>
            <div class="form-group">
              <label for="Password">Password</label>
              <input type="password" class="form-control" id="login-pass" name="password" placeholder="Password">
            </div>
            <div class="form-group form-group-inline">
              <button class="btn btn-outline-success my-2 my-sm-0" id="log-in">Iniciar Sesión</button>
              <a href="?page=register" class="btn btn-outline-primary my-2 my-sm-0" id="register-link">Registrarme</a>
            </div>
          </div>
        </div>
      </span>
<?php } ?>
    </div>
  </nav>
  <div class="container-fluid" id="indexMainBlock">
    <div class="alert alert-danger alert-dismissible fade show" id="error-login-alert" role="alert">
      <span id="error-text"></span>
      <button type="button" class="close alert-close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
<?php 
  $page = isset($_GET['page']) ? $_GET['page'] : "home";
  if($page == "home"){
    $data = $index_controller->getNews();
  }else if($page == "projects"){
    $data = $index_controller->getProjects();
  }
  include_once "./views/".$page.".php";
?>
  </div>
  <footer class="footer bg-dark" id="footer-div">
    <div class="container">
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a href="#" class="nav-link">Aviso Legal</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Política de Privacidad</a>
        </li>
      </ul>
      <div id="copyR">
        <span>Copyright &copy; 2021 The Worker Tree</span>
      </div>
    </div>
  </footer>
</body>
</html>
