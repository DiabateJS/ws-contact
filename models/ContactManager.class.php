<?php
include 'bd.class.php';
include "../constants/Constants.class.php";

class ContactManager {

    private $bdManager;

    function __construct(){
        $this->bdManager = new BdManager();
    }

    function createContact($contact) {
        $sql = "insert into personnes(nom,tel,email,adresse,commentaire) value (:nom,:tel,:email,:adresse,:commentaire)";
        $dicoParam = array (
            "nom" => $contact->nom,
            "tel" => $contact->tel,
            "email" => $contact->email,
            "adresse" => $contact->adresse,
            "commentaire" => $contact->commentaire
        );
        $result = $this->bdManager->executePreparedQuery($sql, $dicoParam);
        return $result;
    }

    function update($contact) {
        $sql = "";
        $dicoParam = array (
            "nom" => $contact->nom,
            "tel" => $contact->tel,
            "email" => $contact->email,
            "adresse" => $contact->adresse,
            "commentaire" => $contact->commentaire
        );
        $result = $this->bdManager->executePreparedQuery($sql, $dicoParam);
        return $result;
    }

    function getAll(){
        $sql = "";
        $entete = array("id","nom","tel","email","adresse","commentaire");
        $result = $this->bdManager->executeSelect($sql, $entete);
        return $result;
    }

    function getById($id){
        $sql = "";
        $entete = array("id","nom","tel","email","adresse","commentaire");
        $dicoParam = array (
            "id" => $id
        );
        $result = $this->bdManager->executePreparedSelect($sql, $dicoParam, $entete);
        return $result;
    }
}

?>