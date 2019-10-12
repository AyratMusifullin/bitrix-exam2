<?php
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("OnIBlock", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("main", "OnEpilog", Array("OnEpilog", "OnEpilogHandler"));

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

class OnEpilog
{
    function OnEpilogHandler()
    {
        if (defined("ERROR_404") && ERROR_404 == "Y") {
            global $APPLICATION;
            $page = $APPLICATION->GetCurPage();
            CEventLog::Add(array(
                "SEVERITY" => "INFO",
                "AUDIT_TYPE_ID" => "ERROR_404",
                "MODULE_ID" => "main",
                "DESCRIPTION" => $page
            ));
        }
    }
}