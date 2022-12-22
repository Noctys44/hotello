<?php

require_once('pdo.php');
require_once('Reservation.php');

class ReservationManager
{
    private $dataBase;

    public function __construct(PDO $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function getByIdReservationRoom()
    {
        $reqId = $this->dataBase->query("SELECT * FROM reservation WHERE id_reservation = '$_GET[id_reservation]'");
        return $reqId;
    }

    public function insertReservation()
    {
        $req = $this->dataBase->prepare("INSERT INTO reservation(start_date, end_date, adults, children) VALUES(:start_date, :end_date, :adults, :children)");
        $req->bindValue(':start_date', $_POST['start_date'], PDO::PARAM_STR);
        $req->bindValue(':end_date', $_POST['end_date']);
        $req->bindValue(':adults', $_POST['adults']);
        $req->bindValue(':children', $_POST['children']);
        $req->execute();
    }

    public function getAllReservationRoomByUser()
    {
        $req = $this->dataBase->query("SELECT * FROM reservation
                                        INNER JOIN client
                                        ON reservation.id_cli = client.id_cli
                                        WHERE client.id_cli = '$_GET[id_cli]' 
                                        ");
        return $req;
    }

    public function getAllReservationServicesByUser()
    {
        $req = $this->dataBase->query("SELECT * FROM room_services 
                                        INNER JOIN services
                                        ON room_services.id_services = services.id_services
                                        INNER JOIN client
                                        ON room_services.id_cli = client.id_cli
                                        WHERE client.id_cli = '$_GET[id_cli]'");
        return $req;
    }

    public function updateReservation()
    {
        $update = $this->dataBase->prepare("UPDATE reservation SET start_date = :start_date, end_date = :end_date, adults = :adults, children = :children WHERE id_reservation = $_GET[id_reservation]");
        $update->bindValue(':start_date', $_POST['start_date'], PDO::PARAM_STR);
        $update->bindValue(':end_date', $_POST['end_date'], PDO::PARAM_STR);
        $update->bindValue(':adults', $_POST['adults'], PDO::PARAM_STR);
        $update->bindValue(':children', $_POST['children'], PDO::PARAM_STR);
        $update->execute();

        $getReservation =  $this->dataBase->query("SELECT * FROM reservation WHERE id_cli = '$_GET[id_cli]'");
        while ($row = $getReservation->fetch(PDO::FETCH_ASSOC)) {
            header("location:admin_reservation.php?id_cli=$row[id_cli]");
        }
    }

    public function deleteReservationRoom()
    {
        $delete = $this->dataBase->query("DELETE FROM reservation WHERE id_reservation = '$_GET[id_reservation]'");

        $getReservation =  $this->dataBase->query("SELECT * FROM reservation WHERE id_cli = '$_GET[id_cli]'");
        while ($row = $getReservation->fetch(PDO::FETCH_ASSOC)) {
            header("location:admin_reservation.php?id_cli=$row[id_cli]");
        }
    }

    public function deleteReservationServices()
    {
        $delete = $this->dataBase->query("DELETE FROM room_services WHERE id_res_services = '$_GET[id_res_services]'");

        $getReservation =  $this->dataBase->query("SELECT * FROM room_services WHERE id_cli = '$_GET[id_cli]'");
        while ($row = $getReservation->fetch(PDO::FETCH_ASSOC)) {
            header("location:admin_reservation.php?id_cli=$row[id_cli]");
        }
    }
}
