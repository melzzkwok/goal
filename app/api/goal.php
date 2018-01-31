<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post("/api/goal/user", function (Request $request, Response $response) {

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
  $goal_unitType = $request->getParam('goal_unitType');
  $goal_frequency = $request->getParam('goal_frequency');
  $goal_priority = $request->getParam('goal_priority');
  $goal_startdate = $request->getParam('goal_startdate');
  $goal_enddate = $request->getParam('goal_enddate');
  $goal_reminder = $request->getParam('goal_reminder');
  $activity_id = $request->getParam('activity_id');
  $user_id = $request->getParam('user_id');


	 $sql = "INSERT INTO goal.goal(goal_description, goal_unit, goal_current_unit, goal_unitType, goal_frequency, goal_priority, goal_startdate, goal_enddate, goal_reminder, goal_complete_pts, goal_complete, activity_id, user_id)
   VALUES (:goal_description, :goal_unit, '0', :goal_unitType, :goal_frequency, :goal_priority, :goal_startdate, :goal_enddate, :goal_reminder, '0', '0', :activity_id, :user_id)";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

 		$stmt->bindParam(':goal_description', $goal_description);
    $stmt->bindParam(':goal_unit', $goal_unit);
    $stmt->bindParam(':goal_unitType', $goal_unitType);
    $stmt->bindParam(':goal_frequency', $goal_frequency);
    $stmt->bindParam(':goal_priority', $goal_priority);
    $stmt->bindParam(':goal_startdate', $goal_startdate);
    $stmt->bindParam(':goal_enddate', $goal_enddate);
    $stmt->bindParam(':goal_reminder', $goal_reminder);
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

$app->put('/api/goal/editgoal', function(Request $request, Response $response){

  $goal_id = $request->getParam('goal_id');
  $goal_description = $request->getParam('goal_description');
  $goal_unit = $request->getParam('goal_unit');
  $goal_unitType = $request->getParam('goal_unitType');
  $goal_frequency = $request->getParam('goal_frequency');
  $goal_priority = $request->getParam('goal_priority');
  $goal_startdate = $request->getParam('goal_startdate');
  $goal_enddate = $request->getParam('goal_enddate');
  $goal_reminder = $request->getParam('goal_reminder');



	 $sql = "UPDATE goal.goal SET
	 goal_description = :goal_description ,
   goal_unit = :goal_unit ,
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
    $stmt->bindParam(':goal_unitType', $goal_unitType);
    $stmt->bindParam(':goal_frequency', $goal_frequency);
    $stmt->bindParam(':goal_priority', $goal_priority);
    $stmt->bindParam(':goal_startdate', $goal_startdate);
    $stmt->bindParam(':goal_enddate', $goal_enddate);
    $stmt->bindParam(':goal_reminder', $goal_reminder);

 		$stmt->execute();

 		echo '"NOTICE":{"text": "goal Updated"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '"error": {"text": '.$e->getMessage().'}';

	 }

});

$app->put('/api/goal/updategoalpoint', function(Request $request, Response $response){

  $goal_id = $request->getParam('goal_id');
  $goal_complete_pts = $request->getParam('goal_complete_pts');
  // $goal_complete_pts_update = ++$goal_complete_pts;



	 $sql = "UPDATE goal.goal SET
	 goal_complete_pts = :goal_complete_pts
   WHERE goal_id = :goal_id";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

    $stmt->bindParam(':goal_id', $goal_id);
    $stmt->bindParam(':goal_complete_pts', $goal_complete_pts);
    // $stmt->bindParam(':goal_complete_pts_update', $goal_complete_pts_update);

 		$stmt->execute();

    echo '"NOTICE":{"text": "goal Updated"}';
 		echo 'goal_complete_pts=',$goal_complete_pts;

	 }
	 catch(PDOException $e)
	 {
	 	echo '"error": {"text": '.$e->getMessage().'}';

	 }

});

$app->put('/api/goal/updategoalcurrentunit', function(Request $request, Response $response){

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
 		echo 'goal_current_unit=',$goal_current_unit;

	 }
	 catch(PDOException $e)
	 {
	 	echo '"error": {"text": '.$e->getMessage().'}';

	 }

});

$app->put('/api/goal/setgoalcompete', function(Request $request, Response $response){

  $goal_id = $request->getParam('goal_id');
  //$goal_current_unit = $request->getParam('goal_current_unit');



	 $sql = "UPDATE goal.goal SET
   goal_complete = '1'
   WHERE goal_id = :goal_id";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

    $stmt->bindParam(':goal_id', $goal_id);
    //$stmt->bindParam(':goal_current_unit', $goal_current_unit);

 		$stmt->execute();

 		echo '"NOTICE":{"text": "goal Updated"}';
    echo 'goal_complete=1';

	 }
	 catch(PDOException $e)
	 {
	 	echo '"error": {"text": '.$e->getMessage().'}';

	 }

});
