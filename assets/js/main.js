!(function ($) {
	"use strict";

	/* Toggle submenu align */
	function SeineSubmenuAuto() {
		if ($('.bt-site-header .bt-container').length > 0) {
			var container = $('.bt-site-header .bt-container'),
				containerInfo = { left: container.offset().left, width: container.innerWidth() },
				contLeftPos = containerInfo.left,
				contRightPos = containerInfo.left + containerInfo.width;

			$('.children, .sub-menu').each(function () {
				var submenuInfo = { left: $(this).offset().left, width: $(this).innerWidth() },
					smLeftPos = submenuInfo.left,
					smRightPos = submenuInfo.left + submenuInfo.width;

				if (smLeftPos <= contLeftPos) {
					$(this).addClass('bt-align-left');
				}

				if (smRightPos >= contRightPos) {
					$(this).addClass('bt-align-right');
				}

			});
		}
	}

	/* Toggle menu mobile */
	function SeineToggleMenuMobile() {
		$('.bt-site-header .bt-menu-toggle').on('click', function (e) {
			e.preventDefault();

			if ($(this).hasClass('bt-menu-open')) {
				$(this).addClass('bt-is-hidden');
				$('.bt-site-header .bt-primary-menu').addClass('bt-is-active');
			} else {
				$('.bt-menu-open').removeClass('bt-is-hidden');
				$('.bt-site-header .bt-primary-menu').removeClass('bt-is-active');
			}
		});
	}

	/* Toggle sub menu mobile */
	function SeineToggleSubMenuMobile() {
		var hasChildren = $('.bt-site-header .page_item_has_children, .bt-site-header .menu-item-has-children');

		hasChildren.each(function () {
			var $btnToggle = $('<div class="bt-toggle-icon"></div>');

			$(this).append($btnToggle);

			$btnToggle.on('click', function (e) {
				e.preventDefault();
				$(this).toggleClass('bt-is-active');
				$(this).parent().children('ul').toggle();
			});
		});
	}

	/* Tabs */
	function SeineTabs() {
		if ($('.bt-tabs-js').length > 0) {
			$('.bt-tabs-js .bt-nav-item').on('click', function (e) {
				e.preventDefault();
				$(this).addClass('bt-is-active').siblings().removeClass('bt-is-active');
				$($.attr(this, 'href')).addClass('bt-is-active').siblings().removeClass('bt-is-active');
			});
		}
	}

	/* Gallery Carousel */
	function SeineGallerCarousel() {
		if ($('.js-gallery-carousel').length > 0) {
			$('.js-gallery-carousel').slick({
				slidesToShow: 2,
				slidesToScroll: 1,
				arrows: true,
				prevArrow: '<button type=\"button\" class=\"slick-prev\">Prev</button>',
				nextArrow: '<button type=\"button\" class=\"slick-next\">Next</button>'
			});
		}
	}

	/* Gallery Slider */
	function SeineGallerSlider() {
		if ($('.js-gallery-slider').length > 0) {
			$('.js-gallery-slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
				arrows: false,
				asNavFor: '.js-gallery-slider-nav',
				prevArrow: '<button type=\"button\" class=\"slick-prev\">Prev</button>',
				nextArrow: '<button type=\"button\" class=\"slick-next\">Next</button>'
			});
			$('.js-gallery-slider-nav').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				focusOnSelect: true,
				asNavFor: '.js-gallery-slider-for',
				responsive: [
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 3
						}
					}
				]
			});
		}
	}

	/* Orbit effect */
	function SeineOrbitEffect() {
		if ($('.bt-orbit-enable').length > 0) {
			var html = '<div class="bt-orbit-effect">' +
				'<div class="bt-orbit-wrap">' +
				'<div class="bt-orbit red"><span></span></div>' +
				'<div class="bt-orbit blue"><span></span></div>' +
				'<div class="bt-orbit yellow"><span></span></div>' +
				'<div class="bt-orbit purple"><span></span></div>' +
				'<div class="bt-orbit green"><span></span></div>' +
				'</div>' +
				'</div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Cursor effect */
	function SeineCursorEffect() {
		if ($('.bt-bg-pattern-enable').length > 0) {
			var html = '<div class="bt-bg-pattern-effect"></div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Buble effect */
	function SeineBubleEffect() {
		if ($('.bt-bg-buble-enable').length > 0) {
			var html = '<div class="bt-bg-buble-effect">' +
				'<div class="bt-bubles-beblow"></div>' +
				'<div class="bt-bubles-above"></div>'
			'</div>';

			$('.bt-social-mcn-ss').append(html);

			for (let i = 0; i < 40; i++) {
				$('.bt-bubles-beblow').append('<span class="buble"></span>');
				$('.bt-bubles-above').append('<span class="buble"></span>');
			}
		}
	}

	/* Shop */
	function SeineShop() {
		if ($('.single-product').length > 0) {
			$('.woocommerce-product-zoom__image').zoom();

			$('.woocommerce-product-gallery__slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
				arrows: false,
				asNavFor: '.woocommerce-product-gallery__slider-nav',
				prevArrow: '<button type=\"button\" class=\"slick-prev\">Prev</button>',
				nextArrow: '<button type=\"button\" class=\"slick-next\">Next</button>'
			});
			$('.woocommerce-product-gallery__slider-nav').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				focusOnSelect: true,
				asNavFor: '.woocommerce-product-gallery__slider'
			});
		}
		if ($('.quantity input').length > 0) {
			/* Plus Qty */
			$(document).on('click', '.qty-plus', function () {
				var parent = $(this).parent();
				$('input.qty', parent).val(parseInt($('input.qty', parent).val()) + 1);
				$('input.qty', parent).trigger('change');
			});
			/* Minus Qty */
			$(document).on('click', '.qty-minus', function () {
				var parent = $(this).parent();
				if (parseInt($('input.qty', parent).val()) > 1) {
					$('input.qty', parent).val(parseInt($('input.qty', parent).val()) - 1);
					$('input.qty', parent).trigger('change');
				}
			});
		}

	}

	/* Units custom */
	function SeineUnitsCustom() {
		if ($('.wp-block-search__button').length > 0) {
			$('.wp-block-search__button svg').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">' +
				'<g clip-path="url(#clip0_19_3488)">' +
				'<path d="M24.408 21.3828L18.6603 15.6347C19.6369 14.08 20.2037 12.2424 20.2037 10.2703C20.2037 4.69102 15.6807 0.168701 10.1016 0.168701C4.52253 0.168701 0 4.69102 0 10.2703C0 15.8498 4.52232 20.3717 10.1016 20.3717C12.2478 20.3717 14.2356 19.7007 15.8714 18.5606L21.5506 24.2403C21.9453 24.6345 22.4626 24.8309 22.9793 24.8309C23.4966 24.8309 24.0133 24.6345 24.4086 24.2403C25.1972 23.4509 25.1972 22.1721 24.408 21.3828ZM10.1016 17.0989C6.33066 17.0989 3.27341 14.0419 3.27341 10.2707C3.27341 6.49957 6.33066 3.44232 10.1016 3.44232C13.8728 3.44232 16.9298 6.49957 16.9298 10.2707C16.9298 14.0419 13.8728 17.0989 10.1016 17.0989Z" fill="white"/>' +
				'</g>' +
				'<defs>' +
				'<clipPath id="clip0_19_3488">' +
				'<rect width="25" height="25" fill="white"/>' +
				'</clipPath>' +
				'</defs>' +
				'</svg>');
		}
		if ($('.bt-post--content').length > 0) {
			var quoteIcon = '<span class="bt-quote-icon"><svg width="38" height="38" viewBox="0 0 38 38" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
				'<path d="M29.1329 33.0577C34.0301 33.0577 38 29.0867 38 24.1879C38 19.2907 34.0301 15.3197 29.1329 15.3197C29.1329 15.3197 29.1758 12.025 31.8525 7.28298C32.1498 6.33283 31.6198 5.321 30.669 5.02539C29.9945 4.8132 29.2846 5.01945 28.8263 5.49957C22.6717 12.2312 20.2625 20.1539 20.2625 24.1879C20.2625 29.0867 24.2323 33.0577 29.1329 33.0577Z"/>' +
				'<path d="M8.87122 33.0577C13.7684 33.0577 17.7383 29.0867 17.7383 24.1879C17.7383 19.2907 13.7684 15.3197 8.87122 15.3197C8.87122 15.3197 8.91412 12.025 11.5907 7.28298C11.8881 6.33283 11.358 5.321 10.4073 5.02539C9.73275 4.8132 9.02292 5.01945 8.56462 5.49957C2.40996 12.2312 0.000741959 20.1539 0.000741959 24.1879C0.000741959 29.0867 3.97063 33.0577 8.87122 33.0577Z"/>' +
				'</svg></span>';
			$('.bt-post--content blockquote').append(quoteIcon);

			var ulIcon = '<span class="bt-ul-icon"><svg width="26" height="26" viewBox="0 0 26 26" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
				'<path fill-rule="evenodd" clip-rule="evenodd" d="M14.8948 0.536215C14.3234 0.190003 13.6681 0.00695801 13 0.00695801C12.3319 0.00695801 11.6766 0.190003 11.1053 0.536215L2.574 5.70696C2.03639 6.03272 1.59185 6.49158 1.28329 7.03924C0.974733 7.5869 0.812585 8.20486 0.8125 8.83346V17.1665C0.812585 17.7951 0.974733 18.413 1.28329 18.9607C1.59185 19.5084 2.03639 19.9672 2.574 20.293L11.1053 25.4637C11.6766 25.8099 12.3319 25.993 13 25.993C13.6681 25.993 14.3234 25.8099 14.8948 25.4637L23.426 20.293C23.9636 19.9672 24.4082 19.5084 24.7167 18.9607C25.0253 18.413 25.1874 17.7951 25.1875 17.1665V8.83346C25.1874 8.20486 25.0253 7.5869 24.7167 7.03924C24.4082 6.49158 23.9636 6.03272 23.426 5.70696L14.8948 0.536215ZM16.6075 9.29496C16.7191 9.17522 16.8536 9.07918 17.0031 9.01257C17.1526 8.94596 17.314 8.91014 17.4777 8.90725C17.6413 8.90437 17.8038 8.93447 17.9556 8.99577C18.1074 9.05706 18.2452 9.1483 18.3609 9.26403C18.4767 9.37976 18.5679 9.51761 18.6292 9.66937C18.6905 9.82112 18.7206 9.98367 18.7177 10.1473C18.7148 10.311 18.679 10.4723 18.6124 10.6218C18.5458 10.7713 18.4497 10.9059 18.33 11.0175L11.83 17.5175C11.6015 17.7457 11.2917 17.8739 10.9688 17.8739C10.6458 17.8739 10.336 17.7457 10.1075 17.5175L6.8575 14.2675C6.64222 14.0364 6.52502 13.7309 6.53059 13.4151C6.53616 13.0994 6.66407 12.7981 6.88736 12.5748C7.11066 12.3515 7.41191 12.2236 7.72765 12.2181C8.04339 12.2125 8.34897 12.3297 8.58 12.545L10.9688 14.9337L16.6075 9.29496Z"/>' +
				'</svg></span>';
			$('.bt-post--content ul li').append(ulIcon);
		}


	}

	function SeineInforProduct() {
		const $itemInfo = $('#bt-product-additional_information .woocommerce-product-attributes-item__label')
		if (!$itemInfo.length) return;

		const $infoIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><g clip-path="url(#clip0_72_1636)"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.8948 0.536215C14.3234 0.190003 13.6681 0.00695801 13 0.00695801C12.3319 0.00695801 11.6766 0.190003 11.1053 0.536215L2.574 5.70696C2.03639 6.03272 1.59185 6.49158 1.28329 7.03924C0.974733 7.5869 0.812585 8.20486 0.8125 8.83346V17.1665C0.812585 17.7951 0.974733 18.413 1.28329 18.9607C1.59185 19.5084 2.03639 19.9672 2.574 20.293L11.1053 25.4637C11.6766 25.8099 12.3319 25.993 13 25.993C13.6681 25.993 14.3234 25.8099 14.8948 25.4637L23.426 20.293C23.9636 19.9672 24.4082 19.5084 24.7167 18.9607C25.0253 18.413 25.1874 17.7951 25.1875 17.1665V8.83346C25.1874 8.20486 25.0253 7.5869 24.7167 7.03924C24.4082 6.49158 23.9636 6.03272 23.426 5.70696L14.8948 0.536215ZM16.6075 9.29496C16.7191 9.17522 16.8536 9.07918 17.0031 9.01257C17.1526 8.94596 17.314 8.91014 17.4777 8.90725C17.6413 8.90437 17.8038 8.93447 17.9556 8.99577C18.1074 9.05706 18.2452 9.1483 18.3609 9.26403C18.4767 9.37976 18.5679 9.51761 18.6292 9.66937C18.6905 9.82112 18.7206 9.98367 18.7177 10.1473C18.7148 10.311 18.679 10.4723 18.6124 10.6218C18.5458 10.7713 18.4497 10.9059 18.33 11.0175L11.83 17.5175C11.6015 17.7457 11.2917 17.8739 10.9688 17.8739C10.6458 17.8739 10.336 17.7457 10.1075 17.5175L6.8575 14.2675C6.64222 14.0364 6.52502 13.7309 6.53059 13.4151C6.53616 13.0994 6.66407 12.7981 6.88736 12.5748C7.11066 12.3515 7.41191 12.2236 7.72765 12.2181C8.04339 12.2125 8.34897 12.3297 8.58 12.545L10.9688 14.9337L16.6075 9.29496Z" fill="#1FBECD"/></g><defs><clipPath id="clip0_72_1636"><rect width="26" height="26" fill="white"/></clipPath></defs></svg>';
		$itemInfo.prepend($infoIcon);
	}
	/* Custom Checkbox */
	function SenineCustomCheckbox() {
		const $itemcheckbox = $('.tnp-privacy-field .tnp-privacy')
		if (!$itemcheckbox.length) return;

		const $divcheckbox = '<div class="checkmark"></div>';
		$itemcheckbox.parent().append($divcheckbox);
	}

	jQuery(document).ready(function ($) {
		SeineSubmenuAuto();
		SeineToggleMenuMobile();
		SeineToggleSubMenuMobile();
		SeineTabs();
		SeineGallerSlider();
		SeineGallerCarousel();
		SeineOrbitEffect();
		SeineCursorEffect();
		SeineBubleEffect();
		SeineShop();
		SeineUnitsCustom();
		SeineInforProduct();
		SenineCustomCheckbox();
	});

	jQuery(window).on('resize', function () {
		SeineSubmenuAuto();
	});

	jQuery(window).on('scroll', function () {

	});

})(jQuery);
