<?php
header('Content-Type: application/json');

include_once "classes/JsonDatabase.php";
include_once "classes/ResponseHandler.php";
include_once "classes/RequestHandler.php";
include_once "classes/SignUp.php";
include_once "classes/Login.php";
include_once "classes/UserData.php";
include_once "classes/models/User.php";

$xhrRequest = file_get_contents("php://input");
$xhrRequest = json_decode($xhrRequest, true);
if ($xhrRequest === null) {
    $xhrRequest = $_REQUEST;
}
$response = new ResponseHandler;

$reqHandler = new RequestHandler();
$reqHandler->check($xhrRequest);
unset($reqHandler);

switch ($xhrRequest["request_type"]) {
    case "signup":
    {
        $xhrRequest["avatar"] = substr($_SERVER["SCRIPT_URI"], 0, -7) . "person.png";
        $signUp = new SignUp($xhrRequest);
        $signUp->signUp();
        break;
    }
    case "login":
    {
        $login = new Login();
        if (isset($xhrRequest["key"])) {
            $login->loginByKey($xhrRequest["key"]);
        } else {
            $login->loginByUsername($xhrRequest["username"], $xhrRequest["password"]);
        }
    }
    case "user_data":
    {
        $userData = new UserData();
        $userData->getUserData($xhrRequest["key"]);
    }
}




