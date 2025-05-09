<?php
require_once 'BaseRepository.php';
require_once '../../Models/Experience.php';

class ExperienceRepository extends BaseRepository implements IExperienceRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function addExperienceQuery(Experience $experience)
    {
        $query = "INSERT INTO experience (user_id, work_at, from_year, to_year, description) 
                 VALUES ('$experience->userId', '$experience->workAt', '$experience->fromYear', 
                         '$experience->toYear', '$experience->description')";
        return $this->insert($query);
    }

    public function updateExperienceQuery(Experience $experience)
    {
        $query = "UPDATE experience 
                 SET work_at = '$experience->workAt', 
                     from_year = '$experience->fromYear', 
                     to_year = '$experience->toYear', 
                     description = '$experience->description' 
                 WHERE id = '$experience->id' AND user_id = '$experience->userId'";
        return $this->update($query);
    }

    public function deleteExperienceQuery($id, $userId)
    {
        $query = "DELETE FROM experience WHERE id = '$id' AND user_id = '$userId'";
        return $this->delete($query);
    }

    public function getUserExperienceQuery($userId)
    {
        $query = "SELECT * FROM experience WHERE user_id = '$userId' ORDER BY from_year DESC";
        $result = $this->select($query);
        if ($result) {
            $experiences = array();
            foreach ($result as $row) {
                $experience = new Experience();
                $experience->setId($row['id']);
                $experience->setUserId($row['user_id']);
                $experience->setWorkAt($row['work_at']);
                $experience->setFromYear($row['from_year']);
                $experience->setToYear($row['to_year']);
                $experience->setDescription($row['description']);
                $experiences[] = $experience;
            }
            return $experiences;
        }
        return array();
    }

    public function getExperienceByIdQuery($id, $userId)
    {
        $query = "SELECT * FROM experience WHERE id = '$id' AND user_id = '$userId'";
        $result = $this->select($query);
        if ($result) {
            $experience = new Experience();
            $experience->setId($result[0]['id']);
            $experience->setUserId($result[0]['user_id']);
            $experience->setWorkAt($result[0]['work_at']);
            $experience->setFromYear($result[0]['from_year']);
            $experience->setToYear($result[0]['to_year']);
            $experience->setDescription($result[0]['description']);
            return $experience;
        }
        return null;
    }
}
?>