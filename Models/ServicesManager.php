<?php

require_once('pdo.php');
require_once('Services.php');

class ServicesManager
{
    private $dataBase;

    public function __construct(PDO $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function getAllServices()
    {
        $req = $this->dataBase->query("SELECT * FROM services");
        return $req;
    }

    public function getServiceById()
    {
        $getId = $this->dataBase->query("SELECT * FROM services WHERE id_services = '$_GET[id_services]'");
        return $getId;
    }

    public function insertServices()
    {
        if (!empty($_FILES['icon'])) {
            $nom_img = time() . '' . $_FILES['icon']['name'];

            define('RACINE', $_SERVER['DOCUMENT_ROOT'] . '/hotello/');
            define('URL', 'http://localhost/hotello/');

            $img_doc = RACINE . "photo/$nom_img";
            $img_bdd = URL . "photo/$nom_img";

            if ($_FILES['icon']['size'] <= 8000000) {
                $data = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);


                $tab = ['jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF', 'Jpg', 'Png', 'Jpeg', 'Gif'];

                if (in_array($data, $tab)) {
                    move_uploaded_file($_FILES['icon']['tmp_name'], $img_doc);
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                Format non autorisé 
                </div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">
            Vérifier la taille de votre image
            </div>';
            }
            $insertServices = $this->dataBase->prepare("INSERT INTO services(icon, name, description, price) VALUES(:icon, :name, :description, :price)");
            $insertServices->bindValue(':icon', $img_bdd, PDO::PARAM_STR);
            $insertServices->bindValue(':name', $_POST['name']);
            $insertServices->bindValue(':description', $_POST['description']);
            $insertServices->bindValue(':price', $_POST['price']);
            $insertServices->execute();
        }
    }

    public function updateServices()
    {
        if (!empty($_FILES['icon'])) {
            $nom_img = time() . '' . $_FILES['icon']['name'];

            define('RACINE', $_SERVER['DOCUMENT_ROOT'] . '/hotello/');
            define('URL', 'http://localhost/hotello/');

            $img_doc = RACINE . "photo/$nom_img";
            $img_bdd = URL . "photo/$nom_img";

            if ($_FILES['icon']['size'] <= 8000000) {
                $data = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);


                $tab = ['jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF', 'Jpg', 'Png', 'Jpeg', 'Gif'];

                if (in_array($data, $tab)) {
                    move_uploaded_file($_FILES['icon']['tmp_name'], $img_doc);
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                Format non autorisé 
                </div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">
            Vérifier la taille de votre image
            </div>';
            }
            $updateServices = $this->dataBase->prepare("UPDATE services SET icon = :icon, name = :name, description = :description, price = :price WHERE id_services = $_GET[id_services]");
            $updateServices->bindValue(':icon', $img_bdd, PDO::PARAM_STR);
            $updateServices->bindValue(':name', $_POST['name']);
            $updateServices->bindValue(':description', $_POST['description']);
            $updateServices->bindValue(':price', $_POST['price']);
            $updateServices->execute();

            header('location:admin_services.php');
        }
    }

    public function deleteServices()
    {
        $deleteServices = $this->dataBase->query("DELETE FROM services WHERE id_services = '$_GET[id_services]'");
        return $deleteServices;
    }
}
