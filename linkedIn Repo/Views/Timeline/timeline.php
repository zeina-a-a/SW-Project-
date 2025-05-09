<?php
require_once '../../Controllers/PostController.php';
require_once '../../Controllers/UserController.php';
require_once '../shared/sessionControl.php';


$postController = new postController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {

	$post = new Post();
	$post->setContent( $_POST['content']);

	$result = $postController->addPost($post);
	if ($result) {
		header('Location: ' . $_SERVER['PHP_SELF']);
		exit();
	} else {
		$error = "Failed to create post";
	}
}
$posts = $postController->getAllPosts();
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
									<div class="loadMore">
										<div class="central-meta item">
											<div class="new-postbox">
												<figure>
													<img src="<?php echo $user->getProfilePhoto()?>" alt="">
												</figure>
												<div class="newpst-input">
													<form method="post" action="timeline.php" enctype="multipart/form-data">
														<textarea rows="2" name="content" placeholder="write something"></textarea>
														<div class="attachments">
															<ul>
																<li>
																	<i class="fa fa-image"></i>
																	<label class="fileContainer">
																		<input name="imagePath" type="file">
																	</label>
																</li>
																<li>
																	<i class="fa fa-video-camera"></i>
																	<label class="fileContainer">
																		<input type="file">
																	</label>
																</li>

																<li>
																	<button type="submit">Post</button>
																</li>
															</ul>
														</div>
													</form>
												</div>
											</div>
										</div>
										<?php if (!empty($posts)): ?>
											<?php foreach ($posts as $post): ?>
												<?php if ($post['userId'] == $userId): ?>
														<div class="central-meta item">
															<div class="user-post">
																<div class="friend-info">
																	<figure>
																		<img src="<?php echo $post['authorImage'] ?>" alt="">
																	</figure>
																	<div class="friend-name">
																		<ins><a href="time-line.html" title=""><?php echo htmlspecialchars($post['authorName']); ?></a></ins>
																		<span><?php echo htmlspecialchars($post['createdAt']); ?></span>
																	</div>
																	<div class="post-meta">
																		<img src="<?php echo $post['imagePath'] ?>" alt="">
																		<div class="we-video-info">
																			<ul>

																				<li>
																					<span class="comment" data-toggle="tooltip" title="Comments">
																						<i class="fa fa-comments-o"></i>
																						<ins>52</ins>
																					</span>
																				</li>
																				<li>
																					<span class="like" data-toggle="tooltip" title="like">
																						<i class="ti-heart"></i>
																						<ins>2.2k</ins>
																					</span>
																				</li>

																				<li>
																					<form method="GET" action="editPost.php">
																						<input type="hidden" name="id" value="<?php echo $post['id']; ?>">
																						<input type="hidden" name="userId" value="<?php echo $post['userId']; ?>">
																						<button type="submit" class="mtr-btn"><span>Edit</span></button>
																					</form>
																				</li>
																				<li>
																					<form method="GET" action="deletePost.php">
																						<input type="hidden" name="id" value="<?php echo $post['id']; ?>">
																						<input type="hidden" name="userId" value="<?php echo $post['userId']; ?>">
																						<button type="submit" class="mtr-btn"><span>Delete</span></button>
																					</form>
																				</li>
																			</ul>
																		</div>
																		<div class="description">

																			<p>
																				<?php echo htmlspecialchars($post['content']); ?>
																			</p>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													
												<?php endif; ?>
											<?php endforeach; ?>
										<?php else: ?>
											<p>No posts found.</p>
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