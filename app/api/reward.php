<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/api/reward/rewardall', function(Request $request, Response $response){
	 $sql = "SELECT * FROM goal.goal_reward ORDER BY reward_id";

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

// display all rewards user have unlocked
$app->post('/api/reward/userreward', function(Request $request, Response $response){

  $user_id = $request->getParam('user_id');

  $sql = "SELECT * FROM goal.goal_reward WHERE user_id = '$user_id'";

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
   echo '"error": {"text": '.$e->getMessage().'}';

  }

});
