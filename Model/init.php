<?php

// $pdo = new PDO(
//     "mysql:host=localhost;dbname=hotello",
//     "root",
//     "",
//     array(
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
//         PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
//     )
// );

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=hotello",
        "root",
        "",
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        )
    );
} catch (PDOexception $e) {
    echo "Erreur de connexion à la bdd" . $e->getMessage();
}
return $pdo;



// var_dump($pdo);
