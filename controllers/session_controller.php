<?php 
include_once dirname(__DIR__,1)."/repository/database.php";
include_once dirname(__DIR__,1)."/models/users_model.php";

if(isset($_SERVER['HTTP_SESSION_ACTION'])){
  $session_controller = new SessionController();
  if($_SERVER['HTTP_SESSION_ACTION'] == "register"){
    $session_controller->register($_POST);
  }else if($_SERVER['HTTP_SESSION_ACTION'] == "login"){
    $session_controller->handleLogin($_POST['email'],$_POST['password']);
  }else if($_SERVER['HTTP_SESSION_ACTION'] == "logout"){
    $session_controller->logout();
  }
}

class SessionController{
  private $users;

  public function __construct(){
    $this->users = new UsersModel();
  }
  
  public function register($newData){
    $registration_attempt = $this->users->addUserFromClient($newData);
    if($registration_attempt != 1){
      echo $registration_attempt;
    }else{
      $credentials = $this->users->getCredentials($newData['email']);
      $this->loginSuccess($credentials[0]['id']);
    }
  }

  public function handleLogin($email,$pass){
    $credentials = $this->users->getCredentials($email);
    if(gettype($credentials) == "array"){
      $storagedPass = $credentials[0]['password'];
      if(password_verify($pass, $storagedPass)){
        $this->loginSuccess($credentials[0]['id']);
        echo true;
      }else{
        echo "Wrong password";
      }
    }else{
      echo "Email not found";
    }
  }
  
  public function logout(){
    session_start();
    session_destroy();
    $_SESSION = array();
    $_SESSION['logged'] = false;
  }
  
  private function loginSuccess($user_id){
    session_start();
    $userData = $this->users->getOne($user_id);
    $_SESSION['logged'] = true;
    $_SESSION['id'] = $userData[0]['id'];
    $_SESSION['user'] = $userData[0]['nombre'];
    $_SESSION['role'] = $userData[0]['role'];
  }
}

?>
