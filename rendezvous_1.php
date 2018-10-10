<?php 
include 'models/patients.php';
include 'models/appointments.php';
include 'controllers/infoAppointment.php';
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
        <title>Info rendez-vous</title>
    </head>
    <body>
        <?php include 'controllers/controllerNavbar2.php'; ?>
        <div class="container">
            <div class="row">
                <table class="col-md-12 bg-white">
                    <!-- En-tête du tableau pour l'information des rendez-vous -->
                    <thead>
                        <tr>
                            <th>Identifiant Patient</th>
                            <th>Nom</th>
                            <th>Prénom</th>         
                            <th>Rendez-vous</th>
                        </tr>
                    </thead>
                    <tbody>
                       <!-- Récupération des valeurs des attributs dans les cellules du tableau -->
                            <tr>
                                <th><?= $infoAppointment->idPatients ?></th>
                                <td><?= $infoAppointment->lastname ?></td>
                                <td><?= $infoAppointment->firstname ?></td>   
                                <th><?= $infoAppointment->dateHour ?></th>
                            </tr>
                            <div class="row">
                <div  class="offset-2 col-md-8 mt-3">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="lastname">Nom</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Nom" value="<?= $profilList->lastname ?>"/>
                            <?php if (isset($formError['lastname'])) { ?>
                                <p class="text-danger"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></p>
                            <?php } ?>
                  
                        </div> 
                    </form>
                    <p class="text-danger"><?= isset($formError['submit']) ? $formError['submit'] : '' ?></p>
                </div>
            </div>
                    </tbody>
                </table>
            </div>
        </div> 
    </body>
</html>