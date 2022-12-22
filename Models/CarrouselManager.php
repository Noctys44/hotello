<?php

require_once('pdo.php');
require_once('Carrousel.php');

class CarrouselManager
{
    private $dataBase;

    public function __construct(PDO $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function getAllImages()
    {
        $req = $this->dataBase->query("SELECT * FROM carousel");
        return $req;
    }

    public function getImageById()
    {
        $getId = $this->dataBase->query("SELECT * FROM carousel WHERE id_image = '$_GET[id_image]'");
        return $getId;
    }

    public function insertCarrousel()
    {
        if (!empty($_FILES['image'])) {
            $nom_img = time() . '' . $_FILES['image']['name'];

            define('RACINE', $_SERVER['DOCUMENT_ROOT'] . '/hotello/');
            define('URL', 'http://localhost/hotello/');

            $img_doc = RACINE . "photo/$nom_img";
            $img_bdd = URL . "photo/$nom_img";

            if ($_FILES['image']['size'] <= 8000000) {
                $data = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);


                $tab = ['jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF', 'Jpg', 'Png', 'Jpeg', 'Gif'];

                if (in_array($data, $tab)) {
                    move_uploaded_file($_FILES['image']['tmp_name'], $img_doc);
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
            $insertImage = $this->dataBase->prepare("INSERT INTO carousel(image) VALUES(:image)");
            $insertImage->bindValue(':image', $img_bdd, PDO::PARAM_STR);
            $insertImage->execute();

            header('location:admin_carrousel.php');
        }
    }

    public function updateCarrousel()
    {
        if (!empty($_FILES['image'])) {
            $nom_img = time() . '' . $_FILES['image']['name'];

            define('RACINE', $_SERVER['DOCUMENT_ROOT'] . '/hotello/');
            define('URL', 'http://localhost/hotello/');

            $img_doc = RACINE . "photo/$nom_img";
            $img_bdd = URL . "photo/$nom_img";

            if ($_FILES['image']['size'] <= 8000000) {
                $data = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);


                $tab = ['jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF', 'Jpg', 'Png', 'Jpeg', 'Gif'];

                if (in_array($data, $tab)) {
                    move_uploaded_file($_FILES['image']['tmp_name'], $img_doc);
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
            $insertImage = $this->dataBase->prepare("UPDATE carousel SET image = :image WHERE id_image = $_GET[id_image]");
            $insertImage->bindValue(':image', $img_bdd, PDO::PARAM_STR);
            $insertImage->execute();

            header('location:admin_carrousel.php');
        }
    }

    public function deleteCarrousel()
    {
        $deleteServices = $this->dataBase->query("DELETE FROM carousel WHERE id_image = '$_GET[id_image]'");
        return $deleteServices;

        header('location:admin_carrousel.php');
    }
}
