<?php

require_once 'BaseRepository.php';
require_once '../../Models/Group.php';
require_once '../../Models/GroupMember.php';
require_once '../../IRepositories/IGroupRepository.php';


class GroupRepository extends BaseRepository implements IGroupRepository
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
            $result= $this->select($query);
            if($result === false){
                return false;
            }else{
                return $result;
            }
       
    }
    public function getMyGroupsQuery($userId)
    {
        
            $query = "SELECT g.* 
            FROM groups g 
            INNER JOIN groupmembers gm ON g.groupId = gm.groupId 
            WHERE gm.userId = $userId";
            $result= $this->select($query);
            if($result === false){
                return false;
            }else{
                return $result;
            }
        
    }

    public function checkJoinQuery(GroupMember $group)
    {
       
            $checkQuery = "SELECT * FROM groupmembers WHERE groupId = {$group->getGroupId()} AND userId = '{$group->getUserId()}'";
            $existing = $this->select($checkQuery);

            if (!empty($existing)) {
                return false;
            }
            return true;
        
    }
    public function joinQuery(GroupMember $group)
    {   
            $query = "INSERT INTO groupmembers (groupId, userId) VALUES ({$group->getGroupId()}, '{$group->getUserId()}')";
            $result= $this->insert($query);
            if($result === false){
                return false;
            }else{
                return $result;
            }
    }

    public function addGroupQuery(Group $group)
    {
        $adminId=$group->getAdminId();
        $query = "INSERT INTO groups (name,description,adminId) VALUES (
              '{$group->getName()}','{$group->getDescription()}','{$adminId}')";
        $result= $this->insert($query);
        if($result === false){
                return false;
            }else{
                return $result;
            }
        
    }
    public function leaveGroupQuery($groupId, $userId)
    {
            $query = "DELETE FROM groupmembers WHERE groupId = $groupId AND userId = $userId";
            $result= $this->delete($query);
            if($result === false){
                return false;
            }else{
                return $result;
            }
        
    }


}


?>