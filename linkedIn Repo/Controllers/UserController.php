<?php


require_once '../../Services/AddMedia.php';
require_once '../../Models/user.php';
require_once '../../Repositories/UserRepository.php';

class UserController
{
    public UserRepository  $_userRepository;

    public function __construct()
    {
        $this->_userRepository = new UserRepository();
    }

    public function getAllUsers()
    {
        $result = $this->_userRepository->getAllUsersQuery();
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function upgradeUser($id, $connectionCount)
    {
        if ($connectionCount !== null && $connectionCount >= 5) {
            $result = $this->_userRepository->upgradeUserQuery($id);
            $_SESSION["successMsg"] = "You Are A Premium User";
            return $result;
        }
        
        return false;
    }

    public function getUser($id)
    {
        $result = $this->_userRepository->getUserQuery($id);
        if ($result === false) {
            return false;
        }
        if (count($result) > 0) {
            $user = new User();
            $user->id = $result[0]['id'];
            $user->name = $result[0]['name'];
            $user->email = $result[0]['email'];
            $user->profilePhoto = $result[0]['profilePhoto'];
            $user->username = $result[0]['username'];
            $user->password = $result[0]['password'];
            $user->coverPhoto = '../../Assets/images/resources/timeline-1.jpg';
            $user->connectionCount = $result[0]['connectionCount'];
            $user->isPremium = $result[0]['isPremium'];
            $user->isEmployer = $result[0]['isEmployer'];
            return $user;
        }
        return false;
    }
}
