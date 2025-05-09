<?php

require_once '../../Services/Email.php';
require_once '../../Services/AddMedia.php';
require_once '../../Models/User.php';
require_once '../../Repositories/AuthRepository.php';
require_once '../../IRepositories/IAuthRepository.php';

class AuthController
{
    public IAuthRepository $_authRepository;

    public function __construct()
    {
        $this->_authRepository = new AuthRepository();
    }

    public function login(user $user)
    {
        $result = $this->_authRepository->loginQuery($user);
        if (!$result) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["errMsg"] = "You have entered wrong email or password";
            return false;
        } else {
            session_start();
            $_SESSION["userId"] = $result[0]["id"];
            $_SESSION["userName"] = $result[0]["username"];
            $_SESSION["isEmployer"] = $result[0]["isEmployer"];
            $_SESSION["email"] = $result[0]["email"];
            return true; 
        }
    }

    public function register(user $user)
    {
        $result = $this->_authRepository->checkRegisterQuery($user);
        if($result)
        {
            $_SESSION["errorMsg"] = "Email is already in use.";
            return false; 
        }
        else{
            $result = $this->_authRepository->registerQuery($user);
            if($result)
            {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                Email::sendEmail($_SESSION["email"], 'Hello From Z.F.R.S, Welcome To Our Website.');
                return true; 
            }
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location:../../Views/Auth/login.php "); 
        exit();
    }
}
