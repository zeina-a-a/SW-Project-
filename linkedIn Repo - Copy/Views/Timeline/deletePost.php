<?php

require_once '../../Controllers/PostController.php';
require_once '../shared/sessionControl.php';

$postController = new postController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {

	$postId = $_POST['id'];
	$postController->deletePost($postId);

	if ($result) {
		header('Location: timeline.php');
		exit();
	} else {
		// Handle error
		$error = "Failed to update post";
	}
}

if (isset($_GET['id']) && isset($_GET['userId'])) {
	if($_GET['userId'] == $userId)
	{
		$postId = $_GET['id'];
		$post = new Post();
		$post = $postController->getPost($postId);
	}

	if (!$post) {
		header('Location:timeline.php');
		exit();
	}
} else {

	header('Location: timeline.php');
	exit();
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
	<link rel="stylesheet" href="../../Assets/css/style.css">
	<link rel="stylesheet" href="../../Assets/css/color.css">
	<link rel="stylesheet" href="../../Assets/css/responsive.css">

</head>

<body>
	<div class="theme-layout">

		<?php require_once '../shared/header.php'; ?>
		<!-- topbar -->
		<?php require_once '../shared/timelineHeader.php'; ?>
			

		<section>
			<div class="gap gray-bg">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="row" id="page-contents">
								<div class="col-lg-3">

								</div>
								<div class="col-lg-6">
									<div class="central-meta">
										<div class="editing-info">
											<h5 class="f-title"><i class="ti-info-alt"></i> Delete Post</h5>

											<form method="post" action="deletePost.php" enctype="multipart/form-data">

												<input type="hidden" name="id" value="<?php echo $post->getId(); ?>">
												<div class="form-group">
													<img name="imagePath" src="<?php echo $post->getImagePath() ?>" alt="">
													<input disabled type="hidden" name="imagePath" value="<?php echo $post->getImagePath() ?>">
													

												</div>
												<div class="form-group">

													<textarea  name="content" rows="4" id="textarea" ><?php echo htmlspecialchars($post->getContent()); ?></textarea>
													<label class="control-label" for="textarea">Post Content</label><i class="mtrl-select"></i>
												</div>
												<div class="attachments">
														<ul>
															<li>
																<i class="fa fa-image"></i>
																<label class="fileContainer">
																	<input disabled name="imagePath" type="file">
																</label>
															</li>
														</ul>
													</div>

												<div class="submit-btns">
													<button type="button" class="mtr-btn"><span>Cancel</span></button>
													<button type="submit" class="mtr-btn"><span>Delete</span></button>
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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>

</body>

</html>