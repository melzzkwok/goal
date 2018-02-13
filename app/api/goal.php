<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//display current goal in progress
$app->post("/api/goal/user", function (Request $request, Response $response) {

    $user_id = $request->getParam('user_id');

    $select = "SELECT goal.goal_id, goal.goal_description, goal.goal_unit, goal.goal_current_unit, goal.goal_unitType, goal.goal_frequency, goal.goal_priority, goal.goal_startdate, goal.goal_enddate, goal.goal_reminder, goal.goal_complete_pts, goal.goal_complete, goal.activity_id, activity_list.activity_name, goal.user_id
    FROM goal.goal JOIN goal.activity_list WHERE goal.user_id = $user_id AND goal.activity_id = activity_list.activity_id AND goal.goal_complete = '0'";

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
     echo '{"error":'.$e->getMessage().'}';

    }

});

//display completed goal from history
$app->post("/api/goal/userhistory", function (Request $request, Response $response) {

    $user_id = $request->getParam('user_id');

    $select = "SELECT * FROM goal.goal WHERE user_id = $user_id AND goal_complete = '1'";

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
     echo '{"error":'.$e->getMessage().'}';

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
    echo '{"error":'.$e->getMessage().'}';
  }

});

//add goal
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
    $last_id = $db->lastInsertId();

 		echo '{"goal_id":';
    echo json_encode ($last_id);
    echo '}';

	 }
	 catch(PDOException $e)
	 {
	 	 echo '{"error":'.$e->getMessage().'}';

	 }

});

//display the goal to be edit with the values
$app->post("/api/goal/goaltoedit", function (Request $request, Response $response) {

    $goal_id = $request->getParam('goal_id');

    $select = "SELECT * FROM goal.goal WHERE goal_id = $goal_id";

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
     echo '{"error":'.$e->getMessage().'}';

    }

});

//update the edited goal values
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

 		echo '{"NOTICE":"goal Updated"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error":'.$e->getMessage().'}';

	 }

});

$app->delete('/api/goal/deletegoal', function(Request $request, Response $response){

   $user_id = $request->getParam('user_id');
   $goal_id = $request->getParam('goal_id');

   $sql1 = "SELECT * FROM goal.goal WHERE user_id = $user_id AND goal_id = $goal_id";
	 $sql2 = "DELETE FROM goal.goal WHERE user_id = :user_id AND goal_id = :goal_id";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

    $stmt1 = $db->query($sql1);
    $count1 = $stmt1->rowCount();

    if ($count1 == null){
      echo '{"error":"no result"}';
    }

    else {
      $stmt2 = $db->prepare($sql2);

      $stmt2->bindParam(':user_id', $user_id);
      $stmt2->bindParam(':goal_id', $goal_id);

      $stmt2->execute();
      echo '{"notice":"Goal Deleted"}';
    }

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error":'.$e->getMessage().'}';

	 }

});

//award user when goal is acheived with goal complete point and add the value into user's total reward point
$app->post("/api/goal/updategoalpoint", function (Request $request, Response $response) {

    $goal_id = $request->getParam('goal_id');
    $goal_complete_pts = $request->getParam('goal_complete_pts');

    $select = "SELECT goal.goal_id, goal.user_id, goal.goal_complete_pts, user.rewardpoint_total
    FROM goal.goal JOIN goal.user WHERE goal.user_id = user.user_id AND goal.goal_id = $goal_id";

    try {
      //GET DB OBJECT
      $db = new db();
      //connect
      $db = $db->connect();

  		$stmt = $db->query($select);

  		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

      if ($result == null){
        echo '{"error":"no result"}';
      }
      else {
        $rewardpoint_total = $result[0]->rewardpoint_total;
        $rewardpoint_total = $rewardpoint_total + $goal_complete_pts;

        $sql = "UPDATE goal.goal JOIN goal.user ON goal.user_id = user.user_id SET
        goal.goal_complete_pts = $goal_complete_pts,
        user.rewardpoint_total = $rewardpoint_total
        WHERE goal.goal_id = $goal_id AND goal.user_id = user.user_id";

        $stmt1 = $db->query($sql);

        echo '{"rewardpoint_total":"';
        echo json_encode($rewardpoint_total);
        echo '"}';

        $db = null;
      }

    }
    catch(PDOException $e)
    {
      echo '{"error":'.$e->getMessage().'}';

    }

});

//update goal current unit
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

 		echo '{"goal_current_unit":';
    echo json_encode($goal_current_unit);
    echo '"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error":'.$e->getMessage().'}';

	 }

});

//set goal to completed
$app->put('/api/goal/setgoalcompete', function(Request $request, Response $response){

  $goal_id = $request->getParam('goal_id');

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

 		$stmt->execute();

    echo '{"goal_complete":"1"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error":'.$e->getMessage().'}';

	 }

});

//re add the goal from history
$app->put('/api/goal/goalreadd', function(Request $request, Response $response){

  $goal_id = $request->getParam('goal_id');

	 $sql = "UPDATE goal.goal SET
   goal_complete = '0'
   WHERE goal_id = :goal_id";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->prepare($sql);

    $stmt->bindParam(':goal_id', $goal_id);

 		$stmt->execute();

    echo '{"goal_complete":"0"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error":'.$e->getMessage().'}';

	 }

});

//insert the current unit of goal into graph
$app->post("/api/goal/progressgraph", function (Request $request, Response $response) {

    $user_id = $request->getParam('user_id');
    //$current_date = $request->getParam('current_date');

    $select = "SELECT goal.goal_id, goal.goal_current_unit FROM goal.goal WHERE user_id = $user_id AND goal_complete = '0'";

    try {
      //GET DB OBJECT
      $db = new db();
      //connect
      $db = $db->connect();

  		$stmt = $db->query($select);

  		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
      if ($result == null){
        echo '{"error":"no result"}';
      }
      else {
        $count = $stmt->rowCount();
        // echo json_encode($count);
        for($i=0; $i<=($count-1); $i++){
          $goal_id = $result[$i]->goal_id;
          //echo json_encode($goal_id);
          $progress_unit = $result[$i]->goal_current_unit;
          //echo json_encode($progress_unit);
          $sql = "INSERT INTO goal.progress(progress_unit, goal_id) VALUES ($progress_unit, $goal_id)";
          //$sql = "INSERT INTO goal.progress(progress_unit, progress_date, goal_id) VALUES ($progress_unit, $current_date, $goal_id)";

          $stmt1 = $db->prepare($sql);
          $stmt1->execute();
          //echo "done:",$i," ";
        }
      }
      echo '{"NOTICE":"progress updated"}';
    }
    catch(PDOException $e)
    {
     echo '{"error":'.$e->getMessage().'}';
    }

});

//get the values of the graph
$app->post("/api/goal/goalgraph", function (Request $request, Response $response) {

    $user_id = $request->getParam('user_id');

    $select1 = "SELECT goal.goal_id, goal.goal_description, goal.goal_unit, goal.goal_unitType, goal.goal_frequency, goal.activity_id, goal.user_id
    FROM goal.goal WHERE goal.user_id = $user_id AND goal.goal_complete = '0'";

    try {
      //GET DB OBJECT
      $db = new db();
      //connect
      $db = $db->connect();

  		$stmt1 = $db->query($select1);

  		$result1 = $stmt1->fetchAll(PDO::FETCH_OBJ);
      $count1 = $stmt1->rowCount();
  		//echo json_encode($result1);

      if ($count1 == null){
        echo '{"error":"no result"}';
      }
      else {
        $rows = array();

        for($i=0; $i<=($count1-1); $i++){
          $goal_id = $result1[$i]->goal_id;
          //echo json_encode($goal_id);
          $select2 = "SELECT DATE(progress.progress_date) as progress_date, progress.progress_unit
          FROM goal.progress JOIN goal.goal WHERE goal.goal_id = progress.goal_id AND progress.goal_id = $goal_id AND goal.user_id = $user_id AND goal.goal_complete = '0'";
          $stmt2 = $db->query($select2);
          $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
          $count2 = $stmt2->rowCount();

          if ($count2 == null) {
            echo '{"error":"no result"}';
          }
          else {
            $goal_detail =["goal_id" =>  $result1[$i]->goal_id,
            "goal_description" =>  $result1[$i]->goal_description,
            "goal_unit" =>  $result1[$i]->goal_unit,
            "goal_unitType" =>  $result1[$i]->goal_unitType,
            "goal_frequency" =>  $result1[$i]->goal_frequency,
            "goal_progress" => $result2,
            "activity_id" =>  $result1[$i]->activity_id,
            "user_id" =>  $result1[$i]->user_id];

            array_push($rows, $goal_detail);
          }

        }
        $response->withHeader('Content-Type', 'application/json');
        $response->write(json_encode($rows));
      }
    }
    catch(PDOException $e)
    {
     echo '{"error":'.$e->getMessage().'}';

    }

});

?>
