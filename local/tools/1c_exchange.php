<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$file_get = $_SERVER["DOCUMENT_ROOT"] . "/get.log";
$file_post = $_SERVER["DOCUMENT_ROOT"] . "/post.log";

if (!empty($_GET)) {
    $fw = fopen($file_get, "a");
    fwrite($fw, "GET " . var_export($_GET, true));
    fclose($fw);
}

if (!empty($_POST)) {
    $fw = fopen($file_post, "a");
    fwrite($fw, "POST " . var_export($_POST, true));
    fclose($fw);
}
?>

<?$APPLICATION->IncludeComponent("custom:catalog.import.1c","",Array(
        "IBLOCK_TYPE" => "catalog",
        "SITE_LIST" => array(),
        "INTERVAL" => "0",
        "GROUP_PERMISSIONS" => array("1"),
        "IBLOCK_CACHE_MODE" => "N",
        "USE_OFFERS" => "N",
        "FORCE_OFFERS" => "N",
        "USE_IBLOCK_TYPE_ID" => "N",
        "SKIP_ROOT_SECTION" => "N",
        "ELEMENT_ACTION" => "N",
        "SECTION_ACTION" => "N",
        "FILE_SIZE_LIMIT" => "204800",
        "USE_CRC" => "Y",
        "USE_ZIP" => "Y",
        "USE_IBLOCK_PICTURE_SETTINGS" => "N",
        "GENERATE_PREVIEW" => "N",
        "PREVIEW_WIDTH" => "100",
        "PREVIEW_HEIGHT" => "100",
        "DETAIL_RESIZE" => "N",
        "DETAIL_WIDTH" => "300",
        "DETAIL_HEIGHT" => "300",
        "TRANSLIT_ON_ADD" => "Y",
        "TRANSLIT_ON_UPDATE" => "N",
        "TRANSLIT_MAX_LEN" => "100",
        "TRANSLIT_CHANGE_CASE" => "L",
        "TRANSLIT_REPLACE_SPACE" => "_",
        "TRANSLIT_REPLACE_OTHER" => "_",
        "TRANSLIT_DELETE_REPEAT_REPLACE" => "Y"
    ),
false
);?>
