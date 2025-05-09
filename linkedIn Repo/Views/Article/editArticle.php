<?php
require_once '../../Controllers/ArticleController.php';
require_once '../shared/sessionControl.php';

$articleController = new ArticleController();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $article = new Article();
    $article->id = $_POST['id'];
    $article->title = $_POST['title'];
    $article->body = $_POST['body'];

    $result = $articleController->updateArticle($article);
    if ($result) {
        header('Location: Article.php');
        exit();
    } else {
        $error = "Failed to update article";
    }
}

// Get article data for editing
if (isset($_GET['id'])) {
    $article = $articleController->getArticleById($_GET['id']);
    if (!$article || $article['userId'] != $_SESSION['userId']) {
        header('Location: Article.php');
        exit();
    }
} else {
    header('Location: Article.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <div class="row" id="page-contents">
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-6">
                                    <div class="central-meta item">
                                        <div class="new-postbox">
                                            <div class="newpst-input">
                                                <form method="post" action="editArticle.php">
                                                    <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                                                    <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required class="form-control mb-2">
                                                    <textarea rows="4" name="body" required class="form-control"><?php echo htmlspecialchars($article['body']); ?></textarea>
                                                    <div class="attachments">
                                                        <ul>
                                                            <li>
                                                                <button type="submit">Update Article</button>
                                                            </li>
                                                            <li>
                                                                <a href="Article.php" class="btn btn-secondary">Cancel</a>
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