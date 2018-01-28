<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post("/api/goal/user", function (Request $request, Response $response) {
    //$response = new Response();
    $user_id = $request->getParam('user_id');

    $select = "SELECT * FROM goal.goal WHERE user_id = $user_id";

    try {
      //GET DB OBJECT
      $db = new db();
      //connect
      $db = $db->connect();

  		$stmt = $db->query($select);

  		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

  		$db = null;
  		echo json_encode($result);
    }
    catch(PDOException $e)
    {
     echo '"error": {"text": '.$e->getMessage().'}';

    }

    // $db = new db();
 		// //connect
 		// $db = $db->connect();
    //
 		// $stmt = $db->query($select);
    //
 		// $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    //
 		// $db = null;
 		// echo json_encode($result);
    //
 		// if($result){
 		// 	$particular = ["goal_id" => $result[0]->goal_id,
    //    "goal_description" => $result[0]->goal_description,
    //    "goal_unit" => $result[0]->goal_unit,
    //    "goal_current_unit" => $result[0]->goal_current_unit,
    //    "goal_unitType" => $result[0]->goal_unitType,
    //    "goal_frequency" => $result[0]->goal_frequency,
    //    "goal_priority" => $result[0]->goal_priority,
    //    "goal_startdate" => $result[0]->goal_startdate,
    //    "goal_enddate" => $result[0]->goal_enddate,
    //    "goal_reminder" => $result[0]->goal_reminder,
    //    "goal_complete_pts" => $result[0]->goal_complete_pts,
    //    "goal_complete" => $result[0]->goal_complete,
    //    "activity_id" => $result[0]->activity_id,
    //    "user_id" => $result[0]->user_id];
    //         echo json_encode($particular);
 		// }
 		// else {
    //       echo json_encode(["error"]);
    //
    //     }

});

$app->get('/api/goal/user/{id}', function($request) {
  $id = $request->getAttribute('id');
  $sql = "SELECT * FROM goal.goal WHERE user_id = '$id'";

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

$app->post('/api/goal/add', function(Request $request, Response $response){

	$goal_description = $request->getParam('goal_description');
  $goal_unit = $request->getParam('goal_unit');
  $goal_current_unit = $request->getParam('goal_current_unit');
  $goal_unitType = $request->getParam('goal_unitType');
  $goal_frequency = $request->getParam('goal_frequency');
  $goal_priority = $request->getParam('goal_priority');
  $goal_startdate = $request->getParam('goal_startdate');
  $goal_enddate = $request->getParam('goal_enddate');
  $goal_reminder = $request->getParam('goal_reminder');
  $goal_complete_pts = $request->getParam('goal_complete_pts');
  $goal_complete = $request->getParam('goal_complete');
  $activity_id = $request->getParam('activity_id');
  $user_id = $request->getParam('user_id');


	 $sql = "INSERT INTO goal.goal(goal_description, goal_unit, goal_current_unit, goal_unitType, goal_frequency, goal_priority, goal_startdate, goal_enddate, goal_reminder, goal_complete_pts, goal_complete, activity_id, user_id)
   VALUES (:goal_description, :goal_unit, :goal_current_unit, :goal_unitType, :goal_frequency, :goal_priority, :goal_startdate, :goal_enddate, :goal_reminder, :goal_complete_pts, :goal_complete, :activity_id, :user_id)";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

 		$stmt->bindParam(':goal_description', $goal_description);
    $stmt->bindParam(':goal_unit', $goal_unit);
    $stmt->bindParam(':goal_current_unit', $goal_current_unit);
    $stmt->bindParam(':goal_unitType', $goal_unitType);
    $stmt->bindParam(':goal_frequency', $goal_frequency);
    $stmt->bindParam(':goal_priority', $goal_priority);
    $stmt->bindParam(':goal_startdate', $goal_startdate);
    $stmt->bindParam(':goal_enddate', $goal_enddate);
    $stmt->bindParam(':goal_reminder', $goal_reminder);
    $stmt->bindParam(':goal_complete_pts', $goal_complete_pts);
    $stmt->bindParam(':goal_complete', $goal_complete);
    $stmt->bindParam(':activity_id', $activity_id);
    $stmt->bindParam(':user_id', $user_id);


 		$stmt->execute();

 		echo '"NOTICE":{"text": "goal Added"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": {"text": '.$e->getMessage().'}';

	 }


});

$app->post('/api/goal/update', function(Request $request, Response $response){

  $goal_id = $request->getParam('goal_id');
  $goal_description = $request->getParam('goal_description');
  $goal_unit = $request->getParam('goal_unit');
  $goal_current_unit = $request->getParam('goal_current_unit');
  $goal_unitType = $request->getParam('goal_unitType');
  $goal_frequency = $request->getParam('goal_frequency');
  $goal_priority = $request->getParam('goal_priority');
  $goal_startdate = $request->getParam('goal_startdate');
  $goal_enddate = $request->getParam('goal_enddate');
  $goal_reminder = $request->getParam('goal_reminder');



	 $sql = "UPDATE goal.goal SET
	 goal_description = :goal_description ,
   goal_unit = :goal_unit ,
   goal_current_unit = :goal_current_unit ,
   goal_unitType = :goal_unitType ,
   goal_frequency = :goal_frequency ,
   goal_priority = :goal_priority ,
   goal_startdate = :goal_startdate ,
   goal_startdate = :goal_startdate ,
   goal_enddate = :goal_enddate ,
   goal_reminder = :goal_reminder
   WHERE goal_id = :goal_id";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

    $stmt->bindParam(':goal_id', $goal_id);
    $stmt->bindParam(':goal_description', $goal_description);
    $stmt->bindParam(':goal_unit', $goal_unit);
    $stmt->bindParam(':goal_current_unit', $goal_current_unit);
    $stmt->bindParam(':goal_unitType', $goal_unitType);
    $stmt->bindParam(':goal_frequency', $goal_frequency);
    $stmt->bindParam(':goal_priority', $goal_priority);
    $stmt->bindParam(':goal_startdate', $goal_startdate);
    $stmt->bindParam(':goal_enddate', $goal_enddate);
    $stmt->bindParam(':goal_reminder', $goal_reminder);
    // $stmt->bindParam(':goal_complete_pts', $goal_complete_pts);
    // $stmt->bindParam(':goal_complete', $goal_complete);
    // $stmt->bindParam(':activity_id', $activity_id);
    // $stmt->bindParam(':user_id', $user_id);

 		$stmt->execute();

 		echo '"NOTICE":{"text": "goal Updated"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '"error": {"text": '.$e->getMessage().'}';

	 }

});

$app->post('/api/goal/updategoalcurrentunit', function(Request $request, Response $response){

  $goal_id = $request->getParam('goal_id');
  $goal_current_unit = $request->getParam('goal_current_unit');



	 $sql = "UPDATE goal.goal SET
   goal_current_unit = :goal_current_unit
   WHERE goal_id = :goal_id";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

    $stmt->bindParam(':goal_id', $goal_id);
    $stmt->bindParam(':goal_current_unit', $goal_current_unit);

 		$stmt->execute();

 		echo '"NOTICE":{"text": "goal Updated"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '"error": {"text": '.$e->getMessage().'}';

	 }

});
