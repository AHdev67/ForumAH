<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Topic extends Entity{

    private $id_topic;
    private $title;
    private $content;
    private $creationDate;
    private $user_id;
    private $category_id;
    private $closed;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id_topic;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id_topic){
        $this->id_topic = $id_topic;
        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle(){
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

     /**
     * Get the value of content
     */ 
    public function getContent(){
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content){
        $this->content = $content;
        return $this;
    }

    /**
     * Get the value of creationDate
     */ 
    public function getCreationDate(){
        return $this->creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */ 
    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser(){
        return $this->user_id;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user_id){
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * Get the value of category_id
     */ 
    public function getCategory_id(){
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */ 
    public function setCategory_id($category_id){
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of closed
     */ 
    public function getClosed(){
        return $this->closed;
    }

    /**
     * Set the value of closed
     *
     * @return  self
     */ 
    public function setClosed($closed){
        $this->closed = $closed;

        return $this;
    }

    public function __toString(){
        return $this->title;
    }
}