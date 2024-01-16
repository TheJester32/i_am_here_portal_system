<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<? $APPLICATION->AddHeadString('<link rel="stylesheet" href="/iamheretest/style.css?'.time().'">', true); ?>

<body>

<?
global $USER;

$idUser = $USER->GetID();
if($idUser) {
    $arSelect = Array(
        "ID",
        "IBLOCK_ID",
        "NAME",
        "PROPERTY_USERS",
        "PROPERTY_BTN1",
        "PROPERTY_BTN2",
    );
    $arFilter = Array("IBLOCK_ID"=>222, "ACTIVE"=>"Y", "PROPERTY_USERS"=>$idUser);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($arRes = $res->GetNext())
    {
        $BTN1 = ($arRes['PROPERTY_STAGE1_VALUE'] == "Y"?true:false);
        $BTN2 = ($arRes['PROPERTY_STAGE2_VALUE'] == "Y"?true:false);
    }
}
?>

<h1>Test</h1>
<button class="first-btn btn">Первая кнопка</button>
<button class="second-btn btn">Вторая кнопка</button>

<h2 id="click-on-btn">Нажми уже на кнопку!</h2>

<script>
    $(window).load(function() {

        $('.second-btn').css('display', 'none');
        getInfo();

        function getInfo() {
            $.ajax({
                url: '/iamheretest/get-info.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        console.log(response.error);
                    } else {
                        var btn1Value = response.PROPERTY_BTN1_VALUE;
                        var btn2Value = response.PROPERTY_BTN2_VALUE;

                        if(btn1Value === 'Y'){
                            $('#first-response').html('<h2>Вы нажали на первую кнопку</h2>');
                            $('#click-on-btn').css('display', 'none');
                            $('.first-btn').css('display', 'none');
                        } else{
                            $('.first-btn').css('display', 'block');
                        }
                        if(btn2Value === 'Y'){
                            $('#second-response').html('<h2>Вы нажали на вторую кнопку</h2>');
                            $('#click-on-btn').css('display', 'none');
                            $('.second-btn').css('display', 'none');
                        } else{
                            setTimeout(function() {
                                $('.second-btn').css('display', 'block');
                            }, 3000);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        $('.first-btn').click(function() {
            var data = {
                'BTN1': 'Y'
            };
            $.post('/iamheretest/ajax-handler.php', data, function(response) {
                $('#first-response').html('<h2>' + response + '</h2>');
                $('#click-on-btn').css('display', 'none');
                $('.first-btn').css('display', 'none');

                getInfo();
            });
        });

        $('.second-btn').click(function() {
            var data = {
                'BTN2': 'Y'
            };
            $.post('/iamheretest/ajax-handler.php', data, function(response) {
                $('#second-response').html('<h2>' + response + '</h2>');
                $('#click-on-btn').css('display', 'none');
                $('.second-btn').css('display', 'none');

                getInfo();
            });
        });
    });
</script>
<div id="first-response"></div>
<div id="second-response"></div>
</body>