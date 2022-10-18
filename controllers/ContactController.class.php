<?php
include "../constants/Constants.class.php";
include dirname(__DIR__)."/models/Contact.class.php";
include dirname(__DIR__)."/models/ContactManager.class.php";

class ContactController {
    private $dico;
    private $method;
    private $url;
    private $route_info;

    function __construct($paramDico)
    {
        $this->dico = $paramDico;
        $this->method = $paramDico["method"];
        $this->url = $paramDico["url"];
        $this->route_info = $paramDico["route_info"];    
    }

    public function getAll(){
        $response = Constants::$DEFAULT_RESPONSE;
        $contactManager = new ContactManager();
        $resultat = $contactManager->getAll();
        if (count($resultat["errors"]) == 0){
            $response["code"] = Constants::$SUCESS_CODE;
            $response["resultat"] = $resultat["data"];
        }
        return $response;
    }

    public function getById(){
        $begin = $this->route_info[0];
        $id = $this->route_info[1];

        $response = Constants::$DEFAULT_RESPONSE;
        if ($begin == "contacts" && strlen($id) > 0){
            $contactManager = new ContactManager();
            $resultat = $contactManager->getById($id);
            if (count($resultat["errors"]) == 0){
                $response["code"] = Constants::$SUCESS_CODE;
                $response["resultat"] = $resultat;
            }
        }
        return $response;
    }

    public function create(){
        $response = Constants::$DEFAULT_RESPONSE;

        $nom = $this->dico["nom"];
        $tel = $this->dico["tel"];
        $email = $this->dico["email"];
        $adresse = $this->dico["adresse"];
        $commentaire = $this->dico["commentaire"];
        $contact = new Contact($nom, $tel, $email, $adresse, $commentaire);
        $contactManager = new ContactManager();
        $resultat = $contactManager->createContact($contact);

        $response["code"] = Constants::$SERVER_ERROR_CODE;
        $response["resultat"] = $response["data"];
        if (count($resultat["errors"]) == 0){
            $response["code"] = Constants::$SUCESS_CODE;
        }
        return $response;
    }

    public function update(){
        /*$response = Constants::$DEFAULT_RESPONSE;
        $dico = $this->dico[Constants::$PUT];
        $titre = $dico["titre"];
        $poste = $dico["poste"];
        $annee = $dico["annee"];
        $dispo = $dico["dispo"];
        $intro = $dico["intro"];
        $idCv = $this->route_info[1];
        $userid = 1;
        $experiences = array(); 
        $formations = array();
        $langues = array();

        $cv = new Cv($titre, $poste, $annee, $dispo, $intro, $userid,$experiences, $formations, $langues);
        $cv->id = $idCv;
        $cvManager = new CvManager();
        $resultat = $cvManager->update($cv);

        $response["code"] = Constants::$SERVER_ERROR_CODE;
        $response["resultat"] = $response["data"];
        if (count($resultat["errors"]) == 0){
            $response["code"] = Constants::$SUCESS_CODE;
        }
        return $response;*/
        return null;
    }

    public function delete(){
        if ($this->method == Constants::$DELETE){

        }
    }

    public function getView(){
        $json = "";
        if ( $this->url == "contacts/" ){
            if ( $this->method == Constants::$POST ){
                $json = json_encode($this->create());
            }
            if ( $this->method == Constants::$GET ){
                $json = json_encode($this->getAll());
            }
        }

        if ( $this->route_info[0] == "contacts" &&  $this->route_info[1] != "" ){
            if ( $this->method == Constants::$GET ){
                $json = json_encode($this->getById());
            }
            if ( $this->method == Constants::$PUT ){
                $json = json_encode($this->update());
            }
        }
        return $json;
    }

} 
?>