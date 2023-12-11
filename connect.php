<?php

class connect
{
    //Definition des credentials correspondant au serveur permettant l'accès et la connexion à la base de données
    private $host = 'localhost';
    private $dbname = 'sandboxnews';
    private $username = 'root';
    private $password = 'root'; // Mot de passe à modifier en fonction de votre configuration (Usage de MAMP dans ce cas)
    public $conn; // Variable de connexion à la base de données
// Connexion à la base de données
    public function connect()
    {
        $this->conn = null; // Initialisation de la connexion à null
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username,
                $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connexion réussie';
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
        }
        return $this->conn; // Retourne la connexion à la base de données
    }
}