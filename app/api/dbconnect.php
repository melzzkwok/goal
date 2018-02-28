<?php
class db{
  private $host = "localhost";
  private $user = "root";
  private $pass = "";
  private $db_name = "goal";

  private $host2 = "localhost";
  private $user2 = "root";
  private $pass2 = "";
  private $db_name2 = "HMS";
  //$mysqli = new mysqli($host, $user, $pass, $db_name);
  public function connect(){
    $mysql_connect_str = "mysql:host=$this->host;db_name=$this->db_name;";
    $dbConnection = new PDO($mysql_connect_str,$this->user,$this->pass);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	return $dbConnection;
  }

  public function connect2(){
    $mysql_connect_str2 = "mysql:host=$this->host2;db_name=$this->db_name2;";
    $dbConnection2 = new PDO($mysql_connect_str2,$this->user2,$this->pass2);
    $dbConnection2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	return $dbConnection2;
  }
}

?>
