<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Test");
?>
<?// $APPLICATION->AddHeadString('<link rel="stylesheet" href="/workshop-in-dermatology/style.css?'.time().'">', true); ?>
<?// $APPLICATION->AddHeadString('<script defer="defer" src="/workshop-in-dermatology/script.js?'.time().'"></script>'); ?>
<style>

    a{
        text-decoration: none;
        width: 150px;
    }
    .container{
        margin-top: 20px;
        display: flex;
        flex-direction: column;
    }

    .btn{
        cursor: pointer;
        background-color: #f7931d;
        color: #fff;
        padding: 20px 15px 20px 15px;
        border-radius: 50px;
        width: 150px;
        margin-bottom: 10px;
        text-align: center;
        font-weight: bolder;
    }
</style>
<h1 clas="title">Смотрите материалы и зарабатывайте баллы!</h1>
<?
$arFilter = Array(
    "IBLOCK_ID"=>IntVal(142),
    "ACTIVE"=>"Y",
    "PROPERTY_USER"=>$USER->GetID(),
    "PROPERTY_PROJECT"=>'activity-test',

);
$res = CIBlockElement::GetList(Array(), $arFilter, Array('ID','PROPERTY_POINTS'));
$sum = 0;
while($ar_fields = $res->GetNext(true, false)){
    $sum += $ar_fields['PROPERTY_POINTS_VALUE'];
}
?>
<?php if($USER->IsAuthorized()): ?>
    <h2 class="points">
        Баллы: <?=trim($sum, "\n");?>
    </h2>
<?php else: ?>
    <h2 class="points">
        Баллы: 0
    </h2>
<?php endif; ?>

    <div class="container">
        <a href="https://con-med.ru/klinicheskiy-razbor/" target="_blank">
            <div class="btn">Материал 1 +10</div></a>
        <a href="https://con-med.ru/podcasts/" target="_blank">
            <div class="btn">Материал 2 +15</div>
        </a>
        <a href="https://digital-doc.ru"
           target="_blank">
            <div class="btn">Материал 3 +20</div></a>
        <a href="https://digital-doc.ru/podcast.php?podcast=2889193" target="_blank">
            <div class="btn">Материал 4 +25</div></a>
        <a href="https://digital-doc.ru/pdf.php?pdf=360953" target="_blank">
            <div class="btn">Материал 5 +30</div></a>
        <a href=" https://con-med.ru/magazines/klinicheskiy_razbor_v_obshchey_meditsine/klinicheskiy_razbor_v_obshchey_meditsine-11-2023/posledstviya_pozdney_diagnostiki_mukovistsidoza_u_rebenka_vosmi_let/"
           target="_blank">
            <div class="btn">Материал 6 +35</div></a>
        <a href="https://con-med.ru/conferences/2917319/2917319/2917321.html" target="_blank">
            <div class="btn">Материал 7 +40</div>
        </a>
        <a href="https://con-med.ru/conferences/online2/detail/2884655/" target="_blank">
            <div class="btn">Материал 8 +45</div>
        </a>
        <a href="https://con-med.ru/art-and-medicine-2/" target="_blank">
            <div class="btn">Материал 9 +50</div></a>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

<?php
if(isset($_GET['podcast']) && $_GET['podcast'] == 2889193 ){

    $APPLICATION->IncludeComponent(
        "dvz:statistic.send",
        "",
        Array(

            "IGNOR_UNIQ" => "N",
            "IBLOCK_ID"=>IntVal(142),
            "POINTS" => 25,
            'TYPE'=>518,
            "PROPERTY_NAME"=>'activity-test',
            "PROPERTY_PROJECT"=>'activity-test',
            'ACTIVITY_ID'=> 2931362,
               "TAG" => array("video"),
            "PAGELOAD" => "Y",

        )
    );
}


?>

<?php

if($APPLICATION->GetCurPage() == "/conferences/2917319/2917319/2917321.html")
{
       $APPLICATION->IncludeComponent(
                "dvz:statistic.send",
                "",
                Array(
                    "IGNOR_UNIQ" => "N",
                    "IBLOCK_ID"=>IntVal(142),
                    "POINTS" => 20,
                    'TYPE'=>578,
                    "PROPERTY_NAME"=>'activity-test',
                    "PROPERTY_PROJECT"=>'activity-test',
                    'ACTIVITY_ID'=> 2924793,
                    "TAG" => array("video"),
                    "PAGELOAD" => "N",
                )
            );
}

?>
