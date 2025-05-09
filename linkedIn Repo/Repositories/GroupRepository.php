<?php

require_once 'BaseRepository.php';
require_once '../../Models/Group.php';
require_once '../../Models/GroupMember.php';


class GroupRepository extends BaseRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllGroupsQuery($userId)
    {
        $query = "select * from groups where groupId NOT IN (
            select groupId from groupmembers where userId = $userId
            )";
        $result = $this->select($query);
        if ($result === false) {
            return false;
        } else {
            return $result;
        }
    }
    public function getMyGroupsQuery($userId)
    {

        $query = "SELECT g.* 
            FROM groups g 
            INNER JOIN groupmembers gm ON g.groupId = gm.groupId 
            WHERE gm.userId = $userId";
        $result = $this->select($query);
        if ($result === false) {
            return false;
        } else {
            return $result;
        }
    }

    public function checkJoinQuery(GroupMember $group)
    {

        $checkQuery = "SELECT * FROM groupmembers WHERE groupId = '$group->groupId' AND userId = '$group->userId'";
        $existing = $this->select($checkQuery);

        if (!empty($existing)) {
            return true;
        }
        return false;
    }
    public function joinQuery(GroupMember $group)
    {
        $query = "INSERT INTO groupmembers (groupId, userId) VALUES ('$group->groupId', '$group->userId')";
        $result = $this->insert($query);
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    public function addGroupQuery(Group $group)
    {
        $adminId = $group->adminId;
        $query = "INSERT INTO groups (name,description,adminId) VALUES (
            '$group->name','$group->description','$adminId')";
        $result = $this->insert($query);
        if ($result === false) {
            return false;
        } else {
            return $result;
        }
    }
    public function leaveGroupQuery($groupId, $userId)
    {
        $query = "DELETE FROM groupmembers WHERE groupId = $groupId AND userId = $userId";
        $result = $this->delete($query);
        if ($result === false) {
            return false;
        } else {
            return $result;
        }
    }
}
