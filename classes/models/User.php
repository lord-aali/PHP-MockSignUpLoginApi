<?php

namespace model;

class User implements \JsonSerializable
{
    private $username;
    private $password;
    private $name;
    private $lastname;
    private $avatar;

    /**
     * User constructor.
     * @param $username
     * @param $password
     * @param $name
     * @param $lastname
     * @param $avatar
     */
    public function __construct($username, $password, $name, $lastname, $avatar)
    {
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}