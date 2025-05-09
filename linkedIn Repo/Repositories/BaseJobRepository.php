<?php

require_once 'BaseRepository.php';
require_once '../../IRepositories/IBaseJobRepository.php';
require_once '../../Models/User.php';

class BaseJobRepository extends BaseRepository implements IBaseJobRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllJobsQuery()
    {

        $query = "SELECT jobs.id,jobs.jobTitle, jobs.companyName,jobs.jobDescription,jobs.employmentType,jobs.location,jobs.city,jobs.salary,
                        jobs.applicationDeadline,jobs.contactEmail,jobs.createdAt FROM jobs";

        return $this->select($query);
    }
}


?>