<?php

require_once 'BaseRepository.php';
require_once '../../Models/User.php';
require_once '../../IRepositories/IUserRepository.php';

class UserRepository extends BaseRepository implements IUserRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllUsersQuery()
    {
        $query = "SELECT * FROM users";
        $result = $this->select($query);
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function upgradeUserQuery($id)
    {
        $query = "update users set isPremium = 1 where id = $id";
        $result = $this->update($query);
        return $result;
    }

    public function getUserQuery($id)
    {
        $query = "select * from users where id = $id";
        $result = $this->select($query);
        if ($result === false) {
            return false;
        }
        return $result;
    }

    // public function incrementConnectionCountQuery($userId)
    // {
    //     $query = "UPDATE users SET connectionCount = connectionCount + 1 WHERE id = $userId";
    //     $result = $this->update($query);
    //     if (!$result) {
    //         return false;
    //     }
    //     return true;
    // }
}
