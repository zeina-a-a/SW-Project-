<?php
require_once 'BaseRepository.php';
require_once '../../Models/Skill.php';

class SkillRepository extends BaseRepository implements ISkillRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function addSkillQuery($skill)
    {
        $query = "INSERT INTO skills (user_id, skill_name) 
                 VALUES ('{$skill->getUserId()}', '{$skill->getSkillName()}')";
        return $this->insert($query);
    }

    public function updateSkillQuery($skill)
    {
        $query = "UPDATE skills 
                 SET skill_name = '{$skill->getSkillName()}' 
                 WHERE id = '{$skill->getId()}' AND user_id = '{$skill->getUserId()}'";
        return $this->update($query);
    }

    public function deleteSkillQuery($id, $userId)
    {
        $query = "DELETE FROM skills WHERE id = '$id' AND user_id = '$userId'";
        return $this->delete($query);
    }

    public function getUserSkillsQuery($userId)
    {
        $query = "SELECT * FROM skills WHERE user_id = '$userId' ORDER BY skill_name ASC";
        return $this->select($query);
    }

    public function getSkillByIdQuery($id, $userId)
    {
        $query = "SELECT * FROM skills WHERE id = '$id' AND user_id = '$userId'";
        $result = $this->select($query);
        if ($result) {
            $skill = new Skill();
            $skill->setId($result[0]['id']);
            $skill->setUserId($result[0]['user_id']);
            $skill->setSkillName($result[0]['skill_name']);
            return $skill;
        }
        return null;
    }
}
?>