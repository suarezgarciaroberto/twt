<?php
include_once dirname(__DIR__,1)."/repository/database.php";
class DatesModel{
  private $conn;
  private $columns = "`clientid`,`client`,`asunto`,`fecha`,`lugar`,`hora`";
  private $fixed_hours = ["09:30:00","10:00:00","10:30:00","11:00:00","11:30:00","12:00:00","12:30:00","13:00:00"];

  public function __construct(){
    $db = new Database();
    $this->conn = $db->getConnection();
  }

  // CRUD Operations & Close Connection

  public function getAll(){
    $sql = "SELECT `id`,".$this->columns." FROM `citas` WHERE 1";
    return $this->returnData($sql);
  }

  public function getOne($dateId){
    $sql = "SELECT `id`,".$this->columns." FROM `citas` WHERE `id`=".$dateId;
    return $this->returnData($sql);
  }

  public function getDatesWithClientId($clientId){
    $sql = "SELECT `id`,`asunto`,`fecha`,`lugar`,`hora` FROM `citas` WHERE `clientid`=".$clientId;
    return $this->returnData($sql);
  }

  /**
   * Función para obtener fechas deshabilitadas
   * 
   * Con esta función vamos a recibir todas las fechas
   * almacenadas en la tabla "citas". Una vez las tenemos
   * eliminamos las duplicadas y reindexamos el array.
   * Posteriormente obtendremos las horas almacenadas para
   * cada fecha con el fin de averiguar si están todas las
   * horas ocupadas, lo cual implicará que esa fecha estará
   * deshabilitada.
   * 
   * Si la cantidad de horas que devuelve la función
   * getHoursAssignedToDate($date) es mayor que 7 significará 
   * que todas las horas están asignadas y se agregará esa 
   * fecha al array de las fechas deshabilitadas. Finalmente 
   * devolveremos dicho array.
   * 
   * @access public
   * @return string[]
   * 
   */
  public function getDisabledDates(){
    $sql = "SELECT `fecha` FROM `citas` WHERE 1";
    $all_dates_registers = $this->returnDataFromColumn($sql,"fecha");
    $unique_dates_registers = array_unique($all_dates_registers);
    $unique_dates_registers_without_key = array_values($unique_dates_registers);
    $disabled_dates = array();
    foreach($unique_dates_registers_without_key as $date){
      $hours_counter = $this->getHoursAssignedToDate($date);
      if($hours_counter > 7){
        $disabled_dates[] = $date;
      }
    }
    return $disabled_dates;
  }

  /**
   * Función para obtener las horas disponibles
   * en una fecha concreta.
   * 
   * Con esta función vamos a recibir todas las horas
   * asignadas a una fecha. Posteriormente, para cada hora
   * comprobaremos si existe en el array $fixed_hours donde
   * están almacenadas todas las horas disponibles. En el
   * caso de que no exista una hora en el array $all_hours_from_date
   * agregaremos dicha hora al array $available_hours.
   * 
   * En el caso de que estén todas las horas disponibles la
   * función returnDataFromColumn devolverá NULL, en ese caso se
   * devolverá un array con todas las horas disponibles.
   * Finalmente, eliminaremos los segundos de cada hora para
   * mandar al front la información tal y como se va a mostrar.
   * 
   * @access public
   * @param array $_POST["fecha"]
   * @return string[]
   */
  public function getAvailableHoursByDate($data){
    $sql = "SELECT `hora` FROM `citas` WHERE `fecha` LIKE '".$data["fecha"]."'";
    $all_hours_from_date = $this->returnDataFromColumn($sql,"hora");
    if($all_hours_from_date != null){
      $available_hours = array();
      foreach($this->fixed_hours as $hour){
        if(!in_array($hour,$all_hours_from_date)){
          $available_hours[] = $hour;
        }
      }
    }else{
      $available_hours = $this->fixed_hours;
    }
    foreach($available_hours as &$hour){
      $hour = substr($hour, 0, -3);
    }
    return $available_hours;
  }

  public function addReg($newData){
    $sql = "INSERT INTO `citas` (".$this->columns.") VALUES 
      ('".$newData["clientid"]."',
      '".$newData["client"]."',
      '".$newData["asunto"]."',
      '".$newData["fecha"]."',
      '".$newData["lugar"]."',
      '".$newData["hora"]."')";
    return $this->doAction($sql);
  }

  /**
   * Función para modificar una cita
   * 
   * En primer lugar se hará la comprobación del rol
   * del usuario que trata de modificar la cita ya que
   * los usuarios no administradores tendrán limitaciones
   * en este aspecto.
   * 
   * En el caso de que el usuario sea administrador podrá
   * hacer el cambio que desee sin limitación alguna. Sin
   * embargo, si es un usuario normal, no podrá modificar
   * la cita 72h antes de la misma.
   * 
   * @access public
   * @param int $date_id 
   * @param int $user_id 
   * @param object $newData
   * @return boolean
   * @return string
   */
  public function updateReg($date_id,$user_id,$newData){
    $able_to_modify = $this->checkUserTryingToModify($date_id,$user_id);
    if($able_to_modify){
      $newDataKeys = array_keys($newData);
      $newDataValues = array_values($newData);
      $sql = "UPDATE `citas` SET ";
      for( $i=0; $i<count($newData); $i++ ){ 
        $sql .= "`".$newDataKeys[$i]."`='".$newDataValues[$i]."',";
      }
      $sql = substr_replace($sql, " WHERE `id`=".$date_id, -1);
      return $this->doAction($sql);
    }else{
      return "No se puede modificar la cita 72h antes de la misma.";
    }
  }

  /**
   * Función para comprobar el rol del usuario que
   * trata de modificar una cita
   * 
   * Dado que sólamente el rol de admin puede modificar
   * las citas con un tiempo inferior a 72h, hay que
   * comprobar qué usuario está tratando de modificar
   * la cita.
   * 
   * @access private
   * @param
   * @return boolean
   */
  private function checkUserTryingToModify($date_id,$user_id){
    $sql = "SELECT `role` FROM `usuarios` WHERE `id` LIKE ".$user_id;
    $role = $this->returnDataFromColumn($sql,"role");
    if($role[0] != "admin"){
      $date_info = $this->getOne($date_id);
      $time = $date_info[0]["fecha"]." ".$date_info[0]["hora"];
      return $this->check72h($time);
    }else{
      return true;
    }
  }

  /**
   * Función para comprobar si se puede modificar la cita
   * 
   * Dado que no se pueden modificar las citas 72h antes
   * de la misma, esta función recibe por parámetro la fecha
   * de la cita y la convierte a segundos. Se almacena en
   * una variable la fecha actual y se convierte también a
   * segundos. 
   * 
   * Dado que 72h en segundos son 259200, solo si la diferencia
   * entre la fecha de la cita y la fecha actual es superior
   * a esta cifra se podrá cambiar la cita.
   * 
   * @access private
   * @param string $time
   * @return boolean
   */
  private function check72h($time){
    $date_now_seconds = strtotime(date("Y-m-d H:i:s"));
    $param_time_seconds = strtotime($time);
    if($param_time_seconds - $date_now_seconds > 259200){
      return true;
    }else{
      return false;
    }
  }

  /**
   * Función para borrar una cita
   * 
   * Dado que los usuarios sin privilegios no pueden
   * modificar las citas 72h antes de la misma, también
   * se debe hacer la comprobación del rol del usuario
   * en esta función
   * 
   * @access public
   * @param int $date_id
   * @param int $user_id
   * @return boolean true
   * @return string
   */
  public function deleteReg($date_id,$user_id){
    $able_to_modify = $this->checkUserTryingToModify($date_id,$user_id);
    if($able_to_modify){
      $sql = "DELETE FROM `citas` WHERE `id`=".$date_id;
      return $this->doAction($sql);
    }else{
      return "No se puede modificar ni cancelar la cita 72h antes de la misma.";
    }
  }

  public function closeConn(){
    $this->conn->close();
  }

  // PRIVATE METHODS

  private function returnData($sql){
    $resForController = array();
    $resFromDB = $this->conn->query($sql);
    if($resFromDB->num_rows>0){
      while($row = $resFromDB->fetch_assoc()){
        $resForController[] = $row;
      }
      return $resForController;
    }else{
      // var_dump($resFromDB->error_log);
      return $this->conn->error;
    }
  }

  private function returnDataFromColumn($sql,$column){
    $arr = array();
    $res = $this->conn->query($sql);
    if($res->num_rows>0){
      while($row = $res->fetch_assoc()){
        $arr[] = $row[$column];
      }
      return $arr;
    }
  }

  private function doAction($sql){
    if($this->conn->query($sql)){
      return true;
    }else{
      return $this->conn->error;
    }
  }

  /**
   * Función para contar las horas asignadas a una fecha
   * 
   * @access private
   * @param string $date
   * @return int
   */
  private function getHoursAssignedToDate($date){
    $sql = "SELECT `hora`FROM `citas` WHERE `fecha` LIKE '".$date."'";
    $allDates = $this->returnDataFromColumn($sql,"hora");
    return count($allDates);
  }
}
?>
