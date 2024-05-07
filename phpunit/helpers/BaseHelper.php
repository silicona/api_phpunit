<?php

namespace Helpers;

use XMLReader;
use mysqli;

//require_once '../src/class/Calculadora.php';
//require_once '../src/class/ThreadsController.php';

class BaseHelper
{

    public static function establecer_conexion()
    {
        $host = $GLOBALS['DB_HOST'];
        $user = $GLOBALS['DB_USER'];
        $pass = $GLOBALS['DB_PASS'];
        $name = $GLOBALS['DB_NAME'];

        $conexion = new mysqli($host, $user, $pass, $name);
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
