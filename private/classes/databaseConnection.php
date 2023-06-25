<?php 

class db{

  private $database_host = "dbhost.cs.man.ac.uk";
  private $database_user = "v52665lm";
  private $database_pass = "22886464BAa+";
  private $database_name = "2022_comp10120_z12";

  // private $database_host = "localhost";
  // private $database_user = "root";
  // private $database_pass = "root";
  // private $database_name = "testforproject";

public function connectdb()
{
try {
    $pdo = new pdo("mysql:dbname=$this->database_name;host=$this->database_host", $this->database_user, $this->database_pass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  } 
  catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}
}

?>