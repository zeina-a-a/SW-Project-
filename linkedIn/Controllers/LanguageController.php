<?php

require_once 'DBController.php';
require_once '../../Models/Language.php';

class LanguageController {
    protected $db;

    public function __construct() {
        $this->db = new DBController();
        if (!$this->db->openConnection()) {
            throw new Exception("Failed to connect to database");
        }
    }

    public function addLanguage($userId, $languageName) {
        $language = new Language();
        $language->userId = $userId;
        $language->languageName = $languageName;

        $query = "INSERT INTO languages (user_id, language_name) 
                 VALUES ('$language->userId', '$language->languageName')";
        return $this->db->insert($query);
    }

    public function updateLanguage($id, $userId, $languageName) {
        $language = new Language();
        $language->id = $id;
        $language->userId = $userId;
        $language->languageName = $languageName;

        $query = "UPDATE languages 
                 SET language_name = '$language->languageName'
                 WHERE id = '$language->id' AND user_id = '$language->userId'";
        return $this->db->update($query);
    }

    public function deleteLanguage($id, $userId) {
        $query = "DELETE FROM languages WHERE id = '$id' AND user_id = '$userId'";
        return $this->db->delete($query);
    }

    public function getUserLanguages($userId) {
        $query = "SELECT * FROM languages WHERE user_id = '$userId' ORDER BY language_name ASC";
        return $this->db->select($query);
    }

    public function getLanguageById($id, $userId) {
        $query = "SELECT * FROM languages WHERE id = '$id' AND user_id = '$userId'";
        $result = $this->db->select($query);
        if ($result) {
            $language = new Language();
            $language->id = $result[0]['id'];
            $language->userId = $result[0]['user_id'];
            $language->languageName = $result[0]['language_name'];
            return $language;
        }
        return null;
    }
}

?> 