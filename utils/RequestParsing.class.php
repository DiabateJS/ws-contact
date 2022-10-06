<?php
include "./Constants.class.php";

class RequestParsing {
    public static function parseQuery($ServerData){
        $query = str_replace("%20"," ",$ServerData[Constants::$QUERY_STRING]);
        $tab = explode(Constants::$PARAMS_SEPARATOR,$query);
        $res = array();
        for ($i = 0 ; $i < count($tab) ; $i++){
            $keyValue = explode(Constants::$KEY_VALUE_SEPARATOR,$tab[$i]);
            $key = $keyValue[0];
            $value = $keyValue[1];
            $res[$key] = $value;
        }
        $res["method"] = $ServerData[Constants::$REQUEST_METHOD];
        return $res;
    }

    public static function getRequestMethod($ServerData){
        return $ServerData[Constants::$REQUEST_METHOD];
    }

    public static function urlParsing($url){
        return explode(Constants::$URL_SEPARATOR, $url);
    }
}

?>