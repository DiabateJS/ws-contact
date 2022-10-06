<?php
class Constants {
    //Constants for request parsing
    public static $QUERY_STRING = "QUERY_STRING";
    public static $REQUEST_METHOD ="REQUEST_METHOD";
    public static $PARAMS_SEPARATOR = "&";
    public static $KEY_VALUE_SEPARATOR = "=";
    public static $URL_SEPARATOR = "/";

    public static $SERVER_ERROR_CODE = 500;
    public static $SUCESS_CODE = 200;

    public static $DEFAULT_RESPONSE = array(
        "resultat" => "",
        "code" => 500,
        "errors" => []
    );

    public static $POST = "POST";
    public static $GET = "GET";
    public static $PUT = "PUT";
    public static $DELETE = "DELETE";

    public static $SERVER_QUERY_STRING_WITH_2_PARAMS = array(
        "QUERY_STRING" => "param1=un&param2=deux"
    );

    public static $SERVER_POST_REQUEST = array (
        "REQUEST_METHOD" => "POST"
    );

    public static $SERVER_GET_REQUEST = array (
        "REQUEST_METHOD" => "GET"
    );

    //Database parameters
    public static $PROD_BD_CONFIG = array(
        "host" => "185.98.131.90",
        "user" => "djste1070339",
        "password" => "da6ysjpqpp",
        "bdname" => "djste1070339"
    );
  
    public static $LOCAL_BD_CONFIG = array(
        "host" => "localhost",
        "user" => "root",
        "password" => "root",
        "bdname" => "contacts"
    );

    //SQL
    public static $SQL_CREATE_CONTACT = "";
    public static $SQL_ALL_CONTACT = "";
    public static $SQL_CONTACT_BY_ID = "";
    public static $SQL_CONTACT_UPDATE = "";

}
?>