<?php

require_once '../../Models/Job.php';
require_once '../../Controllers/JobController.php';
require_once '../shared/sessionControl.php';


$jobcontroller = new JobController();
$Jobs = $jobcontroller->getSavedJobs($userId);
$errMsg = "";
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
			<div class="ext-gap bluesh high-opacity">
				<div class="content-bg-wrap" style="background: url(../../Assets/images/resources/animated-bg2.png)"></div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="top-banner">
								<h1>Your Saved Jobs</h1>
								<nav class="breadcrumb">
									<a class="breadcrumb-item" href="jobs.php">All Jobs Page</a>
									<span class="breadcrumb-item active">Portfolio</span>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- top area animated -->

		

		<section>
			<div class="gap">
				<div class="container">
					<div class="row" id="page-contents">
						<div class="col-lg-12">
							<div id="options" class="isotop-full">
								<div class="option-isotop">
									<ul id="filter2" class="option-set icon-style" data-option-key="filter">
										<li>
											<a href="#all" data-option-value="*" class="selected" data-toggle="tooltip" data-placement="top" title="All">all</a>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="loadMore">
								<?php if (!empty($Jobs)): ?>
									<div style="display: flex; flex-wrap: wrap; gap: 20px;">
										<?php foreach ($Jobs as $job): ?>
											<div style="flex: 0 0 48%; background: #fff; padding: 15px; border: 1px solid #ccc; box-sizing: border-box; display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
												<div class="user-post">
													<div class="friend-info">
														<div style="display: flex; margin-bottom: 10px;">
															<img src="../../Assets/images/job2.png" alt="" width="80" height="80" style="margin-right: 10px;">
															<div>
																<strong><a href="#"><?php echo $job['companyName']; ?></a></strong><br>
																<small>Published: <?= date("F j, Y", strtotime($job['created_at'] ?? 'now')) ?></small>
															</div>
														</div>

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

												<!-- Button Section -->
												<div style="margin-top: 15px; display: flex; gap: 10px;">
													<form action="applyJob.php" method="GET">
														<input type="hidden" name="jobId" value="<?= $job['id']; ?>">
														<button type="submit" class="btn btn-primary" style="width: 100%;">Apply</button>
													</form>

													<!-- <form action="saveJob.php" method="GET">
												<input type="hidden" name="jobId" value="<?= $job['id']; ?>">
												<button type="submit" class="btn btn-primary" style="width: 100%;">Save</button>
											</form> -->
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								<?php else: ?>
									<p>No jobs found</p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


	<?php require_once '../shared/footer.php'; ?>
</body>


</html>