<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../app/api/dbconnect.php';

$app = new \Slim\App;

require_once('../app/api/categorylist.php');
require_once('../app/api/activitylist.php');
require_once('../app/api/goal.php');
require_once('../app/api/reward.php');
require_once('../app/api/dummy.php');
require_once('../app/api/dummytest.php');
require_once('../app/api/user.php');
require_once('../app/api/users.php');

$app->run();

?>
