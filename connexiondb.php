<?php
class ConnexionDB {
    private $host    = "localhost";  // Nom de l'hôte
    private $name    = "gogifty";    // Nom de la base de données
    private $user    = "root";       // Nom d'utilisateur
    private $pass    = "250920";     // Mot de passe (peut-être vide sous Windows)
    private $connexion;

    function __construct($host = null, $name = null, $user = null, $pass = null) {
        if ($host != null) {
            $this->host = $host;
            $this->name = $name;
            $this->user = $user;
            $this->pass = $pass;
        }

        // Création de la connexion MySQLi
        $this->connexion = new mysqli($this->host, $this->user, $this->pass, $this->name);

        // Vérification de la connexion
        if ($this->connexion->connect_error) {
            die("Erreur de connexion à la base de données : " . $this->connexion->connect_error);
        }
    }

    public function connexion() {
        return $this->connexion;
    }
}

$DB = new ConnexionDB;

$your_db_connection = $DB->connexion();
?>
