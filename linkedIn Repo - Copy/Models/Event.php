<?php

class Event {
    private $id;
    private $title;
    private $description;
    private $postedBy;
    private $imagePath;
    private $userId;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPostedBy()
    {
        return $this->postedBy;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPostedBy($postedBy)
    {
        $this->postedBy = $postedBy;
    }
    
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}

?> 
