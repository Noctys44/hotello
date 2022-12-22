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
    const COUNTRY_INVALIDE = 9;


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
        if (empty($lastname) || !is_string($lastname) || strlen($lastname) <= 3 || strlen($lastname) >= 25) {
            $this->erreurs[] = self::LASTNAME_INVALIDE;
            // echo '<div class="form-text text-danger fw-bold"> Le nom est invalide </div>';
        } else {
            $lastname = htmlspecialchars(addslashes(trim($_POST['lastname'])));
            $this->lastname = $lastname;
        }
    }

    public function setFirstname($firstname)
    {
        if (empty($firstname) || !is_string($firstname) || strlen($firstname) <= 2 || strlen($firstname) >= 25) {
            $this->erreurs[] = self::FIRSTNAME_INVALIDE;
            // echo '<div class="form-text text-danger fw-bold"> Le prénom est invalide </div>';
        } else {
            $firstname = htmlspecialchars(addslashes(trim($_POST['firstname'])));
            $this->firstname = $firstname;
        }
    }

    public function setMail($mail)
    {
        if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->erreurs[] = self::MAIL_INVALIDE;
            // echo '<div class="form-text text-danger fw-bold"> L\'email est invalide </div>';
        } else {
            $mail = htmlspecialchars(addslashes(trim($_POST['mail'])));
            $this->mail = $mail;
        }
    }

    public function setPassword($password)
    {
        if (empty($password) || strlen($password) <= 8 || strlen($password) >= 20) {
            $this->erreurs[] = self::PASSWORD_INVALIDE;
        } else {
            $mdp = htmlspecialchars(addslashes(trim($_POST['password'])));
            $password = password_hash($mdp, PASSWORD_DEFAULT);
            $this->password = $password;
        }
    }

    public function setAddress($address)
    {
        if (empty($address)) {
            $this->erreurs[] = self::ADDRESS_INVALIDE;
        } else {
            $address = htmlspecialchars(addslashes(trim($_POST['address'])));
            $this->address = $address;
        }
    }

    public function setCity($city)
    {
        if (empty($city) || !is_string($city)) {
            $this->erreurs[] = self::CITY_INVALIDE;
        } else {
            $city = htmlspecialchars(addslashes(trim($_POST['city'])));
            $this->city = $city;
        }
    }

    public function setZipcode($zipcode)
    {
        if (empty($zipcode) || strlen($zipcode) !== 5 && is_string($zipcode)) {
            $this->erreurs[] = self::ZIPCODE_INVALIDE;
        } else {
            $zipcode = htmlspecialchars(addslashes(trim($_POST['zipcode'])));
            $this->zipcode = $zipcode;
        }
    }

    public function setPhone($phone)
    {
        if (empty($phone) || strlen($phone) !== 10 && is_string($phone)) {
            $this->erreurs[] = self::PHONE_INVALIDE;
        } else {
            $phone = htmlspecialchars(addslashes(trim($_POST['phone'])));
            $this->phone = $phone;
        }
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function setCountry($country)
    {
        if (empty($country) || !is_string($country)) {
            $this->erreurs[] = self::COUNTRY_INVALIDE;
        } else {
            $country = htmlspecialchars(addslashes(trim($_POST['country'])));
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
