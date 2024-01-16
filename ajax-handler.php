<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;
CModule::IncludeModule("iblock");

$idUser = $USER->GetID();
$btn1 = $_POST['BTN1'];
$btn2 = $_POST['BTN2'];

$btn1Value = '';
$btn2Value = '';

if($idUser && ($btn1 == 'Y' || $btn2 == 'Y')) {
    $elementId = 0;

    $res = CIBlockElement::GetList([], [
        'IBLOCK_ID' => 222,
        'PROPERTY_USERS' => $idUser
    ], false, false, ['ID', 'PROPERTY_BTN1', 'PROPERTY_BTN2']);

    while ($element = $res->Fetch()) {
        $elementId = $element['ID'];
        $btn1Value = $element['PROPERTY_BTN1_VALUE'];
        $btn2Value = $element['PROPERTY_BTN2_VALUE'];
    }

    $data = [
        'IBLOCK_ID' => 222,
        'NAME' => $USER->GetEmail(),
        'PROPERTY_VALUES' => [
            'USERS' => $idUser,
            'BTN1' => ($btn1Value == 'Y' || $btn1 == 'Y') ? 'Y' : 'N',
            'BTN2' => ($btn2Value == 'Y' || $btn2 == 'Y') ? 'Y' : 'N'
        ]
    ];

    $el = new CIBlockElement;

    if ($elementId > 0) {
        if ($el->Update($elementId, $data)) {
            if ($btn1 == 'Y') {
                echo "Вы уже нажимали на первую кнопку";
            } elseif ($btn2 == 'Y') {
                echo "Вы уже нажимали на вторую кнопку";
            }
        }
    } else {
        if ($el->Add($data)) {
            echo "Вы уже нажимали на первую кнопку";
        } else {
            echo "Ошибка при добавлении данных в инфоблок";
        }
    }

    if ($el->Update($elementId, $data)) {
        $btn1Value = $btn1;
        $btn2Value = $btn2;
    }
}
?>