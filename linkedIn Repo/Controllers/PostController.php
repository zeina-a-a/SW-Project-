<?php

require_once '../../Services/AddMedia.php';
require_once '../../Models/Post.php';
require_once '../../Repositories/PostRepository.php';

class PostController
{
    public PostRepository $_postRepository;

    public function __construct()
    {
        $this->_postRepository = new PostRepository();
    }

    public function getAllPosts()
    {

        $result = $this->_postRepository->getAllPostsQuery();
        if(!$result){
            return false;
        }
        return $result; 
    }

    public function addPost($post)
    {
        $mediaPath = AddMedia::upload('imagePath');
            if ($mediaPath === false) {
                $errorMsg = "Error in media file upload.";
            } else {
                $post->imagePath = $mediaPath ?? NULL;
            }
            $post->userId = $_SESSION['userId'];
            $result = $this->_postRepository->addPostQuery($post);
            return $result;
    }

    public function getPost($id)
    {
        $result = $this->_postRepository->getPostQuery($id);
        if(!$result){
            return false; 
        }
        $post = new Post();
        $post->id = $result[0]['id'];
        $post->content = $result[0]['content'];
        $post->imagePath = $result[0]['imagePath'];
        $post->createdAt = $result[0]['createdAt'];
        $post->userId = $result[0]['userId'];
        return $post;
    }

    public function editPost($post)
    {
        $mediaPath = AddMedia::upload('imagePath');
            if ($mediaPath !== null) {
                $post->imagePath = $mediaPath;
            } else {
                $post->imagePath = $_POST['imagePath'];
            }
            $post->content = $_POST['content'];
            $result = $this->_postRepository->editPostQuery($post);
            return $result; 

    }

    public function deletePost($id)
    {


        $result = $this->_postRepository->deletePostQuery($id);
        return $result;
    }

}
