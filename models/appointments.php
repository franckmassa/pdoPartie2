<?php

/**
 * Création de la classe appointments
 */
class appointments {

    //Liste des attributs
    private $connexion;
    public $id;
    public $dateHour;
    public $idPatients;

    /**
     * Méthode construct
     */
    public function __construct() {
        //On test les erreurs avec le try/catch 
        //Si tout est bon, on est connecté à la base de donnée
        try {
            $this->connexion = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'franck', 'Piment98');
        }
        //Autrement, un message d'erreur est affiché
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

// Exercice 5
    /**
     * Méthode  addAppointment pour récupérer le résultat de la requête
     * @return type
     */
    public function addAppointment() {
        $query = 'INSERT INTO `appointments`(`dateHour`, `idPatients`) '
                . 'VALUES (:dateHour, :idPatients)';
        $insertRendezVous = $this->connexion->prepare($query);
        $insertRendezVous->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $insertRendezVous->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $insertRendezVous->execute();
    }

    /**
     * Méthode checkIfAppointmentExist pour contrôler si il y a déjà un rendez-vous de programmer
     * @return boolean 
     */
    public function checkIfAppointmentExist() {
        $query = 'SELECT COUNT(`id`) AS `count` FROM `appointments` WHERE `dateHour` = :dateHour ';
        $check = $this->connexion->prepare($query);
        // bindvalue donne une valeur au marqueur nominatif
        $check->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        // Si $check est vérifié, on récupère la valeur dateHour dans la variable $result avec fetch
        if ($check->execute()) {
            $result = $check->fetch(PDO::FETCH_OBJ);
            // On met le résultat 0 ou 1 dans $bool 
            $bool = $result->count;
            // Sinon on retourne le résultat faux
        } else {
            $bool = FALSE;
        }
        // et on retourne le résultat
        return $bool;
    }

// Exercice 6
    /**
     * Méthode  getAppointmentsList pour récupérer le résultat de la requête
     * @return type
     */
    public function getAppointmentsList() {
        $result = array();
        $PDOResult = $this->connexion->query('SELECT `appointments`.`id`, `appointments`.`dateHour`, `appointments`.`idPatients`, `patients`.`id`, `patients`.`lastname`, `patients`.`firstname` '
                . 'FROM `appointments` INNER JOIN `patients` ON `appointments`.`id` = `patients`.`id`');
        if (is_object($PDOResult)) {
            $result = $PDOResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * CORRECTION DE FABIEN
     * Méthode pour afficher la liste des rendez-vous (Affichage liste rendez-vous)
     * @return string

      public function appointmentList(){
      //préparation de la requête SQL
      //Première solution avec DATE_FORMAT simple
      //$query = 'SELECT `id`, DATE_FORMAT(`dateHour`, \'Le %d/%m/%Y à %Hh%i\') AS `dateHour`, `idPatients` FROM `appointments`';
      //Seconde solution avec DATE_FORMAT éclaté
      $query = 'SELECT `id`, DATE_FORMAT(`dateHour`, \'%d/%m/%Y\') AS `date`, DATE_FORMAT (`dateHour`, \'%Hh%i\') AS `hour`, `idPatients` FROM `appointments`';
      //On appelle la requête pour la plasser dans une variable $listAppointments
      $listAppointments = $this->connexion->query($query);
      //Création d'un tableau $isObjectResult qui servira pour la vérification qui va suivre
      $isObjectResult = array();
      //Condition pour vérifier que la variable est bien un objet
      if (is_object($listAppointments)) {
      //On affiche tout le contenu du résulat de la requête avec fetchAll
      $isObjectResult = $listAppointments->fetchAll(PDO::FETCH_OBJ);
      }
      //On retourne le résultat
      return $isObjectResult;
      }
      /**
     * CORRECTION MAXIME
     * public function getShowAppointmentsList() {
      $isObjectResult = array();
      $PDOResult = $this->connexion->query('SELECT `appointments`.`id`, `appointments`.`dateHour`, `patients`.`lastname`, `patients`.`firstname`, `appointments`.`idPatients` FROM `appointments` INNER JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id`');
      if (is_object($PDOResult)) {
      $isObjectResult = $PDOResult->fetchAll(PDO::FETCH_OBJ);
      }
      return $isObjectResult;
      }
        */

   // exercice 7
    public function getAppointmentById() {
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, \'%Y-%m-%d\') AS `date`, DATE_FORMAT(`appointments`.`dateHour`, \'%H:%i\') AS `hour`, `appointments`.`idPatients` '
                . 'FROM `appointments` '
                . 'WHERE `appointments`.`id` = :id';
        $AppointmentDetails = $this->connexion->prepare($query);
        $AppointmentDetails->bindValue(':id', $this->id, PDO::PARAM_INT);
        $AppointmentDetails->execute();
        if (is_object($AppointmentDetails)) {
            $getAppointmentsDetails = $AppointmentDetails->fetch(PDO::FETCH_OBJ);
            // fetch uniquement pour le select
        }
        return $getAppointmentsDetails;
    }
    // exercice 8
    public function updateAppointment() {
        $query = 'UPDATE `appointments` '
                . 'SET `dateHour` = :dateHour, `idPatients` = :idPatients '
                . 'WHERE `id` = :id';
        $updatePatient = $this->connexion->prepare($query);
        // id en dernier pour l'avoir dans le sens de la requete
        
        $updatePatient->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $updatePatient->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        $updatePatient->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $updatePatient->execute();
    }
    public function __destruct() {
        $this->connexion = NULL;
    }

}
