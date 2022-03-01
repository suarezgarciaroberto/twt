<?php 
class Database {
  private $host = "spryrr1myu6oalwl.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
  private $user = "mnocy6yjwekgtlh6";
  private $pass = "sf8qj292v0ayafbu";
  private $db = "hqc4r8e6uym9fwa6";
  
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
