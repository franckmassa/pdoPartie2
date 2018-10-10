<?php 
include 'controllers/appointmentListCtl.php'; 
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
        <title>Liste des rendez-vous</title>
    </head>
    <body>
        <?php include 'controllers/controllerNavbar2.php'; ?>
        <div class="container">

            <div class="row">
                <table class="col-md-12 bg-white">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Identifiant Patient</th>
                            <th>Rendez-vous</th>
                            <th>Prendre un rendez-vous</th>
                            <th>Infos rendez-vous</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointmentList as $appointmentListDetail) { ?>
                            <tr>
                                <td><?= $appointmentListDetail->lastname ?></td>
                                <td><?= $appointmentListDetail->firstname ?></td>
                                <th><?= $appointmentListDetail->idPatients ?></th>
                                <th><?= $appointmentListDetail->dateHour ?></th>
                                <!-- On ajoute un lien qui redirige vers la page ajout-rendezvous.php
                                     On rajoute le paramètre id dans l'url et on echo la valeur nominative de l'id 
                                après ? le mot id doit être  dans le get du controleur ajout-rendezvous.php -->
                                <td><a href="ajout-rendezvous.php?id=<?= $appointmentListDetail->id ?>">RDV</a></td>
                                <td><a href="rendezvous.php?id=<?= $appointmentListDetail->id ?>">Infos</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>