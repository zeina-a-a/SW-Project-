<?php

require_once '../../Repositories/ArticleRepository.php';
require_once '../../IRepositories/IArticleRepository.php';
require_once '../../Models/Article.php';

class ArticleController
{
    public IArticleRepository $_articleRepository;

    public function __construct()
    {
        $this->_articleRepository = new ArticleRepository();
    }

    public function getAllArticles()
    {
        return $this->_articleRepository->getAllArticlesQuery();
    }

    public function addArticle($article)
    {
        $article->setUserId($_SESSION['userId']);
        return $this->_articleRepository->publishArticleQuery($article);
    }

    public function editArticle($article)
    {
        // $article->setAuthor($_POST['author']);
        return $this->_articleRepository->editArticleQuery($article);
    }

    public function deleteArticle($articleId, $userId)
    {
        // First verify that the article belongs to the user
        $article = $this->_articleRepository->getArticleQuery($articleId);
        if ($article && $article->getUserId() == $userId) {
            return $this->_articleRepository->deleteArticleQuery($articleId);
        }
        return false;
    }

    public function getArticleById($articleId)
    {
        return $this->_articleRepository->getArticleQuery($articleId);
    }

    public function updateArticle($article)
    {
        $article->setBody($_POST['body']);
        $article->setTitle($_POST['title']);
        $result = $this->_articleRepository->editArticleQuery($article);
        return $result;
    }
}
