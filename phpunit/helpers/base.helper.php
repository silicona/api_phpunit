<?php
require_once '../src/class/Calculadora.php';
require_once '../src/class/ThreadsController.php';

class BaseHelper
{

    public static function establecer_conexion($db_host = '')
    {
        if ($db_host != 'localhost:8889' && $db_host != "127.0.0.1") {

            define('DB_HOST', $GLOBALS['DB_HOST']);
            define('DB_USER', $GLOBALS['DB_USER']);
            define('DB_PASS', $GLOBALS['DB_PASS']);
            define('DB_NOMBRE', $GLOBALS['DB_NAME']);
        }

        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NOMBRE);
        mysqli_query($conexion, 'SET NAMES "utf8"');

        return $conexion;
    }

    public static function transaction_test($link)
    {

        $sql = "START TRANSACTION;";
        return mysqli_query($link, $sql);
    }


    public static function transaction_test_fin($link)
    {

        $sql = "ROLLBACK;";
        return mysqli_query($link, $sql);
    }

    public function suministra_xml_test()
    {

        //include 'xml_test.xml';
        //print_r($xml);
        //$xml = new SimpleXMLElement($xml);

        $xml = XMLReader::open('xml_test.xml');
        return $xml;
    }
}
