<?php
require_once '../../Models/Job.php';
require_once '../../Models/JobApplication.php';
require_once '../../Services/Email.php';
require_once '../../Repositories/EmpJobRepository.php';
require_once '../../Repositories/BaseJobRepository.php';

class EmpJobController 
{

    public EmpJobRepository $_empjobRepository;
    public BaseJobRepository $_basejobRepository;

    public function __construct()
    {
        $this->_empjobRepository = new EmpJobRepository();
        $this->_basejobRepository = new BaseJobRepository();
        
    }
   

  

    public function publishJob(Job $job)
    {

        $result = $this->_empjobRepository->publishJobQuery($job);
        if ($result) {
            (Email::sendEmail($_SESSION["email"], 'Job Published Successfully'));

            return true;
        }

        return false;
    }
    
    public function getPublishedJobsByUser($userId)
    {
        $result = $this->_empjobRepository->getPublishedJobsByUserQuery($userId);
        if (!$result) {
            return false;
        } else {
            return $result;  
        }
    }

    public function getAllJobs()
    {
        $result = $this->_basejobRepository->getAllJobsQuery();
        if ($result) {
            return $result;
        }
    }

}    

?>