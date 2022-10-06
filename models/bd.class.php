<?php
include "../constants/Constants.class.php";

class BdManager
{
  private $db_host;
  private $db_user;
  private $db_pass;
  private $db_name;
  private $pdo;

  public $errors;

  public function __construct() {
	  	$this->errors = [];
		try
		{
      		$dico = Constants::$LOCAL_BD_CONFIG;
			$this->_db_host = $dico["host"];
			$this->_db_user = $dico["user"];
			$this->_db_pass = $dico["password"];
			$this->_db_name = $dico["bdname"];
			$this->_pdo = new PDO('mysql:dbname=' . $this->_db_name . ';host=' . $this->_db_host, $this->_db_user, $this->_db_pass);
		}
		catch(Exception $e)
		{
			$this->errors[] = "[CLS::BdManager][FCT::__construct] Erreur : ".$e->getMessage();
		}
  }


  public function executeSelect($query, $entete)
  //$entete est un tableau contenant les champs de retour de la requete
  {
	  $returnObject = array(
		  "data" => [],
		  "errors" => []
	  );

	  $resultats = array();
	  try
	  {
			  $result = $this->_pdo->query($query, PDO::FETCH_CLASS, 'stdClass');
			  if ($result)
			  {
					while ($data = $result->fetch())
					{
						if ($data != null)
						{
							$dc = array();
							for ($i = 0 ; $i < count($entete) ; $i++)
							{
								$dc[$entete[$i]] = $data->{$entete[$i]};
							}
							$resultats[]=$dc;
						}
					}

			  }
	  }
	  catch(Exception $e)
	  {
		  $this->errors[] = "[CLS::BdManager][FCT::executeSelect] Erreur : ".$e->getMessage();
	  }
	  $returnObject["data"] = $resultats;
	  $returnObject["errors"] = $this->errors;
      return $returnObject;
  }

	public function executePreparedSelect($sql, $dicoParam, $entete)
	{
		$returnObject = array(
			"data" => [],
			"errors" => []
		);
		$resultats = array();
		try
		{
			$stmt = $this->_pdo->prepare($sql);
			$stmt->execute($dicoParam);
			while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$dc = array();
				for ($i = 0 ; $i < count($entete) ; $i++)
				{
					$dc[$entete[$i]] = $data[$entete[$i]];
				}
				$resultats[]=$dc;
			}
		}
		catch(Exception $e)
		{
			$this->errors[] = "[CLS::BdManager][FCT::executeSelect] Erreur : ".$e->getMessage();
		}
		$returnObject["data"] = $resultats;
		$returnObject["errors"] = $this->errors;
		return $returnObject;
	}

  function executePreparedQuery($sql, $dicoParam){
	$returnObject = array(
		"data" => [],
		"errors" => []
	);
	$result = null;
	try {
		$stmt = $this->_pdo->prepare($sql);
		$result = $stmt->execute($dicoParam);
	}
	catch(Exception $e)
	{
		$this->errors[] = "[CLS::BdManager][FCT::executePreparedQuery] Erreur : ".$e->getMessage();
	}
	$returnObject["data"][] = $result;
	$returnObject["errors"] = $this->errors;
	return $returnObject; 
  }

  function executeInsert($query)
  {
	$returnObject = array(
		"data" => [],
		"errors" => []
	);
	$result = null;
    try {
        $result = $this->_pdo->query($query, PDO::FETCH_CLASS, 'stdClass');
    }
    catch(Exception $e)
    {
        $this->errors[] = "[CLS::BdManager][FCT::executeInsert] Erreur : ".$e->getMessage();
    }
	$returnObject["data"][] = $result;
	$returnObject["errors"] = $this->errors;
	return $returnObject;
  }

  function executeUpdate($query)
  {
	$returnObject = array(
		"data" => [],
		"errors" => []
	);
    try
    {
        $result = $this->_pdo->query($query, PDO::FETCH_CLASS, 'stdClass');
    }
    catch(Exception $e)
    {
        $this->errors[] = "[CLS::BdManager][FCT::executeUpdate] Erreur : ".$e->getMessage();
    }
	$returnObject["data"][] = $result;
	$returnObject["errors"] = $this->errors;
	return $returnObject;
  }

  function executeDelete($query)
  {
	$returnObject = array (
		"data" => [],
		"errors" => []
	);
	$result = null;
    try
    {
        $result = $this->_pdo->query($query, PDO::FETCH_CLASS, 'stdClass');
    }
    catch(Exception $e)
    {
        $this->errors[] = "[CLS::BdManager][FCT::executeDelete] Erreur : ".$e->getMessage();
    }
	$returnObject["data"][] = $result;
	$returnObject["errors"] = $this->errors;
	return $returnObject;
  }

}

?>
