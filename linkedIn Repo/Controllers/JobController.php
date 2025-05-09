<?php

require_once '../../Models/Job.php';
require_once 'DBController.php';
require_once '../../Models/JobApplication.php';
require_once '../../Services/Email.php';

class JobController
{
    protected $db;

    public function publishJob(Job $job)
    {
        $this->db = new DBController;

        if ($this->db->openConnection()) {
            $query = "INSERT INTO jobs (jobTitle,companyName,jobDescription,employmentType,location,city,salary,applicationDeadline,contactEmail,empId
            ) VALUES (
                '$job->jobTitle','$job->companyName','$job->jobDescription','$job->employmentType','$job->location','$job->city','$job->salary','$job->applicationDeadline','$job->contactEmail','$job->empId'
            )";

            $result = $this->db->insert($query);
            if ($result) {
                if (Email::sendEmail($_SESSION["email"], 'Job Published Successfully')) {
                }
                return true;
            }
            return false;
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function getAllJobs()
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {

            $query = "SELECT jobs.id,jobs.jobTitle, jobs.companyName,jobs.jobDescription,jobs.employmentType,jobs.location,jobs.city,jobs.salary,
                        jobs.applicationDeadline,jobs.contactEmail,jobs.createdAt FROM jobs";

            return $this->db->select($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function ApplyJob(JobApplication $JP)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "INSERT INTO jobApplications (userId,jobId, fullName, email, phone, resume, expectedSalary, yearsOfExperience)
            VALUES ($JP->userId,'$JP->jobId', '$JP->fullName', '$JP->email', '$JP->phone', '$JP->resume', '$JP->expectedSalary', '$JP->yearsOfExperience')";
            $result = $this->db->insert($query);
            if ($result) {
                if (Email::sendEmail($_SESSION["email"], 'You Applied Successfully')) {
                }
                return true;
            }
            return false;
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }


    public function saveJob($userId, $jobId)
    {
        $this->db = new DBController();

        if ($this->db->openConnection()) {

            $checkQuery = "SELECT * FROM savedJobs WHERE userid = $userId AND jobid = $jobId";
            $checkResult = $this->db->select($checkQuery);

            if (!empty($checkResult)) {
                $this->db->closeConnection();
                return "You have already saved this job.";
            }

            // Save the job
            $insertQuery = "INSERT INTO savedJobs (userid, jobid) VALUES ($userId, $jobId)";
            $result = $this->db->insert($insertQuery);

            $this->db->closeConnection();

            if ($result !== false) {
                return "Job saved successfully.";
            } else {
                return "Failed to save job.";
            }
        } else {
            return "Database connection failed.";
        }
    }

    public function getSavedJobs($userId)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "SELECT jobs.id, jobs.jobTitle, jobs.companyName, jobs.jobDescription, jobs.employmentType, jobs.location, 
                         jobs.city, jobs.salary, jobs.applicationDeadline, jobs.contactEmail, jobs.createdAt
                  FROM jobs 
                  JOIN savedJobs ON jobs.id = savedJobs.jobId
                  WHERE savedJobs.userId = $userId";


            return $this->db->select($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }



    public function getPublishedJobsByUser($userId)
    {
        $this->db = new DBController();

        if ($this->db->openConnection()) {
            $query = "SELECT * FROM jobs WHERE empId = $userId";
            $result = $this->db->select($query);
            $this->db->closeConnection();
            return $result;
        } else {
            echo "Database connection failed.";
            return false;
        }
    }

    public function getJobApplications($userId)
    {
        $this->db = new DBController();

        if ($this->db->openConnection()) {
            $query = "SELECT j.jobTitle, ja.appliedAt AS appliedDate
                    FROM jobApplications ja
                    JOIN jobs j ON ja.JobId = j.id
                    WHERE ja.UserId = $userId";

            $result = $this->db->select($query);


            return $result;
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
}
