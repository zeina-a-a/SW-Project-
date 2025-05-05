<?php

require_once '../../Controllers/DBController.php';
require_once '../../Services/AddMedia.php';
require_once '../../Models/user.php';


class UserController
{
    protected $db;

    public function getAllUsers()
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "SELECT * FROM users";
            return $this->db->select($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function upgradeUser($id,$connectionCount)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            if($connectionCount !==null && $connectionCount >= 10)
            {
                $query = "update users set isPremium = 1 where id = $id";
                return $this->db->update($query);
            }
            else {
                echo "Not enough Connections"; 
            }
            
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function getUser($id)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "select * from users where id = $id";
            $result = $this->db->select($query);
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
        return false;
    }
}
?>