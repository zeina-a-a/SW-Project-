<?php
require_once 'BaseRepository.php';
require_once '../../IRepositories/IAuthRepository.php';
require_once '../../Models/User.php';

class AuthRepository extends BaseRepository implements IAuthRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    // Login query using getter methods
    public function loginQuery(User $user)
    {
        $query = "SELECT * FROM users WHERE email= '" . $user->getEmail() . "' AND password = '" . $user->getPassword() . "'";
        $result = $this->select($query);
        if ($result === false) {
            return false;
        } else {
            return $result;
        }
    }

    // Check if user is already registered using getter methods
    public function checkRegisterQuery(User $user)
    {
        $checkQuery = "SELECT * FROM users WHERE email = '" . $user->getEmail() . "'";
        $existingUser = $this->select($checkQuery);
        if ($existingUser && count($existingUser) > 0) {
            return true;
        }
        return false;
    }

    // Register user using getter methods
    public function registerQuery(User $user)
    {
        $query = "INSERT INTO users (name, username, password, email, profilePhoto, isEmployer) 
                  VALUES ('" . $user->getName() . "','" . $user->getUsername() . "','" . $user->getPassword() . "','" . $user->getEmail() . "','" . $user->getProfilePhoto() . "','" . $user->getIsEmployer() . "')";
        $result = $this->insert($query);
        if ($result != false) {
            return true;
        }
        $_SESSION["errorMsg"] = " ERROR..please try again ";
        return false;
    }
}
?>