<?php 

// src/Entity/Content.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="content")
 */
class Content {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    //* @Assert\NotBlank()
    
    /**
    * @ORM\Column(type="string", length=100)
    */
    private $title;
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    /**
     * @ORM\Column(type="text")
     */
    private $content;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;
    /**
    * @ORM\Column(type="string", length=15)
    */
    private $status = 'Pending';
    /**
     * @ORM\Column(type="integer")
     */
    private $userId;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    //Getters and Setters

    /**
    * @return mixed
    */
    public function getId()
    { 
        return $this->id; 
    }
    /**
    * @param mixed $id
    */
    public function setId($id)
    { 
        $this->id = $id; 
    }

    /**
    * @return mixed
    */
    public function getTitle()
    {
        return $this->title;
    }
    /**
    * @param mixed $title
    */
    public function setTitle($title)
    {
        if (\strlen($title) < 5) {
            throw new \InvalidArgumentException('Title needs to have 5 or more characters.');
        }

        $this->title = $title;
    }
    /**
    * @return mixed
    */
    public function getDescription()
    {
        return $this->description;
    }
    /**
    * @param mixed $description
    */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    /**
    * @return mixed
    */
    public function getContent()
    {
        return $this->content;
    }
    /**
    * @param mixed $content
    */
    public function setContent($content)
    {
        $this->content = $content;
    }
    /**
    * @return mixed
    */
    public function getEmail()
    {
        return $this->email;
    }
    /**
    * @param mixed $email
    */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    /**
    * @return mixed
    */
    public function getStatus()
    {
        return $this->status;
    }
    /**
    * @param mixed $status
    */
    public function setStatus($status)
    {
        $this->status = $status;
    }
    /**
    * @return mixed
    */
    public function getUserId()
    {
        return $this->userId;
    }
    /**
    * @param mixed $userId
    */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    /**
    * @return mixed
    */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
    * @param mixed $createdAt
    */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime($createdAt);
    }
    /**
    * @return mixed
    */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
    * @param mixed $updatedAt
    */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = new \DateTime($updatedAt);
    }



}
