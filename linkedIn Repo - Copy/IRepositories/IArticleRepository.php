<?php
interface IArticleRepository
{
    public function getAllArticlesQuery();
    public function publishArticleQuery($article);
    public function getArticleQuery($id);
    public function editArticleQuery($article);
    public function deleteArticleQuery($id);
}
?> 