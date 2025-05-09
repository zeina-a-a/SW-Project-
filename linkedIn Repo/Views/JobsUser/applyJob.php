<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../Models/Job.php';
require_once "../../Models/JobApplication.php";
require_once '../../Controllers/JobController.php';
require_once '../../Services/AddMedia.php';
require_once '../shared/sessionControl.php';

$jobId = $_POST['jobId'] ?? $_GET['jobId'] ?? null;
if (!$jobId) {
    die("No job selected.");
}

$errorMsg = "";


if (
    isset($_POST['jobId']) &&
    isset($_POST['fullName']) &&
    isset($_POST['email']) &&
    isset($_POST['phone']) &&
    isset($_POST['expectedSalary']) &&
    isset($_POST['yearsOfExperience'])
) {
    if (
        !empty($_POST['jobId']) &&
        !empty($_POST['fullName']) &&
        !empty($_POST['email']) &&
        !empty($_POST['phone']) &&
        !empty($_POST['expectedSalary']) &&
        !empty($_POST['yearsOfExperience'])
    ) { 
        $JP = new JobApplication();
        $JP->setUserId($userId);
        $JP->setJobId($_POST['jobId']);
        $JP->setFullName($_POST['fullName']);
        $JP->setEmail($_POST['email']);
        $JP->setPhone($_POST['phone']);
        $JP->setExpectedSalary($_POST['expectedSalary']);
        $JP->setYearsOfExperience($_POST['yearsOfExperience']);


        $resumePath = AddMedia::upload('resume');
        if ($resumePath === false) {
            $errorMsg = "Error uploading resume.";
        } else {
            $JP->setResume($resumePath) ;
        }
        

        if (empty($errorMsg)) {
            $controller = new JobController();
            if ($controller->ApplyJob($JP) !== 0) {
                header("Location:myApplications.php");
                exit();
            } else {
                $errorMsg = "Failed to apply for the job.";
            }
        }
    } else {
        $errorMsg = "Please fill in all required fields.";
    }
} else {
    $errorMsg = "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Winku Social Network Toolkit</title>
    <link rel="icon" href="../../../Assets/images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="../../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../../Assets/css/style.css">
    <link rel="stylesheet" href="../../../Assets/css/color.css">
    <link rel="stylesheet" href="../../../Assets/css/responsive.css">


</head>

<body>
    <div class="theme-layout">
        <?php require_once '../shared/header.php'; ?>

        <section>
            <div class="ext-gap bluesh high-opacity">
                <div class="content-bg-wrap" style="background: url(../../Assets/images/resources/animated-bg2.png)"></div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="top-banner">
                                <h1>Apply Now</h1>
                                <nav class="breadcrumb">
                                    <a class="breadcrumb-item" href="jobs.php">Go Back</a>
                                    <!-- <span class="breadcrumb-item active">error</span> -->
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--<div class="se-pre-con"></div>-->



        <section>
            <div class="gap gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" id="page-contents">
                                <div class="col-lg-3">

                                </div><!-- sidebar -->
                                <div class="col-lg-6">
                                    <div class="central-meta">
                                        <div class="editing-info">
                                            <h5 class="f-title"><i class="ti-briefcase"></i> Apply for Job</h5>

                                            <form method="post" action="applyJob.php" enctype="multipart/form-data">
                                                <input type="hidden" name="jobId" value="<?= htmlspecialchars($jobId) ?>" />

                                                <div class="form-group">
                                                    <input type="text" id="fullName" name="fullName" required />
                                                    <label class="control-label" for="fullName">Full Name</label><i class="mtrl-select"></i>
                                                </div>

                                                <div class="form-group">
                                                    <input type="email" id="email" name="email" required />
                                                    <label class="control-label" for="email">Email</label><i class="mtrl-select"></i>
                                                </div>

                                                <div class="form-group">
                                                    <input type="tel" id="phone" name="phone" required />
                                                    <label class="control-label" for="phone">Phone Number</label><i class="mtrl-select"></i>
                                                </div>

                                                <div class="form-group">
                                                    <p>Upload resume</p>
                                                    <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required />
                                                    <label class="control-label" for="resume"></label><i class="mtrl-select"></i>
                                                </div>

                                                <div class="form-group">
                                                    <input type="number" id="expectedSalary" name="expectedSalary" required />
                                                    <label class="control-label" for="expectedSalary">Expected Salary</label><i class="mtrl-select"></i>
                                                </div>

                                                <div class="form-group">
                                                    <input type="number" id="yearsOfExperience" name="yearsOfExperience" required />
                                                    <label class="control-label" for="yearsOfExperience">Years of Experience</label><i class="mtrl-select"></i>
                                                </div>

                                                <div class="submit-btns">
                                                    <button type="button" class="mtr-btn"><span>Cancel</span></button>
                                                    <button type="submit" class="mtr-btn"><span>Apply Now</span></button>
                                                </div>
                                            </form>




                                        </div>
                                    </div>
                                </div><!-- centerl meta -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- section for design -->
        <section>
            <div class="getquot-baner">
                <span>Best Wishes 'Every single job is a challenge'</span>
                <a title="" href="jobs.php">Go To Job Page</a>
            </div>
        </section>


        <?php require_once '../shared/footer.php'; ?>

</body>

</html>