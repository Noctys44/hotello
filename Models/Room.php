<?php

class Room
{

    private $id_room, $title_room, $price_room, $type_chambre, $size, $description, $adults, $children, $status, $erreurs = [];

    const TITLE_INVALIDE = 1;
    const PRICE_INVALIDE = 2;
    const TYPE_INVALIDE = 3;
    const SIZE_INVALIDE = 4;
    const DESCRIPTION_INVALIDE = 5;
    const ADULTS_INVALIDE = 6;
    const CHILDREN_INVALIDE = 7;
    const STATUS_INVALIDE = 8;

    public function __construct($data)
    {
        if (!empty($data)) {
            $this->assignement($data);
        }
    }

    public function assignement($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /* --------------------------------------------- */
    /* SETTERS - SETTERS - SETTERS - SETTERS - SETTERS */
    /* --------------------------------------------- */

    public function setRoomId($id_room)
    {
        if (empty($id_room)) {
            $this->erreur[] = self::TITLE_INVALIDE;
        } else {
            $this->id_room = $id_room;
        }
    }
    public function setTitle($title_room)
    {
        if (empty($title_room)) {
            $this->erreur[] = self::TITLE_INVALIDE;
        } else {
            $this->title_room = $title_room;
        }
    }

    public function setPrice($price_room)
    {
        if (empty($price_room)) {
            $this->erreur[] = self::PRICE_INVALIDE;
        } else {
            $this->price_room = $price_room;
        }
    }

    public function setType($type_chambre)
    {
        if (empty($type_chambre)) {
            $this->erreur[] = self::TYPE_INVALIDE;
        } else {
            $this->type_chambre = $type_chambre;
        }
    }

    public function setSize($size)
    {
        if (empty($size)) {
            $this->erreur[] = self::SIZE_INVALIDE;
        } else {
            $this->size = $size;
        }
    }

    public function setDescription($description)
    {
        if (empty($description)) {
            $this->erreur[] = self::DESCRIPTION_INVALIDE;
        } else {
            $this->description = $description;
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

    public function setStatus($status)
    {
        if (empty($status)) {
            $this->erreur[] = self::STATUS_INVALIDE;
        } else {
            $this->status = $status;
        }
    }

    public function setErreurs($erreurs)
    {
        $this->erreurs = $erreurs;
        return $this;
    }


    /* --------------------------------------------- */
    /* GETTERS - GETTERS - GETTERS - GETTERS - GETTERS */
    /* --------------------------------------------- */

    public function getIdRoom()
    {
        return $this->id_room;
    }


    public function getTitle()
    {
        return $this->title_room;
    }


    public function getPrice()
    {
        return $this->price_room;
    }

    public function getType()
    {
        return $this->type_chambre;
    }


    public function getSize()
    {
        return $this->size;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function getAdults()
    {
        return $this->adults;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }

    public function isRoomValid()
    {
        return !(empty($this->title_room) || empty($this->price_room) || empty($this->type_chambre) || empty($this->size) || empty($this->description) || empty($this->adults) || empty($this->children));
    }
}
