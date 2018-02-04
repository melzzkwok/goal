<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/api/categorylist', function() {
  $sql = "SELECT * FROM goal.category_list ORDER BY cat_id";

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
    echo '{"error":'.$e->getMessage().'}';

  }

});

$app->get('/api/categorylist/{id}', function($request) {
  $id = $request->getAttribute('id');
  $sql = "SELECT * FROM goal.category_list WHERE cat_id = '$id'";
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
    echo '{"error":'.$e->getMessage().'}';
  }

});

$app->post('/api/category/add', function(Request $request, Response $response){

	$cat_img = $request->getParam('cat_img');


	 $sql = "INSERT INTO goal.category_list(cat_img)
   VALUES (:cat_img)";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

 		$stmt->bindParam(':cat_img', $cat_img);


 		$stmt->execute();

 		echo '{"NOTICE":"image Added"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error":'.$e->getMessage().'}';

	 }


});
