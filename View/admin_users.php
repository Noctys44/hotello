<?php

require_once('../Model/User.php');
require_once('../Model/UserManager.php');
require_once('../Model/init.php');

$userManager = new UserManager($pdo);

$lastname = "";
$firstname = "";
$mail = "";
$password = "";
$address = "";
$city = "";
$zipcode = "";
$phone = "";
$birthdate = "";
$country = "";
$success = "";


// INSERT USER
if (!empty($_POST) && !isset($_GET['action']) && !isset($_GET['action']) == 'update') {

    $userNew = new User(
        [
            'lastname' => $_POST['lastname'],
            'firstname' => $_POST['firstname'],
            'mail' => $_POST['mail'],
            'password' => $_POST['password'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'zipcode' => $_POST['zipcode'],
            'phone' => $_POST['phone'],
            'birthdate' => $_POST['birthdate'],
            'country' => $_POST['country'],
        ]
    );
    $userManager->insertUser($userNew);
}

// SHOW ALL USERS
$allUsers = $userManager->getAllUsers();


// DELETE USER
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $delUser = $userManager->deleteUser();
    header('location:signup.php');
}

// UPDATE USER
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    $inputUser = $userManager->getUserById();
    $actualUser = $inputUser->fetch(PDO::FETCH_ASSOC);

    $lastname = (isset($actualUser['lastname'])) ? $actualUser['lastname'] : '';
    $firstname = (isset($actualUser['firstname'])) ? $actualUser['firstname'] : '';
    $mail = (isset($actualUser['mail'])) ? $actualUser['mail'] : '';
    $address = (isset($actualUser['address'])) ? $actualUser['address'] : '';
    $city = (isset($actualUser['city'])) ? $actualUser['city'] : '';
    $zipcode = (isset($actualUser['zipcode'])) ? $actualUser['zipcode'] : '';
    $phone = (isset($actualUser['phone'])) ? $actualUser['phone'] : '';
    $birthdate = (isset($actualUser['birthdate'])) ? $actualUser['birthdate'] : '';
    $country = (isset($actualUser['country'])) ? $actualUser['country'] : '';

    if (!empty($_POST)) {
        $userManager->updateUser();
        $success = '<div class="alert alert-success" role="alert">L\'utilisateur été mise à jour</div>';
    }
}

?>

<?php require_once('../Model/header.inc.php'); ?>

<div class="container">
    <table class="table table-striped">
        <tr>
            <th class="text-center">Nom</th>
            <th class="text-center">Prénom</th>
            <th class="text-center">Email</th>
            <th class="text-center">Adresse</th>
            <th class="text-center">Ville</th>
            <th class="text-center">Code postal</th>
            <th class="text-center">N°téléphone</th>
            <th class="text-center">Date de naissance</th>
            <th class="text-center">Pays</th>
            <th class="text-center">Update</th>
            <th class="text-center">Delete</th>
            <th class="text-center">Réservation</th>
        </tr>
        <?php while ($row = $allUsers->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td class="text-center"> <?php echo $row["lastname"]; ?></td>
                <td class="text-center"> <?php echo $row["firstname"]; ?></td>
                <td class="text-center"> <?php echo $row["mail"]; ?></td>
                <td class="text-center"> <?php echo $row["address"]; ?></td>
                <td class="text-center"> <?php echo $row["city"]; ?></td>
                <td class="text-center"> <?php echo $row["zipcode"]; ?></td>
                <td class="text-center"> <?php echo $row["phone"]; ?></td>
                <td class="text-center"> <?php echo $row["birthdate"]; ?></td>
                <td class="text-center"> <?php echo $row["country"]; ?></td>
                <td class="text-center"><a href="<?php echo "?action=update&id_cli=$row[id_cli]"; ?>"> Update</a></td>
                <td class="text-center"><a href="<?php echo "?action=delete&id_cli=$row[id_cli]"; ?>"> Delete</a></td>
                <td class="text-center"><?php echo "<a href=admin_reservation.php?id_cli=$row[id_cli]>Réservation</a>" ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
<h1>Inscription</h1>
<?php echo $success; ?>
<div>
    <form action="" method="POST">
        <label for="lastname" class="form-label">Votre nom :</label>
        <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $lastname ?>">
        <?php if (isset($erreurs) && in_array(User::LASTNAME_INVALIDE, $erreurs))
            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        ?>

        <label for="firstname" class="form-label">Votre prénom :</label>
        <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $firstname ?>">
        <?php if (isset($erreurs) && in_array(User::FIRSTNAME_INVALIDE, $erreurs))
            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        ?>

        <label for="mail" class="form-label">Votre email :</label>
        <input type="email" name="mail" id="mail" class="form-control" value="<?= $mail ?>">
        <?php if (isset($erreurs) && in_array(User::MAIL_INVALIDE, $erreurs))
            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        ?>

        <label for="password" class="form-label">Votre mot de passe :</label>
        <input type="password" name="password" id="password" class="form-control">
        <?php if (isset($erreurs) && in_array(User::PASSWORD_INVALIDE, $erreurs))
            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        ?>

        <label for="address" class="form-label">Votre adresse :</label>
        <input type="text" name="address" id="address" class="form-control" value="<?= $address ?>">
        <?php if (isset($erreurs) && in_array(User::ADDRESS_INVALIDE, $erreurs))
            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        ?>

        <label for="city" class="form-label">Votre ville :</label>
        <input type="text" name="city" id="city" class="form-control" value="<?= $city ?>">
        <?php if (isset($erreurs) && in_array(User::CITY_INVALIDE, $erreurs))
            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        ?>

        <label for="zipcode" class="form-label">Votre code postal:</label>
        <input type="text" name="zipcode" id="zipcode" class="form-control" value="<?= $zipcode ?>">
        <?php if (isset($erreurs) && in_array(User::ZIPCODE_INVALIDE, $erreurs))
            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        ?>

        <label for="phone" class="form-label">Votre numéro de téléphone :</label>
        <input type="text" name="phone" id="phone" class="form-control" value="<?= $phone ?>">
        <?php if (isset($erreurs) && in_array(User::PHONE_INVALIDE, $erreurs))
            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        ?>

        <label for="birthdate" class="form-label">Votre date de naissance :</label>
        <input type="date" name="birthdate" id="birthdate" class="form-control" value="<?= $birthdate ?>">
        <?php if (isset($erreurs) && in_array(User::BIRTHDATE_INVALIDE, $erreurs))
            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        ?>

        <label for="country" class="form-label">Votre pays :</label>
        <input type="text" name="country" id="country" class="form-control" value="<?= $country ?>">
        <?php if (isset($erreurs) && in_array(User::COUNTRY_INVALIDE, $erreurs))
            echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        ?>

        <?php if (isset($_GET['action']) && $_GET['action'] == 'update') : ?>
            <input type="submit" value="Valider la modification" class="btn btn-lg btn-info">
        <?php else : ?>
            <input type="submit" value="S'inscrire" class="btn btn-lg btn-info">
        <?php endif ?>

    </form>
</div>
<?php require_once('../Model/footer.inc.php'); ?>