<?php

class Contact {
    public $nom;
    public $tel;
    public $email;
    public $adresse;
    public $commentaire;

    function __construct($nom, $tel, $email, $adresse, $commentaire){
        $this->nom = $nom;
        $this->tel = $tel;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->commentaire = $commentaire;
    }
}
?>