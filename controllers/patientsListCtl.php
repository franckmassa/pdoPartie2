<?php

include 'models/patients.php';
// Instanciation de l'objet $patient
$patient = new patients();
$patientsList = $patient->getPatientsList();
