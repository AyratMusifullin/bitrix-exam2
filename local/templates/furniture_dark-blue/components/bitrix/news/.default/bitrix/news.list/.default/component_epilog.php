<?php
/**
 * Created by PhpStorm.
 * User: ayrat
 * Date: 11.10.2019
 * Time: 0:36
 */

if ($arParams["SET_SPECIALDATE"] == "Y") {
    $APPLICATION->SetPageProperty("specialdate", $arResult["SPECIALDATE"]);
}