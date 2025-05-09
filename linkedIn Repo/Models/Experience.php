<?php

class Experience {
    private $id;
    private $userId;
    private $workAt;
    private $fromYear;
    private $toYear;
    private $description;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getWorkAt() {
        return $this->workAt;
    }

    public function getFromYear() {
        return $this->fromYear;
    }

    public function getToYear() {
        return $this->toYear;
    }

    public function getDescription() {
        return $this->description;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setWorkAt($workAt) {
        $this->workAt = $workAt;
    }

    public function setFromYear($fromYear) {
        $this->fromYear = $fromYear;
    }

    public function setToYear($toYear) {
        $this->toYear = $toYear;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
}

?> 