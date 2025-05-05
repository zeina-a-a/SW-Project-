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





		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4">
						<div class="widget">
							<div class="foot-logo">
								<div class="logo">
									<a href="index-2.html" title=""><img src="images/logo.png" alt=""></a>
								</div>
								<p>
									The trio took this simple idea and built it into the world’s leading carpooling platform.
								</p>
							</div>
							<ul class="location">
								<li>
									<i class="ti-map-alt"></i>
									<p>33 new montgomery st.750 san francisco, CA USA 94105.</p>
								</li>
								<li>
									<i class="ti-mobile"></i>
									<p>+1-56-346 345</p>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-4">
						<div class="widget">
							<div class="widget-title">
								<h4>follow</h4>
							</div>
							<ul class="list-style">
								<li><i class="fa fa-facebook-square"></i> <a href="https://web.facebook.com/shopcircut/" title="">facebook</a></li>
								<li><i class="fa fa-twitter-square"></i><a href="https://twitter.com/login?lang=en" title="">twitter</a></li>
								<li><i class="fa fa-instagram"></i><a href="https://www.instagram.com/?hl=en" title="">instagram</a></li>
								<li><i class="fa fa-google-plus-square"></i> <a href="https://plus.google.com/discover" title="">Google+</a></li>
								<li><i class="fa fa-pinterest-square"></i> <a href="https://www.pinterest.com/" title="">Pintrest</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-4">
						<div class="widget">
							<div class="widget-title">
								<h4>Navigate</h4>
							</div>
							<ul class="list-style">
								<li><a href="about.html" title="">about us</a></li>
								<li><a href="contact.html" title="">contact us</a></li>
								<li><a href="terms.html" title="">terms & Conditions</a></li>
								<li><a href="#" title="">RSS syndication</a></li>
								<li><a href="sitemap.html" title="">Sitemap</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-4">
						<div class="widget">
							<div class="widget-title">
								<h4>useful links</h4>
							</div>
							<ul class="list-style">
								<li><a href="#" title="">leasing</a></li>
								<li><a href="#" title="">submit route</a></li>
								<li><a href="#" title="">how does it work?</a></li>
								<li><a href="#" title="">agent listings</a></li>
								<li><a href="#" title="">view All</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-4">
						<div class="widget">
							<div class="widget-title">
								<h4>download apps</h4>
							</div>
							<ul class="colla-apps">
								<li><a href="https://play.google.com/store?hl=en" title=""><i class="fa fa-android"></i>android</a></li>
								<li><a href="https://www.apple.com/lae/ios/app-store/" title=""><i class="ti-apple"></i>iPhone</a></li>
								<li><a href="https://www.microsoft.com/store/apps" title=""><i class="fa fa-windows"></i>Windows</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer><!-- footer -->
		<div class="bottombar">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<span class="copyright"><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></span>
						<i><img src="images/credit-cards.png" alt=""></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="side-panel">
		<h4 class="panel-title">General Setting</h4>
		<form method="post">
			<div class="setting-row">
				<span>use night mode</span>
				<input type="checkbox" id="nightmode1" />
				<label for="nightmode1" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Notifications</span>
				<input type="checkbox" id="switch22" />
				<label for="switch22" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Notification sound</span>
				<input type="checkbox" id="switch33" />
				<label for="switch33" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>My profile</span>
				<input type="checkbox" id="switch44" />
				<label for="switch44" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Show profile</span>
				<input type="checkbox" id="switch55" />
				<label for="switch55" data-on-label="ON" data-off-label="OFF"></label>
			</div>
		</form>
		<h4 class="panel-title">Account Setting</h4>
		<form method="post">
			<div class="setting-row">
				<span>Sub users</span>
				<input type="checkbox" id="switch66" />
				<label for="switch66" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>personal account</span>
				<input type="checkbox" id="switch77" />
				<label for="switch77" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Business account</span>
				<input type="checkbox" id="switch88" />
				<label for="switch88" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Show me online</span>
				<input type="checkbox" id="switch99" />
				<label for="switch99" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Delete history</span>
				<input type="checkbox" id="switch101" />
				<label for="switch101" data-on-label="ON" data-off-label="OFF"></label>
			</div>
			<div class="setting-row">
				<span>Expose author name</span>
				<input type="checkbox" id="switch111" />
				<label for="switch111" data-on-label="ON" data-off-label="OFF"></label>
			</div>
		</form>
	</div><!-- side panel -->

	<script src="js/main.min.js"></script>
	<script src="js/strip.pkgd.min.js"></script>
	<script src="js/script.js"></script>

</body>


</html>