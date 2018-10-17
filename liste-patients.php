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
            <div class="row justify-content-center">
                <h2 class="text-center col-md-12">Liste des patients</h2>

                <!-- Zone de recherche du patient -->
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="nameAsked">Rechercher un patient : </label>
                        <input type="text" id="nameAsked" name="nameAsked" value="" />
                        <?php
                        if (isset($error)) {
                            ?>
                            <p><?= $error ?></p>
                        <?php }
                        ?>
                        <button type="submit">Rechercher</button>
                    </div>
                </form>
                <?php
                if (isset($listPatients)) {
                    if ($listPatients === false) {
                        ?>
                        <p>Il y a eu un probleme</p>
                        <?php
                    } else {
                        (count($listPatients) === 0)
                        ?>
                        <p>Il n'y a aucun resultat</p>
                        <?php
                    }
                }
                ?>
            </div>
            <!-- Tableau pour la liste des patient, vers le profil et possibilité de supprimer le patient et ses rendez-vous -->
            <div class="row">
                <table class="col-md-12 bg-white">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Profil</th>
                            <th>Supprimer un patient et son rendez-vous</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Foreach pour récupérer la liste des patients 
                        foreach ($listPatients as $patientsListDetail) {
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
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>