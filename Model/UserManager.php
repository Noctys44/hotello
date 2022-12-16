<?php

require_once('User.php');


class UserManager
{
    private $dataBase;

    public function __construct(PDO $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function insertUser(User $user)
    {

        // $mdp = password_hash($password, PASSWORD_DEFAULT);

        $req = $this->dataBase->prepare("INSERT INTO client(lastname, firstname, mail, password, address, city, zipcode, phone, birthdate, country) VALUES(:lastname, :firstname, :mail, :password, :address, :city, :zipcode, :phone, :birthdate, :country)");
        $req->bindValue(':lastname', $user->getLastname(), PDO::PARAM_STR);
        $req->bindValue(':firstname', $user->getFirstname());
        $req->bindValue(':mail', $user->getMail());
        $req->bindValue(':password', $user->getPassword());
        $req->bindValue(':address', $user->getAddress());
        $req->bindValue(':city', $user->getCity());
        $req->bindValue(':zipcode', $user->getZipcode());
        $req->bindValue(':phone', $user->getPhone());
        $req->bindValue(':birthdate', $_POST['birthdate']);
        $req->bindValue(':country', $user->getCountry());
        $req->execute();
    }

    public function getAllUsers()
    {
        $getUsers = $this->dataBase->query("SELECT * FROM client ORDER BY lastname ASC");
        return $getUsers;
    }
}
