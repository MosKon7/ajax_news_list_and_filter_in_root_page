<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Проекты");
?>

<h1 class="page-title">
	<?php $APPLICATION->ShowTitle(); ?>
</h1>

<div id="ajax-projects-container">
	<?php $APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"project_ajax",
		array(
			"COMPONENT_TEMPLATE" => "project_ajax",
			"IBLOCK_TYPE" => "projets",
			"IBLOCK_ID" => "6",
			"NEWS_COUNT" => "6",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "STATUS",
				1 => "SQUARE",
				2 => "AREA",
				3 => "DISTRICT",
				4 => "PURPOSE",
				5 => "TOTAL_AMOUNT_CONSTRUCTION",
				6 => "INDUSTRIAL_CONSTRUCTION",
				7 => "SOCIAL_AND_BUSINESS_CONSTRUCTION",
				8 => "RESIDENT_CONSTRUCTION",
				9 => "RENOVATION",
				10 => "RESIDENT_PURPOSE",
				11 => "NON_RESIDENT_PURPOSE",
				12 => "SOCIAL_AND_BUSINESS_PURPOSE",
				13 => "JOB_GROWTH",
				14 => "",
			),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_BROWSER_TITLE" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_LAST_MODIFIED" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"INCLUDE_SUBSECTIONS" => "Y",
			"STRICT_SECTION_CHECK" => "N",
			"PAGER_TEMPLATE" => "load_more",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"SET_STATUS_404" => "N",
			"SHOW_404" => "N",
			"MESSAGE_404" => ""
		),
		false
	);?>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>