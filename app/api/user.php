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
   echo '{"error": {"text": '.$e->getMessage().'}';

  }

});

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
