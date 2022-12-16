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

    public function updateUser()
    {
        if ($_GET['action'] = "update") {
            $updateUser = $this->dataBase;
            if ($_POST) {
                $fetchUser = $updateUser->query("SELECT * FROM client WHERE id_cli = '$_GET[id_cli]'");
                $update = $updateUser->query("UPDATE client SET lastname = '$_POST[lastname]', firstname = '$_POST[firstname]', mail = '$_POST[mail]', address = '$_POST[address]', city = '$_POST[city]', zipcode = '$_POST[zipcode]', phone = '$_POST[phone]', birthdate = '$_POST[birthdate]', country = '$_POST[country]'");
                $actualUser = $fetchUser->fetch(PDO::FETCH_ASSOC);
                return $actualUser;
            }
        }
    }

    public function deleteUser()
    {
        if ($_GET['action'] = "delete") {
            $deleteUser = $this->dataBase;
            $del = $deleteUser->query("DELETE FROM client WHERE id_cli = '$_GET[id_cli]'");
            return $del;
        }
    }
}
