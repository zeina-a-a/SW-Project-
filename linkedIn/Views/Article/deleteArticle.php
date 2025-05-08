<?php
require_once '../../Controllers/ArticleController.php';
require_once '../shared/sessionControl.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['userId'])) {
    $articleId = $_POST['id'];
    $userId = $_POST['userId'];
    
    // Verify that the logged-in user is the one trying to delete
    if ($userId == $_SESSION['userId']) {
        $articleController = new ArticleController();
        $result = $articleController->deleteArticle($articleId, $userId);
        
        if ($result) {
            header('Location: Article.php');
            exit();
        } else {
            echo "Error deleting article";
        }
    } else {
        echo "Unauthorized to delete this article";
    }
} else {
    echo "Invalid request";
}
?> 