<?php
include_once dirname(__DIR__,1)."/models/news_model.php";
include_once dirname(__DIR__,1)."/models/projects_model.php";
include_once dirname(__DIR__,1)."/models/users_model.php";
include_once dirname(__DIR__,1)."/models/dates_model.php";

if(isset($_REQUEST)){
  if(isset($_SERVER['HTTP_USER_ID']) && isset($_SERVER['HTTP_USER_ROLE'])){
    $controller = new UserController();
    if($_SERVER['HTTP_USER_ROLE'] == "admin"){
      if(!isset($_SERVER['HTTP_TABLE']) && isset($_SERVER['HTTP_ACTION'])){
        $controller->adminActionHandler("citas",$_SERVER['HTTP_ACTION']);
      }else if(isset($_SERVER['HTTP_TABLE']) && isset($_SERVER['HTTP_ACTION'])){
        $controller->adminActionHandler($_SERVER['HTTP_TABLE'],$_SERVER['HTTP_ACTION']);
      }else if(!isset($_SERVER['HTTP_TABLE'])){ 
        echo "Missing Table";
      }else if(!isset($_SERVER['HTTP_ACTION'])){ 
        echo "Missing Admin Action"; 
      }
    }else if($_SERVER['HTTP_USER_ROLE'] == "user"){
      if(isset($_SERVER['HTTP_ACTION'])){
        $controller->userActionHandler($_SERVER['HTTP_ACTION']);
      }else{
        echo "Missing User Action";
      }
    }
  }
}

class UserController{
  private $news;
  private $projects;
  private $users;
  private $dates;

  public function __construct(){
    $this->news = new NewsModel();
    $this->projects = new ProjectsModel();
    $this->users = new UsersModel();
    $this->dates = new DatesModel();
  }
  
  /**
   * Función para ejecutar acciones de Administrador
   * 
   * Dado que el administrador podrá hacer acciones en
   * todas las tablas, y en cada una de ellas las acciones
   * serán muy parecidas, se hará uso de dos switch para
   * determinar la tabla y la acción que se hace en cada
   * caso.
   * 
   * @access public
   * @param string $table
   * @param string $action
   * @return boolean|array
   * 
   */
  public function adminActionHandler($table,$action){
    $model;
    switch ($table) {
      case 'proyectos':
        $model = $this->projects;
        break;
      case 'usuarios':
        $model = $this->users;
        break;
      case 'citas':
        $model = $this->dates;
        break;
      case 'noticias':
        $model = $this->news;
        break;
      default:
        echo "Table not found";
        break;
    }
    switch ($action) {
      case 'getDisabledDates':
        $dates_given = $this->dates->getDisabledDates();
        if($dates_given != null){
          echo json_encode($dates_given);        
        }else{
          echo "No hay citas programadas.";
        }
        break;
      case 'getDisabledHours':
        echo json_encode($this->dates->getAvailableHoursByDate($_POST));
        break;
      case 'add':
        if($table != "usuarios"){
          echo $model->addReg($_POST);
        }else{
          echo $model->addUserFromAdmin($_POST);
        }
        break;
      case 'edit':
        if($table == "citas"){
          echo $model->updateReg($_SERVER['HTTP_ELEMENT_ID'],$_SERVER['HTTP_USER_ID'],$_POST);
        }else{
          echo $model->updateReg($_SERVER['HTTP_ELEMENT_ID'],$_POST);
        }
        break;
      case 'deleteReg':
        if($table == "citas"){
          echo $model->deleteReg($_SERVER['HTTP_ELEMENT_ID'],$_SERVER['HTTP_USER_ID']);
        }else{
          echo $model->deleteReg($_SERVER['HTTP_ELEMENT_ID']);
        }
        break;
      case 'getAll':
        echo $model->getAll();
        break;
      default:
        echo "Invalid Admin Action";
        break;
    }
  }

  /**
   * Función para ejecutar acciones de Usuario
   * 
   * Como los usuarios sólamente podrán manipular dos
   * tablas, basta con saber qué acción está haciendo
   * el usuario para determinar el método y el modelo
   * al que se debe llamar por medio de un switch.
   * 
   * @access public
   * @param string $action
   * @return boolean|array
   * 
   */
  public function userActionHandler($action){
    switch ($action) {
      case 'getDisabledDates':
        echo json_encode($this->dates->getDisabledDates());
        break;
      case 'getDisabledHours':
        echo json_encode($this->dates->getAvailableHoursByDate($_POST));
        break;
      case 'addDate':
        echo $this->dates->addReg($_POST);
        break;
      case 'getDateInfo':
        echo json_encode($this->dates->getOne($_SERVER['HTTP_DATE_ID']));
        break;
      case 'modifyDate':
        echo $this->dates->updateReg($_SERVER['HTTP_DATE_ID'],$_SERVER['HTTP_USER_ID'],$_POST);
        break;
      case 'deleteReg':
        echo $this->dates->deleteReg($_SERVER['HTTP_ELEMENT_ID'],$_SERVER['HTTP_USER_ID']);
        break;
      case 'changePersonalData':
        echo $this->users->updateReg($_SERVER['HTTP_USER_ID'],$_POST);
        break;
      case 'changePassword':
        echo $this->users->changePassword($_SERVER['HTTP_USER_ID'],$_POST);
        break;
      default:
        echo "Invalid User Action";
        break;
    }
  }

  /**
   * Función para cargar el contenido inicial
   * que necesitará cada usuario según su rol.
   * 
   * En el caso de ser administrador va a necesitar
   * tener cargados los datos de todas las tablas.
   * Si es un usuario común sólo necesitará sus datos
   * personales y las citas asignadas a su id.
   * 
   * @access public
   * @param int $user_id
   * @param string $role
   * @return array[]
   * 
   */
  public function loadInitialContent($user_id,$role){
    if($role == "admin"){
      $initial_content = array(
        'noticias' => $this->news->getAll(),
        'proyectos' => $this->projects->getAll(),
        'citas' => $this->dates->getAll(),
        'usuarios' => $this->users->getAll()
      );
    }else if($role == "user"){
      $initial_content = array(
        'user_data' => $this->users->getOne($user_id),
        'user_dates' => $this->dates->getDatesWithClientId($user_id)
      );
    }
    return $initial_content;
  }

}

?>
