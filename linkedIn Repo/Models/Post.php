<?php 

class Post 
{
    private $id;
    private $content; 
    private $imagePath;
    private $userId;
    private $createdAt;

    // ID
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    // Content
    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }

    // Image Path
    public function getImagePath()
    {
        return $this->imagePath;
    }
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    // User ID
    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    // Created At
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}
?>
