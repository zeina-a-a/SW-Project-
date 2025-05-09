<?php
require_once 'BaseRepository.php';
require_once '../../Models/Education.php';

class EducationRepository extends BaseRepository implements IEducationRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function addEducationQuery(Education $education)
    {
        $query = "INSERT INTO education (user_id, studying_at, from_year, to_year, description) 
                 VALUES ('$education->userId', '$education->studyingAt', '$education->fromYear', 
                         '$education->toYear', '$education->description')";
        return $this->insert($query);
    }

    public function updateEducationQuery(Education $education)
    {
        $query = "UPDATE education 
                 SET studying_at = '$education->studyingAt', 
                     from_year = '$education->fromYear', 
                     to_year = '$education->toYear', 
                     description = '$education->description' 
                 WHERE id = '$education->id' AND user_id = '$education->userId'";
        return $this->update($query);
    }

    public function deleteEducationQuery($id, $userId)
    {
        $query = "DELETE FROM education WHERE id = '$id' AND user_id = '$userId'";
        return $this->delete($query);
    }

    public function getUserEducationQuery($userId)
    {
        $query = "SELECT * FROM education WHERE user_id = '$userId' ORDER BY from_year DESC";
        $result = $this->select($query);
        if ($result) {
            $educations = array();
            foreach ($result as $row) {
                $education = new Education();
                $education->setId($row['id']);
                $education->setUserId($row['user_id']);
                $education->setStudyingAt($row['studying_at']);
                $education->setFromYear($row['from_year']);
                $education->setToYear($row['to_year']);
                $education->setDescription($row['description']);
                $educations[] = $education;
            }
            return $educations;
        }
        return array();
    }

    public function getEducationByIdQuery($id, $userId)
    {
        $query = "SELECT * FROM education WHERE id = '$id' AND user_id = '$userId'";
        $result = $this->select($query);
        if ($result) {
            $education = new Education();
            $education->setId($result[0]['id']);
            $education->setUserId($result[0]['user_id']);
            $education->setStudyingAt($result[0]['studying_at']);
            $education->setFromYear($result[0]['from_year']);
            $education->setToYear($result[0]['to_year']);
            $education->setDescription($result[0]['description']);
            return $education;
        }
        return null;
    }
}
?>