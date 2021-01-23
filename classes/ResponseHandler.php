<?php
include_once "./classes/JsonDatabase.php";

class ResponseHandler
{
    function send($message, $isOk, $body)
    {
        $db = new JsonDatabase();
        $response = [];
        $response["success"] = $isOk;
        $response["is_app_active"] = $db->getAppConfig()["app_active"];
        $response["message"] = $message;


        if (!is_null($body)) {
            $response["is_user_active"] = $body["active"];
            unset($body["active"]);
        }
        $response["body"] = $body;


        die(json_encode($response));
    }

    function sendWrongMethod()
    {
        $response["success"] = false;
        $response["message"] = "Please use POST method.";
        $response["body"] = null;
        die(json_encode($response));
    }
}