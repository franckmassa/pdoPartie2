<?php

include 'models/patients.php';

$removePatient = NEW patients();
if (isset($_POST['submit'])) {
    if (isset($_GET['idRemove'])) {
        $removePatient->id = $_GET['idRemove'];
        $removePatientRow = $removePatient->removePatient();
    }
}
   $listPatientObject = new patients();
//Si $_POST['nameAsked'] n'est pas vide
    if (!empty($_POST['nameAsked']))
    {   //Déclaration de la variable $search qui est égale a $_POST['nameAsked']
        $search = htmlspecialchars($_POST['nameAsked']);
        //strip_tags — Supprime les balises HTML et PHP d'une chaîne
        $search = strip_tags($search);
        //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
        $search = trim($search);
        $lastnameRegex = '/^[a-z _\'\-àâäéèêëîïôöûüùçæ]*$/i';
        if (preg_match($lastnameRegex, $search))
        {
            //Association de la valeur de la variable $search a l'attribut $lastname de l'instance $listPatientObject
            //$listPatientObject->lastname = $search;
            //Éxécution de la méthode findPatientByLastname() de l'instance $listPatientObject et intégration dans $listPatients
            $listPatients = $listPatientObject->findPatientByLastname($search);
        }
        else
        {
            $error = 'Recherche invalide';
        }
    }//Sinon
    else
    {   //Éxécution de la méthode getListPatient() de l'instance $listPatientObject et intégration dans $listPatients
     
        $listPatients = $listPatientObject->getPatientsList();
    }


