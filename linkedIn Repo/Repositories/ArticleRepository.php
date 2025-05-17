<?php
require_once 'BaseRepository.php';
require_once '../../Models/Article.php';
require_once '../../IRepositories/IArticleRepository.php';

class ArticleRepository extends BaseRepository implements IArticleRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllArticlesQuery()
    {
        $query = "SELECT articles.id, articles.title, articles.body, articles.author, articles.timestamp AS timeStamp, articles.userId,
                         users.name AS authorName, users.profilePhoto AS authorImage
                  FROM articles
                  JOIN users ON articles.userId = users.id
                  ORDER BY articles.timestamp DESC";
        return $this->select($query);
    }

    public function publishArticleQuery($article)
    {
        $query = "INSERT INTO articles (title, body, author, timeStamp, userId) 
                 VALUES (
                    '{$article->getTitle()}',
                    '{$article->getBody()}',
                    '{$article->getAuthor()}',
                    NOW(),
                    {$article->getUserId()}
                 )";
        return $this->insert($query);
    }

    public function getArticleQuery($id)
    {
        $query = "SELECT * FROM articles WHERE id = $id";
        $result = $this->select($query);
        if ($result && count($result) > 0) {
            $article = new Article();
            $article->setId($result[0]['id']);
            $article->setTitle($result[0]['title']);
            $article->setBody($result[0]['body']);
            $article->setAuthor($result[0]['author']);
            $article->setTimeStamp($result[0]['timeStamp']);
            $article->setUserId($result[0]['userId']);
            return $article;
        }
        return false;
    }



    public function editArticleQuery($article)
    {
        $query = "update articles set title = '{$article->getTitle()}' , body = '{$article->getBody()}',timeStamp = NOW() where id = '{$article->getId()}'";
            $result = $this->update($query);
            return $result;
    }

    public function deleteArticleQuery($id)
    {
        $query = "DELETE FROM articles WHERE id = $id";
        return $this->delete($query);
    }
}
?> 