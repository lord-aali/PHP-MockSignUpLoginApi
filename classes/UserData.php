<?php

include_once "./classes/ResponseHandler.php";
include_once "./classes/JsonDatabase.php";

class UserData
{
    private $response;
    private $db;

    public function __construct()
    {
        $this->response = new ResponseHandler();
        $this->db = new JsonDatabase();
    }

    function getUserData($key)
    {
        $allUsers = $this->db->getAllUsers();
        foreach ($allUsers as $user) {
            if ($user["key"] === $key) {
                $data = [];
                $data["username"] = $user["username"];
                $data["name"] = $user["name"];
                $data["lastname"] = $user["lastname"];
                $data["avatar"] = $user["avatar"];
                $data["active"] = $user["active"];
                $this->response->send("success", true, $data);
            }
        }
        $this->response->send("User not found.", false, null);

    }

}