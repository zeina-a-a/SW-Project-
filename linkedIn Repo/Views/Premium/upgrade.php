<?php
require_once '../../Controllers/UserController.php';
require_once '../shared/sessionControl.php';


$userController = new UserController();
$user = $userController->getUser($userId);
if (isset($_POST['connectionCount'])) {
	$connectionCount = $_POST['connectionCount'];
	$userController->upgradeUser($user->id, $connectionCount);
	// header('Location: ../Timeline/timeline.php');
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
	<link rel="icon" href="../../Assets/images/fav.png" type="image/png" sizes="16x16">

	<link rel="stylesheet" href="../../Assets/css/main.min.css">
	<link rel="stylesheet" href="../../Assets/css/strip.css">
	<link rel="stylesheet" href="../../Assets/css/style.css">
	<link rel="stylesheet" href="../../Assets/css/color.css">
	<link rel="stylesheet" href="../../Assets/css/responsive.css">

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
								<h1>Upgrade Your Profile</h1>
								<nav class="breadcrumb">
									<a class="breadcrumb-item" href="index-2.html">Home</a>
									<span class="breadcrumb-item active">Premium</span>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="gap gray-bg">
				<div class="container-fluid">
					<div class="row" id="page-contents">

						<div class="offset-lg-1 col-lg-10">
							<div class="career-page">
								<div class="carrer-title">

									<h2>Fuel your long-term growth with <span>Premium</span>.</h2>
									<form method="post" action="upgrade.php">
										<input type="hidden" name="connectionCount" value="<?php echo $user->connectionCount; ?>">
										<button type="submit" class="mtr-btn"><span>Upgrade Now</span></button>
									</form>



								</div>

								<div class="post-filter-sec">
									<div style="text-align: center;">
										<?php if (isset($_SESSION['successMsg']) || $user->isPremium): ?>
											<span><?php echo 'You Are A Premium User'; ?></span>
											<?php unset($_SESSION['successMsg']); ?>
										<?php endif; ?>
										
									</div>
									<div style="text-align: center;">
										<span>You Currently Have <?php echo $user->connectionCount; ?> Connections</span>
									</div>

								</div>
								<div class="row">
									<div class="col-lg-4 col-sm-6">
										<div class="open-position">
											<h4><a href="#" title="">Access Learning Products</a></h4>
											<a href="#" title="">Gain unlimited access to exclusive courses and tutorials designed to sharpen your skills, boost your career, and keep you ahead in a competitive job market.</a>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6">
										<div class="open-position">
											<h4><a href="#" title="">Tag Users</a></h4>
											<a href="#" title="">Organize your network like never before. Add custom tags to connections for smarter outreach and personalized follow-ups.</a>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6">
										<div class="open-position">
											<h4><a href="#" title="">Hide Your Identity</a></h4>
											<a href="#" title="">Browse profiles anonymously and conduct competitor research discreetly — all while keeping your activity private.</a>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6">
										<div class="open-position">
											<h4><a href="<?php if ($user->isPremium) : ?>
											../Premium/exportConnection.php <?php endif; ?>" title="">Export Your Connections</a></h4>
											<a href="#" title="">Download your full list of connections anytime — perfect for offline analysis, outreach planning, or CRM syncing.</a>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6">
										<div class="open-position">
											<h4><a href="#" title="">Create Poll</a></h4>
											<a href="#" title="">Engage your audience and gather real-time feedback by creating polls directly within your posts or groups.</a>
										</div>
									</div>
									<div class="col-lg-4 col-sm-6">
										<div class="open-position">
											<h4><a href="#" title="">Save Your Search</a></h4>
											<a href="#" title="">Never lose track of a great opportunity. Save your most effective searches and get notified when new matching results appear.</a>
										</div>
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