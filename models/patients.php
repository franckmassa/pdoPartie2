<?php

/** On déclare la classe patients */
class patients {

    /**
     * Les attributs
     * @var type 
     */
    private $connexion;
    public $id;
    public $lastname;
    public $firstname;
    public $birthdate;
    public $phone;
    public $mail;

    /**
     *  On utilise la methode magique __contruct pour se connecter
     */
    public function __construct() {
        /**
         * On test les erreurs avec le try/catch 
         * Si tout est bon, on est connecté à la base de donnée
         */
        try {
            $this->connexion = NEW PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'franck', 'Piment98');
        }
        /**
         *  Autrement, un message d'erreur est affiché
         */ catch (Exception $e) {
            die($e->getMessage());
        }
    }

// Exercice 1
    /**
     * La methode permet d'ajouter des patients à la liste 
     * @return type
     */
    public function addPatient() {
        $query = 'INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`) '
                . 'VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
        $insertPatient = $this->connexion->prepare($query);
        $insertPatient->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $insertPatient->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $insertPatient->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $insertPatient->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $insertPatient->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $insertPatient->execute();
    }
    
// Exercice 2
    /** Méthode getPatientsList pour récupérer le résultat de la requête pour la liste des patients
     * Afichage d'un tableau vide en cas d'erreur, pour plus de clareté pour l'utilisateur 
     */
    public function getPatientsList() {
        $result = array();
        $PDOResult = $this->connexion->query('SELECT `id`, `lastname`, `firstname` FROM `patients`');
        if (is_object($PDOResult)) {
            $result = $PDOResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }
    
// Exercice 3
    /**
     *  Méthode getProfilList pour récupérer le résultat de la requête pour le profil du patient
     * On prépare la requête qui retourne un objet
     */
    public function getProfilById() {
        $PDOResult = $this->connexion->prepare('SELECT `id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail` '
                . 'FROM `patients` '
                . 'WHERE `id` = :id'); // :id marqueur nominatif car id est une inconnue
        // bindvalue Associe une valeur à un paramètre (marqueur nominatif), this se réfère à tous les attributs de la classe
        $PDOResult->bindvalue(':id', $this->id, PDO::PARAM_INT);
        /** On execute la requête
         */
        $PDOResult->execute();
        if (is_object($PDOResult)) {
            /**
             * On utilise fetch pour la récupération d'une seule valeur
             */
            $result = $PDOResult->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }
// Exercice 4
    public function updatePatientProfil() {
        $query = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail WHERE `id` = :id';
        $modifyPatient = $this->connexion->prepare($query);
        $modifyPatient->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $modifyPatient->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $modifyPatient->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $modifyPatient->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $modifyPatient->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $modifyPatient->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $modifyPatient->execute();
    }

    // On ferme la connexion
    public function __destruct() {
        $this->connexion = NULL;
    }

}
