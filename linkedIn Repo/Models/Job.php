<?php
class Job
{
    private $id;
    private $jobTitle;
    private $companyName;
    private $jobDescription;
    private $employmentType;
    private $location;
    private $city;
    private $salary;
    private $applicationDeadline;
    private $contactEmail;
    private $createdAt;
    private $empId;

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getJobTitle()
    {
        return $this->jobTitle;
    }
    public function getCompanyName()
    {
        return $this->companyName;
    }
    public function getJobDescription()
    {
        return $this->jobDescription;
    }
    public function getEmploymentType()
    {
        return $this->employmentType;
    }
    public function getLocation()
    {
        return $this->location;
    }
    public function getCity()
    {
        return $this->city;
    }
    public function getSalary()
    {
        return $this->salary;
    }
    public function getApplicationDeadline()
    {
        return $this->applicationDeadline;
    }
    public function getContactEmail()
    {
        return $this->contactEmail;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function getEmpId()
    {
        return $this->empId;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;
    }
    public function setEmploymentType($employmentType)
    {
        $this->employmentType = $employmentType;
    }
    public function setLocation($location)
    {
        $this->location = $location;
    }
    public function setCity($city)
    {
        $this->city = $city;
    }
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }
    public function setApplicationDeadline($applicationDeadline)
    {
        $this->applicationDeadline = $applicationDeadline;
    }
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
    public function setEmpId($empId)
    {
        $this->empId = $empId;
    }
}
