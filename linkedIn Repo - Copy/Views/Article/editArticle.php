<?php
require_once '../../Controllers/ArticleController.php';
require_once '../shared/sessionControl.php';
require_once '../../Models/Article.php';
$articleController = new ArticleController();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['body'])) {
   
	$id = $_POST['id'];
	$article = new Article();
	$article = $articleController->getArticleById($id);
	$result = $articleController->updateArticle($article);

	if ($result) {
		header('Location: Article.php');
		exit();
	} else {
		$error = "Failed to update article";
	}
}

if (isset($_GET['id']) && isset($_GET['userId'])) {
	if($_GET['userId'] == $userId)
	{
		$id = $_GET['id'];
		$article = new Article();
		$article = $articleController->getArticleById($id);
	}
	if (!$article) {
		header('Location: Article.php');
		exit();
	}
} 
else {
	header('Location: Article.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" body="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Edit Article</title>
    <link rel="stylesheet" href="../../Assets/css/main.min.css">
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <link rel="stylesheet" href="../../Assets/css/color.css">
    <link rel="stylesheet" href="../../Assets/css/responsive.css">
</head>
<body>
    <div class="theme-layout">
        <?php require_once '../shared/header.php'; ?>
        <section>
            <div class="gap gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row" id="page-bodys">
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-6">
                                    <div class="central-meta item">
                                        <div class="new-articlebox">
                                            <div class="newpst-input">
                                                <form method="post" action="editArticle.php">
                                                    <input type="hidden" name="id" value="<?php echo $article->getId(); ?>">
                                                    <input type="text" name="title" value="<?php echo htmlspecialchars($article->getTitle()); ?>" required class="form-control mb-2">
                                                    <textarea rows="4" name="body" required class="form-control"><?php echo htmlspecialchars($article->getBody()); ?></textarea>
                                                    <div class="attachments">
                                                        <ul>
                                                            <li>
                                                                <button type="submit" class="btn btn-primary">Update Article</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>
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
    </div>
</body>
</html> 