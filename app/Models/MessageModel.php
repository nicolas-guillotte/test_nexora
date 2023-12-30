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

    public function getMessagesBySenderId($sender_id)
    {
        // Supposons que vous ayez une colonne "sender_id" dans votre table "messages"
        $sql = "SELECT * FROM `message` WHERE `sender_id` = :sender_id";
        $params = [":sender_id" => $sender_id];

        $statement = $this->db->prepare($sql);
        $statement->execute($params);

        // Récupérez les résultats comme un tableau associatif
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `message` (sender_id, receiver_id, text)
            VALUES (:sender_id, :receiver_id, :text)
        ";

        // on prépare la requête avec la méthode prepare() de PDO
        $stmt = $pdo->prepare($sql);

        // on "bind" (associe) nos valeurs avec les paramètres dans notre requête
        $stmt->bindParam(':sender_id', $this->sender_id);
        $stmt->bindParam(':receiver_id', $this->receiver_id);
        $stmt->bindParam(':text', $this->text);

        // on exécute la requête préparée avec la méthode execute() de PDO   
        // execute() renvoie true si tout s'est bien passé, false sinon
        // on stocke true ou false dans une variable $status     
        $status = $stmt->execute();

        // Si $status est true
        if ($status) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }

        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
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