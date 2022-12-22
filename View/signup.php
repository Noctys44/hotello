<?php

require_once('../Model/User.php');
require_once('../Model/UserManager.php');
require_once('../Model/init.php');

$userManager = new UserManager($pdo);

$success = '';


// INSERT USER
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
        // var_dump($user->isUserValid());
        $userManager->insertUser($user);
        // var_dump($userManager->insertUser($user));
        $success = '<div class="alert alert-success" role="alert">L\'utilisateur a bien été enregistré</div>';
    } else {
        $erreurs = $user->getErreurs();
        // var_dump($erreurs);
    }
    if (isset($erreurs)) {
        echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
    }
}

// $userManager->insertUser($userNew);



?>

<?php require_once('../Model/header.inc.php'); ?>

<h1>Inscription</h1>
<?php if (isset($message)) echo $success; ?>
<div>
    <form action="" method="POST">
        <label for="lastname" class="form-label">Votre nom :</label>
        <input type="text" name="lastname" id="lastname" class="form-control">
        <div id="lastname" class="form-text">
            <?php if (isset($erreurs) && in_array(User::LASTNAME_INVALIDE, $erreurs)) {
                print_r($erreurs);
                echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            } else {
                // var_dump($erreurs);
                echo 'ok';
            }
            // var_dump($erreurs);
            //     print_r($erreurs);
            // echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
            ?>
        </div>

        <label for="firstname" class="form-label">Votre prénom :</label>
        <input type="text" name="firstname" id="firstname" class="form-control">
        <div id="firstname" class="form-text">
            <?php if (isset($erreurs) && in_array(User::FIRSTNAME_INVALIDE, $erreurs))
                // print_r($erreurs);
                echo '<div class="form-text text-danger fw-bold"> Le prénom est invalide </div>';
            ?>
        </div>

        <label for="mail" class="form-label">Votre email :</label>
        <input type="email" name="mail" id="mail" class="form-control">
        <div id="mail" class="form-text">
            <?php if (isset($erreurs) && in_array(User::MAIL_INVALIDE, $erreurs))
                // print_r($erreurs);
                echo '<div class="form-text text-danger fw-bold"> L\'email est invalide </div>';
            ?>
        </div>

        <label for="password" class="form-label">Votre mot de passe :</label>
        <input type="password" name="password" id="password" class="form-control">
        <div id="password" class="form-text">
            <?php if (isset($erreurs) && in_array(User::PASSWORD_INVALIDE, $erreurs))
                // print_r($erreurs);
                echo '<div class="form-text text-danger fw-bold"> Le mdp est invalide </div>';
            ?>
        </div>

        <label for="address" class="form-label">Votre adresse :</label>
        <input type="text" name="address" id="address" class="form-control">
        <div id="address" class="form-text">
            <?php if (isset($erreurs) && in_array(User::ADDRESS_INVALIDE, $erreurs))
                // print_r($erreurs);
                echo '<div class="form-text text-danger fw-bold"> L\'adresse est invalide </div>';
            ?>
        </div>

        <label for="city" class="form-label">Votre ville :</label>
        <input type="text" name="city" id="city" class="form-control">
        <div id="city" class="form-text">
            <?php if (isset($erreurs) && in_array(User::CITY_INVALIDE, $erreurs))
                // print_r($erreurs);
                echo '<div class="form-text text-danger fw-bold"> La ville est invalide </div>';
            ?>
        </div>

        <label for="zipcode" class="form-label">Votre code postal:</label>
        <input type="text" name="zipcode" id="zipcode" class="form-control">
        <div id="zipcode" class="form-text">
            <?php if (isset($erreurs) && in_array(User::ZIPCODE_INVALIDE, $erreurs))
                // print_r($erreurs);
                echo '<div class="form-text text-danger fw-bold"> Le code postal est invalide </div>';
            ?>
        </div>

        <label for="phone" class="form-label">Votre numéro de téléphone :</label>
        <input type="text" name="phone" id="phone" class="form-control">
        <div id="phone" class="form-text">
            <?php if (isset($erreurs) && in_array(User::PHONE_INVALIDE, $erreurs))
                // print_r($erreurs);
                echo '<div class="form-text text-danger fw-bold"> Le numéro est invalide </div>';
            ?>
        </div>

        <label for="birthdate" class="form-label">Votre date de naissance :</label>
        <input type="date" name="birthdate" id="birthdate" class="form-control">


        <label for="country" class="form-label">Votre pays :</label>
        <input type="text" name="country" id="country" class="form-control">
        <div id="country" class="form-text">
            <?php if (isset($erreurs) && in_array(User::COUNTRY_INVALIDE, $erreurs))
                // print_r($erreurs);
                echo '<div class="form-text text-danger fw-bold"> Le pays est invalide </div>';
            ?>
        </div>

        <input type="submit" value="S'inscrire" class="btn btn-primary">


    </form>
</div>
<?php require_once('../Model/footer.inc.php'); ?>