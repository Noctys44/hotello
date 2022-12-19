<?php

require_once('../Models/init.php');
require_once('../Models/Room.php');
require_once('../Models/RoomManager.php');

$room = new RoomManager($pdo);
$success = "";

$id_room = "";
$title_room = "";
$price_room = "";
$type_chambre = "";
$size = "";
$description = "";
$adults = "";
$children = "";
$status = "";

/* DELETE ROOM */
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $room->deleteRoom($room);
    header('location:roomPage.php ');
}

/* UPDATE ROOM */
if (isset($_GET['action']) && $_GET['action'] == 'update') {

    $idRoom = $room->getRoomById();
    $detailRoom = $idRoom->fetch(PDO::FETCH_ASSOC);


    $id_room = (isset($detailRoom['id_room'])) ? $detailRoom['id_room'] : "";
    $title_room = (isset($detailRoom['title_room'])) ? $detailRoom['title_room'] : "";
    $price_room = (isset($detailRoom['price_room'])) ? $detailRoom['price_room'] : "";
    $type_chambre = (isset($detailRoom['type_chambre'])) ? $detailRoom['type_chambre'] : "";
    $size = (isset($detailRoom['size'])) ? $detailRoom['size'] : "";
    $description = (isset($detailRoom['description'])) ? $detailRoom['description'] : "";
    $adults = (isset($detailRoom['adults'])) ? $detailRoom['adults'] : "";
    $children = (isset($detailRoom['children'])) ? $detailRoom['children'] : "";
    $status = (isset($detailRoom['status'])) ? $detailRoom['status'] : "";

    if (!empty($_POST)) {
        $room->updateRoom($room);
    }
}

/* POST ROOM */
if (!empty($_POST) && !isset($_GET['action']) && !isset($_GET['action']) == 'update') {
    $adRoom = new Room(
        [
            'title_room' => $_POST['title_room'],
            'price_room' => $_POST['price_room'],
            'type_chambre' => $_POST['type_chambre'],
            'size' => $_POST['size'],
            'description' => $_POST['description'],
            'adults' => $_POST['adults'],
            'children' => $_POST['children'],
            'status' => $_POST['status']
        ]
    );

    $room->insertRoom($adRoom);
    $success = '<div class="alert alert-success" role="alert">L\'utilisateur a bien été enregistré</div>';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <!-- TABLE ROOMS -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 table-responsive">

                <?php echo $success; ?>

                <table class="table">
                    <!-- <caption>Liste des chambres</caption> -->
                    <thead class="table-light">
                        <th scope="col">id</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Type</th>
                        <th scope="col">Taille</th>
                        <th scope="col">Description</th>
                        <th scope="col">Adultes</th>
                        <th scope="col">Enfants</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </thead>

                    <tbody>
                        <?php
                        $rooms = $room->getAllRooms();
                        while ($room = $rooms->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td> <?php echo $room['id_room']; ?></td>
                                <td> <?php echo $room['title_room']; ?></td>
                                <td> <?php echo $room['price_room']; ?> €</td>
                                <td> <?php echo $room['type_chambre']; ?></td>
                                <td> <?php echo $room['size']; ?></td>
                                <td> <?php echo $room['description']; ?></td>
                                <td> <?php echo $room['adults']; ?></td>
                                <td> <?php echo $room['children']; ?></td>
                                <td> <?php echo $room['status']; ?></td>
                                <td>

                                    <a href="<?php echo "?action=update&id_room=$room[id_room]"; ?>" class="btn btn-warning"> Update</a>
                                    <a href="<?php echo "?action=delete&id_room=$room[id_room]"; ?>" class="btn btn-danger"> delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <br>
    <hr>
    <br>

    <!-- FORM ROOMS -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">


                <form action="" method="POST">

                    <div class="mb-3">
                        <label for="title_room" class="form-label">Titre</label>
                        <input type="text" id="title_room" name="title_room" class="form-control" placeholder="Title" value="<?php echo $title_room ?>">
                    </div>

                    <div class="mb-3">
                        <label for="price_room" class="form-label">Prix</label>
                        <input type="text" id="price_room" name="price_room" class="form-control" placeholder="Prix" value="<?php echo $price_room ?>">
                    </div>

                    <div class="mb-3">
                        <label for="type_chambre" class="form-label">Type de chambre</label>
                        <input type="text" id="type_chambre" name="type_chambre" class="form-control" placeholder="Type de chambre" value="<?php echo $type_chambre ?>">
                    </div>

                    <div class="mb-3">
                        <label for="size" class="form-label">Taille de la chambre</label>
                        <input type="text" id="size" name="size" class="form-control" placeholder="Taille de la chambre" value="<?php echo $size ?>">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description de la chambre</label>
                        <textarea type="text" id="description" name="description" class="form-control" placeholder="Description de la chambre"><?php echo $description ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="adults" class="form-label">Adults de la chambre</label>
                        <input type="text" id="adults" name="adults" class="form-control" placeholder="Adults" value="<?php echo $adults ?>">
                    </div>

                    <div class="mb-3">
                        <label for="children" class="form-label">Children de la chambre</label>
                        <input type="text" id="children" name="children" class="form-control" placeholder="Children" value="<?php echo $children ?>">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Statut de la chambre</label>
                        <select class="form-select mb-3" aria-label="status" name="status" id="status">
                            <option value="libre" <?php if ($status == 'libre') {
                                                        echo "selected";
                                                    } ?>>Libre</option>
                            <option value="réservée" <?php if ($status == 'reservee') {
                                                            echo "selected";
                                                        } ?>>Réservée</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Envoyer">
                    </div>

                </form>

            </div>
        </div>
    </div>



</body>

</html>