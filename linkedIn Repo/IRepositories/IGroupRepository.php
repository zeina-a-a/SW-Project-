<?php

require_once '../../Models/Group.php';
require_once '../../Models/GroupMember.php';

interface IGroupRepository
{
    public function getAllGroupsQuery($userId);

    public function getMyGroupsQuery($userId);

    public function checkJoinQuery(GroupMember $group);

    public function joinQuery(GroupMember $group);

    public function addGroupQuery(Group $group);

    public function leaveGroupQuery($groupId, $userId);
}