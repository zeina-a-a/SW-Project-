<?php


require_once '../../Models/Group.php';
require_once '../../Repositories/GroupRepository.php';
require_once '../../Models/GroupMember.php';



class GroupController
{
    public GroupRepository $_groupRepository;

    public function __construct()
    {
        $this->_groupRepository = new GroupRepository();
    }


    public function getAllGroups($userId)
    {

        return $this->_groupRepository->getAllGroupsQuery($userId);
    }
    public function getMyGroups($userId)
    {
        return $this->_groupRepository->getMyGroupsQuery($userId);
    }
    public function join($group)
    {

        $result = $this->_groupRepository->checkJoinQuery($group);

        if ($result) {
            $_SESSION["errorMsg"] = "You are already a member of this group.";
            return false;
        } else {
            $result = $this->_groupRepository->joinQuery($group);
            return true;
        }
    }

    public function addGroup($group)
    {
        return $this->_groupRepository->addGroupQuery($group);
    }
    public function leaveGroup($groupId, $userId)
    {

        return $this->_groupRepository->leaveGroupQuery($groupId, $userId);
    }
}
