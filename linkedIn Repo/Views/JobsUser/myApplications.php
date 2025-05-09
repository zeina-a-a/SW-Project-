<?php
require_once '../../Models/Job.php';
require_once '../../Controllers/JobController.php';
require_once '../shared/sessionControl.php';


$jobController = new JobController();
$jobs = $jobController->getJobApplications($userId);
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
    <!--<div class="se-pre-con"></div>-->
    <div class="theme-layout">

    <?php require_once '../shared/header.php'; ?>

        <section>
            <div class="gap gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" id="page-contents">
                                <div class="col-lg-6 offset-lg-3">
                                    <div class="loadMore">
                                        <?php if (!empty($jobs)): ?>
                                            <h4 class="text-center mb-4">Your Job Applications</h4>
                                            <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                                <table class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Job Title</th>
                                                            <th>Applied Date</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($jobs as $job): ?>
                                                            <tr>
                                                                <td><?= htmlspecialchars($job['jobTitle']) ?></td>
                                                                <td><?= date("F j, Y", strtotime($job['appliedDate'])) ?></td>
                                                                <td><span class="badge badge-warning">Pending</span></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php else: ?>
                                            <p>You haven't applied for any jobs yet.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php require_once '../shared/footer.php'; ?>

</body>


</html>