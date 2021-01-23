<?php
include_once "./classes/ResponseHandler.php";
include_once "./classes/JsonDatabase.php";

class Login
{
    private $response;
    private $db;

    public function __construct()
    {
        $this->response = new ResponseHandler();
        $this->db = new JsonDatabase();
    }


    public function loginByUsername($username, $password)
    {
        $allUsers = $this->db->getAllUsers();
        foreach ($allUsers as $user) {
            if ($user["username"] === $username) {
                if ($user["password"] === $password) {
                    $data = [];
                    $data["key"] = $user["key"];
                    $data["active"] = $user["active"];
                    $this->response->send("key", true, $data);
                }
                $this->response->send("wrong username/password", false, null);
            }
        }
        $this->response->send("User not found.", false, null);
    }

    public function loginByKey($key)
    {
        $allUsers = $this->db->getAllUsers();
        foreach ($allUsers as $user) {
            if ($user["key"] === $key) {
                $this->response->send("success", true, null);
            }
        }
        $this->response->send("User not found.", false, null);
    }


}