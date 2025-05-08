<?php

require_once 'DBController.php';
require_once '../../Models/Education.php';

class EducationController {
    protected $db;

    public function __construct() {
        $this->db = new DBController();
        if (!$this->db->openConnection()) {
            throw new Exception("Failed to connect to database");
        }
    }

    public function addEducation($userId, $studyingAt, $fromYear, $toYear, $description) {
        $education = new Education();
        $education->userId = $userId;
        $education->studyingAt = $studyingAt;
        $education->fromYear = $fromYear;
        $education->toYear = $toYear;
        $education->description = $description;

        $query = "INSERT INTO education (user_id, studying_at, from_year, to_year, description) 
                 VALUES ('$education->userId', '$education->studyingAt', '$education->fromYear', 
                         '$education->toYear', '$education->description')";
        return $this->db->insert($query);
    }

    public function updateEducation($id, $userId, $studyingAt, $fromYear, $toYear, $description) {
        $education = new Education();
        $education->id = $id;
        $education->userId = $userId;
        $education->studyingAt = $studyingAt;
        $education->fromYear = $fromYear;
        $education->toYear = $toYear;
        $education->description = $description;

        $query = "UPDATE education 
                 SET studying_at = '$education->studyingAt', 
                     from_year = '$education->fromYear', 
                     to_year = '$education->toYear', 
                     description = '$education->description' 
                 WHERE id = '$education->id' AND user_id = '$education->userId'";
        return $this->db->update($query);
    }

    public function deleteEducation($id, $userId) {
        $query = "DELETE FROM education WHERE id = '$id' AND user_id = '$userId'";
        return $this->db->delete($query);
    }

    public function getUserEducation($userId) {
        $query = "SELECT * FROM education WHERE user_id = '$userId' ORDER BY from_year DESC";
        $result = $this->db->select($query);
        if ($result) {
            $educations = array();
            foreach ($result as $row) {
                $education = new Education();
                $education->id = $row['id'];
                $education->userId = $row['user_id'];
                $education->studyingAt = $row['studying_at'];
                $education->fromYear = $row['from_year'];
                $education->toYear = $row['to_year'];
                $education->description = $row['description'];
                $educations[] = $education;
            }
            return $educations;
        }
        return array();
    }

    public function getEducationById($id, $userId) {
        $query = "SELECT * FROM education WHERE id = '$id' AND user_id = '$userId'";
        $result = $this->db->select($query);
        if ($result) {
            $education = new Education();
            $education->id = $result[0]['id'];
            $education->userId = $result[0]['user_id'];
            $education->studyingAt = $result[0]['studying_at'];
            $education->fromYear = $result[0]['from_year'];
            $education->toYear = $result[0]['to_year'];
            $education->description = $result[0]['description'];
            return $education;
        }
        return null;
    }
}

?> 