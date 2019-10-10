<?php
/**
 * Created by PhpStorm.
 * User: ayrat
 * Date: 10.10.2019
 * Time: 18:56
 */

function dump($array, $showAll = false)
{
    global $USER;
    if ($showAll == true || $USER->IsAdmin()) {
        echo '<h2>Внимание, ведется тестирование!</h2><h3>Данное сообщение видно только администраторам.</h3><pre>';
        print_r($array);
        echo '</pre>';
    }
}