<?php


require_once '../../Models/Group.php';
require_once '../../Controllers/DBController.php';
require_once '../../Models/GroupMember.php';



class GroupController
{
    protected $db;
    public function __construct()
    {
        $this->db = new DBController();
        $this->db->openConnection();
    }

    public function getAllGroups($userId)
    {

        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $userId = (int) $userId;
            $query = "select * from groups where groupId NOT IN (
            select groupId from groupmembers where userId = $userId
            )";
            return $this->db->select($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
    public function getMyGroups($userId)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $userId = (int)$userId;
            $query = "SELECT g.* 
            FROM groups g 
            INNER JOIN groupmembers gm ON g.groupId = gm.groupId 
            WHERE gm.userId = $userId";

            return $this->db->select($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
    public function join($group)
    {
        $this->db = new DBController;

        if ($this->db->openConnection()) {


            $checkQuery = "SELECT * FROM groupmembers WHERE groupId = '$group->groupId' AND userId = '$group->userId'";
            $existing = $this->db->select($checkQuery);

            if (!empty($existing)) {
                $_SESSION["errorMsg"] = "You are already a member of this group.";
                return false;
            }
            $query = "INSERT INTO groupmembers (groupId, userId) VALUES ('$group->groupId', '$group->userId')";
            return $this->db->insert($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function addGroup(Group $group)
    {
        $this->db = new DBController;

        $adminId = (int)$group->adminId;
        if ($this->db->openConnection()) {
            $query = "INSERT INTO groups (name,description,adminId) VALUES (
                '$group->name','$group->description',$adminId)";

            return $this->db->insert($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
    public function leaveGroup($groupId, $userId)
    {
        $this->db = new DBController;

        if ($this->db->openConnection()) {

            $query = "DELETE FROM groupmembers WHERE groupId = $groupId AND userId = $userId";
            return $this->db->delete($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
}
