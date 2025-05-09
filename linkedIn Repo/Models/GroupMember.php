<?php

class GroupMember {

    private int $groupId;
    private int $userId;

    public function __construct(int $groupId, int $userId) {
        $this->groupId = $groupId;
        $this->userId = $userId;
    }

    public function getGroupId(): int {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): void {
        $this->groupId = $groupId;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

}
?>