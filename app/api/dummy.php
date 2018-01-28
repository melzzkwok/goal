<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$app->get('/api/dummy', function() {
  require_once('dbconnect.php');
  $query = "select * from dummy order by dummy_id";
  $result = $mysqli->query($query);

  while($row = $result->fetch_assoc()) {
    $data[] = $row;
  }

  if (isset($data)) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }

});

$app->get('/api/dummy/{id}', function($request) {
  require_once('dbconnect.php');
  $id = $request->getAttribute('id');
  $query = "SELECT * from dummy WHERE dummy_id = $id";
  $result = $mysqli->query($query);

  $data[] = $result->fetch_assoc();

  header('Content-Type: application/json');
  echo json_encode($data);

});

//post data and create a new record
$app->post('/api/dummy', function($request) {

  require_once('dbconnect.php');
  $query = "INSERT INTO `dummy` (`dummy_id`, `dummy_name`, `dummy_value`) VALUES (NULL, ?, ?)";
  $stmt =  $mysqli->prepare($query);
  $stmt->bind_param("ss", $a, $b);

  $a = $request->getParsedBody()['dummy_name'];
  $b = $request->getParsedBody()['dummy_value'];


  $stmt->execute();

});

//update a record on the database
$app->put('/api/dummy/{id}', function($request) {

  require_once('dbconnect.php');
  $id = $request->getAttribute('id');
  $query = "UPDATE `dummy` SET 'dummy_name' = ?, `dummy_value` = ? WHERE 'dummy'.'dummy_id' = $id";
  $stmt =  $mysqli->prepare($query);
  $stmt->bind_param("ss", $a, $b);

  $a = $request->getParsedBody()['dummy_name'];
  $b = $request->getParsedBody()['dummy_value'];


  $stmt->execute();

});
