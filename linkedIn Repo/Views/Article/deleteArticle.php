<?php
require_once '../../Controllers/ArticleController.php';
require_once '../shared/sessionControl.php';

$articleController = new ArticleController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['userId'])) {
    $articleId = $_POST['id'];
    $userId = $_POST['userId'];
    
    if ($userId == $_SESSION['userId']) {
        $result = $articleController->deleteArticle($articleId, $userId);
        if ($result) {
            header('Location: Article.php');
            exit();
        }
    }
}

header('Location: Article.php');
exit();
?>