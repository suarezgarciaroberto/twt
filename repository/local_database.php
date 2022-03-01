<?php 
class Database {
  private $host = "localhost";
  private $user = "root";
  private $pass = "";
  private $db = "masterdphp";
  
  public $conn;

  public function getConnection(){
    $this->conn = null;
    $this->conn = new mysqli($this->host,$this->user,$this->pass,$this->db);
    if($this->conn->connect_errno){
      echo "algo falla";
    }
    return $this->conn;
  }
}
?>
