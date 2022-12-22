<?php 

    try
        {
        $pdo = new PDO(
            "mysql:host=localhost;port:8888;dbname=hotello", "root", "root",
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ));
                // var_dump($pdo);
        }
    catch(PDOexception $e)
        {
            echo "Erreur de connexion à la bdd" . $e->getMessage();
        }

        session_start();

