(function () {
	'use strict';

	if (!!window.ICJCProjectList) {
		return;
	}

	window.ICJCProjectList = function (params) {
		this.ajaxContainerId = params.ajaxContainerId || '';
		this.templatePath = params.templatePath || '';
		this.ajaxContainerNode = document.getElementById(this.ajaxContainerId) || {};
		this.projectCardsSelector = '.projects__list';
		this.projectCardSelector = '.projects__card';
		this.desktopFilterSelector = 'form#filter_projects';
		this.mobileFilterSelector = 'dialog#filter_projects';
		this.filterActiveSelector = '#filter_projects.active';
		this.filterActiveNode = {};
		this.areaSelectSelector= '#area';
		this.districtSelectSelector= '#district';
		this.purposesSelectSelector= '#purposes';
		this.statusSelectSelector= '#status';
		this.minSquareInputSelector= '#min_square';
		this.maxSquareInputSelector= '#max_square';
		this.minSquareRangeSelector= '#min_square_range';
		this.maxSquareRangeSelector= '#max_square_range';

		this.resetButtonSelector = 'button#reset';

		this.filterApplyButtonSelector = '#apply'
		this.showMoreButtonSelector = '.show_more';
		this.footerSelector = '.projects__footer';

		if (params.navParams) {
			this.navParams = {
				NavNum: params.navParams.NavNum || 1,
				NavPageNomer: parseInt(params.navParams.NavPageNomer) || 1,
				NavPageCount: parseInt(params.navParams.NavPageCount) || 1
			};
		}

		this.init();
	}

	window.ICJCProjectList.prototype = {
		init: function () {
			this.setActiveFilter();
			this.bindResetButton();
			this.bindShowMore();
		},

		setActiveFilter: function () {
			let isDesktop = (window.screen.width > 1280);

			if (isDesktop) {
				this.ajaxContainerNode.querySelector(this.desktopFilterSelector).classList.add('active');
			} else {
				this.ajaxContainerNode.querySelector(this.mobileFilterSelector).classList.add('active');
			}

			this.filterActiveNode = this.ajaxContainerNode.querySelector(this.filterActiveSelector);

			if (isDesktop) {
				this.bindAreaSelect();
				this.bindDistrictSelect();
				this.bindMinSquareRange();
				this.bindMaxSquareRange();
				this.bindPurposesSelect();
				this.bindStatusSelect();
			} else {
				this.bindAreaSelectMobile();
				this.bindModalFilterApplyButton();
			}
		},

		bindAreaSelect: function () {
			const areaSelect = this.filterActiveNode.querySelector(this.areaSelectSelector);

			BX.bind(areaSelect, 'change', BX.delegate(this.filterApply, this));
		},

		bindAreaSelectMobile: function () {
			const areaSelect = this.filterActiveNode.querySelector(this.areaSelectSelector);

			BX.bind(areaSelect, 'change', BX.delegate(this.setDistrictOptions, this));
		},

		setDistrictOptions: function () {
			let area = this.filterActiveNode.querySelector(this.areaSelectSelector).value;

			let data = {
				'AREA': area,
			}

			data['PAGEN_' + this.navParams.NavNum] = this.navParams.NavPageNomer;

			BX.ajax({
				url: this.templatePath + '/ajax.php',
				method: 'POST',
				dataType: 'html',
				timeout: 60,
				data: data,
				onsuccess: BX.delegate(function (html) {
					const htmlResult = document.createElement('div');
					htmlResult.innerHTML = html;

					const newDistrictSelect = htmlResult.querySelector(this.districtSelectSelector);
					const oldDistrictSelect = this.filterActiveNode.querySelector(this.districtSelectSelector);

					oldDistrictSelect.innerHTML = '';

					for (let i = 0; i < newDistrictSelect.options.length; i++) {
						let option = newDistrictSelect.options[i].cloneNode(true);
						oldDistrictSelect.appendChild(option);
					}

					oldDistrictSelect.nextElementSibling.remove();
					window.reinitFilter();
				}, this)
			});
		},

		bindDistrictSelect: function () {
			const districtSelect = this.filterActiveNode.querySelector(this.districtSelectSelector);

			BX.bind(districtSelect, 'change', BX.delegate(this.filterApply, this));
		},

		bindMinSquareRange: function () {
			const minSquareInput = this.filterActiveNode.querySelector(this.minSquareInputSelector);
			const minSquareRange = this.filterActiveNode.querySelector(this.minSquareRangeSelector);

			BX.bind(minSquareInput, 'change', BX.delegate(this.filterApply, this));
			BX.bind(minSquareRange, 'change', BX.delegate(this.filterApply, this));
		},

		bindMaxSquareRange: function () {
			const maxSquareInput = this.filterActiveNode.querySelector(this.maxSquareInputSelector);
			const maxSquareRange = this.filterActiveNode.querySelector(this.maxSquareRangeSelector);

			BX.bind(maxSquareInput, 'change', BX.delegate(this.filterApply, this));
			BX.bind(maxSquareRange, 'change', BX.delegate(this.filterApply, this));
		},

		bindPurposesSelect: function () {
			const purposesSelect = this.filterActiveNode.querySelector(this.purposesSelectSelector);

			BX.bind(purposesSelect, 'change', BX.delegate(this.filterApply, this));
		},

		bindStatusSelect: function () {
			const statusSelect = this.filterActiveNode.querySelector(this.statusSelectSelector);

			BX.bind(statusSelect, 'change', BX.delegate(this.filterApply, this));
		},

		bindResetButton: function () {
			const resetButton = this.ajaxContainerNode.querySelector(this.resetButtonSelector);

			BX.bind(resetButton, 'click', BX.delegate(this.filterReset, this));
		},

		filterReset: function () {
			let data = {
				'AREA': '',
				'DISTRICT': '',
				'MIN_SQUARE': 0,
				'MAX_SQUARE': 100,
				'PURPOSES': '',
				'STATUS': '',
			}

			this.sendRequest(data);
		},

		bindModalFilterApplyButton: function() {
			const filterApplyButtonSelector = this.ajaxContainerNode.querySelector(this.filterApplyButtonSelector);

			BX.bind(filterApplyButtonSelector, 'click', BX.delegate(this.filterApply, this));
		},

		filterApply: function () {
			let data = this.getAjaxParams();

			this.sendRequest(data);
		},

		bindShowMore: function () {
			const showMore = this.ajaxContainerNode.querySelector(this.showMoreButtonSelector);

			BX.bind(showMore, 'click', BX.delegate(this.moreProjects, this));
		},

		moreProjects: function (event) {
			event.preventDefault();

			let data = this.getAjaxParams();

			data['PAGEN_' + this.navParams.NavNum] = this.navParams.NavPageNomer + 1;

			this.sendRequest(data, true);
		},

		getAjaxParams: function () {
			let area = this.filterActiveNode.querySelector(this.areaSelectSelector).value;
			let district = this.filterActiveNode.querySelector(this.districtSelectSelector).value;
			let minSquare = this.filterActiveNode.querySelector(this.minSquareInputSelector).value;
			let maxSquare = this.filterActiveNode.querySelector(this.maxSquareInputSelector).value;

			let purposeOptions = this.filterActiveNode.querySelector(this.purposesSelectSelector).selectedOptions;
			let purposes = Array.from(purposeOptions).map(({ value }) => value);

			let status = this.filterActiveNode.querySelector(this.statusSelectSelector).value;

			let data = {
				'AREA': area,
				'DISTRICT': district,
				'MIN_SQUARE': minSquare,
				'MAX_SQUARE': maxSquare,
				'PURPOSES': purposes,
				'STATUS': status,
			}

			data['PAGEN_' + this.navParams.NavNum] = this.navParams.NavPageNomer;

			return data;
		},

		sendRequest: function (data, showMore= false) {
			BX.ajax({
				url: this.templatePath + '/ajax.php',
				method: 'POST',
				dataType: 'html',
				timeout: 60,
				data: data,
				onsuccess: BX.delegate(function (html) {
					if (showMore) {
						const htmlResult = document.createElement('div');
						htmlResult.innerHTML = html;

						const projectCards = htmlResult.querySelectorAll(this.projectCardSelector);

						projectCards.forEach((projectCard) => {
							const newsContainer = this.ajaxContainerNode.querySelector(this.projectCardsSelector);
							newsContainer.append(projectCard);
						});

						const footer = this.ajaxContainerNode.querySelector(this.footerSelector);
						const footerResult = htmlResult.querySelector(this.footerSelector);

						footer.innerHTML = footerResult.innerHTML;
					} else {
						this.ajaxContainerNode.innerHTML = html;
					}

					window.reinitFilter();
					window.initDialog();
					window.init2gis();
					window.toggleNoscrollBody(false);
				}, this)
			});
		}
	}
})();