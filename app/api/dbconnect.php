<?php
class db{
  private $host = "localhost";
  private $user = "root";
  private $pass = "root";
  private $db_name = "goal";
  //$mysqli = new mysqli($host, $user, $pass, $db_name);
  public function connect(){
    $mysql_connect_str = "mysql:host=$this->host;db_name=$this->db_name;";
    $dbConnection = new PDO($mysql_connect_str,$this->user,$this->pass);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	return $dbConnection;
  }
}

?>
