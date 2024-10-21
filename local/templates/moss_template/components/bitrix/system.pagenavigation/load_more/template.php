<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var CMain $arResult */
?>

<?php if ($arResult['NavPageCount'] > 1): ?>
    <?php if ($arResult['NavPageNomer'] + 1 <= $arResult['nEndPage']): ?>
        <?php
        	$plus = $arResult['NavPageNomer'] + 1;
        	$url = $arResult['sUrlPathParams'] . 'PAGEN_' . $arResult['NavNum'] . '=' . $plus;
        ?>
		<button type="button" data-url="<?php echo $url; ?>" class="button show_more">
			<span><?php echo Loc::getMessage('LOAD_MORE'); ?></span>
		</button>
    <?php endif; ?>
<?php endif; ?>