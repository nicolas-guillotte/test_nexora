<?php

class User extends CoreModel
{
    private $password;
    private $firstname;
    private $lastname;
    private $picture;

    // Active Record : des méthodes utilitaires (find(), findAll(), etc.) pour récupérer des enregistrements depuis la BDD

    // la méthode find() permet de récupérer une marque en fonction de son $id
    public function find($id)
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `user` WHERE `id` = " . $id;
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchObject("User");
        return $result;
    }

    public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `user`";
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, "User");
        return $results;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }
}