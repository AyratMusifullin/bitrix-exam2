<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
if ($arResult["CANONICAL"] && intval($arParams["IB_CANONICAL_ID"]) > 0) {
    $APPLICATION->SetPageProperty("canonical", $arResult["CANONICAL"]);
}
?>