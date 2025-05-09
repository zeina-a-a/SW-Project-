<?php
require_once 'BaseRepository.php';
require_once '../../Services/AddMedia.php';
require_once '../../Models/Post.php';

class PostRepository extends BaseRepository
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
        $query = "insert into posts (content, userId, createdAt,imagePath) VALUES ('$post->content',$post->userId,NOW(),'$post->imagePath')";
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
        $query = "update posts set content = '$post->content', imagePath = '$post->imagePath',createdAt = NOW() where id = '$post->id'";
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
