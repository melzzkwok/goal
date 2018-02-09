<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//$app = new \Slim\App;

//GEt all thread
$app->get('/api/count/thread', function(Request $request, Response $response){
	 $sql = "SELECT * FROM HMS.thread";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$thread = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		echo json_encode($thread);
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});
//get all post
$app->get('/api/count/post', function(Request $request, Response $response){
	 $sql = "SELECT * FROM HMS.post";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$post = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		echo json_encode($post);
	 }
	 catch(PDOException $e)
	 {
		 echo '{"error": '.$e->getMessage().'}';

	 }


});

//GEt all main categories
$app->get('/api/category', function(Request $request, Response $response){
	 $sql = "SELECT * FROM HMS.category ORDER BY category_name";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$users = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		$data = [];

        if ($users) {
        	 foreach ($users as $category) {
                $data[] = ["category_id"   => $category->category_id, "category_name" => $category->category_name];
                $cat = $data;
            }
            echo json_encode($cat);
        } else {

            echo json_encode(["status" => "INVALID"]);
        }


        }
		 catch(PDOException $e)
		 {
		 	echo '{"error": '.$e->getMessage().'}';

		 }


});
//GEt all main categories
$app->get('/api/topic/{id}', function(Request $request, Response $response){
	 $id = $request->getAttribute('id');

	 $sql = "SELECT * FROM HMS.topic WHERE category_id = '$id' ORDER BY topic_name";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$topics = $stmt->fetchAll(PDO::FETCH_OBJ);


 		$db = null;

 		$data = [];

        if ($topics) {
        	 foreach ($topics as $topic) {
                $data[] = ["topic_id"   => $topic->topic_id, "topic_name" => $topic->topic_name];
                $top = $data;
            }
            echo json_encode($top);
        } else {

            echo json_encode(["status" => "INVALID"]);
        }


        }
		 catch(PDOException $e)
		 {
			echo '{"error": '.$e->getMessage().'}';

		 }


});
//GEt 1 users
$app->get('/api/users/{id}', function(Request $request, Response $response){
	$id = $request->getAttribute('id');

	 $sql = "SELECT * FROM HMS.users WHERE user_id = $id";


	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$user = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		echo json_encode($user);
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }
});
$app->get(
    "/api/verifyAccount/{userNo}/{password}",
    function (Request $request, Response $response) {
    //$response = new Response();
    $newPassword = $request->getAttribute('password');
    $user_number = $request->getAttribute('userNo');
    $select = "SELECT * FROM HMS.users WHERE user_number = $user_number AND user_password = '$newPassword'";
   //$result = $app->modelsManager->executeQuery($select, ["user_number" => $userNo]);
    	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($select);

 		$user = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;
 		//echo json_encode($user);
 		if($user){
 			$particular = ["user_id" => $user[0]->user_id, "user_number" => $user[0]->user_number, "user_name" => $user[0]->user_name, "user_role" => $user[0]->user_role];
            echo json_encode($particular);
 		}
 		else {
          echo json_encode(["status" => "INVALID", "user_number" => $user_number, "password" => $newPassword]);

        }

});
////Retrieve the status of thread subscribed by users by specifying the user $id and thread $id
$app->get('/api/subscribe/{uid}/{tid}', function(Request $request, Response $response){

	$user_id = $request->getAttribute('uid');
    $thread_id = $request->getAttribute('tid');
	 $sql = "SELECT * FROM HMS.subscribed_thread WHERE user_id = $user_id AND thread_id = '$thread_id'";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$sthread = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		if($sthread){
 			echo json_encode(["status" => "FOUND"]);
 			echo json_encode($sthread);
 		}

 		else {

 			echo json_encode(["status" => "NOT-FOUND"]);

 		}


	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});
//Subscribe to a thread
$app->post(
    "/api/subscribe",
    function (Request $request, Response $response) {

    	$thread_id = $request->getParam('thread_id');
    	$user_id = $request->getParam('user_id');


        $sql = "INSERT INTO subscribed_thread(thread_id,user_id) VALUES (:thread_id, :user_id)";

        try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->prepare($sql);

 		$stmt->bindParam(':thread_id', $thread_id);
 		$stmt->bindParam(':user_id', $user_id);

 		$stmt->execute();

 		echo '{"text": "Thread Added"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';
	 }


});
//like a post
$app->post(
    "/api/like",
    function (Request $request, Response $response) {

    	$post_id = $request->getParam('post_id');
    	$user_id = $request->getParam('user_id');


        $sql = "INSERT INTO liked_post(post_id,user_id) VALUES (:post_id, :user_id)";

        try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->prepare($sql);

 		$stmt->bindParam(':post_id', $post_id);
 		$stmt->bindParam(':user_id', $user_id);

 		$stmt->execute();

 		echo '{"text": "Like Added"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});
//Update a thread information based on the specified thread $id
$app->put(
    "/api/thread/{id}",
    function (Request $request, Response $response) {

    	$id= $request->getAttribute('id');
		$thread_title = $request->getParam('thread_title');



	 $sql = "UPDATE thread SET thread_title = :thread_title WHERE thread_id = '$id'";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->prepare($sql);

 		$stmt->bindParam(':thread_title', $thread_title);

 		$stmt->execute();

 		if($stmt){

 			echo '("NOTICE":{"text": "thread title Updated"}';

 		} else {

 			echo 'conflict';

 			$errors = [];

 			foreach ($stmt->getMessages() as $message) {
 				$errors[] = $message->getMessage();
 			}

 			echo json_encode(["status" => "ERROR", "messages" => $errors]);

 		}



	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});
//update a post information based on the specified post $id

$app->put(
    "/api/post/{id}",
     function (Request $request, Response $response) {

       	$id= $request->getAttribute('id');
		$post_body = $request->getParam('post_body');



	 $sql = "UPDATE post SET post_body = :post_body WHERE post_id = '$id'";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->prepare($sql);

 		$stmt->bindParam(':post_body', $post_body);

 		$stmt->execute();

 		if($stmt){

 			echo '("NOTICE":{"text": "post Updated"}';

 		} else {

 			echo 'conflict';

 			$errors = [];

 			foreach ($stmt->getMessages() as $message) {
 				$errors[] = $message->getMessage();
 			}

 			echo json_encode(["status" => "ERROR", "messages" => $errors]);

 		}

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});
//delete a thread based on the specified thread $id

$app->delete(
    "/api/thread/{id}",
    function (Request $request, Response $response) {


    	$id = $request->getAttribute('id');
 		$postBackupArray = [];
        $totalThreadPost = 0;

        $postBackupPhql = "SELECT * FROM HMS.post WHERE thread_id = '$id' ORDER BY post_id";

    	try {
    		//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($postBackupPhql);

 		$db = null;

 		if(count($stmt) > 0) {
 			$totalThreadPost = count($stmt);
 			 foreach ($stmt as $post) {
                $postBackupArray[] = ["post_id" => $post->post_id, "post_body" => $post->post_body, "post_created_time" => $post->post_created_time, "user_id" => $post->user_id, "thread_id" => $post->thread_id,"reply_post_id" => $post ->reply_post_id,"post_media_content"=> $post->post_media_content];
 			}

 		}

 		$postPhql = "DELETE FROM HMS.post WHERE thread_id = '$id'";
 		$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt1 = $db->query($postPhql);

 		$threadsql = "SELECT thread_id FROM HMS.thread WHERE thread_id = '$id'";

 		$stmt3 = $db->query($threadsql);

 		if($row = $stmt3->fetch()) {

 			$delete = "DELETE FROM HMS.thread WHERE thread_id = '$id'";

 			$stmt2 = $db->query($delete);

			if($stmt2){

				echo json_encode(["status" => "OK"]);
			} else {

				$reinsertCount = 0;

				$post_body = $request->getParam('post_body');
				$post_created_time = $request->getParam('post_created_time');

				foreach ($postBackupArray as $restore) {
                    $reinsertPhql = "INSERT INTO post VALUES (:post_body, :post_created_time)";
                    $reinsert = $db->prepare(reinsertPhql);

                $reinsert->bindParam(':post_body', $post_body);
 				$reinsert->bindParam(':post_created_time', $post_created_time);

 				$reinsert->execute();

 				if ($reinsert) {
                        $reinsertCount = $reinsertCount + 1;
                    }


				}

                echo json_encode(["status" => "ERROR", "messages" => $errors]);

 			}


        } else {
            /*$response->setStatusCode(409, "Conflict");*/

           echo json_encode(["status" => "ERROR", "messages" => $errors]);
        }

    	echo json_encode("DONE");

    }

    catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }

});

//Delete a post based on the specified post $id
//to be cfm again
$app->delete(
    "/api/post/{id}",
    function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

	 $sql = "SELECT 'post_id' FROM HMS.post WHERE post_id = '$id'";



	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);


 		if($row = $stmt->fetch()) {

 			$delete = "DELETE FROM HMS.post WHERE post_id = '$id'";

 			$stmt1 = $db->query($delete);


 			echo json_encode("post Deleted");

 		} else {


 		echo json_encode(["status" => "ERROR", "messages" => $errors]);

	 	}
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});
$app->delete(
    "/api/subscribe/{id}/{uid}",
    function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $uid = $request->getAttribute('uid');

	 $sql = "SELECT 'thread_id','user_id' FROM HMS.subscribed_thread WHERE thread_id = '$id' AND user_id = '$uid'" ;


	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		if($row = $stmt->fetch()) {

 			$delete = "DELETE FROM HMS.subscribed_thread WHERE thread_id = '$id' AND user_id = '$uid'" ;

 			$stmt1 = $db->query($delete);


 			echo json_encode("post Deleted");

 		} else {


 		echo json_encode(["status" => "ERROR", "messages" => $errors]);

	 	}
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }

});
$app->post(
    "/api/verifyAccount",
    function (Request $request, Response $response) {
    //$response = new Response();
    $newPassword = $request->getParam('user_password');
    $user_number = $request->getParam('user_number');

    $select = "SELECT * FROM HMS.users WHERE user_number = $user_number AND user_password = '$newPassword'";
   //$result = $app->modelsManager->executeQuery($select, ["user_number" => $userNo]);
    	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($select);

 		$user = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;
 		//echo json_encode($user);

 		if($user){
 			$particular = ["user_id" => $user[0]->user_id, "user_number" => $user[0]->user_number, "user_name" => $user[0]->user_name, "user_role" => $user[0]->user_role];
            echo json_encode($particular);
 		}
 		else {
          echo json_encode(["status" => "INVALID", "user_number" => $user_number, "password" => $newPassword]);

        }

});

$app->get('/api/allmedicine', function(Request $request, Response $response){
	 $sql = "SELECT * FROM HMS.medicine";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$Medicine = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		echo json_encode($Medicine);
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});

//GEt 1 medicine
$app->get('/api/allmedicine/{id}', function(Request $request, Response $response){
	$id = $request->getAttribute('id');

	 $sql = "SELECT * FROM HMS.medicine WHERE medicine_id = $id";


	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$Medicine= $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		echo json_encode($Medicine);
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }
});
//delete medicine
$app->delete('/api/allmedicine/delete/{id}', function(Request $request, Response $response){

	 $id = $request->getAttribute('id');

	 $sql = "DELETE FROM HMS.medicine WHERE medicine_id = '$id'";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->prepare($sql);

 		$stmt->execute();

 		$db = null;

 		echo '{"text":"Medicine Deleted"}';
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});
$app->post('/api/allmedicine/add', function(Request $request, Response $response){

	//$medicine_id = $request->getParam('medicine_id');
	$medicine_name = $request->getParam('medicine_name');
	$available_dose = $request->getParam('available_dose');
	$max_frequency = $request->getParam('max_frequency');
	$max_patient_dosage = $request->getParam('max_patient_dosage');
	$medicine_unit = $request->getParam('medicine_unit ');
	$patient_unit = $request->getParam('patient_unit');



	 $sql = "INSERT INTO medicine(medicine_name,available_dose,max_frequency,max_patient_dosage,medicine_unit,patient_unit) VALUES (:medicine_name,:available_dose,:max_frequency,:max_patient_dosage,:medicine_unit,:patient_unit)";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->prepare($sql);

 		//$stmt->bindParam(':medicine_id', $medicine_id);
 		$stmt->bindParam(':medicine_name', $medicine_name);
 		$stmt->bindParam(':available_dose', $available_dose);
 		$stmt->bindParam(':max_frequency', $max_frequency);
 		$stmt->bindParam(':max_patient_dosage', $max_patient_dosage);
 		$stmt->bindParam(':medicine_unit', $medicine_unit);
 		$stmt->bindParam(':patient_unit', $patient_unit);

 		$stmt->execute();

 		echo '{"text": "Customer Added"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});
//update medicine table
$app->post('/api/updateMedicineEvent', function(Request $request, Response $response){

	//$id = $request->getAttribute('id');

	$medicine_id = $request->getParam('medicine_id');
	$medicine_name = $request->getParam('medicine_name');
	$available_dose = $request->getParam('available_dose');
	$max_frequency = $request->getParam('max_frequency');
	$max_patient_dosage = $request->getParam('max_patient_dosage');
	$medicine_unit = $request->getParam('medicine_unit ');
	$patient_unit = $request->getParam('patient_unit');



	 $sql = "UPDATE medicine SET
	 medicine_id = :medicine_id ,
	 medicine_name = :medicine_name ,
	 available_dose =:available_dose,
	 max_frequency = :max_frequency ,
	 max_patient_dosage = :max_patient_dosage,
	 medicine_unit = :medicine_unit,
	 patient_unit = :patient_unit  WHERE medicine_id = :medicine_id";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->prepare($sql);

 		$stmt->bindParam(':medicine_id', $medicine_id);
 		$stmt->bindParam(':medicine_name', $medicine_name);
 		$stmt->bindParam(':available_dose', $available_dose);
 		$stmt->bindParam(':max_frequency', $max_frequency);
 		$stmt->bindParam(':max_patient_dosage', $max_patient_dosage);
 		$stmt->bindParam(':medicine_unit', $medicine_unit);
 		$stmt->bindParam(':patient_unit', $patient_unit);

 		$stmt->execute();

 		echo '{"text": "Medicine Updated"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});
//retrieve all the medical event
$app->get('/api/MedicalEvent', function(Request $request, Response $response){
	 $sql = "SELECT * FROM HMS.medical_event";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$MedEvent = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		echo json_encode($MedEvent);
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});
//retrieve event by user_id
$app->get('/api/retrieveMedicalEvent/{id}', function(Request $request, Response $response){

	$id = $request->getAttribute('id');

	 $sql = "SELECT * FROM HMS.medical_event WHERE user_id = $id";



	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$medevent = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		echo json_encode($medevent);
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }
});
//retrieve event by user_id
$app->get('/api/retrieveMedicalEventById/{medical_event_id}', function(Request $request, Response $response){

	$id = $request->getAttribute('medical_event_id');

	 $sql = "SELECT * FROM HMS.medical_event WHERE medical_event_id = $id";


	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->query($sql);

 		$medevent = $stmt->fetchAll(PDO::FETCH_OBJ);

 		$db = null;

 		echo json_encode($medevent);
	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }
});
//Inserting Medical Event
$app->post('/api/insertMedicalEvent', function(Request $request, Response $response){

	//$medicine_id = $request->getParam('medicine_id');
	$medicine_name = $request->getParam('user_id');
	$available_dose = $request->getParam('location');
	$max_frequency = $request->getParam('instruction');
	$max_patient_dosage = $request->getParam('event_start_date');
	$medicine_unit = $request->getParam('event_created_date');
	$patient_unit = $request->getParam('healthcare_profession');
	$patient1_unit = $request->getParam('purpose_of_visit');



	$sql = "INSERT INTO medical_event (user_id, location, instruction, event_start_date, healthcare_profession, purpose_of_visit) VALUES (:user_id, :location, :instruction, :event_start_date, :healthcare_profession, :purpose_of_visit)";

	 try {
	 	//GET DB OBJECT
	 	$db = new db();
 		//connect
 		$db = $db->connect2();

 		$stmt = $db->prepare($sql);

 		//$stmt->bindParam(':medicine_id', $medicine_id);
 		$stmt->bindParam(':user_id', $medicine_name);
 		$stmt->bindParam(':location', $available_dose);
 		$stmt->bindParam(':instruction', $max_frequency);
 		$stmt->bindParam(':event_start_date', $max_patient_dosage);
 		$stmt->bindParam(':healthcare_profession', $patient_unit);
 		$stmt->bindParam(':purpose_of_visit', $patient1_unit);

 		$stmt->execute();

 		echo '{"text": "Medical Event Added"}';

	 }
	 catch(PDOException $e)
	 {
	 	echo '{"error": '.$e->getMessage().'}';

	 }


});

$app->get('/api/retrieveHealthcareProfession', function(Request $request, Response $response){
	 	$sql = "SELECT * FROM HMS.healthcare_profession";

     try {
        //GET DB OBJECT
        $db = new db();
        //connect
        $db = $db->connect2();

        $stmt = $db->query($sql);

        $healthservice = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo json_encode($healthservice);
     }
     catch(PDOException $e)
     {
        echo '{"error": '.$e->getMessage().'}';

     }


});
$app->get('/api/retrieveHealthcareService', function(Request $request, Response $response){
	 	$sql = "SELECT * FROM HMS.healthcare_service";

     try {
        //GET DB OBJECT
        $db = new db();
        //connect
        $db = $db->connect2();

        $stmt = $db->query($sql);

        $healthservice = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo json_encode($healthservice);
     }
     catch(PDOException $e)
     {
        echo '{"error": '.$e->getMessage().'}';

     }


});
?>
