<?php

require_once '../../Services/AddMedia.php';
require_once '../../Models/Post.php';
require_once '../../Repositories/PostRepository.php';
require_once '../../IRepositories/IPostRepository.php';
class PostController
{
    public IPostRepository $_postRepository;

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
                $post->setImagePath($mediaPath ?? NULL);
            }
            $post->setUserId($_SESSION['userId']);
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
        $post->setId($result[0]['id']) ;
        $post->setContent($result[0]['content']) ;
        $post->setImagePath($result[0]['imagePath']) ;
        $post->setCreatedAt($result[0]['createdAt']) ;
        $post->setUserId($result[0]['userId']) ;
        return $post;
    }

    public function editPost($post)
    {
        $mediaPath = AddMedia::upload('imagePath');
            if ($mediaPath !== null) {
                $post->setImagePath($mediaPath) ;
            } else {
                $post->setImagePath($_POST['imagePath']) ;
            }
            $post->setContent($_POST['content']) ;
            $result = $this->_postRepository->editPostQuery($post);
            return $result; 

    }

    public function deletePost($id)
    {

        
        $result = $this->_postRepository->deletePostQuery($id);
        return $result;
    }

}
