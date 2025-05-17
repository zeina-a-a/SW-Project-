<?php
class Group
{

    private int $groupId;
    private string $name;
    private string $description;
    private int $adminId;

    public function __construct(string $name, string $description, int $adminId) {
        $this->name = $name;
        $this->description = $description;
        $this->adminId = $adminId;
    }

    public function getGroupId(): int {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): void {
        $this->groupId = $groupId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getAdminId(): int {
        return $this->adminId;
    }

    public function setAdminId(int $adminId): void {
        $this->adminId = $adminId;
    }
}
?>