<?php

require_once('../Models/Services.php');
require_once('../Models/ServicesManager.php');
require_once('../Models/pdo.php');

$icon = "";
$name = "";
$description = "";
$price = "";

// SHOW ALL SERVICES
$servicesManager = new ServicesManager($pdo);
$showServices = $servicesManager->getAllServices();


// INSERT SERVICES
if (!empty($_POST) && !isset($_GET['action']) && !isset($_GET['action']) == 'update') {

    $newServices = new Services(
        [
            'icon' => $_FILES['icon'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
        ]
    );
    $servicesManager->insertServices($newServices);
    header('location:admin_services.php');
}

// UPDATE SERVICES
if (isset($_GET['action']) && $_GET['action'] == "update") {

    $inputServices = $servicesManager->getServiceById();
    $actualServices = $inputServices->fetch(PDO::FETCH_ASSOC);

    $icon = (isset($actualServices['icon'])) ? $actualServices['icon'] : '';
    $name = (isset($actualServices['name'])) ? $actualServices['name'] : '';
    $description = (isset($actualServices['description'])) ? $actualServices['description'] : '';
    $price = (isset($actualServices['price'])) ? $actualServices['price'] : '';

    if (!empty($_POST)) {
        $update = $servicesManager->updateServices();
    }
}

// DELETE SERVICES
if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $delete = $servicesManager->deleteServices();
    header('location:admin_services.php');
}

?>

<?php require_once('../Models/header.inc.php'); ?>

<div class="container">
    <h1 class="text-center m-3">Gestion des services</h1>
    <table class="table table-striped">
        <tr>
            <th class="text-center">Id Services</th>
            <th class="text-center">Icon</th>
            <th class="text-center">Nom du service</th>
            <th class="text-center">Description</th>
            <th class="text-center">Prix</th>
            <th class="text-center">Update</th>
            <th class="text-center">Delete</th>
        </tr>
        <?php while ($row = $showServices->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td class="text-center"> <?php echo $row["id_services"]; ?></td>
                <td class="text-center"> <?php echo "<img src='$row[icon]' width='50px'>"; ?></td>
                <td class="text-center"> <?php echo $row["name"]; ?></td>
                <td class="text-center"> <?php echo $row["description"]; ?></td>
                <td class="text-center"> <?php echo $row["price"]; ?> €</td>
                <td class="text-center"><a href="<?php echo "?action=update&id_services=$row[id_services]"; ?>" class="btn btn-warning"> Update</a></td>
                <td class="text-center"><a href="<?php echo "?action=delete&id_services=$row[id_services]"; ?>" class="btn btn-danger"> Delete</a></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">

            <h1 class="text-center">Ajouter un service</h1>

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <input type="hidden" id="id_services" name="id_services" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="file" id="icon" name="icon" class="form-control" value="<?= $icon ?>">
                    <?php if (!empty($icon)) : ?>
                        <p>Vous pouvez ajouter une nouvelle photo.<br>
                            <!----afficher la photo---->
                            <img src="<?= $icon ?>" width="50">
                        </p><br>
                    <?php endif;     ?>
                    <input type="hidden" name="icon_actuelle" value="<?= $icon  ?>"><br>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nom du service</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= $name ?>">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" cols="10" rows="5" class="form-control"><?= $description ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prix</label>
                    <input type="num" id="price" name="price" class="form-control" value="<?= $price ?>">
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Ajouter le service">
                </div>

            </form>

        </div>
    </div>
</div>

<?php require_once('../Models/footer.inc.php'); ?>