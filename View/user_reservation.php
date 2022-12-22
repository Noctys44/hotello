<?php

require_once('../Models/pdo.php');
require_once('../Models/Reservation.php');
require_once('../Models/ReservationManager.php');

$reservationManager = new ReservationManager($pdo);

if (!empty($_POST) && !isset($_GET['action']) && !isset($_GET['action']) == 'update') {

    $reservation = new Reservation(
        [
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'adults' => $_POST['adults'],
            'children' => $_POST['children'],
        ]
    );
    $reservation = $reservationManager->insertReservation();
}

?>

<?php require_once('../Models/header.inc.php'); ?>


<!-- FORM ROOMS -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">


            <form action="" method="POST">


                <div class="mb-3">
                    <label for="start_date" class="form-label">Date de début</label>
                    <input type="date" id="start_date" name="start_date" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label">Date de fin</label>
                    <input type="date" id="end_date" name="end_date" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="adults" class="form-label">Nombre d'adultes</label>
                    <input type="text" id="adults" name="adults" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="children" class="form-label">Nombre d'enfants</label>
                    <input type="text" id="children" name="children" class="form-control">
                </div>


                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Réserver">
                </div>

            </form>

        </div>
    </div>
</div>

<?php require_once('../Models/footer.inc.php'); ?>