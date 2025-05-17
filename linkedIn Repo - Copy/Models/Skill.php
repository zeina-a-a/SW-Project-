<?php

class Skill {
    private $id;
    private $userId;
    private $skillName;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getSkillName() {
        return $this->skillName;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setSkillName($skillName) {
        $this->skillName = $skillName;
    }
}

?> 