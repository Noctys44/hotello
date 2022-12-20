<?php

require_once('init.php');
require_once('Equipments.php');

class ReviewsManager
{
    private $dataBase;

    /* CONSTRUCTOR */
    public function __construct(PDO $dataBase)
    {
        $this->dataBase = $dataBase;
    }


    /* FIND ALL */
    public function getAllReviews()
    {
        // $getAllReviews = $this->dataBase->query("SELECT * FROM reviews ORDER BY id_reviews");
        $getAllReviews = $this->dataBase->query("SELECT * FROM reviews
        INNER JOIN client ON reviews.id_cli = client.id_cli
        INNER JOIN room ON reviews.id_room = room.id_room
        ORDER BY id_reviews");
        return $getAllReviews;
    }


    /* FIND ALL CLIENTS */

    public function getAllClients()
    {
        $getAllClients = $this->dataBase->query("SELECT * FROM client
        INNER JOIN reviews ON client.id_cli = reviews.id_cli
        ORDER BY client.id_cli");
        return $getAllClients;
    }


    /* FIND ALL ROOMS */

    public function getAllRooms()
    {
        $getAllRooms = $this->dataBase->query("SELECT * FROM room
        INNER JOIN reviews ON room.id_room = reviews.id_room
        ORDER BY room.id_room");
        return $getAllRooms;
    }

    /* FIND BY ID */
    public function getReviewsById()
    {
        $idReviews = $this->dataBase;
        $getIdReviews = $idReviews->query("SELECT DISTINCT * FROM reviews
        INNER JOIN client ON reviews.id_cli = client.id_cli
        INNER JOIN room ON reviews.id_room = room.id_room
        WHERE id_reviews = '$_GET[id_reviews]'");
        return $getIdReviews;
    }

    /* DELETE */
    public function deleteReviews()
    {
        $deletReviews = $this->dataBase;
        $del = $deletReviews->query("DELETE FROM reviews WHERE id_reviews = '$_GET[id_reviews]'");
        header('location:reviewsPage.php ');
    }

    /* INSERT REVIEWS */
    public function insertReviews(Reviews $reviews)
    {
        $ad = $this->dataBase->prepare("INSERT INTO reviews(id_cli, review, rating, id_room, moderation) VALUES (:id_cli, :review, :rating, :id_room, :moderation)");

        $ad->bindValue(':id_cli', $_POST['id_cli'], PDO::PARAM_INT);
        $ad->bindValue(':review', $_POST['review'], PDO::PARAM_STR);
        $ad->bindValue(':rating', $_POST['rating'], PDO::PARAM_INT);
        $ad->bindValue(':id_room', $_POST['id_room'], PDO::PARAM_INT);
        $ad->bindValue(':moderation', $_POST['moderation'], PDO::PARAM_STR);

        $ad->execute();
        header('location:reviewsPage.php ');
    }

    /* UPDATE REVIEWS */
    public function updateReviews()
    {
        $reqUpdate = $this->dataBase->prepare("UPDATE reviews SET id_cli = :id_cli, review = :review, rating = :rating, id_room = :id_room, moderation = :moderation");

        $reqUpdate->bindValue(':id_cli', $_POST['id_cli'], PDO::PARAM_INT);
        $reqUpdate->bindValue(':review', $_POST['review'], PDO::PARAM_STR);
        $reqUpdate->bindValue(':rating', $_POST['rating'], PDO::PARAM_INT);
        $reqUpdate->bindValue(':id_room', $_POST['id_room'], PDO::PARAM_INT);
        $reqUpdate->bindValue(':moderation', $_POST['moderation'], PDO::PARAM_STR);

        $reqUpdate->execute();

        header('location:reviewsPage.php ');
    }
}
