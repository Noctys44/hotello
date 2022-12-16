<?php

require_once('../Model/User.php');
require_once('../Model/UserManager.php');
require_once('../Model/init.php');


// $userManager = new UserManager($pdo);


if ($_POST) {

    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];
    $country = $_POST['country'];

    // $date_birthday = new DateTime($date_birthday);

    $userNew = new User(
        [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'mail' => $mail,
            'password' => $password,
            'address' => $address,
            'city' => $city,
            'zipcode' => $zipcode,
            'phone' => $phone,
            'birthdate' => $birthdate,
            'country' => $country,
        ]
    );
    $userManager = new UserManager($pdo);
    $userManager->insertUser($userNew);
}
$users = new UserManager($pdo);
$allUsers = $users->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Sign up</title>
</head>

<body>

    <div class="container">
        <table class="table table-striped">
            <tr>
                <th class="text-center">Nom</th>
                <th class="text-center">Prénom</th>

            </tr>
            <?php while ($row = $allUsers->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td class="text-center"> <?php echo $row["lastname"]; ?></td>
                    <td class="text-center"> <?php echo $row["firstname"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
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
            <input type="text" name="phone" id="phone">
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