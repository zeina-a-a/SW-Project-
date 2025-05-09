<?php
require_once 'BaseRepository.php';
require_once '../../Models/User.php';
require_once'../../IRepositories/IJobRepository.php';
class JobRepository extends BaseRepository implements IJobRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

   

    
    public function ApplyJobQuery(JobApplication $JP)
    {
        // Using getters to access the JobApplication object properties
        $query = "INSERT INTO jobapplications (userId, jobId, fullName, email, phone, resume, expectedSalary, yearsOfExperience)
                  VALUES (
                    ".$JP->getUserId().",
                    '".$JP->getJobId()."',
                    '".$JP->getFullName()."',
                    '".$JP->getEmail()."',
                    '".$JP->getPhone()."',
                    '".$JP->getResume()."',
                    '".$JP->getExpectedSalary()."',
                    '".$JP->getYearsOfExperience()."'
                  )";
        $result = $this->insert($query);
        if ($result) {
            return true;
        }
        return false;
    }

    public function checkSavedQuery($userId, $jobId)
    {
        $checkQuery = "SELECT * FROM savedjobs WHERE userid = $userId AND jobid = $jobId";
        $checkResult = $this->select($checkQuery);
        if (empty($checkResult)) {
            return false;
        } else {
            return true;
        }
    }


    public function saveJobQuery($userId, $jobId)
    {

        $insertQuery = "INSERT INTO savedjobs (userid, jobid) VALUES ($userId, $jobId)";
        $result = $this->insert($insertQuery);
        if ($result !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function getSavedJobsQuery($userId)
    {

        $query = "SELECT jobs.id, jobs.jobTitle, jobs.companyName, jobs.jobDescription, jobs.employmentType, jobs.location, 
                         jobs.city, jobs.salary, jobs.applicationDeadline, jobs.contactEmail, jobs.createdAt
                  FROM jobs 
                  JOIN savedjobs ON jobs.id = savedjobs.jobId
                  WHERE savedjobs.userId = $userId";
        $result = $this->select($query);
        return $result;
    }



    

    public function getJobApplicationsQuery($userId)
    {
        $query = "SELECT j.jobTitle, ja.appliedAt AS appliedDate
                    FROM jobapplications ja
                    JOIN jobs j ON ja.JobId = j.id
                    WHERE ja.UserId = $userId";

        $result = $this->select($query);
        return $result;
    }


}