<?php

class Services
{
    private $id_services, $icon, $name, $description, $price, $erreurs = [];

    const ICON_INVALIDE = 1;
    const NAME_INVALIDE = 2;
    const DESCRIPTION_INVALIDE = 3;
    const PRICE_INVALIDE = 4;


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
    public function setIcon($icon)
    {
        if (empty($icon)) {
            $this->erreur[] = self::ICON_INVALIDE;
        } else {
            $this->icon = $icon;
        }
    }

    public function setName($name)
    {
        if (empty($name) || !is_string($name)) {
            $this->erreur[] = self::NAME_INVALIDE;
        } else {
            $this->name = $name;
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

    public function setPrice($price)
    {
        if (empty($price)) {
            $this->erreur[] = self::PRICE_INVALIDE;
        } else {
            $this->price = $price;
        }
    }

    public function setErreurs($erreurs)
    {
        $this->erreurs = $erreurs;
        return $this;
    }

    // GETTERS

    public function getIdServices()
    {
        return $this->id_services;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }
}
