<?php 
class Database {
  // JAWS_DB
  // private $host = "spryrr1myu6oalwl.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
  // private $user = "mnocy6yjwekgtlh6";
  // private $pass = "sf8qj292v0ayafbu";
  // private $db = "hqc4r8e6uym9fwa6";
  
  // CLEAR_DB
  private $host = "eu-cdbr-west-02.cleardb.net";
  private $user = "b2ef7e7e5364f6";
  private $pass = "927608cc";
  private $db = "heroku_33ec3d5d2fffe7e";
  
  
  public $conn;

  public function getConnection(){
    $this->conn = null;
    $this->conn = new mysqli($this->host,$this->user,$this->pass,$this->db);
    if($this->conn->connect_errno){
      echo "An error occurred while trying to connect to the database.";
    }
    return $this->conn;
  }
}
?>
