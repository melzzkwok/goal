<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
// session_start();

$app->get('/api/userall', function() {
  $sql = "SELECT * FROM goal.user ORDER BY user_id";

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

//user login
$app->post("/api/user/login", function (Request $request, Response $response) {
    //$response = new Response();
    $user_name = $request->getParam('user_name');
    $user_password = $request->getParam('user_password');

    $select = "SELECT * FROM goal.user WHERE user_name = $user_name AND user_password = $user_password";
    //$result = $app->modelsManager->executeQuery($select, ["user_number" => $userNo]);
    $db = new db();
 		//connect
 		$db = $db->connect();

 		$stmt = $db->query($select);

 		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;
 		//echo json_encode($result);

 		if($result){
 			$particular = ["user_id" => $result[0]->user_id, "user_name" => $result[0]->user_name];
            echo json_encode($particular);
            // $_SESSION = ["user_id" => $result[0]->user_id];
            // echo json_encode($_SESSION);
 		}
 		else {
          echo json_encode(["status" => "INVALID", "user_name" => $user_name, "user_password" => $user_password]);

        }

});

//count goal in progress, goal completed, total goal, user's total reward point
$app->post("/api/user/countall", function (Request $request, Response $response) {

    $user_id = $request->getParam('user_id');

    $select1 = "SELECT goal_id FROM goal.goal WHERE user_id = $user_id AND goal_complete = '0'";
    $select2 = "SELECT goal_id FROM goal.goal WHERE user_id = $user_id AND goal_complete = '1'";
    $select3 = "SELECT goal_id FROM goal.goal WHERE user_id = $user_id";
    $select4 = "SELECT rewardpoint_total FROM goal.user WHERE user_id = $user_id";

    try {
      //GET DB OBJECT
      $db = new db();
      //connect
      $db = $db->connect();

  		$stmt1 = $db->query($select1);
      $stmt2 = $db->query($select2);
      $stmt3 = $db->query($select3);
      $stmt4 = $db->query($select4);
      $result = $stmt4->fetchAll(PDO::FETCH_OBJ);
  		$db = null;

      $count1 = $stmt1->rowCount();
      $count2 = $stmt2->rowCount();
      $count3 = $stmt3->rowCount();
      $reward = $result[0]->rewardpoint_total;

      echo '{"progress":"';
      echo json_encode($count1);
      echo '",';
      echo '"completed":"';
      echo json_encode($count2);
      echo '",';
      echo '"total":"';
      echo json_encode($count3);
      echo '",';
      echo '"totalrewardpoint":';
      echo json_encode($reward);
      echo '}';

    }
    catch(PDOException $e)
    {
     echo '{"error":'.$e->getMessage().'}';

    }

});
