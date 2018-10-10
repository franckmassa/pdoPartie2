<?php
include 'models/patients.php';
include 'models/appointments.php';
include 'controllers/infoAppointment.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../assets/css/style.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <title>Liste des rendez-vous</title>
    </head>
    <body style="background-color:powderblue;">
        <h1> La liste des rendez-vous </h1>
        <?php if (isset($_POST['submit']) && (count($formError) === 0)) { ?>
            <p class="paragraphe">Votre rendez-vous a bien été enregistré.</p>
        <?php } else { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="form offset-2 col-8 offset-2">
                        <form action="rendezvous.php?id=<?= $appointment->id ?>" method="POST">
                            <div class="input-group-prepend">
                            </div>
                            <label for="dateApp">date</label>
                            <input class="form-control" id="dateApp" type="date" name="dateApp" value="<?= $showAppointment->date ?>"/>
                            <?php if (isset($formError['dateApp'])) { ?>
                                <p class="text-danger"><?= isset($formError['dateApp']) ? $formError['dateApp'] : '' ?></p>
                            <?php } ?>
                            <label for="hourApp">Heure</label>
                            <input class="form-control" id="hourApp" type="time" name="hourApp" value="<?= $showAppointment->hour ?>"/>
                            <?php if (isset($formError['hourApp'])) { ?>
                                <p class="text-danger"><?= isset($formError['hourApp']) ? $formError['hourApp'] : '' ?></p>
                            <?php } ?>
                            <select name="patient">
                                <option selected disabled>Veuillez selectionner un patient</option>
                                <?php
                                foreach ($patientsList as $patientDetails) {
                                    ?>
                                <option value="<?= $patientDetails->id ?>" <?= $patientDetails->id == $showAppointment->idPatients ? 'selected' : '' ?>><?= $patientDetails->lastname . ' ' . $patientDetails->firstname ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="submit" name="submit" value="Envoyer !" />
                        </form>
                        <a href="ajout-patient.php">ajout de patient</a>
                    </div>
                </div>
            </div>
        <?php
        }
        if (isset($formError['submit'])) {
            ?>
            <p><?= $formError['submit'] ?></p>
<?php } ?>
    </body>
</html>
