<?php 
class Database {
  
  // private $database = null;
  // private $hostname = null;
  // private $username = null;
  // private $password = null;
  
  public $conn;

  // function __construct() {
  //   $url = getenv('JAWSDB_URL');
  //   $dbparts = parse_url($url);
  //   $hostname = $dbparts['host'];
  //   $username = $dbparts['user'];
  //   $password = $dbparts['pass'];
  //   $database = ltrim($dbparts['path'],'/');
  // }
  
  public function getConnection(){
    $this->conn = null;
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');
    $this->conn = new mysqli($hostname,$username,$password,$database);
    if($this->conn->connect_error){
      echo getenv('JAWSDB_URL');
      echo "An error occurred while trying to connect to the database.";
    }
    return $this->conn;
  }
}
?>
