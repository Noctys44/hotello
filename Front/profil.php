<?php
require_once('../Models/pdo.php');
require_once('../Models/User.php');
require_once('../Models/UserManager.php');


$success = '';
$erreurs = '';

$userManager = new UserManager($pdo);
$connect = $userManager->clientConnected();
$detailClient = $userManager->getProfilById();
$infoClient = $detailClient->fetch(PDO::FETCH_ASSOC);

if (!$connect) {
    header('location:connexion.php');
    exit();
}

/* DECONNEXION */
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    // session_destroy();
    session_unset();
    header('location:index.php');
}

/* POST MODIFICATIONS */
if (!empty($_POST)) {
    $userManager->updateUser($user);
    header('location:profil.php');
    $success = "<div class=\"alert alert-success\" role=\"alert\">Modifications a été prise en compte</div>";
}

$lastname = $_SESSION['client']['lastname'];
$firstname = $_SESSION['client']['firstname'];
$mail = $_SESSION['client']['mail'];
$address = $_SESSION['client']['address'];
$city = $_SESSION['client']['city'];
$zipcode = $_SESSION['client']['zipcode'];
$phone = $_SESSION['client']['phone'];
$birthdate = $_SESSION['client']['birthdate'];
$country = $_SESSION['client']['country'];
$idCli = $_SESSION['client']['id_cli'];
$status = $_SESSION['client']['status'];


require_once('./inc/header.inc.php');
require_once('./inc/top-nav.inc.php');
?>


<h2>Bonjour <?php echo $firstname . " " . $lastname ?></h2>



<?php if (isset($_GET['action']) && $_GET['action'] == 'update') { ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">

                <h2 class="text-center m-3">Modification du client</h2>
                <?php echo $success; ?>
                <?php echo $erreurs; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Nom :</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $infoClient['lastname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="firstname" class="form-label">Prénom :</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $infoClient['firstname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="mail" class="form-label">eMail :</label>
                        <input type="email" name="mail" id="mail" class="form-control" value="<?= $infoClient['mail'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse :</label>
                        <input type="text" name="address" id="address" class="form-control" value="<?= $infoClient['address'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">Ville :</label>
                        <input type="text" name="city" id="city" class="form-control" value="<?= $infoClient['city'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="zipcode" class="form-label">Code postal:</label>
                        <input type="text" name="zipcode" id="zipcode" class="form-control" value="<?= $infoClient['zipcode'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Numéro de téléphone :</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="<?= $infoClient['phone'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="birthdate" class="form-label">Date de naissance :</label>
                        <input type="date" name="birthdate" id="birthdate" class="form-control" value="<?= $infoClient['birthdate'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="country" class="form-label">Pays :</label>
                        <input type="text" name="country" id="country" class="form-control" value="<?= $infoClient['country'] ?>">
                    </div>

                    <div class="mb-3">
                        <input type="submit" value="Valider la modification" class="w-100 btn btn-success" href="?action=validate">
                    </div>

                </form>
            </div>
        </div>
    </div>

<?php } else { ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">

                <?php echo $success ?>

                <div class="card mt-3 mb-3">
                    <div class="card-header">
                        Vos informations :
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Nom : <?php echo $infoClient['lastname'] ?></h5>
                        <h5 class="card-title">Prénom : <?php echo $infoClient['firstname'] ?></h5>
                        <h5 class="card-title">eMail : <?php echo $infoClient['mail'] ?></h5>
                        <h5 class="card-title">Tél. : <?php echo $infoClient['phone'] ?></h5>

                        <hr>
                        <h5 class="card-title">Date de naissance : <?php echo $infoClient['birthdate'] ?></h5>
                        <hr>
                        <h5 class="card-title">Adresse :</h5>
                        <p class="card-text"><?php echo $infoClient['address'] . " " . $infoClient['zipcode'] . " " . $infoClient['city'] ?></p>
                        <p class="card-text"><?php echo $infoClient['country'] ?></p>
                        <hr>
                        <a href="?action=update&id_cli=<?php echo $idCli ?>" class="btn btn-warning">Modifier vos informations</a>
                        <a href="?action=deconnexion" class="btn btn-danger">Se déconnecter</a>

                        <?php if ($status == 1) {
                            echo '<a href="../views/admin_users.php" class="btn btn-dark">Dashboard ADMIN</a>';
                        } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php } ?>


<?php
require_once('./inc/footer.inc.php');
?>