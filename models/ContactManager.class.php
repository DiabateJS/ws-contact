<?php
include 'bd.class.php';
include "../constants/Constants.class.php";

class ContactManager {

    private $bdManager;

    function __construct(){
        $this->bdManager = new BdManager();
    }

    function createContact($contact) {
        $sql = Constants::$SQL_CREATE_CONTACT;
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
        $sql = Constants::$SQL_CONTACT_UPDATE;
        $dicoParam = array (
            "id" => $contact->id,
            "nom" => $contact->nom,
            "tel" => $contact->tel,
            "email" => $contact->email,
            "adresse" => $contact->adresse,
            "commentaire" => $contact->commentaire
        );
        $result = $this->bdManager->executePreparedQuery($sql, $dicoParam);
        return $result;
    }

    function delete($id) {
        $sql = Constants::$SQL_CONTACT_DELETE;
        $dicoParam = array (
            "id" => $id
        );
        $result = $this->bdManager->executePreparedQuery($sql, $dicoParam);
        return $result;
    }

    function getAll(){
        $sql = Constants::$SQL_ALL_CONTACT;
        $entete = array("id","nom","tel","email","adresse","commentaire");
        $result = $this->bdManager->executeSelect($sql, $entete);
        return $result;
    }

    function getById($id){
        $sql = Constants::$SQL_CONTACT_BY_ID;
        $entete = array("id","nom","tel","email","adresse","commentaire");
        $dicoParam = array (
            "id" => $id
        );
        $result = $this->bdManager->executePreparedSelect($sql, $dicoParam, $entete);
        return $result;
    }
}

?>