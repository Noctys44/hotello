<?php

require_once('../Models/pdo.php');
require_once('../Models/Equipments.php');
require_once('../Models/EquipmentsManager.php');

$equipment = new EquipmentsManager($pdo);
$success = "";

$name_equip = "";

/* DELETE EQUIPMENT */
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $equipment->deleteEquipment($equipment);
    header('location:equipmentsPage.php ');
}

/* UPDATE EQUIPMENT */
if (isset($_GET['action']) && $_GET['action'] == 'update') {

    $idEquipment = $equipment->getEquipmentsById();
    $updateEquipement = $idEquipment->fetch(PDO::FETCH_ASSOC);

    $name_equip = (isset($updateEquipement['name_equip'])) ? $updateEquipement['name_equip'] : "";

    if (!empty($_POST)) {
        $equipment->updateEquipments($equipment);
    }
}

/* POST ROOM */
if (!empty($_POST) && !isset($_GET['action']) && !isset($_GET['action']) == 'update') {
    $adEquipment = new Equipments(
        [
            'name_equip' => $_POST['name_equip']
        ]
    );

    $equipment->insertEquipment($adEquipment);
    $success = '<div class="alert alert-success" role="alert">L\'utilisateur a bien été enregistré</div>';
}

?>

<?php require_once('../Models/header.inc.php'); ?>

<!-- EQUIPMENTS TABLE -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 table-responsive">

            <?php echo $success; ?>

            <table class="table">

                <thead>
                    <th>id</th>
                    <th>Equipment's name</th>
                    <th>Actions</th>
                    <th></th>
                </thead>

                <tbody>

                    <?php
                    $equipments = $equipment->getAllEquipments();
                    while ($equipment = $equipments->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?php echo $equipment['id_equip']; ?></td>
                            <td><?php echo $equipment['name_equip']; ?></td>
                            <td>
                                <a href="<?php echo "?action=update&id_equip=$equipment[id_equip]"; ?>" class="btn btn-warning"> Update</a>
                            </td>
                            <td>
                                <a href="<?php echo "?action=delete&id_equip=$equipment[id_equip]"; ?>" class="btn btn-danger"> delete</a>
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


<!-- EQUIPMENTS FORM -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 table-responsive">

            <form action="" method="POST">

                <div class="mb-3">
                    <label for="name_equip" class="form-label">Nom de l'équipement</label>
                    <input type="text" id="name_equip" name="name_equip" class="form-control" placeholder="Nom de l'équipement" value="<?php echo $name_equip ?>">
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Envoyer">
                </div>

            </form>

        </div>
    </div>
</div>
<?php require_once('../Models/footer.inc.php'); ?>