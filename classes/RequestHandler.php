<?php

include_once "./classes/ResponseHandler.php";
include_once "./classes/JsonDatabase.php";

class RequestHandler
{
    private $response;

    public function __construct()
    {
        $this->response = new ResponseHandler();
    }

    public function check($req)
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $this->response->sendWrongMethod();
        }

        if (!isset($req["request_type"])) {
            $this->say("request_type is required.");
        }
        switch ($req["request_type"]) {
            case "login":
                $this->checkLoginRequest($req);
                break;
            case "signup":
                $this->checkSignUpRequest($req);
                break;
            case "user_data":
                $this->checkUserDataRequest($req);
                break;
            default:
                $this->say("request_type is not valid.");
        }
    }

    private function checkUserDataRequest($req)
    {
        if (!isset($req["key"])) {
            $this->say("key is required.");
        }
    }

    private function checkSignUpRequest($req)
    {
        $missing = "";
        if (!isset($req["username"]))
            $missing .= "username, ";
        if (!isset($req["password"]))
            $missing .= "password, ";
        if (!isset($req["name"]))
            $missing .= "name, ";
        if (!isset($req["lastname"]))
            $missing .= "lastname, ";
        if ($missing != "") {
            $missing = substr($missing, 0, -2);
            $this->say("$missing is required.");
        }
    }

    private function checkLoginRequest($req)
    {
        if (!isset($req["key"])) {
            if (!isset($req["username"]) || !isset($req["password"])) {
                $this->say("key or username/password is required.");
            }
        }
    }

    private function say($message)
    {
        $this->response->send($message, false, null);
    }
}