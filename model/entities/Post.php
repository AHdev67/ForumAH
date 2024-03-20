<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Topic extends Entity{

    private $id_post;
    private $content;
    private $creationDate;
    private $user_id;
    private $topic_id;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id_post;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id_post){
        $this->id_post = $id_post;
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

    public function __toString(){
        return $this->content;
    }
}