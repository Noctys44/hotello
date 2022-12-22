<?php 

    require_once('./inc/header.inc.php');
    require_once('./inc/top-nav.inc.php');
?>



        <!-- CONTAINER -->
        <div id="container">

            <!-- FORM RESERVATION -->
            <section class="form-search">
                <!-- FORM RESERVATION -->
                <form id="search">
                    <!-- ARRIVEE -->
                    <label for="arrived">Arrivée</label>
                    <input type="date" name="arrived" />

                    <!-- DEPART -->
                    <label for="departure">Départ</label>
                    <input type="date" name="departure" />

                    <!-- ADULTES -->
                    <label for="adults">Adultes</label>
                    <select name="adults">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>

                    <!-- ENFANTS -->
                    <label for="children">Enfants</label>
                    <select name="children">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>

                    <button type="submit">RECHERCHER</button>
                </form>
            </section>

            

        <div class="roomInfo">
            <h2>Un cadre exceptionnel en plein coeur de Paris</h2>
            <p class="text">
            Découvrez le charme captivant qui émane de la Ville Lumière au Paris
            HOTELLO. Notre hôtel au centre de Paris est idéalement situé au cœur
            du quartier des Champs Elysées, proche de sites parisiens
            emblématiques. Grâce à l’emplacement privilégié de notre hôtel à
            Paris, rue des boulets, explorez facilement les boutiques de luxe et
            les restaurants à la renommée internationale. Prenez le temps
            d’explorer tous les avantages de notre hôtel, parmi lesquels une salle
            de sport, un salon Executive et un restaurant français réputé. Le
            soir, vous pourrez vous reposer dans une chambre au design
            méticuleusement réfléchi avec une élégante salle de bains et une vue
            panoramique sur la ville. Si vous organisez un événement, profitez des
            prestigieuses salles de notre hôtel à Paris, et d’un service
            d’organisation spécialisé et d’une technologie de pointe. Nous sommes
            impatients de vous recevoir au Paris HOTELLO Hotel.
            </p>
        </div>

        <div class="room">
            <img
            src="./assets/img/chambres/chambreLuxe1.jpeg"
            alt="Chambre de luxe"
            class="roomImg"
            />
            <div class="roomInfo">
            <h3>Chambre de luxe</h3>
            <span>à partir de 650€</span>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae quod
                repellat nihil inventore corporis recusandae fugit culpa nisi
                tenetur accusamus itaque velit voluptas, nobis alias vero aliquid
                mollitia ipsum dolorum!
            </p>
            <button class="book"><a href="Room1.html">Réserver</a></button>
            </div>
        </div>

        <div class="room">
            <div class="roomInfo">
            <h3>Chambre de luxe double</h3>
            <span>à partir de 1200€</span>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae quod
                repellat nihil inventore corporis recusandae fugit culpa nisi
                tenetur accusamus itaque velit voluptas, nobis alias vero aliquid
                mollitia ipsum dolorum!
            </p>
            <button class="book"><a href="Room2.html">Réserver</a></button>
            </div>
            <img
            src="./assets/img/chambres/chambreLuxe3.jpeg"
            alt="Chambre de luxe"
            class="roomImg"
            />
        </div>

        <div class="room">
            <img
            src="./assets/img/chambres/suiteLuxe.jpeg"
            alt="Chambre de luxe"
            class="roomImg"
            />
            <div class="roomInfo">
            <h3>Suite de luxe</h3>
            <span>à partir de 2600€</span>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae quod
                repellat nihil inventore corporis recusandae fugit culpa nisi
                tenetur accusamus itaque velit voluptas, nobis alias vero aliquid
                mollitia ipsum dolorum!
            </p>
            <button class="book"><a href="Room3.html">Réserver</a></button>
            </div>
        </div>
        <a id="otherRoom" href="#">Voir les autres chambres</a>
        <h2>Services</h2>
        <p class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae quod
            repellat nihil inventore corporis recusandae fugit culpa nisi tenetur
            accusamus itaque velit voluptas, nobis alias vero aliquid mollitia ipsum
            dolorum!
        </p>

        <div id="services">
            <div class="service l b">
            <img src="./assets/img/services/signal-wifi.png" alt="" />
            <h3>Wifi</h3>
            </div>
            <div class="service l b">
            <img src="./assets/img/services/cafe.png" alt="" />
            <h3>Petit déjeuner</h3>
            </div>
            <div class="service l b">
            <img src="./assets/img/services/hotel-cart.png" alt="" />
            <h3>Bagagerie</h3>
            </div>
            <div class="service b">
            <img src="./assets/img/services/relax.png" alt="" />
            <h3>Spa</h3>
            </div>
            <div class="service l">
            <img src="./assets/img/services/piscine.png" alt="" />
            <h3>Piscine</h3>
            </div>
            <div class="service l">
            <img src="./assets/img/services/service-de-voiturier.png" alt="" />
            <h3>Voiturier</h3>
            </div>
            <div class="service l">
            <img src="./assets/img/services/room-service.png" alt="" />
            <h3>Room service</h3>
            </div>
            <div class="service">
            <img src="./assets/img/services/chef.png" alt="" />
            <h3>Restaurant</h3>
            </div>
        </div>
        <h2>Avis clients</h2>
        <p class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae quod
            repellat nihil inventore corporis recusandae fugit culpa nisi tenetur
            accusamus itaque velit voluptas, nobis alias vero aliquid mollitia ipsum
            dolorum!
        </p>
        </div>

        <!-- REVIEWS -->
        <div class="review">
        <div class="review__items">
            <h1>Magnifique !</h1>

            <span>
            "Tout est splendide avec un sens du détail exceptionnel, d’une
            propreté irréprochable, un service excellent et un personnel
            absolument merveilleux Merci à tous pour nous avoir fait sentir comme
            des rois."
            </span>

            <span>Bernard B.</span>
        </div>

        <div class="review__items">
            <h1>Merveilleux séjour</h1>

            <span>
            "Nous nous sommes offert un week-end en amoureux. Le room service
            était de qualité (pas d’autre choix pour cause de restrictions) et le
            personnel vraiment adorable et à l’écoute. Nous reviendrons pour vivre
            pleinement l’expérience, sans restrictions nous l’espérons :-)"
            </span>

            <span>Marie C.</span>
        </div>

        <div class="review__items">
            <h1>Parfait</h1>

            <span>
            "J’ai pratiquement tout aimé, les chambres étaient bien insonorisées,
            le personnel était aux petits soins, le room service au top, tout
            était ok."
            </span>

            <span>Paul D.</span>
        </div>

        <div class="review__button">
            <button id="prev" onclick="previousReview()">Précédent</button>

            <button id="next" onclick="nextReview()">Suivant</button>
        </div>
        </div>

<?php 
    require_once('./inc/footer.inc.php')

?>
