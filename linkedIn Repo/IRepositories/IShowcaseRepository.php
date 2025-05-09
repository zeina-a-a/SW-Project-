<?php
require_once '../../Models/ShowcasePage.php';
interface IShowcaseRepository
{
    public function getAllShowcasePagesQuery();
    
    public function addShowcasePageQuery($showcasePage);
    
    public function getShowcasePageQuery($id);
    
    public function getShowcasePageByUserIdQuery($userId);
    
}
?>