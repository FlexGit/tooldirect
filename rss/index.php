<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("RSS");
?><?$APPLICATION->IncludeComponent("bitrix:rss.out", "turbo.rss", Array(
    "IBLOCK_TYPE" => "news",
    "NUM_NEWS" => "500",
    "IBLOCK_ID" => "13",
    "SECTION_ID" => "",
    "SECTION_CODE" => "",
    "RSS_TTL" => "60",
    "YANDEX" => "Y",
    "SORT_BY1" => "ACTIVE_FROM",
    "SORT_ORDER1" => "DESC",
    "SORT_BY2" => "SORT",
    "SORT_ORDER2" => "ASC",
    "FILTER_NAME" => "",
    "CACHE_TYPE" => "N",
    "CACHE_TIME" => "3600",
    "CACHE_NOTES" => "",
    "CACHE_FILTER" => "N",
    "CACHE_GROUPS" => "N"
),
    false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>