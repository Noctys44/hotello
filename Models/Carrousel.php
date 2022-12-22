<?php

require_once('pdo.php');

class Carrousel
{
    private $id_image, $image, $erreurs = [];

    const IMAGE_INVALIDE = 1;

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

    public function setImage($image)
    {
        if (empty($image)) {
            $this->erreur[] = self::IMAGE_INVALIDE;
        } else {
            $this->image = $image;
        }
    }

    public function setErreurs($erreurs)
    {
        $this->erreurs = $erreurs;
        return $this;
    }

    // GETTERS

    public function getIdImage()
    {
        return $this->id_image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }
}
