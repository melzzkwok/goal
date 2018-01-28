<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/api/test', function(Request $request, Response $response){
  echo "test";
});

//get dummy table
$app->get('/api/dummyall', function(Request $request, Response $response){
	 $sql = "SELECT * FROM goal.dummy ORDER BY dummy_id";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->query($sql);

 		$users = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		echo json_encode($users);
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": {"text": '.$e->getMessage().'}';

	 }

});

//insert dummy table
$app->post('/api/dummy/add', function(Request $request, Response $response){

	//$medicine_id = $request->getParam('medicine_id');
	$dummy_name = $request->getParam('dummy_name');
	$dummy_value = $request->getParam('dummy_value');

	 $sql = "INSERT INTO goal.dummy(dummy_name,dummy_value) VALUES (:dummy_name,:dummy_value)";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

 		//$stmt->bindParam(':medicine_id', $medicine_id);
 		$stmt->bindParam(':dummy_name', $dummy_name);
    $stmt->bindParam(':dummy_value', $dummy_value);

 		$stmt->execute();

 		echo '("NOTICE":{"text": "dummy Added"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": {"text": '.$e->getMessage().'}';

	 }


});

//update dummy table with id param
$app->post('/api/dummy/update/{id}', function(Request $request, Response $response){

	$id = $request->getAttribute('id');

  //$dummy_id = $request->getParam('dummy_id');
	$dummy_name = $request->getParam('dummy_name');
	$dummy_value = $request->getParam('dummy_value');



	 $sql = "UPDATE goal.dummy SET
	 dummy_name = :dummy_name ,
   dummy_value = :dummy_value
   WHERE dummy_id = '$id'";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

    //$stmt->bindParam(':dummy_id', $dummy_id);
 		$stmt->bindParam(':dummy_name', $dummy_name);
    $stmt->bindParam(':dummy_value', $dummy_value);

 		$stmt->execute();

 		echo '("NOTICE":{"text": "dummy Updated"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": {"text": '.$e->getMessage().'}';

	 }

});

//update dummy table with id param
$app->post('/api/dummy/update', function(Request $request, Response $response){

	//$id = $request->getAttribute('id');

  $dummy_id = $request->getParam('dummy_id');
	$dummy_name = $request->getParam('dummy_name');
	$dummy_value = $request->getParam('dummy_value');



	 $sql = "UPDATE goal.dummy SET
	 dummy_name = :dummy_name ,
   dummy_value = :dummy_value
   WHERE dummy_id = :dummy_id";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

    $stmt->bindParam(':dummy_id', $dummy_id);
 		$stmt->bindParam(':dummy_name', $dummy_name);
    $stmt->bindParam(':dummy_value', $dummy_value);

 		$stmt->execute();

 		echo '("NOTICE":{"text": "dummy Updated"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": {"text": '.$e->getMessage().'}';

	 }

});

//delete dummy table with id
$app->delete('/api/dummy/delete/{id}', function(Request $request, Response $response){

	 $id = $request->getAttribute('id');


	 $sql = "DELETE FROM goal.dummy WHERE dummy_id = '$id'";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

 		$stmt->execute();

 		$db = null;

 		echo '{"notice": {"text":"dummy Deleted"}';
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": {"text": '.$e->getMessage().'}';

	 }

});

//delete dummy table with id param
$app->delete('/api/dummy/delete', function(Request $request, Response $response){

	 //$id = $request->getAttribute('id');
   $dummy_id = $request->getParam('dummy_id');

	 $sql = "DELETE FROM goal.dummy WHERE dummy_id = :dummy_id";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);
    $stmt->bindParam(':dummy_id', $dummy_id);

 		$stmt->execute();

 		$db = null;

 		echo '{"notice": {"text":"dummy Deleted"}';
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": {"text": '.$e->getMessage().'}';

	 }

});
