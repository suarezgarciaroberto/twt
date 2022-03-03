<?php 
class Database {
  
  private $database = null;
  private $hostname = null;
  private $username = null;
  private $password = null;
  
  public $conn;

  function __construct() {
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');
  }
  
  public function getConnection(){
    $this->conn = null;
    $this->conn = new mysqli($this->hostname,$this->username,$this->password,$this->database);
    if($this->conn->connect_errno){
      echo "An error occurred while trying to connect to the database.";
    }
    return $this->conn;
  }
}
?>
