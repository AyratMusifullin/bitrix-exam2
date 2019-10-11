<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
if (intval($arParams["IB_CANONICAL_ID"]) > 0 && $arResult["ID"] && CModule::IncludeModule('iblock')) {
    $res = CIBlockElement::GetList(
        Array(),
        Array(
            "IBLOCK_ID" => IntVal($arParams["IB_CANONICAL_ID"]),
            "PROPERTY_NEWS_LINK" => $arResult["ID"]
        ),
        false,
        Array(
            "nTopCount" => 1
        ),
        array(
            "NAME"
        )
    );
    if ($ob = $res->Fetch()) {
        $arResult["CANONICAL"] = $ob["NAME"];

        $cp = $this->__component;
        $cp->SetResultCacheKeys(array("CANONICAL"));
    }
}
?>