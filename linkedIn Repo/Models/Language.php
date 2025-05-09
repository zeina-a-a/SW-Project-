<?php

class Language {
    private $id;
    private $userId;
    private $languageName;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getLanguageName() {
        return $this->languageName;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setLanguageName($languageName) {
        $this->languageName = $languageName;
    }
}
    ?> 