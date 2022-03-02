<?php
include_once dirname(__DIR__,1)."/repository/database.php";
class NewsModel{
  private $conn;
  private $columns = "`titular`,`resumen`,`contenido`,`fecha`";

  public function __construct(){
    $db = new Database();
    $this->conn = $db->getConnection();
  }

  // CRUD Operations & Close Connection

  public function getAll(){
    $sql = "SELECT `id`,".$this->columns." FROM `noticias` WHERE 1";
    return $this->returnData($sql);
  }

  /**
   * Obtener una noticia por id
   * 
   * description
   * 
   * @access public
   * @param int $id
   * @return string[]
   * 
   */
  public function getOne($id){
    $sql = "SELECT `id`,".$this->columns." FROM `noticias` WHERE `id`=".$id;
    return $this->returnData($sql);
  }

  // Funcion para añadir un registro
  public function addReg($newData){    
    $sql = "INSERT INTO `noticias` (".$this->columns.") VALUES 
      ('".$newData["titular"]."',
      '".$newData["resumen"]."',
      '".$newData["contenido"]."',
      '".$newData["fecha"]."')";
    return $this->doAction($sql);
  }

  public function updateReg($id,$newData){
    $newDataKeys = array_keys($newData);
    $newDataValues = array_values($newData);
    $sql = "UPDATE `noticias` SET ";
    for( $i=0; $i<count($newData); $i++ ){ 
      $sql .= "`".$newDataKeys[$i]."`='".$newDataValues[$i]."',";
    }
    $sql = substr_replace($sql, " WHERE `id`=".$id, -1);
    return $this->doAction($sql);
  }

  public function deleteReg($id){
    $sql = "DELETE FROM `noticias` WHERE `id`=".$id;
    return $this->doAction($sql);
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
      return $resFromDB->error_log;
    }
  }

  private function doAction($sql){
    if($this->conn->query($sql)){
      return true;
    }else{
      return $this->conn->error;
    }
  }
}
?>
