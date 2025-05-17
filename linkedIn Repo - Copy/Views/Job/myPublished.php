<?php
require_once '../../Controllers/EmpJobController.php';
require_once '../../Controllers/JobController.php';
require_once '../shared/sessionControl.php';


$isEmployer = isset($_SESSION['isEmployer']) && $_SESSION['isEmployer'] == 1;
$empjobController = new EmpJobController();
$publishedJobs = $empjobController->getPublishedJobsByUser($userId);
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
        <?php require_once '../shared/timelineHeader.php'; ?>

        <section>

            <div class="gap gray-bg">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="row" id="page-contents">
                                <div class="col-lg-6 offset-lg-3">
                                    <div style="margin-top: 30px;">
                                        <?php if ($isEmployer): ?>
                                            <a href="publishJob.php" class="btn btn-primary" style="margin: 10px;">Publish A New Job</a>
                                        <?php else: ?>
                                            <button class="btn btn-primary" style="margin: 10px;" onclick="alert('Sorry, you cannot publish a job as you are not an employer.')">Publish Job</button>
                                        <?php endif; ?>
                                    </div>

                                    <div class="loadMore">
                                        <?php if (!empty($publishedJobs)): ?>
                                            <?php
                                            foreach ($publishedJobs as $job):
                                            ?>
                                                <div class="central-meta item">
                                                    <div class="user-post">
                                                        <div class="friend-info">
                                                            <figure>
                                                                <img src="../../Assets/images/job2.png" alt="">
                                                            </figure>

                                                            <div class="friend-name">
                                                                <ins><a href="#" title=""><?php echo $job['companyName'] ?></a></ins>
                                                                <span>Published: <?= date("F j, Y", strtotime($job['created_at'] ?? 'now')) ?></span>
                                                            </div>

                                                            <div class="post-meta">
                                                                <div class="description">
                                                                    <p><strong>Job Title:</strong> <?= htmlspecialchars($job['jobTitle']) ?></p>
                                                                    <p><strong>Company:</strong> <?= htmlspecialchars($job['companyName']) ?></p>
                                                                    <p><strong>Employment Type:</strong> <?= htmlspecialchars($job['employmentType']) ?></p>
                                                                    <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
                                                                    <p><strong>City:</strong> <?= htmlspecialchars($job['city']) ?></p>
                                                                    <p><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>
                                                                    <p><strong>Deadline:</strong> <?= htmlspecialchars($job['applicationDeadline']) ?></p>
                                                                    <p><strong>Contact Email:</strong> <?= htmlspecialchars($job['contactEmail']) ?></p>
                                                                    <p><strong>Description:</strong> <?= htmlspecialchars($job['jobDescription']) ?></p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p>No posts found </p>
                                        <?php endif; ?>

                                    </div>

                                </div>
                                <!-- centerl meta -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php require_once '../shared/footer.php'; ?>

</body>


</html>