<?php 

class User {
    private $id;
    private $name;
    private $username;
    private $email;
    private $password;
    // private $createdAt;
    private $profilePhoto;//profile photo
    private $isEmployer;
    private $isPremium; 
    private $coverPhoto;
    private $connectionCount;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    // Name
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    // Username
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }

    // Email
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    // Password
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Profile Photo
    public function getProfilePhoto()
    {
        return $this->profilePhoto;
    }
    public function setProfilePhoto($profilePhoto)
    {
        $this->profilePhoto = $profilePhoto;
    }

    // Is Employer
    public function getIsEmployer()
    {
        return $this->isEmployer;
    }
    public function setIsEmployer($isEmployer)
    {
        $this->isEmployer = $isEmployer;
    }

    // Is Premium
    public function getIsPremium()
    {
        return $this->isPremium;
    }
    public function setIsPremium($isPremium)
    {
        $this->isPremium = $isPremium;
    }

    // Cover Photo
    public function getCoverPhoto()
    {
        return $this->coverPhoto;
    }
    public function setCoverPhoto($coverPhoto)
    {
        $this->coverPhoto = $coverPhoto;
    }

    // Connection Count
    public function getConnectionCount()
    {
        return $this->connectionCount;
    }
    public function setConnectionCount($connectionCount)
    {
        $this->connectionCount = $connectionCount;
    }
}
?>