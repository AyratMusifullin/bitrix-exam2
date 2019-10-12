<?php
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("OnIBlock", "OnBeforeIBlockElementUpdateHandler"));

class OnIBlock
{
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        if ($arFields["IBLOCK_ID"] == IBLOCK_PROD_ID && $arFields["ACTIVE"] == "N") {
            $res = CIBlockElement::GetByID($arFields["ID"]);
            if ($ar_res = $res->GetNext()) {
                if ($ar_res["SHOW_COUNTER"] > 2) {
                    global $APPLICATION;
                    $APPLICATION->ThrowException("Товар невозможно деактивировать, у него " . $ar_res["SHOW_COUNTER"] . " просмотров");
                    return false;
                }
            }
        }
    }
}
