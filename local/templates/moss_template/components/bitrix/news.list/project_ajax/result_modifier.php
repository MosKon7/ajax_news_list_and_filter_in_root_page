<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */

foreach ($arResult['ITEMS'] as &$arItem) {
    if (!$arItem['PREVIEW_PICTURE']) {
        $arItem['PREVIEW_PICTURE']['SRC'] = SITE_TEMPLATE_PATH . '/assets/img/no-img.jpg';
    } else {
        $renderImage =
            CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], ['width' => 400, 'height' => 400], BX_RESIZE_IMAGE_EXACT);
        $arItem['PREVIEW_PICTURE']['SRC'] = $renderImage['src'];
    }

    $arItem['ON_SALE'] = ($arItem['PROPERTIES']['STATUS']['VALUE_XML_ID'] == 'ON_SALE');
}

$arResult['ITEMS_SQUARES']['MIN']['VALUE'] = $_REQUEST['MIN_SQUARE'] ?? 0;
$arResult['ITEMS_SQUARES']['MAX']['VALUE'] = $_REQUEST['MAX_SQUARE'] ?? 100;

if (!empty($_REQUEST['MIN_SQUARE']) && !empty($_REQUEST['MAX_SQUARE'])) {
    $arResult['ITEMS_SQUARES']['SELECTED'] = 'selected';
}

$arFilter['IBLOCK_ID'] = $arParams['IBLOCK_ID'];
$arSelect = ['ID', 'IBLOCK_ID', 'NAME'];

$dbElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

while ($obElement = $dbElements->GetNextElement()) {
    $arProps = $obElement->GetProperties();

    if (!empty($arProps['AREA']['VALUE'])) {
        $arResult['ITEMS_AREAS'][$arProps['AREA']['VALUE_ENUM_ID']]['VALUE'] = $arProps['AREA']['VALUE'];

        $arResult['ITEMS_AREAS'][$arProps['AREA']['VALUE_ENUM_ID']]['SELECTED'] =
            ($_REQUEST['AREA'] == $arProps['AREA']['VALUE_ENUM_ID']) ? 'selected' : '';
    }

    if (!empty($arProps['PURPOSE']['VALUE'])) {
        foreach ($arProps['PURPOSE']['VALUE'] as $purposeKey => $purposeValue) {
            $arResult['ITEMS_PURPOSES'][$arProps['PURPOSE']['VALUE_ENUM_ID'][$purposeKey]]['VALUE'] = $purposeValue;

            if (!empty($_REQUEST['PURPOSES'])) {
                $arResult['ITEMS_PURPOSES'][$arProps['PURPOSE']['VALUE_ENUM_ID'][$purposeKey]]['SELECTED'] =
                    in_array($arProps['PURPOSE']['VALUE_ENUM_ID'][$purposeKey], $_REQUEST['PURPOSES']) ? 'selected' : '';
            }
        }
    }

    if (!empty($arProps['STATUS']['VALUE'])) {
        $arResult['ITEMS_STATUSES'][$arProps['STATUS']['VALUE_ENUM_ID']]['VALUE'] = $arProps['STATUS']['VALUE'];

        $arResult['ITEMS_STATUSES'][$arProps['STATUS']['VALUE_ENUM_ID']]['SELECTED'] =
            ($_REQUEST['STATUS'] == $arProps['STATUS']['VALUE_ENUM_ID']) ? 'selected' : '';
    }
}

$arFilter['PROPERTY_AREA'] = $_REQUEST['AREA'];
$dbElements = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

while ($obElement = $dbElements->GetNextElement()) {
    $arProps = $obElement->GetProperties();

    if (!empty($arProps['DISTRICT']['VALUE'])) {
        $arResult['ITEMS_DISTRICTS'][$arProps['DISTRICT']['VALUE_ENUM_ID']]['VALUE'] = $arProps['DISTRICT']['VALUE'];

        $arResult['ITEMS_DISTRICTS'][$arProps['DISTRICT']['VALUE_ENUM_ID']]['SELECTED'] =
            ($_REQUEST['DISTRICT'] == $arProps['DISTRICT']['VALUE_ENUM_ID']) ? 'selected' : '';
    }
}

asort($arResult['ITEMS_AREAS']);
asort($arResult['ITEMS_DISTRICTS']);
asort($arResult['ITEMS_STATUSES']);
asort($arResult['ITEMS_PURPOSES']);

