<?php

require_once('./Model/UserManager.php');
require_once('./Model/User.php');
require_once('./Model/init.php');
require_once('./View/signup.php');

// function getAllUsers()
// {

//     $getUsers = $pdo->query("SELECT * FROM client ORDER BY lastname ASC");
//     return $getUsers;
// }

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
