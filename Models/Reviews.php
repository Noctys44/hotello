<?php 

class Reviews{

    private $id_reviews, $id_cli, $review, $rating, $id_room, $moderation, $erreurs = [];

    const ID_EQUIPMENT_INVALIDE = 9;

    public function __construct($data)
    {
        if(!empty($data))
        {
            $this->assignement($data);
        }
    }

    public function assignement($data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    /* --------------------------------------------- */
    /* SETTERS - SETTERS - SETTERS - SETTERS - SETTERS */
    /* --------------------------------------------- */

    
    public function setReviewsId($id_reviews)
    {
        $this->id_reviews = $id_reviews;
    }
    
    public function setIdClient($id_cli)
    {
        $this->id_cli = $id_cli;
    }
    
    public function setIdRoom($id_room)
    {
        $this->id_room = $id_room;
    }
    
    public function setReview($review)
    {
        $this->review = $review;
    }
    
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
    
    public function setModeration($moderation)
    {
        $this->moderation = $moderation;
    }

    /* --------------------------------------------- */
    /* GETTERS - GETTERS - GETTERS - GETTERS - GETTERS */
    /* --------------------------------------------- */


    public function getReviewsId(){
        $this->id_reviews;
    }


    public function getIdClient(){
        $this->id_cli;
    }


    public function getIdRoom(){
        $this->id_room;
    }


    public function getReview(){
        $this->review;
    }

    public function getRating(){
        $this->rating;
    }

    public function getModeration(){
        $this->moderation;
    }

}
