<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 07.12.2018
 * Time: 18:21
 */
namespace App\Http\Objects;

class User {

    protected $username;
    protected $email;
    protected $type;

    public function __construct($username,$email,$type)
    {
        $this->username = $username;
        $this->email = $email;
        $this->type = $type;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}