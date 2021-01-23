<?php

use model\User;

include_once "./classes/ResponseHandler.php";
include_once "./classes/JsonDatabase.php";
include_once "./classes/models/User.php";

class SignUp
{
    private $user;

    public function __construct($req)
    {
        $this->user = new User(
            $req["username"],
            $req["password"],
            $req["name"],
            $req["lastname"],
            $req["avatar"]
        );
    }

    public function signUp()
    {
        $db = new JsonDatabase();
        $response = new ResponseHandler();

        $result = $db->addNewUser($this->user);
        if (!$result[0]) {
            $response->send($result[1], false, null);
        } else {
            $response->send("key", true, $result[1]);
        }
    }


}