<?php

require_once '../../Models/Job.php';

interface IEmpJobRepository
{
    public function publishJobQuery(Job $job);
    public function getPublishedJobsByUserQuery($userId);
}