<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;
CModule::IncludeModule("iblock");

$idUser = $USER->GetID();

if($idUser) {
    $res = CIBlockElement::GetList([], [
        'IBLOCK_ID' => 222,
        'PROPERTY_USERS' => $idUser
    ], false, false, ['ID', 'PROPERTY_BTN1', 'PROPERTY_BTN2']);

    $info = $res->Fetch();

    if($info) {
        echo json_encode($info);
    } else {
        echo json_encode(['error' => 'Данные не найдены']);
    }
} else {
    echo json_encode(['error' => 'Пользователь не авторизован']);
}
?>