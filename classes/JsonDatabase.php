<?php
include_once "RandomString.php";

class JsonDatabase
{
    private static $USERS_FILE_NAME = "./db/users.json";
    private static $CONFIGS_FILE_NAME = "./db/config.json";


    public function getAllUsers($assoc = true)
    {
        $contents = $this->getContents();
        $allUsers = json_decode($contents, $assoc);
        if (is_null($allUsers))
            return false;
        return $allUsers;
    }

    public function getSpecificUser($username, $assoc = true)
    {
        $contents = $this->getContents();
        $users = json_decode($contents);
        if (!is_null($users)) {
            foreach ($users as $user) {
                if ($user->username === $username) {
                    if ($assoc) {
                        return $this->toArray($user);
                    }
                    return $user;
                }
            }
        }
        return false;
    }

    public function addNewUser($user)
    {
        $contents = $this->getContents();

        $allUsers = json_decode($contents, true);
        $user = $this->toArray($user);
        $user["key"] = generateRandomString($allUsers);
        $user["active"] = true;

        if (!is_null($allUsers)) {
            foreach ($allUsers as $savedUser) {
                if ($savedUser["username"] == $user["username"]) {
                    return [false, "User already exists. Try to login."];
                }
            }
        } else {
            $allUsers = [];
        }

        $allUsers[] = $user;
        if (file_put_contents(self::$USERS_FILE_NAME, json_encode($allUsers))) {
            return [true, $user];
        } else {
            return [false, "Internal error. Please check permission of db file."];
        }
    }

    private function getContents()
    {
        if (!file_exists(self::$USERS_FILE_NAME)) {
            if (!file_put_contents(self::$USERS_FILE_NAME, "")) {
                echo "E: Couldn't create json file.";
            }
        }
        return file_get_contents(self::$USERS_FILE_NAME);
    }

    private function toArray($object)
    {
        return json_decode(json_encode($object), true);
    }

    public function activateUser($username, $activate)
    {
        $allUsers = $this->getAllUsers();
        for ($i = 0; $i < sizeof($allUsers); $i++) {
            if ($allUsers[$i]["username"] == $username) {
                $allUsers[$i]["active"] = $activate;
                file_put_contents(self::$USERS_FILE_NAME, json_encode($allUsers));
                $name = $allUsers[$i]["name"];
                return ($activate) ? "${name} activated." : "${name} deactivated.";
            }

        }
        return "$username not found.";
    }

    public function deleteUser($username)
    {
        $allUsers = $this->getAllUsers();
        $otherUsers = [];
        foreach ($allUsers as $user) {
            if ($user["username"] != $username) {
                $otherUsers[] = $user;
            }
        }
        file_put_contents(self::$USERS_FILE_NAME, json_encode($otherUsers));
        return "$username removed.";
    }

    public function activateApp($activate = true)
    {
        $configs = file_get_contents(self::$CONFIGS_FILE_NAME);
        if (is_null($configs)) {
            $configs = [];
        } else {
            $configs = json_decode($configs, true);
        }
        $configs["app_active"] = $activate;
        file_put_contents(self::$CONFIGS_FILE_NAME, json_encode($configs));

        return ($configs["app_active"]) ? "App activated" : "App deactivated";
    }

    public function getAppConfig()
    {
        $configs = file_get_contents(self::$CONFIGS_FILE_NAME);
        if (!is_null($configs)) {
            $configs = json_decode($configs, true);
        }

        if (!isset($configs["app_active"])) {
            $configs["app_active"] = true;
            $this->setAppConfig("app_active", true);
        }
        return $configs;
    }

    public function setAppConfig($config, $value)
    {
        $configs = file_get_contents(self::$CONFIGS_FILE_NAME);
        $configs = json_decode($configs, true);
        $configs[$config] = $value;
        file_put_contents(self::$CONFIGS_FILE_NAME, json_encode($configs));
    }

}