<?php

require_once '../../Models/Job.php';
require_once '../../Controllers/JobController.php';
require_once '../shared/sessionControl.php';



if (isset($_GET['jobId'])) {
    $jobId = $_GET['jobId'];

    $jobController = new JobController();
    $result = $jobController->saveJob($userId, $jobId);

    if ($result === "You have already saved this job.") {
        // Show alert and stop the script
        echo "<script>alert('You have already saved this job.'); window.history.back();</script>";
        exit(); // Ensure no further processing
    } elseif ($result === "Job saved successfully.") {
        header("Location: mySavedJobs.php");
        exit();
    } else {
        echo "<script>alert('$result'); window.history.back();</script>";
        exit();
    }
} else {
    echo "<script>alert('No job ID provided.'); window.history.back();</script>";
    exit();
}
?>