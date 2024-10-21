<?php

/** @global \CMain $APPLICATION */

define('STOP_STATISTICS', true);
define('NOT_CHECK_PERMISSIONS', true);

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if (!empty($_REQUEST['AREA'])) {
    $GLOBALS['arrProjectsFilter'][] = ['PROPERTY_AREA' => $_REQUEST['AREA']];
}

if (!empty($_REQUEST['DISTRICT'])) {
    $GLOBALS['arrProjectsFilter'][] = ['PROPERTY_DISTRICT' => $_REQUEST['DISTRICT']];
}

if (!empty($_REQUEST['MIN_SQUARE']) && !empty($_REQUEST['MAX_SQUARE'])) {
    $GLOBALS['arrProjectsFilter'][] = [
        '>=PROPERTY_SQUARE' => $_REQUEST['MIN_SQUARE'],
        '<=PROPERTY_SQUARE' => $_REQUEST['MAX_SQUARE']
    ];
}

if (!empty($_REQUEST['PURPOSES'])) {
    $GLOBALS['arrProjectsFilter'][] = ['PROPERTY_PURPOSE' => $_REQUEST['PURPOSES']];
}

if (!empty($_REQUEST['STATUS'])) {
    $GLOBALS['arrProjectsFilter'][] = ['PROPERTY_STATUS' => $_REQUEST['STATUS']];
}

$APPLICATION->IncludeComponent(
    'bitrix:news.list',
    'project_ajax',
    [
        'COMPONENT_TEMPLATE'              => 'project_ajax',
        'IBLOCK_TYPE'                     => 'projets',
        'IBLOCK_ID'                       => '6',
        'NEWS_COUNT'                      => '6',
        'USE_FILTER'                      => 'Y',
        'FILTER_NAME'                     => 'arrProjectsFilter',
        'FIELD_CODE'                      => [
            0 => '',
            1 => '',
        ],
        'PROPERTY_CODE'                   => [
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
        ],
        'CHECK_DATES'                     => 'Y',
        'DETAIL_URL'                      => '',
        'AJAX_MODE'                       => 'N',
        'AJAX_OPTION_JUMP'                => 'N',
        'AJAX_OPTION_STYLE'               => 'N',
        'AJAX_OPTION_HISTORY'             => 'N',
        'AJAX_OPTION_ADDITIONAL'          => '',
        'CACHE_TYPE'                      => 'N',
        'CACHE_GROUPS'                    => 'N',
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
        'INCLUDE_SUBSECTIONS'             => 'N',
        'STRICT_SECTION_CHECK'            => 'N',
        'TITLE'                           => '',
        'PAGER_TEMPLATE'                  => 'load_more',
        'DISPLAY_TOP_PAGER'               => 'N',
        'DISPLAY_BOTTOM_PAGER'            => 'Y',
        'PAGER_TITLE'                     => 'Проекты',
        'PAGER_SHOW_ALWAYS'               => 'N',
        'PAGER_DESC_NUMBERING'            => 'N',
        'PAGER_DESC_NUMBERING_CACHE_TIME' => '36000',
        'PAGER_SHOW_ALL'                  => 'N',
        'PAGER_BASE_LINK_ENABLE'          => 'N',
        'SET_STATUS_404'                  => 'N',
        'SHOW_404'                        => 'N',
        'MESSAGE_404'                     => ''
    ],
    false
);