<?php
class ShowcasePage
{
    private $id;
    private $title;
    private $body;
    private $website;
    private $industry;
    private $imagePath;
    private $userId;

    // ID
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    // Title
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }

    // Body
    public function getBody()
    {
        return $this->body;
    }
    public function setBody($body)
    {
        $this->body = $body;
    }

    // Website
    public function getWebsite()
    {
        return $this->website;
    }
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    // Industry
    public function getIndustry()
    {
        return $this->industry;
    }
    public function setIndustry($industry)
    {
        $this->industry = $industry;
    }

    // ImagePath
    public function getImagePath()
    {
        return $this->imagePath;
    }
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    // UserId
    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
?>