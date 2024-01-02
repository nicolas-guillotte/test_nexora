<?php

class Message extends CoreModel
{
    private $sender_id;
    private $receiver_id;
    private $text;

    public function find($id)
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `message` WHERE `id` = " . $id;
        $pdoStatement = $pdo->query($sql);
        $result = $pdoStatement->fetchObject("Message");
        return $result;
    }

    public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `message`";
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Message");
        return $results;
    }

    public function getMessagesForChat($sender_id, $receiver_id) {
        $pdo = Database::getPDO();
        $sql = "SELECT *
                FROM message
                WHERE (sender_id = $sender_id AND receiver_id = $receiver_id)
                OR (sender_id = $receiver_id AND receiver_id = $sender_id)
                ORDER BY created_at ASC;
        ";
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, "Message");
        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `message` (sender_id, receiver_id, text)
            VALUES (:sender_id, :receiver_id, :text)
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':sender_id', $this->sender_id);
        $stmt->bindParam(':receiver_id', $this->receiver_id);
        $stmt->bindParam(':text', $this->text);

        $status = $stmt->execute();

        if ($status) {
            $this->id = $pdo->lastInsertId();

            return true;
        }

        return false;
    }

    /**
     * Get the value of sender_id
     */ 
    public function getSender_id()
    {
        return $this->sender_id;
    }

    /**
     * Set the value of sender_id
     *
     * @return  self
     */ 
    public function setSender_id($sender_id)
    {
        $this->sender_id = $sender_id;

        return $this;
    }

    /**
     * Get the value of receiver_id
     */ 
    public function getReceiver_id()
    {
        return $this->receiver_id;
    }

    /**
     * Set the value of receiver_id
     *
     * @return  self
     */ 
    public function setReceiver_id($receiver_id)
    {
        $this->receiver_id = $receiver_id;

        return $this;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}