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

    public function getAllRooms()
    {
        $getRooms = $this->dataBase->query("SELECT * FROM room ORDER BY size DESC");
        return $getRooms;
    }

    public function getRoomById($id_room)
    {
        $idRoom = $this->dataBase;
        $getIdRoom = $idRoom->query("SELECT * FROM room WHERE id_room = $id_room");
        return $getIdRoom;
    }

    public function updateRoom()
    {
        $updateRoom = $this->dataBase;
        if ($_POST) {
            $reqUpdate = $updateRoom->query("UPDATE room SET title_room = '$_POST[title_room]', price_room = '$_POST[price_room]', type_chambre = '$_POST[type_chambre]', size = '$_POST[size], description = '$_POST[description], adults = '$_POST[adults],  children = '$_POST[children], status = '$_POST[status]'");
        }
    }

    public function deleteRoom()
    {
        if ($_GET['action'] = "delete") {
            $deleteRoom = $this->dataBase;
            $del = $deleteRoom->query("DELETE FROM room WHERE id_room = '$_GET[id_room]'");
        }
    }

    public function insertRoom(Room $room)
    {
        $req = $this->dataBase->prepare("INSERT INTO room(title_room, price_room, type_chambre, size, description, adults, children) VALUES(:title_room, :price_room, :type_chambre, :size, :description, :adults, :children)");
        $req->bindValue(':title_room', $room->getTitle(), PDO::PARAM_STR);
        $req->bindValue(':price_room', $room->getPrice(), PDO::PARAM_STR);
        $req->bindValue(':type_chambre', $room->getType(), PDO::PARAM_STR);
        $req->bindValue(':size', $room->getSize(), PDO::PARAM_STR);
        $req->bindValue(':description', $room->getDescription(), PDO::PARAM_STR);
        $req->bindValue(':adults', $room->getAdults(), PDO::PARAM_INT);
        $req->bindValue(':children', $room->getChildren(), PDO::PARAM_INT);
        $req->execute();
    }
}

// $req = $this->dataBase->prepare("INSERT INTO room(title_room, price_room, type_chambre, size, description, adults, children) VALUES(:title_room, :price_room, :type_chambre, :size, :description, :adults, :children)");
// $req->bindValue(':title_room', $_POST['title_room'], PDO::PARAM_STR);
// $req->bindValue(':price_room',  $_POST['price_room'], PDO::PARAM_STR);
// $req->bindValue(':type_chambre',  $_POST['type_chambre'], PDO::PARAM_STR);
// $req->bindValue(':size',  $_POST['size'], PDO::PARAM_STR);
// $req->bindValue(':description',  $_POST['description'], PDO::PARAM_STR);
// $req->bindValue(':adults',  $_POST['adults'], PDO::PARAM_INT);
// $req->bindValue(':children',  $_POST['children'], PDO::PARAM_INT);
// $req->execute();
