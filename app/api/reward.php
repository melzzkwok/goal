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
	 	echo '{"error":'.$e->getMessage().'}';

	 }

});

// display all rewards user have unlocked
$app->post('/api/reward/userreward', function(Request $request, Response $response){

  $user_id = $request->getParam('user_id');

  $sql = "SELECT userReward_id, reward_id FROM goal.user_reward WHERE user_id = $user_id";

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

//check if user have redeem the reward and if user's reward point is more than reward unlock point to redeem reward
$app->post('/api/reward/redeemreward', function(Request $request, Response $response){

  $user_id = $request->getParam('user_id');
  $reward_id = $request->getParam('reward_id');

  $select1 = "SELECT rewardpoint_total FROM goal.user WHERE user_id = $user_id";
  $select2 = "SELECT reward_unlock_pts FROM goal.goal_reward WHERE reward_id = $reward_id";
  $select3 = "SELECT userReward_id FROM goal.user_reward WHERE user_id = $user_id AND reward_id = $reward_id";

  try {
    //GET DB OBJECT
    $db = new db();
    //connect
    $db = $db->connect();

    $stmt1 = $db->query($select1);
    $stmt2 = $db->query($select2);
    $stmt3 = $db->query($select3);

    $result1 = $stmt1->fetchAll(PDO::FETCH_OBJ);
    $result2 = $stmt2->fetchAll(PDO::FETCH_OBJ);
    $result3 = $stmt3->fetchAll(PDO::FETCH_OBJ);
    $count1 = $stmt1->rowCount();
    $count2 = $stmt2->rowCount();
    $count3 = $stmt3->rowCount();
    //echo $count;

    if (($count1 == null) || ($count2 == null)){
      echo '{"error":"no result"}';
    }
    else {
      $rewardpoint_total = $result1[0]->rewardpoint_total;
      //echo $rewardpoint_total;
      $reward_unlock_pts = $result2[0]->reward_unlock_pts;
      //echo $reward_unlock_pts;

      if ($count3 == null){
        if ($reward_unlock_pts <= $rewardpoint_total){
          $sql1 = "INSERT INTO goal.user_reward(user_id, reward_id) VALUES ($user_id, $reward_id)";
          $stmt4 = $db->prepare($sql1);
          $stmt4->execute();

          $sql2 = "SELECT user_reward.userReward_id, goal_reward.reward_id, goal_reward.reward_name, goal_reward.reward_description, goal_reward.reward_img FROM goal.user_reward JOIN goal.goal_reward WHERE user_reward.user_id = $user_id AND user_reward.reward_id = $reward_id AND user_reward.reward_id = goal_reward.reward_id";
          $stmt5 = $db->query($sql2);
          $result5 = $stmt5->fetchAll(PDO::FETCH_OBJ);
          echo json_encode($result5);
          echo '{"NOTICE":"reward redeem"}';
        }

        else {
          echo '{"NOTICE":"not enough points to redeem"}';
        }

      }

      else {
        $sql3 = "SELECT user_reward.userReward_id, goal_reward.reward_id, goal_reward.reward_name, goal_reward.reward_description, goal_reward.reward_img FROM goal.user_reward JOIN goal.goal_reward WHERE user_reward.user_id = $user_id AND user_reward.reward_id = $reward_id AND user_reward.reward_id = goal_reward.reward_id";
        $stmt6 = $db->query($sql3);
        $result6 = $stmt6->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($result6);
        echo '{"NOTICE":"reward already redeemed"}';
      }
    }
  }
  catch(PDOException $e)
  {
    echo '{"error":'.$e->getMessage().'}';

  }

});

//reward progress bar for user to view the progress to unlock next reward
$app->post('/api/reward/nextreward', function(Request $request, Response $response){

  $user_id = $request->getParam('user_id');

  $select1 = "SELECT * FROM goal.goal_reward ORDER BY reward_id";
  $select2 = "SELECT rewardpoint_total FROM goal.user WHERE user_id = $user_id";

  try {
    //GET DB OBJECT
    $db = new db();
    //connect
    $db = $db->connect();

    $stmt1 = $db->query($select1);
    $stmt2 = $db->query($select2);

    $result1 = $stmt1->fetchAll(PDO::FETCH_OBJ);
    $result2 = $stmt2->fetchAll(PDO::FETCH_OBJ);
    $rewardpoint_total = $result2[0]->rewardpoint_total;

    $count1 = $stmt1->rowCount();

    for($i=0; $i<=($count1-1); $i++){
      $reward_unlock_pts = $result1[$i]->reward_unlock_pts;

      if ($i > 0) {
        $pre_reward_unlock_pts = $result1[$i-1]->reward_unlock_pts;

        if ($reward_unlock_pts >= $rewardpoint_total) {
          // echo "reward unlocked points: ";
          // echo json_encode ($reward_unlock_pts);
          // echo "reward total points: ";
          // echo json_encode ($rewardpoint_total);
          $point_till_unlock = $reward_unlock_pts - $rewardpoint_total;
          $reward_to_reward = $reward_unlock_pts - $pre_reward_unlock_pts;
          $reward_progress = $reward_to_reward - $point_till_unlock;

          if ($reward_progress < 0) {
            $reward_progress = 0;
          }
          // echo "points till unlock: ";
          // echo json_encode ($point_till_unlock);
          echo '{"current_reward_progress":"';
          echo json_encode ($reward_progress);
          echo '",';
          echo '"reward_progress":"';
          echo json_encode ($reward_to_reward);
          echo '"}';
          break;
        }
      }

    }
  }
  catch(PDOException $e)
  {
   echo '{"error":'.$e->getMessage().'}';

  }

});

?>
