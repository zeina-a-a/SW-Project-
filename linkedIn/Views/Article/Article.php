<?php
require_once '../../Controllers/ArticleController.php';
require_once '../../Controllers/UserController.php';
require_once '../shared/sessionControl.php';


$articleController = new ArticleController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['body'])) {

	$article = new Article();
	$article->title = $_POST['title'];
	$article->body = $_POST['body'];

	$result = $articleController->addArticle($article);
	if ($result) {
		header('Location: ' . $_SERVER['PHP_SELF']);
		exit();
	} else {
		$error = "Failed to create article";
	}
}
$articles = $articleController->getAllArticles();
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
		<?php require_once 'articleHeader.php'; ?>

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
													<img src="<?php echo $user->profilePhoto?>" alt="">
												</figure>
												<div class="newpst-input">
													<form method="post" action="Article.php">
														<input type="text" name="title" placeholder="Article Title" required class="form-control mb-2">
														<textarea rows="4" name="body" placeholder="Write your article..." required class="form-control"></textarea>
														<div class="attachments">
															<ul>
																<li>
																	<button type="submit" class="btn btn-primary">Publish Article</button>
																</li>
															</ul>
														</div>
													</form>
												</div>
											</div>
										</div>
										<?php if (!empty($articles)): ?>
											<?php foreach ($articles as $article): ?>
												<?php if ($article['userId'] == $userId): ?>
														<div class="central-meta item">
															<div class="user-post">
																<div class="friend-info">
																	<figure>
																		<img src="<?php echo $article['authorImage'] ?>" alt="">
																	</figure>
																	<div class="friend-name">
																		<ins><a href="time-line.html" title=""><?php echo htmlspecialchars($article['authorName']); ?></a></ins>
																	</div>
																	<div class="post-meta">
																		<div class="description">
																			<h2><?php echo htmlspecialchars($article['title']); ?></h2>
																			<p><?php echo htmlspecialchars($article['body']); ?></p>
																		</div>
																		<div class="we-video-info">
																			<ul>
																				<li>
																					<form method="GET" action="editArticle.php">
																						<input type="hidden" name="id" value="<?php echo $article['id']; ?>">
																						<input type="hidden" name="userId" value="<?php echo $article['userId']; ?>">
																						<button type="submit" class="mtr-btn"><span>Edit</span></button>
																					</form>
																				</li>
																				<li>
																					<form method="POST" action="deleteArticle.php" onsubmit="return confirm('Are you sure you want to delete this article?');">
																						<input type="hidden" name="id" value="<?php echo $article['id']; ?>">
																						<input type="hidden" name="userId" value="<?php echo $article['userId']; ?>">
																						<button type="submit" class="mtr-btn"><span>Delete</span></button>
																					</form>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													
												<?php endif; ?>
											<?php endforeach; ?>
										<?php else: ?>
											<p>No articles found.</p>
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

	</div>
</body>

</html>