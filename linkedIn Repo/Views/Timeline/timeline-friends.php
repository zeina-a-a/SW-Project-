<?php
session_start();
require_once '../../Controllers/SendController.php';
require_once '../../Controllers/UserController.php';

// Require user to be logged in
if (!isset($_SESSION['userId'])) {
    header("Location: ../Auth/login.php");
    exit;
}

$userId = $_SESSION['userId'];
$userController = new UserController();
$user = $userController->getUser($userId);

$sendController = new SendController();
$friends = $sendController->getFriends($userId);
$friendRequests = $sendController->getPendingConnections($userId);
$nonFriends = $sendController->getUsersExceptCurrent($userId);
?>


<!DOCTYPE html>
<html lang="en">
	

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Winku Social Network Toolkit</title>
    <link rel="icon" href="../images/fav.png" type="image/png" sizes="16x16"> 
    <link rel="stylesheet" href="../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="../../Assets/css/color.css">
    <link rel="stylesheet" href="../../Assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <!-- Add required JavaScript dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>


</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
		<?php require_once '../shared/header.php'; ?>
		<!-- topbar -->
		<?php require_once '../shared/timelineHeader.php'; ?>
	<!-- topbar -->
	
	
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
									<div class="container mt-4">
										<?php if (!empty($friendRequests)): ?>
										<div class="alert alert-info alert-dismissible fade show" role="alert">
											You have <?php echo count($friendRequests); ?> pending connection request(s)!
											<a href="#frends-req" class="alert-link">Click here to view them</a>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
										<?php endif; ?>

										<?php if (isset($_GET['message'])): ?>
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											<?php echo htmlspecialchars($_GET['message']); ?>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
										<?php endif; ?>
									</div>
									<div class="frnds">
										<ul class="nav nav-tabs">
												<li class="nav-item"><a class="nav-link active" href="#frends" data-toggle="tab">My Connections</a> <span><?= count($friends) ?></span></li>
												<li class="nav-item"><a class="nav-link" href="#frends-req" data-toggle="tab">Connection Requests</a><span><?= count($friendRequests) ?></span></li>
												<li class="nav-item"><a class="nav-link" href="#find-frends" data-toggle="tab">Find Connections</a></li>
										</ul>
										
								<div class="tab-content">
									<div class="tab-pane active fade show" id="frends">
										<ul class="nearby-contct">
											<?php foreach ($friends as $friend): ?>
												<li>
													<div class="nearly-pepls">
														<figure>
														
														</figure>
														<div class="pepl-info">
															<h4><?= htmlspecialchars($friend['name']) ?></h4>
															<form method="POST" action="../../Controllers/SendController.php" class="d-inline">
																<input type="hidden" name="action" value="remove">
																<input type="hidden" name="connectionId" value="<?= $friend['connection_id'] ?>">
																<button type="submit" class="add-butn">Remove Connection</button>
															</form>
														</div>
													</div>
												</li>
											<?php endforeach; ?>
										</ul>
										<div class="lodmore"><button class="btn-view btn-load-more"></button></div>
									</div>
									<div class="tab-pane fade" id="frends-req">
										<ul class="nearby-contct">
											<?php foreach ($friendRequests as $request): ?>
												<li>
													<div class="nearly-pepls">
														<figure>
														
														</figure>
														<div class="pepl-info">
															<h4><?= htmlspecialchars($request['name']) ?></h4>
															<div class = "d-flex align-items-center justify-content-center ">
															<form method="POST" action="../../Controllers/SendController.php" class="d-inline">
																<input type="hidden" name="action" value="reject">
																<input type="hidden" name="connectionId" value="<?= $request['connection_id'] ?>">
																<button type="submit" class="add-butn more-action">Delete Request</button>
															</form>
															<form method="POST" action="../../Controllers/SendController.php" class="d-inline">
																<input type="hidden" name="action" value="accept">
																<input type="hidden" name="connectionId" value="<?= $request['connection_id'] ?>">
																<button type="submit" class="add-butn">Confirm</button>
															</form>
														</div>
														</div>
													</div>
												</li>
											<?php endforeach; ?>
										</ul>
										<div class="lodmore"><button class="btn-view btn-load-more"></button></div>
									</div>
									<div class="tab-pane fade" id="find-frends">
										<ul class="nearby-contct">
											<?php foreach ($nonFriends as $user): ?>
												<li>
													<div class="nearly-pepls">
													<div class="d-flex align-items-center justify-content-around flex-row p-2   mb-2">
														<div class="d-flex align-items-center gap-3">
															<figure class="mb-0">
																
															</figure>
															<h4 class="mb-0"><?= htmlspecialchars($user['name']) ?></h4>
														</div>
														<div class="pepl-info">
															<form method="POST" action="../../Controllers/SendController.php" class="d-inline">
																<input type="hidden" name="action" value="send">
																<input type="hidden" name="to" value="<?= $user['id'] ?>">
																<button type="submit" class="btn btn-primary">Send Connection</button>
															</form>
														</div>
													</div>
													</div>
												</li>
											<?php endforeach; ?>
										</ul>
										<div class="lodmore"><button class="btn-view btn-load-more"></button></div>
									</div>
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