<?php

require_once '../../Controllers/DBController.php';
require_once '../../Services/AddMedia.php';
require_once '../../Models/Article.php';

class ArticleController
{
    protected $db;
    
    public function getAllArticles()
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "SELECT articles.id, articles.title, articles.author, articles.body, articles.userId,
                        users.name AS authorName, users.profilePhoto AS authorImage
                    FROM articles
                    JOIN users ON articles.userId = users.id";
            return $this->db->select($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function addArticle($article)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $article->userId = $_SESSION['userId'];
            
            // Get user information for author name
            $userQuery = "SELECT name FROM users WHERE id = " . (int)$article->userId;
            $userResult = $this->db->select($userQuery);
            $authorName = $userResult[0]['name'];
            
            // Sanitize inputs to prevent SQL injection
            $title = mysqli_real_escape_string($this->db->connection, $article->title);
            $body = mysqli_real_escape_string($this->db->connection, $article->body);
            $author = mysqli_real_escape_string($this->db->connection, $authorName);
            $userId = (int)$article->userId;
            
            $query = "INSERT INTO articles (body, title, author, userId) 
                    VALUES ('$body', '$title', '$author', $userId)";
            
            $result = $this->db->insert($query);
            if (!$result) {
                echo "Error in insertion: " . mysqli_error($this->db->connection);
            }
            return $result;
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
    public function editArticle($article)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            // $mediaPath = AddMedia::upload('imagePath');
            // if ($mediaPath !== null) {
            //     $article->imagePath = $mediaPath;
            // } else {
            //     $article->imagePath = $_POST['imagePath'];
            // }
            $article->content = $_POST['content'];
            $query = "update articles set content = '$article->content',createdAt = NOW() where id = '$article->id'";
            $result = $this->db->update($query);
            return $result;
        }
        return false;
    }

    public function deleteArticle($articleId, $userId)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            // First verify that the article belongs to the user
            $checkQuery = "SELECT userId FROM articles WHERE id = " . (int)$articleId;
            $result = $this->db->select($checkQuery);
            
            if ($result && $result[0]['userId'] == $userId) {
                $query = "DELETE FROM articles WHERE id = " . (int)$articleId;
                return $this->db->delete($query);
            }
            return false;
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function getArticleById($articleId)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "SELECT articles.id, articles.title, articles.body, articles.userId,
                        users.name AS authorName, users.profilePhoto AS authorImage
                    FROM articles
                    JOIN users ON articles.userId = users.id
                    WHERE articles.id = " . (int)$articleId;
            $result = $this->db->select($query);
            return $result ? $result[0] : false;
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function updateArticle($article)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $checkQuery = "SELECT userId FROM articles WHERE id = " . (int)$article->id;
            $result = $this->db->select($checkQuery);
            
            if ($result && $result[0]['userId'] == $_SESSION['userId']) {
                $title = mysqli_real_escape_string($this->db->connection, $article->title);
                $body = mysqli_real_escape_string($this->db->connection, $article->body);
                $id = (int)$article->id;
                
                $query = "UPDATE articles SET title = '$title', body = '$body' WHERE id = $id";
                $updateResult = $this->db->update($query);
                return $updateResult;
            }
            return false;
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
}

