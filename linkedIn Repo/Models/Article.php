<?php
class Article
{
    private $id;
    private $title;
    private $body;
    private $author;
    private $timeStamp;
    private $userId;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getBody()
    {
        return $this->body;
    }
    public function setBody($body)
    {
        $this->body = $body;
    }
    
    public function getAuthor()
    {
        return $this->author;
    }
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getTimeStamp()
    {
        return $this->timeStamp;
    }
    public function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }

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