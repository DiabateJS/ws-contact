<?php
include "constants/Constants.class.php";
include "utils/RequestParsing.class.php";
include "controllers/ContactController.class.php";

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

$queryMethod = RequestParsing::getRequestMethod($_SERVER);
$queryStringDico = RequestParsing::parseQuery($_SERVER);

$queryStringDico["route_info"] = RequestParsing::urlParsing($queryStringDico["url"]);

if ($queryMethod == Constants::$GET){
    $queryStringDico[Constants::$GET] = $_GET;
}
if ($queryMethod == Constants::$POST){
    parse_str(file_get_contents('php://input'), $queryStringDico[Constants::$POST]);
    $tab = array_keys($queryStringDico[Constants::$POST])[0];
    $tab = str_replace("_"," ",$tab);
    $tab = json_decode($tab, true);
    $queryStringDico[Constants::$POST] = $tab;
}
if ($queryMethod == Constants::$PUT){
    $query_string = $_SERVER["QUERY_STRING"];
    $query_string = str_replace("%20"," ",$query_string);
    $tab = explode("&",$query_string); 
    $tab_res = array();
    for ($i = 0; $i < count($tab); $i++) {
        $tab_tmp = explode("=",$tab[$i]);
        $tab_res[$tab_tmp[0]] = $tab_tmp[1]; 
    }
    $queryStringDico[Constants::$PUT] = $tab_res;
}
if ($queryMethod == Constants::$DELETE){
    parse_str(file_get_contents('php://input'), $queryStringDico[Constants::$DELETE]);
}

$tab_route = $queryStringDico["route_info"];
$controller = null;
if (count($tab_route) == 2 && $tab_route[0] == "contacts"){
    $controller = new ContactController($queryStringDico);
}

if ($controller != null){
    echo $controller->getView();
}

?>