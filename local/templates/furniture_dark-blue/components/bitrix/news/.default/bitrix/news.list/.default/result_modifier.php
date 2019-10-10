<?php
/**
 * Created by PhpStorm.
 * User: ayrat
 * Date: 11.10.2019
 * Time: 0:36
 */

if ($arParams["SET_SPECIALDATE"] == "Y") {
    $arResult["SPECIALDATE"] = $arResult["ITEMS"]["0"]["ACTIVE_FROM"];

    $cp = $this->__component;
    $cp->SetResultCacheKeys(array("SPECIALDATE"));
}