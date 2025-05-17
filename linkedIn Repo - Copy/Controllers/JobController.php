<?php

require_once '../../Models/Job.php';
require_once '../../Models/JobApplication.php';
require_once '../../Services/Email.php';
require_once '../../Repositories/JobRepository.php';
require_once '../../IRepositories/IJobRepository.php';
require_once '../../Repositories/BaseJobRepository.php';
require_once '../../IRepositories/IBaseJobRepository.php';


class JobController
{

    public IJobRepository $_jobRepository;
    public IBaseJobRepository $_basejobRepository;

    public function __construct()
    {
        $this->_jobRepository = new JobRepository();
        $this->_basejobRepository = new BaseJobRepository();
    }

    public function getAllJobs()
    {
        $result = $this->_basejobRepository->getAllJobsQuery();
        if ($result) {
            return $result;
        }
    }

    public function ApplyJob(JobApplication $JP)
    {
        $result = $this->_jobRepository->ApplyJobQuery($JP);
        if ($result) {
            if (Email::sendEmail($_SESSION["email"], 'You Applied Successfully')) {
            }
            return true;
        }
        return false;
    }

    public function saveJob($userId, $jobId)
    {
        $result = $this->_jobRepository->checkSavedQuery($userId, $jobId);
        if ($result) {
            return "Job is already saved";
        } else {
            $result = $this->_jobRepository->saveJobQuery($userId, $jobId);
            if ($result !== false) {
                return "Job saved successfully.";
            } else {
                return "Failed to save job.";
            }
        }
    }

    public function getSavedJobs($userId)
    {

        $result = $this->_jobRepository->getSavedJobsQuery($userId);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getJobApplications($userId)
    {
        $result = $this->_jobRepository->getJobApplicationsQuery($userId);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
}