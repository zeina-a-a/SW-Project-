<?php

require_once 'DBController.php';
require_once '../../Models/Experience.php';

class ExperienceController {
    protected $db;

    public function __construct() {
        $this->db = new DBController();
        if (!$this->db->openConnection()) {
            throw new Exception("Failed to connect to database");
        }
    }

    public function addExperience($userId, $workAt, $fromYear, $toYear, $description) {
        $experience = new Experience();
        $experience->userId = $userId;
        $experience->workAt = $workAt;
        $experience->fromYear = $fromYear;
        $experience->toYear = $toYear;
        $experience->description = $description;

        $query = "INSERT INTO experience (user_id, work_at, from_year, to_year, description) 
                 VALUES ('$experience->userId', '$experience->workAt', '$experience->fromYear', 
                         '$experience->toYear', '$experience->description')";
        return $this->db->insert($query);
    }

    public function updateExperience($id, $userId, $workAt, $fromYear, $toYear, $description) {
        $experience = new Experience();
        $experience->id = $id;
        $experience->userId = $userId;
        $experience->workAt = $workAt;
        $experience->fromYear = $fromYear;
        $experience->toYear = $toYear;
        $experience->description = $description;

        $query = "UPDATE experience 
                 SET work_at = '$experience->workAt', 
                     from_year = '$experience->fromYear', 
                     to_year = '$experience->toYear', 
                     description = '$experience->description' 
                 WHERE id = '$experience->id' AND user_id = '$experience->userId'";
        return $this->db->update($query);
    }

    public function deleteExperience($id, $userId) {
        $query = "DELETE FROM experience WHERE id = '$id' AND user_id = '$userId'";
        return $this->db->delete($query);
    }

    public function getUserExperience($userId) {
        $query = "SELECT * FROM experience WHERE user_id = '$userId' ORDER BY from_year DESC";
        $result = $this->db->select($query);
        if ($result) {
            $experiences = array();
            foreach ($result as $row) {
                $experience = new Experience();
                $experience->id = $row['id'];
                $experience->userId = $row['user_id'];
                $experience->workAt = $row['work_at'];
                $experience->fromYear = $row['from_year'];
                $experience->toYear = $row['to_year'];
                $experience->description = $row['description'];
                $experiences[] = $experience;
            }
            return $experiences;
        }
        return array();
    }

    public function getExperienceById($id, $userId) {
        $query = "SELECT * FROM experience WHERE id = '$id' AND user_id = '$userId'";
        $result = $this->db->select($query);
        if ($result) {
            $experience = new Experience();
            $experience->id = $result[0]['id'];
            $experience->userId = $result[0]['user_id'];
            $experience->workAt = $result[0]['work_at'];
            $experience->fromYear = $result[0]['from_year'];
            $experience->toYear = $result[0]['to_year'];
            $experience->description = $result[0]['description'];
            return $experience;
        }
        return null;
    }
}

?> 