<?php

require_once('../Model/init.php');
require_once('../Model/Room.php');
require_once('../Model/RoomManager.php');

$room = new RoomManager($pdo);
$success = "";

if ($_POST) {
    $adRoom = new Room(
        [
            'title_room' => $_POST['title_room'],
            'price_room' => $_POST['price_room'],
            'type_chambre' => $_POST['type_chambre'],
            'size' => $_POST['size'],
            'description' => $_POST['description'],
            'adults' => $_POST['adults'],
            'children' => $_POST['children']
        ]
    );

    // if ($adRoom->isRoomValid()) {
    //     $room->insertRoom($adRoom);
    //     $success = '<div class="alert alert-success" role="alert">L\'utilisateur a bien été enregistré</div>';
    // } else {
    //     $erreurs = $adRoom->getErreurs();
    // }
    $room->insertRoom($adRoom);
    $success = '<div class="alert alert-success" role="alert">L\'utilisateur a bien été enregistré</div>';
}

// if($_POST){
//     var_dump($_POST['title_room'], $_POST['price_room'], $_POST['type_chambre'], $_POST['size'], $_POST['description'], $_POST['adults'], $_POST['children']);
// }

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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">

                <?php echo $success; ?>

                <table class="table">

                    <thead>
                        <th>Titre</th>
                        <th>Prix</th>
                        <th>Type</th>
                        <th>Taille</th>
                        <th>Description</th>
                        <th>Adlutes</th>
                        <th>Enfants</th>
                    </thead>

                    <tbody>
                        <?php
                        $rooms = $room->getAllRooms();
                        while ($room = $rooms->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td> <?php echo $room['title_room']; ?></td>
                                <td> <?php echo $room['price_room']; ?> €</td>
                                <td> <?php echo $room['type_chambre']; ?></td>
                                <td> <?php echo $room['size']; ?></td>
                                <td> <?php echo $room['description']; ?></td>
                                <td> <?php echo $room['adults']; ?></td>
                                <td> <?php echo $room['children']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>

    <hr>
    <hr>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">


                <form action="" method="POST">

                    <div class="mb-3">
                        <label for="title_room" class="form-label">Titre</label>
                        <input type="text" id="title_room" name="title_room" class="form-control" placeholder="Title">
                        <?php if (isset($erreurs) && in_array(Room::TITLE_INVALIDE, $erreurs))
                            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="price_room" class="form-label">Prix</label>
                        <input type="text" id="price_room" name="price_room" class="form-control" placeholder="Prix">
                    </div>

                    <div class="mb-3">
                        <label for="type_chambre" class="form-label">Type de chambre</label>
                        <input type="text" id="type_chambre" name="type_chambre" class="form-control" placeholder="Type de chambre">
                    </div>

                    <div class="mb-3">
                        <label for="size" class="form-label">Taille de la chambre</label>
                        <input type="text" id="size" name="size" class="form-control" placeholder="Taille de la chambre">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description de la chambre</label>
                        <textarea type="text" id="description" name="description" class="form-control" placeholder="Description de la chambre"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="adults" class="form-label">Adults de la chambre</label>
                        <input type="number" id="adults" name="adults" class="form-control" placeholder="Adults">
                    </div>

                    <div class="mb-3">
                        <label for="children" class="form-label">Children de la chambre</label>
                        <input type="number" id="children" name="children" class="form-control" placeholder="Children">
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