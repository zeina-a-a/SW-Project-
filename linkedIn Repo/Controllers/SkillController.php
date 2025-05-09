<?php

require_once 'DBController.php';
require_once '../../Models/Skill.php';

class SkillController {
    protected $db;

    public function __construct() {
        $this->db = new DBController();
        if (!$this->db->openConnection()) {
            throw new Exception("Failed to connect to database");
        }
    }

    public function addSkill($userId, $skillName) {
        $skill = new Skill();
        $skill->userId = $userId;
        $skill->skillName = $skillName;

        $query = "INSERT INTO skills (user_id, skill_name) 
                 VALUES ('$skill->userId', '$skill->skillName')";
        return $this->db->insert($query);
    }

    public function updateSkill($id, $userId, $skillName) {
        $skill = new Skill();
        $skill->id = $id;
        $skill->userId = $userId;
        $skill->skillName = $skillName;

        $query = "UPDATE skills 
                 SET skill_name = '$skill->skillName' 
                 WHERE id = '$skill->id' AND user_id = '$skill->userId'";
        return $this->db->update($query);
    }

    public function deleteSkill($id, $userId) {
        $query = "DELETE FROM skills WHERE id = '$id' AND user_id = '$userId'";
        return $this->db->delete($query);
    }

    public function getUserSkills($userId) {
        $query = "SELECT * FROM skills WHERE user_id = '$userId' ORDER BY skill_name ASC";
        return $this->db->select($query);
    }

    public function getSkillById($id, $userId) {
        $query = "SELECT * FROM skills WHERE id = '$id' AND user_id = '$userId'";
        $result = $this->db->select($query);
        if ($result) {
            $skill = new Skill();
            $skill->id = $result[0]['id'];
            $skill->userId = $result[0]['user_id'];
            $skill->skillName = $result[0]['skill_name'];
            return $skill;
        }
        return null;
    }
}

?> 