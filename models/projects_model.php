<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/twt/repository/database.php";
class ProjectsModel{
  private $conn;
  private $columns = "`titulo`,`descripcion`,`tecnologias`,`tiempo`";

  public function __construct(){
    $db = new Database();
    $this->conn = $db->getConnection();
  }

  // CRUD Operations & Close Connection

  public function getAll(){
    $sql = "SELECT `id`,".$this->columns." FROM `proyectos` WHERE 1";
    return $this->returnData($sql);
  }

  public function getOne($id){
    $sql = "SELECT `id`,".$this->columns." FROM `proyectos` WHERE `id`=".$id;
    return $this->returnData($sql);
  }

  public function addReg($newData){
    $sql = "INSERT INTO `proyectos` (".$this->columns.") VALUES 
      ('".$newData["titulo"]."',
      '".$newData["descripcion"]."',
      '".$newData["tecnologias"]."',
      '".$newData["tiempo"]."')";
    return $this->doAction($sql);
  }

  public function updateReg($id,$newData){
    $newDataKeys = array_keys($newData);
    $newDataValues = array_values($newData);
    $sql = "UPDATE `proyectos` SET ";
    for( $i=0; $i<count($newData); $i++ ){ 
      $sql .= "`".$newDataKeys[$i]."`='".$newDataValues[$i]."',";
    }
    $sql = substr_replace($sql, " WHERE `id`=".$id, -1);
    return $this->doAction($sql);
  }

  public function deleteReg($id){
    $sql = "DELETE FROM `proyectos` WHERE `id`=".$id;
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
