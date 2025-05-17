<?php

require_once 'BaseRepository.php';
require_once '../../Services/AddMedia.php';
require_once '../../Models/showcasepage.php';
require_once '../../IRepositories/IShowcaseRepository.php';
class ShowcaseRepository extends BaseRepository implements IShowcaseRepository
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }


    public function getAllShowcasePagesQuery()
    {
        $query = "SELECT showcasepage.id, showcasepage.title, showcasepage.body, showcasepage.website, showcasepage.industry, showcasepage.imagePath, showcasepage.userId ,
                users.name AS authorName, users.profilePhoto AS authorImage
        FROM showcasepage 
        JOIN users ON showcasepage.userId = users.id ORDER BY createdAt DESC";
        return $this->select($query);
    }

    public function addShowcasePageQuery($showcasePage)
    {
        $query = "insert into showcasepage (title, body, website, industry, imagePath, userId) VALUES ('{$showcasePage->getTitle()}','{$showcasePage->getBody()}','{$showcasePage->getWebsite()}','{$showcasePage->getIndustry()}','{$showcasePage->getImagePath()}','{$showcasePage->getUserId()}')";

        $result = $this->insert($query);
        if (!$result) {
            return false;
        }
        return $result;
    }

    // public function getShowcasePageQuery($id)
    // {
    //     $query = "select * from showcasepage where id = $id";
    //     $result = $this->select($query);

    //     if ($result === false) {
    //         return false;
    //     }
    //     return $result;
    // }

    public function getShowcasePageByUserIdQuery($userId)
    {
        $query = "SELECT * FROM showcasepage WHERE userId = $userId LIMIT 1";
            $result = $this->select($query);
        return $result; 
    }
}
