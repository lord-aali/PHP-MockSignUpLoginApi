<?php
include_once "classes/JsonDatabase.php";


$xhrRequest = file_get_contents("php://input");
$xhrRequest = json_decode($xhrRequest, true);
if ($xhrRequest === null) {
    $xhrRequest = $_REQUEST;
}
$db = new JsonDatabase();

switch ($xhrRequest["order"]) {
    case "deactivate":
        echo $db->activateUser($xhrRequest["value"], false);
        break;
    case "activate":
        echo $db->activateUser($xhrRequest["value"], true);
        break;
    case "delete":
        echo $db->deleteUser($xhrRequest["value"]);
        break;
    case "deactivate_app":
        echo $db->activateApp(true);
        break;
    case "activate_app":
        echo $db->activateApp(false);
}