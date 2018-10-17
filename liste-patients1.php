<?php
include 'models/database.php';
include 'controllers/patientsListCtl.php';
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
        <title>Liste des patients</title>
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
                            <th>Profil</th>
                            <th>Supprimer un patient et son rendez-vous</th>
                            <th>

                                <form class="text-center" method="post" action="#">
                                    <input type="text" class="form-control" name="search" placeholder="Recherche"/>
                                    <i class="fas fa-search"></i>
                                    <input type="submit" class="form-control" name="searchSubmit"/>
                                </form>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (isset($_POST['search'])) {
                            foreach ($showPatientsList as $patientsListDetail) {
                                ?>
                                <tr>
                                    <td><?= $patientsListDetail->lastname ?></td>
                                    <td><?= $patientsListDetail->firstname ?></td>
                                    <!-- On ajoute un lien qui redirige vers la page profil-patient.php
                                         On rajoute le paramètre id dans l'url et on echo la valeur nominative de l'id 
                                    après ? le mot id doit être  dans le get du controleur profil-patientCtl.php -->
                                    <td><a href="profil-patient.php?id=<?= $patientsListDetail->id ?>">Voir le profil</a></td>                               
                                    <td><form method="POST" action="?idRemove=<?= $patientsListDetail->id ?>"><input type="submit" value="Supprimer" name="submit" class="btn btn-danger"/></form></td>
                                </tr>
                                <?php
                            }
                        } else {
                            foreach ($patientsList as $patientsListDetail) {
                                ?>
                                <tr>
                                    <td><?= $patientsListDetail->lastname ?></td>
                                    <td><?= $patientsListDetail->firstname ?></td>
                                    <!-- On ajoute un lien qui redirige vers la page profil-patient.php
                                         On rajoute le paramètre id dans l'url et on echo la valeur nominative de l'id 
                                    après ? le mot id doit être  dans le get du controleur profil-patientCtl.php -->
                                    <td><a href="profil-patient.php?id=<?= $patientsListDetail->id ?>">Voir le profil</a></td>                               
                                    <td><form method="POST" action="?idRemove=<?= $patientsListDetail->id ?>"><input type="submit" value="Supprimer" name="submit" class="btn btn-danger"/></form></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>