<?php

require_once '../../Models/JobApplication.php';

interface IJobRepository
{
    public function applyJobQuery(JobApplication $JP);
    public function checkSavedQuery($userId, $jobId);
    public function saveJobQuery($userId, $jobId);
    public function getSavedJobsQuery($userId);
    public function getJobApplicationsQuery($userId);
}