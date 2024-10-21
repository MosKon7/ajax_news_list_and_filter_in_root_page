<?php

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

global $APPLICATION;

$APPLICATION->SetTitle('Проекты');

\Bitrix\Main\Loader::includeModule('iblock');

$elementId = 0;
$arListNews = [];
$template = 'projects';

if (!empty($_REQUEST['ELEMENT_CODE'])) {
    $dbElement = CIBlockElement::GetList(
        [],
        ['IBLOCK_ID' => IB_PROJECT, 'CODE' => $_REQUEST['ELEMENT_CODE']],
        ['ID', 'PROPERTY_STATUS']
    );

    if ($arElement = $dbElement->Fetch()) {
		$elementId = $arElement['ID'];

        if ($arElement['PROPERTY_STATUS_VALUE'] == 'На торгах') {
            $template = 'project_on_sale';
        }

		if ($elementId > 0) {
			$arOrder = ['ID' => 'ASC'];
			$arFilter = ['IBLOCK_ID' => IB_NEWS, 'ACTIVE' => 'Y', 'PROPERTY_PROJECTS' => $elementId];
			$arSelect = ['IBLOCK_ID', 'ID', 'NAME', 'ACTIVE', 'PROPERTY_PROJECT'];

			$resNews = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

			while ($arNews = $resNews->GetNext()) {
				$arListNews[] = $arNews['ID'];
			}
		}
    }
}
?>

<?php
$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	$template,
		array(
			"IBLOCK_TYPE" => "projets",
			"IBLOCK_ID" => "6",
			"ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
			"COMPONENT_TEMPLATE" => "projects",
			"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
			"CHECK_DATES" => "Y",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "",
				1 => "AT_AUCTION_LINK",
				2 => "AREA",
				3 => "DISTRICT",
				4 => "SQUARE",
				5 => "PURPOSE",
				6 => "STATUS",
				7 => "TOTAL_AMOUNT_CONSTRUCTION",
				8 => "INDUSTRIAL_CONSTRUCTION",
				9 => "SOCIAL_AND_BUSINESS_CONSTRUCTION",
				10 => "RESIDENT_CONSTRUCTION",
				11 => "RENOVATION",
				12 => "RESIDENT_PURPOSE",
				13 => "NON_RESIDENT_PURPOSE",
				14 => "SOCIAL_AND_BUSINESS_PURPOSE",
				15 => "JOB_GROWTH",
				16 => "DEADLINE_PROJECT",
				17 => "DEADLINE_PPT",
				18 => "LINK_IMPORT_GEO_DATA",
				19 => "POLYGON_COORDINATES",
				20 => "MARKER_COORDINATES",
				21 => "INCLUDED_BLOCKS",
				22 => "BLOCK_8_TEXT",
				23 => "BLOCK_8_SORT",
				24 => "BLOCK_9_TEXT",
				25 => "BLOCK_9_SORT",
				26 => "BLOCK_1_SORT",
				27 => "BLOCK_1_TEXT",
				28 => "BLOCK_2_SORT",
				29 => "BLOCK_2_TEXT",
				30 => "BLOCK_3_SORT",
				31 => "BLOCK_3_TEXT",
				32 => "BLOCK_4_SORT",
				33 => "BLOCK_4_INVERT",
				34 => "BLOCK_4_TEXT",
				35 => "BLOCK_5_SORT",
				36 => "BLOCK_5_INVERT",
				37 => "BLOCK_5_TEXT",
				38 => "BLOCK_6_SORT",
				39 => "BLOCK_6_SLIDER",
				40 => "BLOCK_7_SORT",
				41 => "BLOCK_7_SLIDER",
				42 => "BLOCK_10_SORT",
				43 => "BLOCK_10_TEXT",
				44 => "BLOCK_11_SORT",
				45 => "BLOCK_11_TEXT",
				46 => "BLOCK_12_SORT",
				47 => "BLOCK_13_SORT",
				48 => "BLOCK_13_TEXT",
				49 => "BLOCK_14_SORT",
				50 => "BLOCK_14_START_PRICE",
				51 => "BLOCK_14_GUARANTEES",
				52 => "BLOCK_14_DEADLINE_APPLICATION",
				53 => "BLOCK_14_DEPOSIT",
				54 => "BLOCK_14_STEP_AUCION",
				55 => "BLOCK_14_DATA_AUCION",
				56 => "BLOCK_4_ICONS",
				57 => "BLOCK_5_ICONS",
				58 => "",
			),
			"IBLOCK_URL" => "",
			"DETAIL_URL" => "",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "N",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_GROUPS" => "Y",
			"SET_TITLE" => "Y",
			"SET_CANONICAL_URL" => "N",
			"SET_BROWSER_TITLE" => "Y",
			"BROWSER_TITLE" => "-",
			"SET_META_KEYWORDS" => "Y",
			"META_KEYWORDS" => "-",
			"SET_META_DESCRIPTION" => "Y",
			"META_DESCRIPTION" => "-",
			"SET_LAST_MODIFIED" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"ADD_ELEMENT_CHAIN" => "N",
			"ACTIVE_DATE_FORMAT" => "j F Y",
			"USE_PERMISSIONS" => "N",
			"STRICT_SECTION_CHECK" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"USE_SHARE" => "N",
			"PAGER_TEMPLATE" => ".default",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "Проекты",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"SET_STATUS_404" => "N",
			"SHOW_404" => "N",
			"MESSAGE_404" => ""
		),
		false
	);
?>


<?php if (!empty($arListNews)): ?>
	<?php $GLOBALS['arrFilter'] = ['ID' => $arListNews]; ?>

	<?php $APPLICATION->IncludeComponent(
		'bitrix:news.list',
		'news',
		[
			'COMPONENT_TEMPLATE'              => 'news',
			'IBLOCK_TYPE'                     => 'content',
			'IBLOCK_ID'                       => IB_NEWS,
			'NEWS_COUNT'                      => '3',
			'SORT_BY1'                        => 'ACTIVE_FROM',
			'SORT_ORDER1'                     => 'DESC',
			'SORT_BY2'                        => 'SORT',
			'SORT_ORDER2'                     => 'ASC',
			'FILTER_NAME'                     => 'arrFilter',
			'FIELD_CODE'                      => [
				0 => '',
				1 => '',
			],
			'PROPERTY_CODE'                   => [
				0 => '',
				1 => '',
			],
			'CHECK_DATES'                     => 'Y',
			'DETAIL_URL'                      => '',
			'AJAX_MODE'                       => 'N',
			'AJAX_OPTION_JUMP'                => 'N',
			'AJAX_OPTION_STYLE'               => 'Y',
			'AJAX_OPTION_HISTORY'             => 'N',
			'AJAX_OPTION_ADDITIONAL'          => '',
			'CACHE_TYPE'                      => 'A',
			'CACHE_TIME'                      => '36000000',
			'CACHE_FILTER'                    => 'N',
			'CACHE_GROUPS'                    => 'Y',
			'PREVIEW_TRUNCATE_LEN'            => '',
			'ACTIVE_DATE_FORMAT'              => 'd.m.Y',
			'SET_TITLE'                       => 'N',
			'SET_BROWSER_TITLE'               => 'N',
			'SET_META_KEYWORDS'               => 'N',
			'SET_META_DESCRIPTION'            => 'N',
			'SET_LAST_MODIFIED'               => 'N',
			'INCLUDE_IBLOCK_INTO_CHAIN'       => 'N',
			'ADD_SECTIONS_CHAIN'              => 'N',
			'HIDE_LINK_WHEN_NO_DETAIL'        => 'N',
			'PARENT_SECTION'                  => '',
			'PARENT_SECTION_CODE'             => '',
			'INCLUDE_SUBSECTIONS'             => 'Y',
			'STRICT_SECTION_CHECK'            => 'N',
			'PAGER_TEMPLATE'                  => '.default',
			'DISPLAY_TOP_PAGER'               => 'N',
			'DISPLAY_BOTTOM_PAGER'            => 'N',
			'PAGER_TITLE'                     => '',
			'PAGER_SHOW_ALWAYS'               => 'N',
			'PAGER_DESC_NUMBERING'            => 'N',
			'PAGER_DESC_NUMBERING_CACHE_TIME' => '36000',
			'PAGER_SHOW_ALL'                  => 'Y',
			'PAGER_BASE_LINK_ENABLE'          => 'N',
			'SET_STATUS_404'                  => 'N',
			'SHOW_404'                        => 'N',
			'MESSAGE_404'                     => '',
			'TITLE'                           => 'Новости по проекту'
		],
		false
	); ?>
<?php endif; ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>