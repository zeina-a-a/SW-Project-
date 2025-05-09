<?php
require_once 'BaseRepository.php';
require_once '../../Models/User.php';
class EmpJobRepository extends BaseRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function publishJobQuery(Job $job)
    {

        $query = "INSERT INTO jobs (jobTitle,companyName,jobDescription,employmentType,location,city,salary,applicationDeadline,contactEmail,empId
            ) VALUES (
                '$job->jobTitle','$job->companyName','$job->jobDescription','$job->employmentType','$job->location','$job->city','$job->salary','$job->applicationDeadline','$job->contactEmail','$job->empId'
            )";

        $result = $this->insert($query);
        if ($result) {
            return true;
        }
        return false;
    }


    public function getPublishedJobsByUserQuery($userId)
    {
        $query = "SELECT * FROM jobs WHERE empId = $userId";
        $result = $this->select($query);
        return $result;
    }
}