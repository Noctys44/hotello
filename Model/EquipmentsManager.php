<?php

require_once('init.php');
require_once('Equipments.php');

class EquipmentsManager
{
    private $dataBase;

    public function __construct(PDO $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function getAllEquipments()
    {
        $getEquipments = $this->dataBase->query("SELECT * FROM equipments ORDER BY id_equip");
        return $getEquipments;
    }

    public function getEquipmentsById()
    {
        $idEquipment = $this->dataBase;
        $getIdEquipment = $idEquipment->query("SELECT * FROM equipments WHERE id_equip = '$_GET[id_equip]'");
        return $getIdEquipment;
    }

    public function deleteEquipment()
    {
        $deleteEquipment = $this->dataBase;
        $del = $deleteEquipment->query("DELETE FROM equipments WHERE id_equip = '$_GET[id_equip]'");
        header('location:equipmentsPage.php ');
    }

    public function insertEquipment(Equipments $equipments)
    {
        $ad = $this->dataBase->prepare("INSERT INTO equipments(name_equip) VALUES (:name_equip)");

        $ad->bindValue(':name_equip', $_POST['name_equip'], PDO::PARAM_STR);
        $ad->execute();

        header('location:equipmentsPage.php ');
    }

    public function updateEquipments()
    {
        $reqUpdate = $this->dataBase->prepare("UPDATE equipments SET name_equip = :name_equip WHERE id_equip = $_GET[id_equip]");

        $reqUpdate->bindValue(':name_equip', $_POST['name_equip'], PDO::PARAM_STR);
        $reqUpdate->execute();

        header('location:equipmentsPage.php ');
    }
}
