<?php

// On crée un moèle database parent
class database {

    protected $db;

    public function __construct() {
        try {
            // On initialise la base de données hospitalE2NS
            $this->db = NEW PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', '');
        }
// Autrement un message d'erreur est affiché
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

// On ferme la connexion
    public function __destruct() {
        $this->db = NULL;
    }

}
