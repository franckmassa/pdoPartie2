<?php
include 'models/patients.php';
include 'models/appointments.php';
// On instancie l'objet $appointment
$appointment = new appointments();
// On appelle la méthode getAppointmentsList
$appointmentList = $appointment->getAppointmentsList();
