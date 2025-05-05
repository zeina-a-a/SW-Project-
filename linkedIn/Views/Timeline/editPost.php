<?php

require_once '../shared/sessionControl.php';
require_once '../../Controllers/PostController.php';
require_once '../shared/sessionControl.php';

$postController = new postController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
	$postId = $_POST['id'];
	$post = new Post();
	$post = $postController->getPost($postId);
	$result = $postController->editPost($post);

	if ($result) {
		header('Location: timeline.php');
		exit();
	} else {
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
		header('Location: timeline.php');
		exit();
	}
} 
else {
	header('Location: Location:timeline.php');
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
	<title>Z.F.R.S Social Network Toolkit</title>
	<link rel="icon" href="../../Assets/images/fav.png" type="image/png" sizes="16x16">

	<link rel="stylesheet" href="../../Assets/css/main.min.css">
	<link rel="stylesheet" href="../../Assets/css/style.css">
	<link rel="stylesheet" href="../../Assets/css/color.css">
	<link rel="stylesheet" href="../../Assets/css/responsive.css">

</head>

<body>
	<div class="theme-layout">

		<?php require_once '../shared/header.php' ?>
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
											<h5 class="f-title"><i class="ti-info-alt"></i> Edit Post</h5>

											<form method="post" action="editPost.php" enctype="multipart/form-data">

												<input type="hidden" name="id" value="<?php echo $post->id; ?>">
												<div class="form-group">
													<img name="image_path" src="<?php echo $post->imagePath ?>" alt="">
													<input type="hidden" name="image_path" value="<?php echo $post->imagePath ?>">
													

												</div>
												<div class="form-group">

													<textarea name="content" rows="4" id="textarea" required="required"><?php echo htmlspecialchars($post->content); ?></textarea>
													<label class="control-label" for="textarea">Post Content</label><i class="mtrl-select"></i>
												</div>
												<div class="attachments">
														<ul>
															<li>
																<i class="fa fa-image"></i>
																<label class="fileContainer">
																	<input name="imagePath" type="file">
																</label>
															</li>
														</ul>
													</div>

												<div class="submit-btns">
													<button type="button" class="mtr-btn"><span>Cancel</span></button>
													<button type="submit" class="mtr-btn"><span>Update</span></button>
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