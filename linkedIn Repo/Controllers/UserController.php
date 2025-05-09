<?php


require_once '../../Services/AddMedia.php';
require_once '../../Models/user.php';
require_once '../../Repositories/UserRepository.php';
require_once '../../IRepositories/IUserRepository.php';

class UserController
{
    public IUserRepository  $_userRepository;

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
            $user->setId($result[0]['id']) ;
            $user->setName($result[0]['name']) ;
            $user->setEmail($result[0]['email']) ;
            $user->setProfilePhoto($result[0]['profilePhoto']) ;
            $user->setUsername($result[0]['username']) ;
            $user->setPassword($result[0]['password']) ;
            $user->setCoverPhoto('../../Assets/images/resources/timeline-1.jpg') ;
            $user->setConnectionCount($result[0]['connectionCount']) ;
            $user->setIsPremium( $result[0]['isPremium']) ;
            $user->setIsEmployer($result[0]['isEmployer']) ;
            return $user;
        }
        return false;
    }
}
