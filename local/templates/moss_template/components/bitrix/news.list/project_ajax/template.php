<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent $component
 * @var string $templateName
 * @var string $componentPath
 */

if (!empty($arResult['NAV_RESULT'])) {
    $navParams = [
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum'       => $arResult['NAV_RESULT']->NavPageNomer == 1 ? $arResult['NAV_RESULT']->NavPageNomer :
            $arResult['NAV_RESULT']->NavNum
    ];
} else {
    $navParams = [
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum'       => 1
    ];
}
?>

<article class="article">
	<div class="container">
		<div class="projects">
			<div class="tabs">
				<div class="tabs__tabs">
					<div class="tabs__tab"><span>На карте</span></div>
					<div class="tabs__tab is-active"><span>Списком</span></div>
				</div>
				<div class="tabs__contents">
					<div class="tabs__content">
                        <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/map.php', [],
                            ['MODE' => 'php']); ?>
					</div>
					<div class="tabs__content is-active">
						<div class="projects__main">
							<div class="projects__filter">
								<form class="filter" id="filter_projects">
									<div class="filter__modal-toggler" data-dialog="filter_projects">
										<span>Фильтровать по</span>
									</div>
									<label class="filter__item">
										<select id="area" name="AREA" data-placeholder="Округ">
											<option value="" hidden></option>
                                            <?php foreach ($arResult['ITEMS_AREAS'] as $areaId => $area): ?>
												<option value="<?php echo $areaId; ?>" <?php echo $area['SELECTED']; ?>>
                                                    <?php echo $area['VALUE']; ?>
												</option>
                                            <?php endforeach; ?>
										</select>
									</label>
									<label class="filter__item">
										<select id="district" name="DISTRICT" data-placeholder="Район">
											<option value="" hidden></option>
                                            <?php foreach ($arResult['ITEMS_DISTRICTS'] as $districtId => $district): ?>
												<option value="<?php echo $districtId; ?>" <?php echo $district['SELECTED']; ?>>
                                                    <?php echo $district['VALUE']; ?>
												</option>
                                            <?php endforeach; ?>
										</select>
									</label>
									<label class="filter__item">
										<button type="button" class="filter__item__label <?php echo $arResult['ITEMS_SQUARES']['SELECTED']; ?>">
											<span>Площадь</span>
										</button>
										<div class="filter__item__drop">
											<div class="interval">
												<div class="interval__fields">
													<label class="interval__field">
														<span>От</span>
														<input type="number"
															   id="min_square"
															   name="MIN_SQUARE"
															   data-interval="min"
															   value="<?php echo $arResult['ITEMS_SQUARES']['MIN']['VALUE']; ?>"
															   min="0"
															   max="100">
													</label>
													<label class="interval__field">
														<span>До</span>
														<input type="number"
															   id="max_square"
															   name="MAX_SQUARE"
															   data-interval="max"
															   value="<?php echo $arResult['ITEMS_SQUARES']['MAX']['VALUE']; ?>"
															   min="0"
															   max="100">
													</label>
												</div>
												<div class="interval__slider">
													<input id="min_square_range" type="range" />
													<input id="max_square_range" type="range" />
												</div>
											</div>
										</div>
									</label>
									<label class=" filter__item">
										<select id="purposes" name="PURPOSES[]" data-placeholder="Назначение" multiple>
                                            <?php foreach ($arResult['ITEMS_PURPOSES'] as $purposeId => $purpose): ?>
												<option value="<?php echo $purposeId; ?>" <?php echo $purpose['SELECTED']; ?>>
                                                    <?php echo $purpose['VALUE']; ?>
												</option>
                                            <?php endforeach; ?>
										</select>
									</label>
									<label class="filter__item">
										<select id="status" name="STATUS" data-placeholder="Статус">
											<option value="" hidden></option>
                                            <?php foreach ($arResult['ITEMS_STATUSES'] as $statusId => $status): ?>
												<option value="<?php echo $statusId; ?>" <?php echo $status['SELECTED']; ?>>
                                                    <?php echo $status['VALUE']; ?>
												</option>
                                            <?php endforeach; ?>
										</select>
									</label>
									<button type="button" id="reset" class="button button--outlined button--xsmall">
										<span>Сбросить фильтры</span>
									</button>
								</form>
								<dialog class="dialog" id="filter_projects">
									<div class="dialog__body">
										<div class="dialog__header">
											<div class="links">
												<a href="/" target="_blank" class="links__link">
													<span class="icon icon--logo"></span>
												</a>
											</div>
											<div class="dialog__selfcloser" data-dialog-selfcloser></div>
										</div>
										<div class="filter-modal">
											<label class="filter__item">
												<select id="area" name="AREA" data-placeholder="Округ">
													<option value="" hidden></option>
                                                    <?php foreach ($arResult['ITEMS_AREAS'] as $areaId => $area): ?>
														<option value="<?php echo $areaId; ?>" <?php echo $area['SELECTED']; ?>>
                                                            <?php echo $area['VALUE']; ?>
														</option>
                                                    <?php endforeach; ?>
												</select>
											</label>
											<label class="filter__item">
												<select id="district" name="DISTRICT" data-placeholder="Район">
													<option value="" hidden></option>
                                                    <?php foreach ($arResult['ITEMS_DISTRICTS'] as $districtId =>
                                                                   $district): ?>
														<option value="<?php echo $districtId; ?>" <?php echo $district['SELECTED']; ?>>
                                                            <?php echo $district['VALUE']; ?>
														</option>
                                                    <?php endforeach; ?>
												</select>
											</label>
											<label class="filter__item">
												<button type="button" class="filter__item__label <?php echo $arResult['ITEMS_SQUARES']['SELECTED']; ?>">
													<span>Площадь</span>
												</button>
												<div class="filter__item__drop">
													<div class="interval">
														<div class="interval__fields">
															<label class="interval__field">
																<span>От</span>
																<input type="number"
																	   id="min_square"
																	   name="MIN_SQUARE"
																	   data-interval="min"
																	   value="<?php echo $arResult['ITEMS_SQUARES']['MIN']['VALUE']; ?>"
																	   min="0"
																	   max="100">
															</label>
															<label class="interval__field">
																<span>До</span>
																<input type="number"
																	   id="max_square"
																	   name="MAX_SQUARE"
																	   data-interval="max"
																	   value="<?php echo $arResult['ITEMS_SQUARES']['MAX']['VALUE']; ?>"
																	   min="0"
																	   max="100">
															</label>
														</div>
														<div class="interval__slider">
															<input id="min_square_range" type="range">
															<input id="max_square_range" type="range">
														</div>
													</div>
												</div>
											</label>
											<label class=" filter__item">
												<select id="purposes" name="PURPOSES[]" data-placeholder="Назначение" multiple>
                                                    <?php foreach ($arResult['ITEMS_PURPOSES'] as $purposeId => $purpose): ?>
														<option value="<?php echo $purposeId; ?>" <?php echo $purpose['SELECTED']; ?>>
                                                            <?php echo $purpose['VALUE']; ?>
														</option>
                                                    <?php endforeach; ?>
												</select>
											</label>
											<label class="filter__item">
												<select id="status" name="STATUS" data-placeholder="Статус">
													<option value="" hidden></option>
                                                    <?php foreach ($arResult['ITEMS_STATUSES'] as $statusId => $status): ?>
														<option value="<?php echo $statusId; ?>" <?php echo $status['SELECTED']; ?>>
                                                            <?php echo $status['VALUE']; ?>
														</option>
                                                    <?php endforeach; ?>
												</select>
											</label>
											<div class="button" id="apply">
												<span>Применить фильтры</span>
											</div>
										</div>
									</div>
								</dialog>
							</div>
                            <?php if (count($arResult['ITEMS']) > 0): ?>
								<div class="projects__list">
                                    <?php foreach ($arResult['ITEMS'] as $arItem): ?>
                                        <?php
                                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                                            CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                                            CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'),
                                            ['CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
                                        ?>

										<div class="projects__card <?php echo $arItem['ON_SALE'] ?
                                            'projects__card--onsale' : ''; ?>"
											 id="<?php echo $this->GetEditAreaId($arItem['ID']); ?>">
											<a href="<?php echo $arItem["DETAIL_PAGE_URL"] ?>"
											   class="projects__card__img">
												<img src="<?php echo $arItem['PREVIEW_PICTURE']['SRC']; ?>"
													 alt="<?php echo $arItem["NAME"] ?>">
											</a>
											<a href="<?php echo $arItem["DETAIL_PAGE_URL"] ?>"
											   class="projects__card__header">
												<span class="projects__card__title"><span><?php echo $arItem["NAME"] ?></span></span>
												<span class="projects__card__link"><span><?php echo Loc::getMessage("MSG_PJ_LIST_MORE") ?></span></span>
											</a>
											<div class="projects__card__text">
                                                <?php if (!empty($arItem["PROPERTIES"]["SQUARE"]["VALUE"])) { ?>
													<p><?php echo Loc::getMessage("MSG_PJ_LIST_SQUARE") .
                                                            $arItem["PROPERTIES"]["SQUARE"]["VALUE"] ?></p>
                                                <?php } ?>
                                                <?php if (!empty($arItem["PROPERTIES"]["AREA"]["VALUE"])) { ?>
													<p><?php echo Loc::getMessage("MSG_PJ_LIST_AREA") .
                                                            $arItem["PROPERTIES"]["AREA"]["VALUE"] ?></p>
                                                <?php } ?>
                                                <?php if (!empty($arItem["PROPERTIES"]["DISTRICT"]["VALUE"])) { ?>
													<p><?php echo Loc::getMessage("MSG_PJ_LIST_DISTRICT") .
                                                            $arItem["PROPERTIES"]["DISTRICT"]["VALUE"] ?></p>
                                                <?php } ?>
                                                <?php if (!empty($arItem["PROPERTIES"]["STATUS"]["VALUE"])) { ?>
													<p><?php echo Loc::getMessage("MSG_PJ_LIST_STATUS") .
                                                            $arItem["PROPERTIES"]["STATUS"]["VALUE"] ?></p>
                                                <?php } ?>
                                                <?php if (!empty($arItem["PROPERTIES"]["TOTAL_AMOUNT_CONSTRUCTION"]["VALUE"])
                                                    || !empty($arItem["PROPERTIES"]["INDUSTRIAL_CONSTRUCTION"]["VALUE"])
                                                    ||
                                                    !empty($arItem["PROPERTIES"]["SOCIAL_AND_BUSINESS_CONSTRUCTION"]["VALUE"])
                                                    || !empty($arItem["PROPERTIES"]["RESIDENT_CONSTRUCTION"]["VALUE"])
                                                    || !empty($arItem["PROPERTIES"]["JOB_GROWTH"]["VALUE"])) { ?>
													<strong><?php echo Loc::getMessage("MSG_PJ_LIST_PROP_TITLE") ?></strong>

                                                    <?php if (!empty($arItem["PROPERTIES"]["TOTAL_AMOUNT_CONSTRUCTION"]["VALUE"])) { ?>
														<p><?php echo Loc::getMessage("MSG_PJ_LIST_TOTAL_AMOUNT_CONSTRUCTION") .
                                                                $arItem["PROPERTIES"]["TOTAL_AMOUNT_CONSTRUCTION"]["VALUE"] ?></p>
                                                    <?php } ?>
                                                    <?php if (!empty($arItem["PROPERTIES"]["INDUSTRIAL_CONSTRUCTION"]["VALUE"])) { ?>
														<p><?php echo Loc::getMessage("MSG_PJ_LIST_INDUSTRIAL_CONSTRUCTION") .
                                                                $arItem["PROPERTIES"]["INDUSTRIAL_CONSTRUCTION"]["VALUE"] ?></p>
                                                    <?php } ?>
                                                    <?php if (!empty($arItem["PROPERTIES"]["SOCIAL_AND_BUSINESS_CONSTRUCTION"]["VALUE"])) { ?>
														<p><?php echo Loc::getMessage("MSG_PJ_LIST_SOCIAL_AND_BUSINESS_CONSTRUCTION") .
                                                                $arItem["PROPERTIES"]["SOCIAL_AND_BUSINESS_CONSTRUCTION"]["VALUE"] ?></p>
                                                    <?php } ?>
                                                    <?php if (!empty($arItem["PROPERTIES"]["RESIDENT_CONSTRUCTION"]["VALUE"])) { ?>
														<p><?php echo Loc::getMessage("MSG_PJ_LIST_RESIDENT_CONSTRUCTION") .
                                                                $arItem["PROPERTIES"]["RESIDENT_CONSTRUCTION"]["VALUE"] ?></p>
                                                    <?php } ?>
                                                    <?php if (!empty($arItem["PROPERTIES"]["JOB_GROWTH"]["VALUE"])) { ?>
														<p><?php echo Loc::getMessage("MSG_PJ_LIST_JOB_GROWTH") .
                                                                $arItem["PROPERTIES"]["JOB_GROWTH"]["VALUE"] ?></p>
                                                    <?php } ?>
                                                <?php } ?>
											</div>
										</div>
                                    <?php endforeach; ?>
								</div>
								<div class="projects__footer">
                                    <?php if ($arParams['DISPLAY_BOTTOM_PAGER']): ?>
                                        <?php echo $arResult['NAV_STRING']; ?>
                                    <?php endif; ?>
								</div>
                            <?php else: ?>
								<div class="search__sorry">
									<h3 class="search__sorry__title">
                                        <?php echo Loc::getMessage('SEARCH_NOTHING_TO_FOUND'); ?>
									</h3>
								</div>
                            <?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>

<script>
	new ICJCProjectList({
		ajaxContainerId: 'ajax-projects-container',
		templatePath: '<?php echo CUtil::JSEscape($this->GetFolder()); ?>',
		navParams: <?php echo CUtil::PhpToJSObject($navParams); ?>,
	});
</script>