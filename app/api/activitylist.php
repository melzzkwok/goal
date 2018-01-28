<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/api/activitylist', function() {
  $sql = "SELECT * FROM goal.activity_list ORDER BY activity_id";

  try {
   //GET DB OBJECT
   $db = new db();
   //connect
   $db = $db->connect();

   $stmt = $db->query($sql);

   $result = $stmt->fetchAll(PDO::FETCH_OBJ);

   $db = null;

   echo json_encode($result);
  }
  catch(PDOException $e)
  {
   echo '{"error": {"text": '.$e->getMessage().'}';

  }

});

$app->get('/api/activitylist/{id}', function($request) {
  $id = $request->getAttribute('id');
  $sql = "SELECT * FROM goal.activity_list WHERE cat_id = '$id'";

  try {
    //GET DB OBJECT
    $db = new db();
    //connect
    $db = $db->connect();

    $stmt = $db->query($sql);

    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    $db = null;

    echo json_encode($result);
  }
  catch(PDOException $e)
  {
    echo '{"error": {"text": '.$e->getMessage().'}';
  }

});
