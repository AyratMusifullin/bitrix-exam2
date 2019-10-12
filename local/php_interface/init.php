<?php
/**
 * Created by PhpStorm.
 * User: ayrat
 * Date: 10.10.2019
 * Time: 18:55
 */

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/functions.php'))
    require_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/functions.php';
if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/const.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/const.php");
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/handler.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]. '/local/php_interface/include/handler.php');