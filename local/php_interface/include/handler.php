<?php
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("OnIBlock", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("main", "OnEpilog", Array("OnEpilog", "OnEpilogHandler"));
AddEventHandler("main", "OnBeforeEventAdd", Array("onEvent", "OnBeforeEventAddHandler"));

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

class onEvent
{
    function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if ($event == "FEEDBACK_FORM") {
            global $USER;
            if ($USER->IsAuthorized()) {
                $userID = $USER->GetID();
                $rsUser = CUser::GetByID($userID);
                if ($arUser = $rsUser->Fetch()) {
                    $arFields["AUTHOR"] = "Пользователь авторизован: " . $arUser['ID'] . " (" . $arUser['LOGIN'] . ") " . $arUser['NAME'] . ", данные из формы: " . $arFields['AUTHOR'];
                }
            } else {
                $arFields["AUTHOR"] = "Пользователь не авторизован, данные из формы: " . $arFields['AUTHOR'];
            }

            CEventLog::Add(array(
                "SEVERITY" => "INFO",
                "AUDIT_TYPE_ID" => "FEEDBACK_FORM",
                "MODULE_ID" => "main",
                "DESCRIPTION" => "Замена данных в отсылаемом письме – " . $arFields["AUTHOR"]
            ));
        }
    }
}