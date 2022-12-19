<?php

require_once('../Model/init.php');

class Reservation
{
    private $id_reservation, $id_room, $id_cli, $date, $adults, $children, $erreurs = [];

    const IDRESERVATION_INVALIDE = 1;
    const IDROOM_INVALIDE = 2;
    const IDCLI_INVALIDE = 3;
    const DATE_INVALIDE = 4;
    const ADULTS_INVALIDE = 5;
    const CHILDREN_INVALIDE = 6;


    public function __construct(array $data)
    {
        $this->assignement($data);
    }

    public function assignement(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // SETTERS

    public function setIdReservation($id_reservation)
    {
        if (empty($id_reservation)) {
            $this->erreur[] = self::IDRESERVATION_INVALIDE;
        } else {
            $this->id_reservation = $id_reservation;
        }
    }

    public function setIdRoom($id_room)
    {
        if (empty($id_room)) {
            $this->erreur[] = self::IDROOM_INVALIDE;
        } else {
            $this->id_room = $id_room;
        }
    }

    public function setDate($date)
    {
        if (empty($date)) {
            $this->erreur[] = self::DATE_INVALIDE;
        } else {
            $this->date = $date;
        }
    }

    public function setAdults($adults)
    {
        if (empty($adults)) {
            $this->erreur[] = self::ADULTS_INVALIDE;
        } else {
            $this->adults = $adults;
        }
    }

    public function setChildren($children)
    {
        if (empty($children)) {
            $this->erreur[] = self::CHILDREN_INVALIDE;
        } else {
            $this->children = $children;
        }
    }

    public function setIdCli($id_cli)
    {
        if (empty($id_cli)) {
            $this->erreur[] = self::IDCLI_INVALIDE;
        } else {
            $this->id_cli = $id_cli;
        }
    }

    public function setErreurs($erreurs)
    {
        $this->erreurs = $erreurs;
        return $this;
    }


    // GETTERS

    public function getIdReservation()
    {
        return $this->id_reservation;
    }

    public function getIdRoom()
    {
        return $this->id_room;
    }

    public function getIdCli()
    {
        return $this->id_cli;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getAdults()
    {
        return $this->adults;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }
}
