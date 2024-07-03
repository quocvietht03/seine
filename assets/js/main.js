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
			var quoteIcon = '<span class="bt-quote-icon"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">' +
				'<path d="M0 37.4881H15.252L10.257 47.7223V52.548L28.188 37.4881V9.30005H0L0 37.4881Z" fill="#E96CA7"/>' +
				'<path d="M36.9893 14.6172V37.488H49.3637L45.3101 45.792V49.7058L59.8583 37.488V14.6172H36.9893Z" fill="#E96CA7"/>' +
				'</svg></span>';
			$('.bt-post--content blockquote').append(quoteIcon);

			var ulIcon = '<span class="bt-ul-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">' +
				'<path d="M2.74902 8.33377C2.43837 8.33464 2.13431 8.42344 1.87202 8.58991C1.60973 8.75638 1.39993 8.99371 1.26689 9.27444C1.13386 9.55517 1.08302 9.86783 1.12027 10.1762C1.15751 10.4847 1.28132 10.7762 1.47736 11.0172L5.65647 16.1366C5.80548 16.3216 5.99648 16.4684 6.21361 16.5648C6.43074 16.6612 6.66774 16.7044 6.90491 16.6908C7.41216 16.6635 7.87013 16.3922 8.16211 15.946L16.8432 1.96516C16.8446 1.96284 16.8461 1.96052 16.8476 1.95824C16.9291 1.83317 16.9027 1.58532 16.7345 1.42962C16.6884 1.38687 16.6339 1.35402 16.5745 1.3331C16.5152 1.31218 16.4522 1.30363 16.3894 1.30799C16.3266 1.31235 16.2654 1.32951 16.2095 1.35842C16.1535 1.38734 16.1042 1.42739 16.0643 1.47611C16.0612 1.47994 16.058 1.48372 16.0547 1.48743L7.2997 11.3793C7.26639 11.4169 7.22592 11.4476 7.18067 11.4694C7.13541 11.4913 7.08625 11.504 7.03606 11.5067C6.98587 11.5094 6.93564 11.5021 6.88828 11.4852C6.84093 11.4684 6.7974 11.4423 6.76022 11.4084L3.8546 8.76431C3.55283 8.48768 3.1584 8.33408 2.74902 8.33377Z" fill="#E96CA7"/>' +
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
