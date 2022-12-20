<?php

require_once('init.php');
require_once('Room.php');

class RoomManager
{

    private $dataBase;

    public function __construct(PDO $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    // public function displayError()
    // {
    //     $erreurs = $this->getErreurs();
    //     return $erreurs;
    // }

    public function getAllRooms()
    {
        $getRooms = $this->dataBase->query("SELECT * FROM room ORDER BY size DESC");
        return $getRooms;
    }

    public function getRoomById()
    {
        $idRoom = $this->dataBase;
        $getIdRoom = $idRoom->query("SELECT * FROM room WHERE id_room = '$_GET[id_room]'");
        return $getIdRoom;
    }


    public function deleteRoom()
    {
        // if($_GET['action'] = "delete")
        // {
        $deleteRoom = $this->dataBase;
        $del = $deleteRoom->query("DELETE FROM room WHERE id_room = '$_GET[id_room]'");
        // }
    }

    public function insertRoom(Room $room)
    {
        $req = $this->dataBase->prepare("INSERT INTO room(title_room, price_room, type_chambre, size, description, adults, children, status) VALUES(:title_room, :price_room, :type_chambre, :size, :description, :adults, :children, :status)");
        $req->bindValue(':title_room', $_POST['title_room'], PDO::PARAM_STR);
        $req->bindValue(':price_room',  $_POST['price_room'], PDO::PARAM_STR);
        $req->bindValue(':type_chambre',  $_POST['type_chambre'], PDO::PARAM_STR);
        $req->bindValue(':size',  $_POST['size'], PDO::PARAM_STR);
        $req->bindValue(':description',  $_POST['description'], PDO::PARAM_STR);
        $req->bindValue(':adults',  $_POST['adults'], PDO::PARAM_INT);
        $req->bindValue(':children',  $_POST['children'], PDO::PARAM_INT);
        $req->bindValue(':status',  $_POST['status'], PDO::PARAM_STR);
        $req->execute();

        header('location:roomPage.php');
    }

    public function updateRoom()
    {
        // $updateRoom = $this->dataBase;

        $reqUpdate = $this->dataBase->prepare("UPDATE room SET title_room = :title_room , price_room = :price_room, type_chambre = :type_chambre, size = :size, description = :description, adults = :adults,  children = :children, status = :status WHERE id_room = $_GET[id_room]");

        $reqUpdate->bindValue(':title_room', $_POST['title_room'], PDO::PARAM_STR);
        $reqUpdate->bindValue(':price_room',  $_POST['price_room'], PDO::PARAM_STR);
        $reqUpdate->bindValue(':type_chambre',  $_POST['type_chambre'], PDO::PARAM_STR);
        $reqUpdate->bindValue(':size',  $_POST['size'], PDO::PARAM_STR);
        $reqUpdate->bindValue(':description',  $_POST['description'], PDO::PARAM_STR);
        $reqUpdate->bindValue(':adults',  $_POST['adults'], PDO::PARAM_INT);
        $reqUpdate->bindValue(':children',  $_POST['children'], PDO::PARAM_INT);
        $reqUpdate->bindValue(':status',  $_POST['status'], PDO::PARAM_STR);
        $reqUpdate->execute();


        header('location:roomPage.php ');
        $success = '<div class="alert alert-success" role="alert">La room a bioen été mise à jours</div>';
    }
}
