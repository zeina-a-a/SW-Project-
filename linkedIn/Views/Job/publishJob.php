<?php

require_once '../../Controllers/JobController.php';
require_once '../shared/sessionControl.php';

$errorMsg = "";

if (isset($_POST['jobTitle']) && isset($_POST['companyName']) && isset($_POST['jobDescription']) && isset($_POST['employmentType']) && isset($_POST['location']) && isset($_POST['city']) && isset($_POST['salary']) && isset($_POST['applicationDeadline']) && isset($_POST['contactEmail'])) {
	if (!empty($_POST['jobTitle']) && !empty($_POST['companyName']) && !empty($_POST['jobDescription']) && !empty($_POST['employmentType']) && !empty($_POST['location']) && !empty($_POST['city']) && !empty($_POST['contactEmail'])) {


		$job = new Job;
		$jbcontroller = new JobController();
		$job->jobTitle = $_POST['jobTitle'];
		$job->companyName = $_POST['companyName'];
		$job->jobDescription = $_POST['jobDescription'];
		$job->employmentType = $_POST['employmentType'];
		$job->location = $_POST['location'];
		$job->city = $_POST['city'];
		$job->salary = $_POST['salary'];
		$job->applicationDeadline = $_POST['applicationDeadline'];
		$job->contactEmail = $_POST['contactEmail'];
		$job->empId = $userId;

		if ($jbcontroller->publishJob($job)) {
			header("location: ../Home/index.php");
			exit();
		} else {
			echo 'Error: ' . $_SESSION["errorMsg"];
			$errorMsg = $_SESSION["errorMsg"];
		}
	} else {
		$errorMsg = "Please fill all required fields.";
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>Z.F.R.S Social Network Toolkit</title>
	<link rel="icon" href="../../../Assets/images/fav.png" type="image/png" sizes="16x16">

	<link rel="stylesheet" href="../../Assets/css/main.min.css">
	<link rel="stylesheet" href="../../Assets/css/style.css">
	<link rel="stylesheet" href="../../Assets/css/color.css">
	<link rel="stylesheet" href="../../Assets/css/responsive.css">

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
									<div class="col-lg-3">

									</div><!-- sidebar -->
									<div class="col-lg-6">
										<div class="central-meta">
											<div class="editing-info">
												<h5 class="f-title"><i class="ti-briefcase"></i> Publish Job</h5>
												<form method="post" action="publishJob.php">
													<div class="form-group">
														<input type="text" id="jobTitle" name="jobTitle" required />
														<label class="control-label" for="jobTitle">Job Title</label><i class="mtrl-select"></i>
													</div>

													<div class="form-group">
														<input type="text" id="companyName" name="companyName" required />
														<label class="control-label" for="companyName">Company Name</label><i class="mtrl-select"></i>
													</div>

													<div class="form-group">
														<textarea id="jobDescription" name="jobDescription" rows="6" required></textarea>
														<label class="control-label" for="jobDescription">Job Description</label><i class="mtrl-select"></i>
													</div>

													<div class="form-group">
														<select id="employmentType" name="employmentType" required>
															<option value="" disabled selected>Select employment type</option>
															<option value="full-time">Full-time</option>
															<option value="part-time">Part-time</option>
															<option value="contract">Contract</option>
															<option value="internship">Internship</option>
															<option value="freelance">Freelance</option>
														</select>
														<label class="control-label" for="employmentType">Employment Type</label><i class="mtrl-select"></i>
													</div>

													<div class="form-group">
														<select id="location" name="location" required>
															<option value="" disabled selected>Select location type</option>
															<option value="on-site">On-site</option>
															<option value="remote">Remote</option>
															<option value="hybrid">Hybrid</option>
														</select>
														<label class="control-label" for="location">Location Type</label><i class="mtrl-select"></i>
													</div>

													<div class="form-group half">
														<input type="text" id="city" name="city" required />
														<label class="control-label" for="city">City</label><i class="mtrl-select"></i>
													</div>

													<div class="form-group">
														<input type="text" id="salary" name="salary" />
														<label class="control-label" for="salary">Salary Range (optional)</label><i class="mtrl-select"></i>
													</div>

													<div class="form-group">
														<input type="date" id="applicationDeadline" name="applicationDeadline" />
														<label class="control-label" for="applicationDeadline">Application Deadline</label><i class="mtrl-select"></i>
													</div>

													<div class="form-group half">
														<input type="email" id="contactEmail" name="contactEmail" required />
														<label class="control-label" for="contactEmail">Company Email</label><i class="mtrl-select"></i>
													</div>

													<div class="submit-btns">
														<button type="button" class="mtr-btn"><span>Cancel</span></button>
														<button type="submit" class="mtr-btn"><span>Publish Job</span></button>
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

		<?php require_once '../shared/footer.php'; ?>

</body>

</html>