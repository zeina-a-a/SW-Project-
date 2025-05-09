<?php
require_once 'BaseRepository.php';
require_once '../../Models/User.php';
require_once '../../IRepositories/IEmpJobRepository.php';
class EmpJobRepository extends BaseRepository implements IEmpJobRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function publishJobQuery(Job $job)
    {
        // Using getters to access the Job object properties
        $query = "INSERT INTO jobs (jobTitle, companyName, jobDescription, employmentType, location, city, salary, applicationDeadline, contactEmail, empId)
                  VALUES (
                    '".$job->getJobTitle()."',
                    '".$job->getCompanyName()."',
                    '".$job->getJobDescription()."',
                    '".$job->getEmploymentType()."',
                    '".$job->getLocation()."',
                    '".$job->getCity()."',
                    '".$job->getSalary()."',
                    '".$job->getApplicationDeadline()."',
                    '".$job->getContactEmail()."',
                    '".$job->getEmpId()."'
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
?>