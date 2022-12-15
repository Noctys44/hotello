<?php

require_once('../Model/User.php');
require_once('../Model/UserManager.php');
require_once('../Model/init.php');


$userManager = new UserManager($pdo);

if ($_POST) {
    $user = new User(
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

    if ($user->isUserValid()) {
        $userManager->insertUser($user);
        $success = '<div>Le client a bien été enregistré</div>';
    } else {
        $erreurs = $user->getErreurs();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>

<body>
    <h1>Inscription</h1>
    <?php if (isset($message)) echo $success; ?>
    <div>
        <form action="" method="POST">
            <label for="lastname">Votre nom :</label>
            <input type="text" name="lastname" id="lastname">
            <?php if (isset($erreurs) && in_array(User::LASTNAME_INVALIDE, $erreurs))
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>

            <label for="firstname">Votre prénom :</label>
            <input type="text" name="firstname" id="firstname">
            <?php if (isset($erreurs) && in_array(User::FIRSTNAME_INVALIDE, $erreurs))
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>

            <label for="mail">Votre email :</label>
            <input type="email" name="mail" id="mail">
            <?php if (isset($erreurs) && in_array(User::MAIL_INVALIDE, $erreurs))
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>

            <label for="password">Votre mot de passe :</label>
            <input type="password" name="password" id="password">
            <?php if (isset($erreurs) && in_array(User::PASSWORD_INVALIDE, $erreurs))
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>

            <label for="address">Votre adresse :</label>
            <input type="text" name="address" id="address">
            <?php if (isset($erreurs) && in_array(User::ADDRESS_INVALIDE, $erreurs))
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>

            <label for="city">Votre ville :</label>
            <input type="text" name="city" id="city">
            <?php if (isset($erreurs) && in_array(User::CITY_INVALIDE, $erreurs))
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>

            <label for="zipcode">Votre code postal:</label>
            <input type="text" name="zipcode" id="zipcode">
            <?php if (isset($erreurs) && in_array(User::ZIPCODE_INVALIDE, $erreurs))
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>

            <label for="phone">Votre numéro de téléphone :</label>
            <input type="num" name="phone" id="phone">
            <?php if (isset($erreurs) && in_array(User::PHONE_INVALIDE, $erreurs))
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>

            <label for="birthdate">Votre date de naissance :</label>
            <input type="date" name="birthdate" id="birthdate">
            <?php if (isset($erreurs) && in_array(User::BIRTHDATE_INVALIDE, $erreurs))
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>

            <label for="country">Votre pays :</label>
            <input type="text" name="country" id="country">
            <?php if (isset($erreurs) && in_array(User::COUNTRY_INVALIDE, $erreurs))
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>

            <input type="submit" value="S'inscrire">

        </form>
    </div>
</body>

</html>