<?php
require_once 'BaseRepository.php';
require_once '../../Services/AddMedia.php';
require_once '../../Models/Post.php';
require_once '../../IRepositories/IPostRepository.php';
class PostRepository extends BaseRepository implements IPostRepository
{

    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllPostsQuery()
    {

        $query = "SELECT posts.id, posts.content, posts.createdAt ,posts.imagePath,posts.userId ,
                        users.name AS authorName, users.profilePhoto AS authorImage
                FROM posts 
                JOIN users ON posts.userId = users.id ORDER BY createdAt DESC";
        $result = $this->select($query);
        if ($result != false) {
            return $result;
        }
        $_SESSION["errorMsg"] = " ERROR..please try again ";
        return false;
    }

    public function addPostQuery($post)
    {
        $query = "INSERT INTO posts (content, userId, createdAt, imagePath)
          VALUES ('{$post->getContent()}', {$post->getUserId()}, NOW(), '{$post->getImagePath()}')";

        $result = $this->insert($query);
        if ($result != false) {
            return true;
        }
        return false;
    }

    public function getPostQuery($id)
    {

        $query = "select * from posts where id = $id";
        $result = $this->select($query);
        if ($result === false) {
            return false;
        }
        else if (count($result) > 0){
            return $result; 
        }
        return false; 
    }

    public function editPostQuery($post)
    {
        $query = "update posts set content = '{$post->getContent()}' , imagePath = '{$post->getImagePath()}',createdAt = NOW() where id = '{$post->getId()}'";
            $result = $this->update($query);
            return $result;
    }

    public function deletePostQuery($id)
    {
        $query = "delete from posts where id = $id";
            $result = $this->delete($query);
            if ($result === false) {
                return false;
            }
            return true;
    }
}
