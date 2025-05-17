<?php
class JobApplication
{
    private $userId;
    private $jobId;
    private $fullName;
    private $email;
    private $phone;
    private $resume;
    private $expectedSalary;
    private $yearsOfExperience;
    private $appliedAt;


    // Getters
    public function getUserId()
    {
        return $this->userId;
    }
    public function getJobId()
    {
        return $this->jobId;
    }
    public function getFullName()
    {
        return $this->fullName;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getResume()
    {
        return $this->resume;
    }
    public function getExpectedSalary()
    {
        return $this->expectedSalary;
    }
    public function getYearsOfExperience()
    {
        return $this->yearsOfExperience;
    }
    public function getAppliedAt()
    {
        return $this->appliedAt;
    }

    // Setters
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function setJobId($jobId)
    {
        $this->jobId = $jobId;
    }
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function setResume($resume)
    {
        $this->resume = $resume;
    }
    public function setExpectedSalary($expectedSalary)
    {
        $this->expectedSalary = $expectedSalary;
    }
    public function setYearsOfExperience($yearsOfExperience)
    {
        $this->yearsOfExperience = $yearsOfExperience;
    }
    public function setAppliedAt($appliedAt)
    {
        $this->appliedAt = $appliedAt;
    }
}
