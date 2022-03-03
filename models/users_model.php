<?php
include_once dirname(__DIR__,1)."/repository/database.php";
class UsersModel{
  private $conn;
  private $columns = "`nombre`,`apellidos`,`email`,`telefono`,`role`";
  private $columns_p = "`nombre`,`apellidos`,`email`,`password`,`telefono`,`role`";

  public function __construct(){
    $db = new Database();
    $this->conn = $db->getConnection();
  }

  // CRUD Operations & Close Connection

  public function getAll($adminId){
    $sql = "SELECT `id`,".$this->columns." FROM `usuarios` WHERE `id` NOT LIKE ".$adminId;
    return $this->returnData($sql);
  }

  public function getOne($id){
    $sql = "SELECT `id`,".$this->columns." FROM `usuarios` WHERE `id`=".$id;
    return $this->returnData($sql);
  }

  public function getCredentials($email){
    $sql = "SELECT `id`,`email`,`password` FROM `usuarios` WHERE `email` LIKE '".$email."'";
    return $this->returnCredentialData($sql);
  }

  public function addUserFromAdmin($newData){
    $hashed_password = password_hash("password", PASSWORD_DEFAULT);
    $sql = "INSERT INTO `usuarios` (".$this->columns_p.") VALUES 
      ('".$newData["nombre"]."',
      '".$newData["apellidos"]."',
      '".$newData["email"]."',
      '".$hashed_password."',
      '".$newData["telefono"]."',
      'user')";
    return $this->doAction($sql);
  }

  public function addUserFromClient($newData){
    $all_emails = $this->returnAllEmails();
    if(in_array($newData["email"],$all_emails)){
      return "Email already in use!";
    }else{
      if($newData["password"] == $newData["repeat_password"]){
        $hashed_password = password_hash($newData["password"], PASSWORD_DEFAULT);
        $sql = "INSERT INTO `usuarios` (".$this->columns_p.") VALUES 
        ('".$newData["nombre"]."',
        '".$newData["apellidos"]."',
        '".$newData["email"]."',
        '".$hashed_password."',
        '".$newData["telefono"]."',
        'user')";
        return $this->doAction($sql);
      }else{
        return "passwords doesn't match!";
      }
    }
  }

  public function updateReg($id,$newData){
    $newDataKeys = array_keys($newData);
    $newDataValues = array_values($newData);
    $sql = "UPDATE `usuarios` SET ";
    for( $i=0; $i<count($newData); $i++ ){ 
      $sql .= "`".$newDataKeys[$i]."`='".$newDataValues[$i]."',";
    }
    $sql = substr_replace($sql, " WHERE `id`=".$id, -1);
    return $this->doAction($sql);
  }

  public function changePassword($id,$newData){
    $lastPass = $this->returnPassword($id);
    if(password_verify($newData["old_pass"],$lastPass)){
      if($newData["new_pass"] == $newData["repeat_new_pass"]){
        $hashed_password = password_hash($newData["new_pass"], PASSWORD_DEFAULT);
        $changePassSql = "UPDATE usuarios SET `password`='".$hashed_password."' WHERE `id`=".$id; 
        return $this->doAction($changePassSql);
      }else{
        echo "passwords doesn't match!";
      }
    }else{
      echo "wrong password";
    }
  }

  public function stablishPassword($id,$newData){
    if($newData["new_pass"] == $newData["repeat_new_pass"]){
      $hashed_password = password_hash($newData["new_pass"], PASSWORD_DEFAULT);
      $stablishPassSql = "UPDATE usuarios SET `password`='".$hashed_password."' WHERE `id`=".$id; 
      $this->doAction($stablishPassSql);
    }else{
      echo "passwords doesn't match!";
    }
  }

  public function deleteReg($id){
    $sql = "DELETE FROM `usuarios` WHERE `id`=".$id;
    return $this->doAction($sql);
  }

  public function closeConn(){
    $this->conn->close();
  }

  // PRIVATE METHODS

  private function returnData($sql){
    $dataArr = array();
    $resFromDB = $this->conn->query($sql);
    if($resFromDB->num_rows>0){
      while($row = $resFromDB->fetch_assoc()){
        $dataArr[] = $row;
      }
      return $dataArr;
    }else{
      return $this->conn->error;
    }
  }

  private function returnDataFromColumn($sql,$column){
    $dataArr = array();
    $res = $this->conn->query($sql);
    if($res->num_rows>0){
      while($row = $res->fetch_assoc()){
        $dataArr[] = $row[$column];
      }
      return $dataArr;
    }
  }

  private function doAction($sql){
    if($this->conn->query($sql)){
      return true;
    }else{
      return $this->conn->error;
    }
  }

  private function returnCredentialData($sql){
    $dataArr = array();
    $resFromDB = $this->conn->query($sql);
    if($resFromDB->num_rows>0){
      while($row = $resFromDB->fetch_assoc()){
        $dataArr[] = $row;
      }
      return $dataArr;
    }else{
      return $this->conn->error;
    }
  }

  private function returnPassword($id){
    $sql = "SELECT `password` FROM `usuarios` WHERE `id`=".$id;
    $res = $this->conn->query($sql);
    if($res->num_rows>0){
      while($row = $res->fetch_assoc()){
        $pass = $row["password"];
      }
      return $pass;
    }
  }

  private function returnAllEmails(){
    $sql = "SELECT `email` FROM `usuarios` WHERE 1";
    return $this->returnDataFromColumn($sql,"email");
  }
}
?>
