<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    public function findUserByEmail($email) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.email = :email";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false), 
            $this->className
        );
    }

    public function findUserByUsername($username) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.username = :username";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['username' => $username]), 
            $this->className
        );
    }

    public function updateUser($data, $id){
        $sql = "UPDATE user
                SET
                    ".$data."
                    
                WHERE user.id_user = :id";
        
        return DAO::update($sql, ['id' => $id]);
    }
}