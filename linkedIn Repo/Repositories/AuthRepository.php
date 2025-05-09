<?php

require_once 'BaseRepository.php';
require_once '../../Models/User.php';
class AuthRepository extends BaseRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function loginQuery(User $user)
    {
        $query = "SELECT * FROM users WHERE email= '$user->email' AND password = '$user->password'";
        $result = $this->select($query);
        if ($result === false) {
            return false;
        } else {
            return $result;
        }
    }

    public function checkRegisterQuery(User $user)
    {
        $checkQuery = "SELECT * FROM users WHERE email = '$user->email'";
        $existingUser = $this->select($checkQuery);
        if ($existingUser && count($existingUser) > 0) {
            return true;
        }
        return false;
    }

    public function registerQuery(User $user)
    {
        $query = "INSERT INTO users (name,username,password,email,profilePhoto,isEmployer) 
                VALUES ('$user->name','$user->username','$user->password','$user->email','$user->profilePhoto','$user->isEmployer')";
        $result = $this->insert($query);
        if ($result != false) {
            return true;
        }
        $_SESSION["errorMsg"] = " ERROR..please try again ";
        return false;
    }
}
