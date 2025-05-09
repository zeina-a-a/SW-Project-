<?php
require_once '../../Models/Post.php';

interface IPostRepository
{
    public function getAllPostsQuery();
    public function addPostQuery($post);
    public function getPostQuery($id);
    public function editPostQuery($post);
    public function deletePostQuery($id);
}