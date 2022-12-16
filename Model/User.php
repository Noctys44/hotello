<?php

class User
{

    private $id, $lastname, $firstname, $mail, $password, $address, $city, $zipcode, $phone, $birthdate, $country, $erreurs = [];

    const LASTNAME_INVALIDE = 1;
    const FIRSTNAME_INVALIDE = 2;
    const MAIL_INVALIDE = 3;
    const PASSWORD_INVALIDE = 4;
    const ADDRESS_INVALIDE = 5;
    const CITY_INVALIDE = 6;
    const ZIPCODE_INVALIDE = 7;
    const PHONE_INVALIDE = 8;
    const BIRTHDATE_INVALIDE = 9;
    const COUNTRY_INVALIDE = 10;


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
    public function setLastname($lastname)
    {
        if (empty($lastname) || !is_string($lastname)) {
            $this->erreur[] = self::LASTNAME_INVALIDE;
        } else {
            $this->lastname = $lastname;
        }
    }

    public function setFirstname($firstname)
    {
        if (empty($firstname) || !is_string($firstname)) {
            $this->erreur[] = self::FIRSTNAME_INVALIDE;
        } else {
            $this->firstname = $firstname;
        }
    }

    public function setMail($mail)
    {
        if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->erreur[] = self::MAIL_INVALIDE;
        } else {
            $this->mail = $mail;
        }
    }

    public function setPassword($password)
    {
        if (empty($password)) {
            $this->erreur[] = self::PASSWORD_INVALIDE;
        } else {
            $this->password = $password;
        }
    }

    public function setAddress($address)
    {
        if (empty($address)) {
            $this->erreur[] = self::ADDRESS_INVALIDE;
        } else {
            $this->address = $address;
        }
    }

    public function setCity($city)
    {
        if (empty($city)) {
            $this->erreur[] = self::CITY_INVALIDE;
        } else {
            $this->city = $city;
        }
    }

    public function setZipcode($zipcode)
    {
        if (empty($zipcode)) {
            $this->erreur[] = self::ZIPCODE_INVALIDE;
        } else {
            $this->zipcode = $zipcode;
        }
    }

    public function setPhone($phone)
    {
        if (empty($phone)) {
            $this->erreur[] = self::PHONE_INVALIDE;
        } else {
            $this->phone = $phone;
        }
    }

    public function setBirhtdate($birthdate)
    {

        if (empty($birthdate)) {
            $this->erreur[] = self::BIRTHDATE_INVALIDE;
        } else {

            $this->birthdate = $birthdate;
        }
    }

    public function setCountry($country)
    {
        if (empty($country)) {
            $this->erreur[] = self::COUNTRY_INVALIDE;
        } else {
            $this->country = $country;
        }
    }

    public function setErreurs($erreurs)
    {
        $this->erreurs = $erreurs;
        return $this;
    }


    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }

    // Function validate User
    public function isUserValid()
    {
        return !(empty($this->lastname) || empty($this->firstname) || empty($this->mail) || empty($this->password) || empty($this->address) || empty($this->city) || empty($this->zipcode) || empty($this->phone) || empty($this->birthdate) || empty($this->country));
    }
}
