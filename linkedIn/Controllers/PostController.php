<?php

require_once '../../Controllers/DBController.php';
require_once '../../Services/AddMedia.php';
require_once '../../Models/Post.php';

class postController
{
    protected $db;

    public function getAllPosts()
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "SELECT posts.id, posts.content, posts.createdAt ,posts.imagePath,posts.userId ,
                        users.name AS authorName, users.profilePhoto AS authorImage
                FROM posts 
                JOIN users ON posts.userId = users.id ORDER BY createdAt DESC";
            return $this->db->select($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function addPost($post)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $mediaPath = AddMedia::upload('imagePath');
            if ($mediaPath === false) {
                $errorMsg = "Error in media file upload.";
            } else {
                $post->imagePath = $mediaPath ?? NULL;
            }

            $post->userId = $_SESSION['userId'];
            $query = "insert into posts (content, userId, createdAt,imagePath) VALUES ('$post->content',$post->userId,NOW(),'$post->imagePath')";

            return $this->db->insert($query);
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function getPost($id)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $query = "select * from posts where id = $id";
            $result = $this->db->select($query);
            if ($result === false) {
                return false;
            }
            if (count($result) > 0) {
                $post = new Post();
                $post->id = $result[0]['id'];
                $post->content = $result[0]['content'];
                $post->imagePath = $result[0]['imagePath'];
                $post->createdAt = $result[0]['createdAt'];
                $post->userId = $result[0]['userId'];
                return $post;
            }
            return false;
        }
        return false;
    }

    public function editPost($post)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) {
            $mediaPath = AddMedia::upload('imagePath');
            if ($mediaPath !== null) {
                $post->imagePath = $mediaPath;
            } else {
                $post->imagePath = $_POST['imagePath'];
            }
            $post->content = $_POST['content'];
            $query = "update posts set content = '$post->content', imagePath = '$post->imagePath',createdAt = NOW() where id = '$post->id'";
            $result = $this->db->update($query);
            return $result;
        }
        return false;
    }

    public function deletePost($id)
    {
        $this->db = new DBController();
        if ($this->db->openConnection()) 
        {
            $query = "delete from posts where id = $id";
            $result = $this->db->delete($query);
            if ($result === false) {
                return false;
            }
            return true;
        }
    }
}
