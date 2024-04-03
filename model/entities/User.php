<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity{

    private $id_user;
    private $username;
    private $email;
    private $password;
    private $registerDate;
    private $role;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id_user;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id_user){
        $this->id_user = $id_user;
        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername(){
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username){
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email){
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword(){
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password){
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of registerDate
     */ 
    public function getRegisterDate(){
        return $this->registerDate;
    }

    /**
     * Set the value of registerDate
     *
     * @return  self
     */ 
    public function setRegisterDate($registerDate){
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole(){
        return $this->role;
    }
    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role){
        $this->role = $role;

        return $this;
    }

    public function hasRole($role){
        if($this->getRole() == $role){
            return true;
        }
    }

    public function __toString() {
        return $this->username;
    }
}