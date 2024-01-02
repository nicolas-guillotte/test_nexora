<?php

class User extends CoreModel
{
    private $password;
    private $firstname;
    private $lastname;
    private $picture;
    private $email;

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

    public function insert(User $user)
    {
        $pdo = Database::getPDO();
    
        $sql = "
            INSERT INTO `user` (firstname, lastname, email, picture, password)
            VALUES (:firstname, :lastname, :email, :picture, :password)
        ";
    
        $stmt = $pdo->prepare($sql);
    
        $firstnameValue = $user->getFirstname();
        $lastnameValue = $user->getLastname();
        $emailValue = $user->getEmail();
        $passwordValue = $user->getPassword();
        $pictureValue = $user->getPicture();
    
        $stmt->bindParam(':firstname', $firstnameValue);
        $stmt->bindParam(':lastname', $lastnameValue);
        $stmt->bindParam(':email', $emailValue);
        $stmt->bindParam(':password', $passwordValue);
        $stmt->bindParam(':picture', $pictureValue);
    
        $status = $stmt->execute();
    
        return $status;
    }
    
    public function findByEmail($email)
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `user` WHERE `email` = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchObject("User");

        return $result;
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

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}