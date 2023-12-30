<?php

/**
 * Classe CoreModel
 * cette classe sera héritée par tous les modèles de notre application
 * 
 * on y met donc toutes les propriétés & méthodes communes à chaque modèle
 */
class CoreModel
{
    protected $id;
    protected $created_at;
    protected $db; // Nouvelle propriété pour stocker la connexion à la base de données

    public function __construct()
    {
        // Initialisez $this->db avec votre objet de connexion à la base de données
        $this->db = Database::getPDO(); // Assurez-vous que la classe Database est correctement définie
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}