<?php

require_once('../Model/Reservation.php');
require_once('../Model/ReservationManager.php');
require_once('../Model/init.php');

$start_date = "";
$end_date = "";
$adults = "";
$children = "";
$success = "";

// SHOW ALL RESERVATIONS BY USERS
$reservationManager = new ReservationManager($pdo);
$showById = $reservationManager->getAllReservationByUser();

// UPDATE RESERVATION
if (isset($_GET['action']) && $_GET['action'] == "update") {

    $inputReservation = $reservationManager->getByIdReservation();
    $actualReservation = $inputReservation->fetch(PDO::FETCH_ASSOC);

    $start_date = (isset($actualReservation['start_date'])) ? $actualReservation['start_date'] : '';
    $end_date = (isset($actualReservation['end_date'])) ? $actualReservation['end_date'] : '';
    $adults = (isset($actualReservation['adults'])) ? $actualReservation['adults'] : '';
    $children = (isset($actualReservation['children'])) ? $actualReservation['children'] : '';

    if (!empty($_POST)) {
        $update = $reservationManager->updateReservation();
    }
}

// DELETE RESERVATION
if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $update = $reservationManager->deleteReservation();
}



?>

<?php require_once('../Model/header.inc.php'); ?>


<!-- FORM ROOMS -->

<div class="container">
    <table class="table table-striped">
        <tr>
            <th class="text-center">Id Reservation</th>
            <th class="text-center">Id Room</th>
            <th class="text-center">Id Client</th>
            <th class="text-center">Début du séjour</th>
            <th class="text-center">Fin du séjour</th>
            <th class="text-center">Nombre d'adultes</th>
            <th class="text-center">Nombre d'enfants</th>
            <th class="text-center">Update</th>
            <th class="text-center">Delete</th>
        </tr>
        <?php while ($row = $showById->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td class="text-center"> <?php echo $row["id_reservation"]; ?></td>
                <td class="text-center"> <?php echo $row["id_room"]; ?></td>
                <td class="text-center"> <?php echo $row["id_cli"]; ?></td>
                <td class="text-center"> <?php echo $row["start_date"]; ?></td>
                <td class="text-center"> <?php echo $row["end_date"]; ?></td>
                <td class="text-center"> <?php echo $row["adults"]; ?></td>
                <td class="text-center"> <?php echo $row["children"]; ?></td>
                <td class="text-center"><a href="<?php echo "?action=update&id_cli=$row[id_cli]&id_reservation=$row[id_reservation]"; ?>"> Update</a></td>
                <td class="text-center"><a href="<?php echo "?action=delete&id_cli=$row[id_cli]&id_reservation=$row[id_reservation]"; ?>"> Delete</a></td>
            </tr>
        <?php } ?>
    </table>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">


            <form action="" method="POST">

                <div class="mb-3">
                    <input type="hidden" id="id_reservation" name="id_reservation" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="hidden" id="id_room" name="id_room" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="hidden" id="id_cli" name="id_cli" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label">Date de début</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="<?= $start_date ?>">
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label">Date de fin</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="<?= $end_date ?>">
                </div>

                <div class="mb-3">
                    <label for="adults" class="form-label">Nombre d'adultes</label>
                    <input type="text" id="adults" name="adults" class="form-control" value="<?= $adults ?>">
                </div>

                <div class="mb-3">
                    <label for="children" class="form-label">Nombre d'enfants</label>
                    <input type="text" id="children" name="children" class="form-control" value="<?= $children ?>">
                </div>


                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Réserver">
                </div>

            </form>

        </div>
    </div>
</div>

<?php require_once('../Model/footer.inc.php'); ?>