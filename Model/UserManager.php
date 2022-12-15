<?php

require_once('User.php');

class UserManager
{
    private $dataBase;

    public function __construct($dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function insertUser($user)
    {

        // $mdp = password_hash($password, PASSWORD_DEFAULT);

        $req = $this->dataBase->prepare("INSERT INTO client(lastname, firstname, mail, password, address, city, zipcode, phone, birthdate, country) VALUES(:lastname, :firstname, :mail, :password, :address, :city, :zipcode, :phone, :birthdate, :country)");
        $req->bindValue(':lastname', $user->getLastname(), PDO::PARAM_STR);
        $req->bindValue(':firstname', $user->getFirstname(), PDO::PARAM_STR);
        $req->bindValue(':mail', $user->getMail(), PDO::PARAM_STR);
        $req->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $req->bindValue(':address', $user->getAddress(), PDO::PARAM_STR);
        $req->bindValue(':city', $user->getCity(), PDO::PARAM_STR);
        $req->bindValue(':zipcode', $user->getZipcode(), PDO::PARAM_STR);
        $req->bindValue(':phone', $user->getPhone(), PDO::PARAM_STR);
        $req->bindValue(':birthdate', $user->getBirthdate(), PDO::PARAM_STR);
        $req->bindValue(':country', $user->getCountry(), PDO::PARAM_STR);
        $req->execute();
    }

    public function getAllUsers()
    {
        $getUsers = $this->dataBase->query("SELECT * FROM client ORDER BY lastname_cli ASC");
        return $getUsers;
    }
}
