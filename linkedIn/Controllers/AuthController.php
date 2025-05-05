<?php

require_once '../../Services/Email.php';
require_once '../../Controllers/DBController.php';
require_once '../../Services/AddMedia.php';
require_once '../../Models/user.php';

class AuthController
{
    protected $db;
    public function login(user $user)
    {
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $query = "SELECT * FROM users WHERE email='$user->email' AND password = '$user->password'";
            $result = $this->db->select($query);
            if ($result === false) {
                echo "Error in Query";
                return false;
            } else {
                if (count($result) == 0) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }                    
                    $_SESSION["errMsg"] = "You have entered wrong email or password";
                    $this->db->closeConnection();
                    return false;
                } else {
                    session_start();
                    $_SESSION["userId"] = $result[0]["id"];
                    $_SESSION["userName"] = $result[0]["username"];
                    $_SESSION["isEmployer"] = $result[0]["isEmployer"];
                    $_SESSION["email"] = $result[0]["email"];

                    $this->db->closeConnection();
                    return true;
                }
            }
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function register(user $user)
    {
        $this->db = new DBController;

        if ($this->db->openConnection()) {
            $checkQuery = "SELECT * FROM users WHERE email = '$user->email'";
            $existingUser = $this->db->select($checkQuery);

            if ($existingUser && count($existingUser) > 0) {
                $_SESSION["errorMsg"] = "Email is already in use.";
                $this->db->closeConnection();
                return false;
            }
            $query = "INSERT INTO users (name,username,password,email,profilePhoto,isEmployer) VALUES ('$user->name','$user->username','$user->password','$user->email','$user->profilePhoto','$user->isEmployer')";

            $result = $this->db->insert($query);
            if ($result != false) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                

                if (Email::sendEmail($_SESSION["email"], 'hello from Rody')) {
                    // Success
                    // header("Location: index.php?status=success");
                    // exit();
                } else {
                    // Error
                    // header("Location: index.php?status=error");
                    //  exit();
                }
                $this->db->closeConnection();
                return true;
            } else {
                $_SESSION["errorMsg"] = " ERROR..please try again ";
                $this->db->closeConnection();
                return false;
            }
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
}
?>