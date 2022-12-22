<?php

/* REVIEWS */
require_once('../Models/pdo.php');
require_once('../Models/Reviews.php');
require_once('../Models/ReviewsManager.php');

$review = new ReviewsManager($pdo);

$success = "";
$id_reviews = "";
$id_cli = "";
$reviewText = "";
$rating = "";
$id_room = "";
$moderation = "";


/* DELETE REVIEWS */
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $review->deleteReviews($review);
    header('location:reviewsPage.php ');
}

/* UPDATE REVIEWS */
if (isset($_GET['action']) && $_GET['action'] == 'update') {

    $idReview = $review->getReviewsById();
    $detailReview = $idReview->fetch(PDO::FETCH_ASSOC);


    $id_reviews = (isset($detailReview['id_reviews'])) ? $detailReview['id_reviews'] : "";
    $id_cli = (isset($detailReview['firstname']['lastname'])) ? $detailReview['firstname']['lastname'] : "";
    $reviewText = (isset($detailReview['review'])) ? $detailReview['review'] : "";
    $rating = (isset($detailReview['rating'])) ? $detailReview['rating'] : "";
    $id_room = (isset($detailReview['title_room'])) ? $detailReview['title_room'] : "";
    $moderation = (isset($detailReview['moderation'])) ? $detailReview['moderation'] : "";


    if (!empty($_POST)) {
        $review->updateReviews($review);
    }
}

/* POST REVIEW */
if (!empty($_POST) && !isset($_GET['action']) && !isset($_GET['action']) == 'update') {
    $reviews = new Reviews(
        [
            'id_cli' => $_POST['id_cli'],
            'review' => $_POST['review'],
            'rating' => $_POST['rating'],
            'id_room' => $_POST['id_room'],
            'moderation' => $_POST['moderation']
        ]
    );

    $review->insertReviews($reviews);
    $success = '<div class="alert alert-success" role="alert">L\'utilisateur a bien été enregistré</div>';
}


?>

<?php require_once('../Models/header.inc.php'); ?>

<!-- ---------------------------------------- -->
<!-- REVIEWS TABLE -->
<!-- ---------------------------------------- -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 table-responsive">

            <?php echo $success; ?>

            <table class="table">
                <thead>
                    <th>ID Review</th>
                    <th>Client</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Room</th>
                    <th>Modération</th>
                    <th>Actions</th>
                    <th></th>
                </thead>

                <tbody>

                    <?php
                    $reviews = $review->getAllReviews();
                    while ($reviewAll = $reviews->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                        <tr>
                            <td><?php echo $reviewAll['id_reviews']; ?></td>
                            <td><?php echo $reviewAll['lastname'] . " " . $reviewAll['firstname']; ?></td>
                            <td><?php echo $reviewAll['review']; ?></td>
                            <td><?php echo $reviewAll['rating']; ?></td>
                            <td><?php echo $reviewAll['title_room']; ?></td>
                            <td><?php echo $reviewAll['moderation']; ?></td>
                            <td>
                                <a href="<?php echo "?action=update&id_reviews=$reviewAll[id_reviews]"; ?>" class="btn btn-warning">Update</a>
                            </td>
                            <td>
                                <a href="<?php echo "?action=delete&id_reviews=$reviewAll[id_reviews]"; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table>

        </div>
    </div>
</div>

<br>
<hr>
<br>

<!-- ----------------------------------------- -->
<!-- REVIEWS FORM -->
<!-- ----------------------------------------- -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 table-responsive">

            <form action="" method="POST">

                <input type="hidden" name="id_reviews" value="<?php echo $id_reviews ?>">

                <?php

                if (!isset($_GET['action']) && !isset($_GET['action']) == 'update') {
                ?>

                    <!-- CLIENT BASE -->

                    <div class="mb-3">
                        <label for="id_cli" class="form-label">Client</label>
                        <select class="form-select mb-3" aria-label="id_cli" name="id_cli" id="id_cli">
                            <option value=""> --Selectioner un client-- </option>

                            <?php
                            $findAllClients = $review->getAllClients($review);
                            $getAllClients = $findAllClients->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($getAllClients as $clients) :
                            ?>
                                <!-- <textarea name="" id="" cols="30" rows="10">
                                    <?php var_dump($clients['firstname']) ?>
                                </textarea> -->
                                <option><?php echo $clients['id_cli'] . " - " . $clients['firstname'] . " " . $clients['lastname']; ?></option>

                            <?php endforeach ?>
                        </select>
                    </div>

                <?php } else { ?>


                    <!-- CLIENT UPDATE -->
                    <div class="mb-3">
                        <label for="id_cli" class="form-label">Client</label>
                        <input type="text" id="id_cli" name="id_cli" class="form-control" placeholder="Client" value="<?php echo $detailReview['id_cli'] . " - " . $detailReview['firstname'] . " " . $detailReview['lastname']; ?>">
                    </div>

                <?php } ?>

                <!-- REVIEW -->
                <div class="mb-3">
                    <label for="review" class="form-label">Avis</label>
                    <textarea class="form-control" name="review" id="review" name="review"><?php echo $reviewText ?></textarea>
                </div>

                <!-- RATING -->
                <div class="mb-3">
                    <label for="rating" class="form-label">Note</label>
                    <input type="text" id="rating" name="rating" class="form-control" placeholder="Rating" value="<?php echo $rating ?>">
                </div>


                <?php if (!isset($_GET['action']) && !isset($_GET['action']) == 'update') { ?>

                    <!-- ID ROOM NORMAL -->
                    <!-- <div class="mb-3">
                            <label for="id_room" class="form-label">Chambre</label>
                            <input type="text" id="id_room" name="id_room" class="form-control" placeholder="Id_room">
                        </div> -->

                    <div class="mb-3">
                        <label for="id_room" class="form-label">Chambre</label>
                        <select class="form-select mb-3" aria-label="id_room" name="id_room" id="id_room">
                            <option value=""> --Selectioner une chambre-- </option>

                            <?php
                            $findAllRooms = $review->getAllRooms($review);
                            $getAllRooms = $findAllRooms->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($getAllRooms as $rooms) :
                            ?>

                                <option><?php echo $rooms['id_room'] . " - " . $rooms['title_room']; ?></option>

                            <?php endforeach ?>
                        </select>
                    </div>

                <?php } else { ?>

                    <!-- ID ROOM UPDATE-->
                    <div class="mb-3">
                        <label for="id_room" class="form-label">Chambre</label>
                        <input type="text" id="id_room" name="id_room" class="form-control" placeholder="Id_room" value="<?php echo $detailReview['id_room'] . " - " . $detailReview['title_room'] ?>">
                    </div>
                <?php } ?>

                <!-- MODERATION -->
                <div class="mb-3">
                    <label for="moderation" class="form-label">Statut de la modération</label>
                    <select class="form-select mb-3" aria-label="moderation" name="moderation" id="moderation">
                        <option value="validé" <?php if ($moderation == 'validé') {
                                                    echo "selected";
                                                } ?>>Validé</option>
                        <option value="refusé" <?php if ($moderation == 'refusé') {
                                                    echo "selected";
                                                } ?>>Refusé</option>
                    </select>
                </div>

                <!-- SUBMIT -->
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Envoyer">
                </div>

            </form>

        </div>
    </div>
</div>

<?php require_once('../Models/footer.inc.php'); ?>