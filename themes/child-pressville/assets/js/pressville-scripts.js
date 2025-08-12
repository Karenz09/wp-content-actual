/**
 * Table of contents
 *
 * 1. General
 * 2. Components & shortcodes
 * 3. Header
 * 4. Core
 * 5. Other
 * 6. Shortcodes
 * 7. Plugins
 */

(function($){ "use strict";
$(document).ready( function() {

/* -----------------------------------------------------------------------------

	1. GENERAL

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		IMPROVE ACCESSIBILITY
	-------------------------------------------------------------------------- */

	if ( $( 'body' ).hasClass( 'lsvr-accessibility' ) ) {

		// User is using mouse
		$(document).on( 'mousedown', function() {
			$('body').addClass( 'lsvr-using-mouse' );
			$('body').removeClass( 'lsvr-using-keyboard' );
		});

		// User is using keyboard
		$(document).on( 'keyup', function(e) {
			if ( e.key === "Tab" ) {
				$('body').addClass( 'lsvr-using-keyboard' );
				$('body').removeClass( 'lsvr-using-mouse' );
			}
		});

	}

/* -----------------------------------------------------------------------------

	2. COMPONENTS & SHORTCODES

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		LEAFLET MAP
	-------------------------------------------------------------------------- */

	if ( $.fn.lsvrPressvilleMapLeaflet && 'object' === typeof L ) {

		$( '.c-map--leaflet' ).each(function() {
			$(this).lsvrPressvilleMapLeaflet();
		});

	}

	/* -------------------------------------------------------------------------
		MAP
	-------------------------------------------------------------------------- */

	if ( $.fn.lsvrPressvilleMapGmaps ) {

		$( '.c-map--gmaps' ).each(function() {
			$(this).lsvrPressvilleMapGmaps();
		});

	}

	/* -------------------------------------------------------------------------
		LSVR PRESSVILLE POST GRID SHORTCODE
	-------------------------------------------------------------------------- */

	if ( $.fn.lsvrPressvillePostGridShortcode ) {

		$( '.lsvr-pressville-post-grid--has-slider' ).each(function() {
			$(this).addClass( 'lsvr-pressville-post-grid--init' );
			$(this).lsvrPressvillePostGridShortcode();
		});

	}

	/* -------------------------------------------------------------------------
		LSVR PRESSVILLE SITEMAP SHORTCODE
	-------------------------------------------------------------------------- */

	if ( $.fn.lsvrPressvilleSitemapShortcode ) {

		$( '.lsvr-pressville-sitemap' ).each(function() {
			$(this).addClass( 'lsvr-pressville-sitemap--init' );
			$(this).lsvrPressvilleSitemapShortcode();
		});

	}


/* -----------------------------------------------------------------------------

	3. HEADER

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		BACKGROUND SLIDESHOW
	-------------------------------------------------------------------------- */

	$( '.header-titlebar__background--slideshow, .header-titlebar__background--slideshow-home' ).each(function() {

		var $this = $(this),
			$images = $this.find( '.header-titlebar__background-image' ),
			slideshowSpeed = $this.data( 'slideshow-speed' ) ? parseInt( $this.data( 'slideshow-speed' ) ) * 1000 : 10,
			animationSpeed = 2000;

		// Continue if there are at least two images
		if ( $images.length > 1 ) {

			// Set default active image
			$images.filter( '.header-titlebar__background-image--default' ).addClass( 'header-titlebar__background-image--active' );
			var $active = $images.filter( '.header-titlebar__background-image--active' ),
				$next;

			// Change image to next one
			var changeImage = function() {

				// Determine next image
				if ( $active.next().length > 0 ) {
					$next = $active.next();
				}
				else {
					$next = $images.first();
				}

				// Hide active
				$active.fadeOut( animationSpeed, function() {
					$(this).removeClass( 'header-titlebar__background-image--active'  );
				});

				// Show next
				$next.fadeIn( animationSpeed, function() {
					$(this).addClass( 'header-titlebar__background-image--active' );
					$active = $(this);
				});

				// Repeat
				setTimeout( function() {
					changeImage();
				}, slideshowSpeed );

			};

			// Init
			if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 1199 ) {
				setTimeout( function() {
					changeImage();
				}, slideshowSpeed );
			}

		}

	});

	/* -------------------------------------------------------------------------
		STICKY NAVBAR
	-------------------------------------------------------------------------- */

	$( '.header-navbar--is-sticky' ).each(function(){

		if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 991 ) {

			var $navbar = $(this),
				$titlebar = $( '.header-titlebar' ),
				navbarHeight = $navbar.outerHeight(),
				titlebarHeight = $titlebar.outerHeight();

			// Insert navbar placeholder element
			$navbar.after( '<div class="header-navbar__placeholder"></div>' );
			var $placeholder = $( '.header-navbar__placeholder' );
			$placeholder.css( 'height', navbarHeight );

			$(window).on( 'scroll', function() {

	    		if ( $(window).scrollTop() > titlebarHeight ) {
	    			$placeholder.addClass( 'header-navbar__placeholder--active' );
	    			$navbar.addClass( 'header-navbar--sticky' );
	    		} else {
	    			$placeholder.removeClass( 'header-navbar__placeholder--active' );
	    			$navbar.removeClass( 'header-navbar--sticky' );
	    		}

			});

		}

	});

	/* -------------------------------------------------------------------------
		PRIMARY MENU
	------------------------------------------------------------------------- */

	$( '.header-menu-primary' ).each( function() {

		var $this = $(this),
			expandPopupLabel = $this.data( 'label-expand-popup' ),
			collapsePopupLabel = $this.data( 'label-collapse-popup' ),
			animatedMenu = $( '.header-navbar--animated-primary-menu' ).length > 0 ? true : false;

		// Hide desktop all submenus function
		function resetMenu() {
			$this.find( '.header-menu-primary__item' ).removeClass( 'header-menu-primary__item--hover header-menu-primary__item--active' );
			$this.find( '.header-menu-primary__item-link' ).attr( 'aria-expanded', false );
			$this.find( '.header-menu-primary__submenu' ).removeAttr( 'style' ).attr( 'aria-expanded', false );
			$this.find( '.header-menu-primary__submenu-toggle' ).removeClass( 'header-menu-primary__submenu-toggle--active' ).attr( 'title', expandPopupLabel ).attr( 'aria-expanded', false );
		}

		// Init mobile
		function initMobile() {
			$this.find( '.header-menu-primary__item-link' ).each(function() {
				if ( $(this).attr( 'aria-controls' ) ) {
					$(this).attr( 'data-aria-controls', $(this).attr( 'aria-controls' ) ).removeAttr( 'aria-controls' ).removeAttr( 'aria-owns' ).removeAttr( 'aria-haspopup' ).removeAttr( 'aria-expanded' );
				}
			});
		}

		// Init desktop
		function initDesktop() {
			$this.find( '.header-menu-primary__item-link' ).each(function() {
				if ( $(this).attr( 'data-aria-controls' ) ) {
					$(this).attr( 'aria-controls', $(this).attr( 'data-aria-controls' ) ).attr( 'aria-owns', $(this).attr( 'data-aria-controls' ) ).attr( 'aria-haspopup', true ).attr( 'aria-expanded', false );
				}
			});
		}

		// Init mobile version on refresh
		if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() < 992 ) {
			initMobile();
		}

		// Reset menu when click on link without submenu
		$this.find( '.header-menu-primary__item-link' ).each(function() {
			$(this).on( 'click', function() {
				if ( $(this).parent().find( '> .header-menu-primary__submenu' ).length < 1 ) {
					resetMenu();
				}
			});
		});

		// Parse submenus
		$this.find( '.header-menu-primary__submenu' ).each(function() {

			var $submenu = $(this),
				$parent = $submenu.parent(),
				$toggle = $parent.find( '> .header-menu-primary__submenu-toggle' ),
				$link = $parent.find( '> .header-menu-primary__item-link' ),
				type = $link.closest( '.header-menu-primary__item--megamenu' ).length > 0 ? 'megamenu' : 'dropdown',
				mouseOverTimeout;

			// Show desktop submenu function
			function desktopShowSubmenu() {

				if ( true === animatedMenu ) {
					$submenu.stop( true, false ).fadeIn( 50 );
				} else {
					$submenu.show();
				}

				$submenu.attr( 'aria-expanded', true );
				$parent.addClass( 'header-menu-primary__item--hover' );
				$link.attr( 'aria-expanded', true );

			}

			// Hide desktop submenu function
			function desktopHideSubmenu() {

				if ( true === animatedMenu ) {
					$submenu.stop( true, false ).delay( 100 ).fadeOut( 150 );
				} else {
					$submenu.hide();
				}

				$submenu.attr( 'aria-expanded', false );
				$parent.removeClass( 'header-menu-primary__item--hover' );
				$link.attr( 'aria-expanded', false );

			}

			// Show mobile submenu function
			function mobileShowSubmenu() {
				$submenu.slideDown( 150 );
				$submenu.attr( 'aria-expanded', true );
				$parent.addClass( 'header-menu-primary__item--active' );
				$toggle.attr( 'title', collapsePopupLabel ).attr( 'aria-expanded', true );
			}

			// Hide mobile submenu function
			function mobileHideSubmenu() {
				$submenu.slideUp( 150 );
				$submenu.attr( 'aria-expanded', false );
				$parent.removeClass( 'header-menu-primary__item--active' );
				$toggle.attr( 'title', expandPopupLabel ).attr( 'aria-expanded', false );
			}

			// Desktop interaction
			if ( ( 'dropdown' === type &&
					( $submenu.hasClass( 'header-menu-primary__submenu--level-0' ) || $submenu.hasClass( 'header-menu-primary__submenu--level-1' ) ) ) ||
						( 'megamenu' === type && $submenu.hasClass( 'header-menu-primary__submenu--level-0' ) ) ) {

				// Desktop mouseover and focus action
				$parent.on( 'mouseover focus', function() {
					if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 991 ) {

						desktopShowSubmenu();
/*
						//$parent.data( 'lsvr-mouse-over-timeout', setTimeout( function() { desktopShowSubmenu(); }, 250 ) )

						mouseOverTimeout = setTimeout( function() { desktopShowSubmenu(); }, 250 );

						$parent.data( 'lsvr-mouse-over-timeout', mouseOverTimeout )

						//$parent.data( 'lsvr-mouse-over-timeout', setTimeout( function() { desktopShowSubmenu(); }, 250 ) )


						//clearTimeout( mouseOverTimeout );
*/

					}
				});

				// Desktop mouseleave and blur action
				$parent.on( 'mouseleave blur', function() {
					if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 991 ) {
/*

						mouseOverTimeout = $parent.data( 'lsvr-mouse-over-timeout' );

						clearTimeout( mouseOverTimeout );

						window.console.log( $parent.data( 'lsvr-mouse-over-timeout' ) );
*/
						desktopHideSubmenu();

					}
				});

				// Desktop click or key enter
				$link.on( 'click', function() {

					if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 991 && ! $parent.hasClass( 'header-menu-primary__item--hover' ) ) {

						// Hide opened submenus
						$parent.siblings( '.header-menu-primary__item.header-menu-primary__item--hover' ).each(function() {
							$(this).removeClass( 'header-menu-primary__item--hover' );
							$(this).find( '> .header-menu-primary__submenu' ).hide();
							$(this).find( '> .header-menu-primary__item-link' ).attr( 'aria-expanded', false );
							$(this).find( '> .header-menu-primary__submenu' ).attr( 'aria-expanded', false );
						});

						// Show submenu
						desktopShowSubmenu();

						// Hide on click outside
						$( 'html' ).on( 'click.lsvrPressvilleHeaderMenuPrimaryCloseSubmenuOnClickOutside touchstart.lsvrPressvilleHeaderMenuPrimaryCloseSubmenuOnClickOutside', function(e) {

							desktopHideSubmenu();
							$( 'html' ).unbind( 'click.lsvrPressvilleHeaderMenuPrimaryCloseSubmenuOnClickOutside touchstart.lsvrPressvilleHeaderMenuPrimaryCloseSubmenuOnClickOutside' );

						});

						// Disable link
						$parent.on( 'click touchstart', function(e) {
							e.stopPropagation();
						});
						return false;

					} else {
						resetMenu();
					}

				});

			}

			// Mobile interactions
			$toggle.on( 'click', function() {

				$toggle.toggleClass( 'header-menu-primary__submenu-toggle--active' );
				if ( $toggle.hasClass( 'header-menu-primary__submenu-toggle--active' ) ) {
					mobileShowSubmenu();
				} else {
					mobileHideSubmenu();
				}

			});

		});

		// Reset menu on ESC key
		$(document).on( 'keyup.lsvrPressvilleHeaderMenuPrimaryCloseSubmenuOnEscKey', function(e) {

			if ( e.key === "Escape" ) {

				// Close active submenu
				if ( $( '*:focus' ).closest( '.header-menu-primary__item--hover, .header-menu-primary__item--active' ).length > 0 ) {

					$( '*:focus' ).closest( '.header-menu-primary__item--hover, .header-menu-primary__item--active' ).each(function() {

						$(this).removeClass( 'header-menu-primary__item--hover header-menu-primary__item--active' );
						$(this).find( '> .header-menu-primary__submenu' ).hide();
						$(this).find( '> .header-menu-primary__submenu' ).attr( 'aria-expanded', false );
						$(this).find( '> .header-menu-primary__submenu-toggle' ).removeClass( 'header-menu-primary__submenu-toggle--active' ).attr( 'title', expandPopupLabel ).attr( 'aria-expanded', false );
						if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 991 ) {
							$(this).find( '> .header-menu-primary__item-link' ).attr( 'aria-expanded', false );
							$(this).find( '> .header-menu-primary__item-link' ).focus();
						} else {
							$(this).find( '> .header-menu-primary__submenu-toggle' ).focus();
						}

					});

				}

				// Otherwise close all submenus
				else {

					$( '.header-menu-primary__item--hover, .header-menu-primary__item--active' ).each(function() {

						$(this).removeClass( 'header-menu-primary__item--hover header-menu-primary__item--active' );
						$(this).find( '> .header-menu-primary__submenu' ).hide();
						$(this).find( '> .header-menu-primary__submenu' ).attr( 'aria-expanded', false );
						$(this).find( '> .header-menu-primary__submenu-toggle' ).removeClass( 'header-menu-primary__submenu-toggle--active' ).attr( 'title', expandPopupLabel ).attr( 'aria-expanded', false );
						if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 991 ) {
							$(this).find( '> .header-menu-primary__item-link' ).attr( 'aria-expanded', false );
						}

					});

				}

			}

		});

		// Reset on screen transition
		$(document).on( 'lsvrPressvilleScreenTransition', function() {

			resetMenu();

			if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 991 ) {
				initDesktop();
			} else {
				initMobile();
			}

		});

	});

	/* -------------------------------------------------------------------------
		HEADER SEARCH
	------------------------------------------------------------------------- */

	$( '.header-search' ).each(function() {

		var $popup = $(this),
			$form = $popup.find( '.header-search__form' ),
			$input = $form.find( '.header-search__input' ),
			$filter = $form.find( '.header-search__filter' ),
			$toggle = $( '.header-search__toggle' ),
			$closeButton = $( '.header-search__form-close-button' ),
			expandPopupLabel = $toggle.data( 'label-expand-popup' ),
			collapsePopupLabel = $toggle.data( 'label-collapse-popup' );

		// Close form function
		function closeSearch() {
			$popup.slideUp( 100 );
			$toggle.removeClass( 'header-search__toggle--active' );
			$toggle.attr( 'title', expandPopupLabel );
			$toggle.attr( 'aria-expanded', false );
			$popup.attr( 'aria-expanded', false );
		}

		// Refresh filter function
		function refreshSearchFilter( checkbox ) {

			if ( true === checkbox.prop( 'checked' ) || 'checked' === checkbox.prop( 'checked' ) ) {

				checkbox.parent().addClass( 'header-search__filter-label--active' );

				// Filter all
				if ( checkbox.attr( 'id' ).indexOf( 'header-search-filter-type-any' ) >= 0 ) {
					$filter.find( 'input:not( [id^=header-search-filter-type-any] )' ).prop( 'checked', false ).trigger( 'change' );
				}

				// Filter others
				else {
					$filter.find( 'input[id^=header-search-filter-type-any]' ).prop( 'checked', false ).trigger( 'change' );
				}

			} else {

				checkbox.parent().removeClass( 'header-search__filter-label--active' );

				// Filter All if there is no other filter active
				if ( $filter.find( 'input:checked' ).length < 1 ) {
					$filter.find( 'input[id^=header-search-filter-type-any]' ).prop( 'checked', true ).trigger( 'change' );
				}

			}

		}

		// Toggle search
		$toggle.on( 'click', function() {

			$toggle.toggleClass( 'header-search__toggle--active' );
			$popup.slideToggle( 100 );

			if ( $toggle.hasClass( 'header-search__toggle--active' ) ) {
				$input.focus();
				$toggle.attr( 'title', collapsePopupLabel ).attr( 'aria-expanded', true );
				$popup.attr( 'aria-expanded', true );
			} else {
				$toggle.attr( 'title', expandPopupLabel ).attr( 'aria-expanded', false );
				$popup.attr( 'aria-expanded', false );
			}

		});

		// Close form on close button click
		$closeButton.on( 'click', function() {
			closeSearch();
		});

		// Search filter
		$filter.find( 'input' ).each(function() {
			refreshSearchFilter( $(this) );
			$(this).on( 'change', function() {
				refreshSearchFilter( $(this) );
			});
		});

		// Close on click outside
		$(document).on( 'click.lsvrPressvilleHeaderSearchClosePopupOnClickOutside', function(e) {
			if ( ! $( e.target ).closest( '.header-search__wrapper' ).length && $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 991 ) {
				closeSearch();
			}
		});

		// Close on ESC key
		$(document).on( 'keyup.lsvrPressvilleHeaderSearchClosePopupOnEscKey', function(e) {
			if ( e.key === "Escape" && $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 991 ) {
				closeSearch();
			}
		});

		// Remove inline styles on screen transition
		$(document).on( 'lsvrPressvilleScreenTransition', function() {
			$popup.removeAttr( 'style' ).attr( 'aria-expanded', false );
			$toggle.removeClass( 'header-search__toggle--active' ).attr( 'title', expandPopupLabel ).attr( 'aria-expanded', false );
		});

	});

	/* -------------------------------------------------------------------------
		HEADER LANGUAGES MOBILE
	------------------------------------------------------------------------- */

	$( '.header-languages-mobile' ).each(function() {

		var $this = $(this),
			$popup = $this.find( '.header-languages-mobile__inner' ),
			$toggle = $this.find( '.header-languages-mobile__toggle' ),
			expandPopupLabel = $toggle.data( 'label-expand-popup' ),
			collapsePopupLabel = $toggle.data( 'label-collapse-popup' );

		$toggle.on( 'click', function() {

			$(this).toggleClass( 'header-languages-mobile__toggle--active' );
			$popup.slideToggle( 100 );

			if ( $toggle.hasClass( 'header-languages-mobile__toggle--active' ) ) {
				$toggle.attr( 'title', collapsePopupLabel ).attr( 'aria-expanded', true );
				$popup.attr( 'aria-expanded', true );
			} else {
				$toggle.attr( 'title', expandPopupLabel ).attr( 'aria-expanded', false );
				$popup.attr( 'aria-expanded', false );
			}

		});

		// Remove inline styles on screen transition
		$(document).on( 'lsvrPressvilleScreenTransition', function() {
			$toggle.removeClass( 'header-languages-mobile__toggle--active' ).attr( 'title', expandPopupLabel ).attr( 'aria-expanded', false );
			$popup.removeAttr( 'style' ).attr( 'aria-expanded', false );
		});

	});

	/* -------------------------------------------------------------------------
		HEADER MOBILE TOGGLE
	------------------------------------------------------------------------- */

	$( '.header-mobile-toggle' ).each(function() {

		var $toggle = $(this),
			$popup = $( '.header__navgroup' ),
			expandPopupLabel = $toggle.data( 'label-expand-popup' ),
			collapsePopupLabel = $toggle.data( 'label-collapse-popup' );

		$toggle.on( 'click', function() {

			$toggle.toggleClass( 'header-mobile-toggle--active' );
			$popup.slideToggle( 100 );

			if ( $toggle.hasClass( 'header-mobile-toggle--active' ) ) {
				$toggle.attr( 'title', collapsePopupLabel ).attr( 'aria-expanded', true );
				$popup.attr( 'aria-expanded', true );
			} else {
				$toggle.attr( 'title', expandPopupLabel ).attr( 'aria-expanded', false );
				$popup.attr( 'aria-expanded', false );
			}

		});

		// Set navgroup as popup
		if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() < 992 ) {
			$popup.attr( 'aria-labelledby', $popup.data( 'aria-labelledby' ) ).attr( 'aria-expanded', false );
		}

		// Reset states on screen transition
		$(document).on( 'lsvrPressvilleScreenTransition', function() {

			$toggle.removeClass( 'header-mobile-toggle--active' );
			$popup.removeAttr( 'style aria-labelledby aria-expanded' );

			// Set navgroup as popup
			if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() < 992 ) {
				$popup.attr( 'aria-labelledby', $popup.data( 'aria-labelledby' ) ).attr( 'aria-expanded', false );
			}

		});

	});


/* -----------------------------------------------------------------------------

	4. CORE

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		POST COMPONENTS
	------------------------------------------------------------------------- */

	// Post filter
	$( '.post-archive-filter' ).each(function() {

		var $this = $(this),
			$form = $this.find( '.post-archive-filter__form' ),
			$resetButton = $this.find( '.post-archive-filter__reset-button' );

		// Datepicker
		if ( $.fn.datepicker ) {

			$this.find( '.post-archive-filter__input--datepicker' ).each(function() {

				var $datepicker = $(this);

				$datepicker.datepicker({
					dateFormat: 'yy-mm-dd',
					beforeShow: function() {
						$( '#ui-datepicker-div' ).addClass( 'lsvr-datepicker' );
					},
				});

				$datepicker.parent().on( 'click', function() {
					$datepicker.datepicker( 'show' );
				});

			});
		}

		// Reset
		$resetButton.on( 'click', function() {
			$this.find( '.post-archive-filter__input--datepicker' ).each(function() {
				$(this).val( '' );
			});
			$form.submit();
		});

	});

	/* -------------------------------------------------------------------------
		DIRECTORY
	------------------------------------------------------------------------- */

	// Listing masonry
	if ( $.fn.masonry && $.fn.imagesLoaded ) {
		$( '.lsvr_listing-post-archive .lsvr-grid--masonry' ).each(function() {

			var $this = $(this),
				isRTL = $( 'html' ).attr( 'dir' ) && 'rtl' === $( 'html' ).attr( 'dir' ) ? true : false;

			// Wait for images to load
			$this.imagesLoaded(function() {
				$this.masonry({
					isRTL: isRTL
				});
			});

		});
	}

	// Listing gallery carousel
	if ( $.fn.slick ) {
		$( '.lsvr_listing-post-gallery' ).each(function() {

			var $this = $(this),
				$list = $this.find( '.lsvr_listing-post-gallery__list' ),
				isRTL = $( 'html' ).attr( 'dir' ) && 'rtl' === $( 'html' ).attr( 'dir' ) ? true : false;

			$list.on( 'init', function() {

				$this.removeClass( 'lsvr_listing-post-gallery--loading' );

				// Init lightbox
				if ( $.fn.magnificPopup ) {

					$this.find( '.lsvr_listing-post-gallery__link' ).magnificPopup({
						type: 'image',
						removalDelay: 300,
						mainClass: 'mfp-fade',
						gallery: {
							enabled: true,
							tCounter: '' // Disable images count, because carousel contains image duplicates to create seamless loop
						}
					});

				}

			});

			// Init Slick
			$list.slick({
  				infinite: false,
  				rtl: isRTL,
  				prevArrow: false,
  				nextArrow: false,
  				slidesToShow: 5,
  				slidesToScroll: 3,
				responsive: [
					{
				  		breakpoint: 2000,
				  		settings: {
			    			slidesToShow: 4,
				    		slidesToScroll: 2,
				  		}
					},
					{
				  		breakpoint: 1600,
				  		settings: {
				    		slidesToShow: 3,
				    		slidesToScroll: 1
			  			}
					},
					{
				  		breakpoint: 1000,
				  		settings: {
				    		slidesToShow: 2,
				    		slidesToScroll: 1
				  		}
					},
					{
				  		breakpoint: 500,
				  		settings: {
				    		slidesToShow: 1,
				    		slidesToScroll: 1
				  		}
					}
				],
			});

			// Prev
			$( '.lsvr_listing-post-gallery__button--prev' ).on( 'click', function() {
				$list.slick( 'slickPrev' );
			});

			// Next
			$( '.lsvr_listing-post-gallery__button--next' ).on( 'click', function() {
				$list.slick( 'slickNext' );
			});

		});

	}

	/* -------------------------------------------------------------------------
		EVENTS
	------------------------------------------------------------------------- */

	// Events masonry
	if ( $.fn.masonry && $.fn.imagesLoaded ) {
		$( '.lsvr_event-post-archive .lsvr-grid--masonry' ).each(function() {

			var $this = $(this),
				isRTL = $( 'html' ).attr( 'dir' ) && 'rtl' === $( 'html' ).attr( 'dir' ) ? true : false;

			// Wait for images to load
			$this.imagesLoaded(function() {
				$this.masonry({
					isRTL: isRTL
				});
			});

		});
	}

	// Upcoming dates
	$( '.lsvr_event-post-single .post__dates' ).each(function() {

		var $this = $(this),
			$title = $this.find( '.post__dates-title' ),
			$listWrapper = $this.find( '.post__dates-list-wrapper' );

		$title.on( 'click', function() {
			$title.toggleClass( 'post__dates-title--active' );
			$listWrapper.slideToggle( 150 );
		});

	});

	/* -------------------------------------------------------------------------
		GALLERIES
	------------------------------------------------------------------------- */

	// Gallery masonry
	if ( $.fn.masonry && $.fn.imagesLoaded ) {
		$( '.lsvr_gallery-post-archive .lsvr-grid--masonry, .lsvr_gallery-post-single .post__image-list--masonry' ).each(function() {

			var $this = $(this),
				isRTL = $( 'html' ).attr( 'dir' ) && 'rtl' === $( 'html' ).attr( 'dir' ) ? true : false;

			// Wait for images to load
			$this.imagesLoaded(function() {
				$this.masonry({
					isRTL: isRTL
				});
			});

		});
	}

	/* -------------------------------------------------------------------------
		DOCUMENTS
	------------------------------------------------------------------------- */

	// Categorized attachments
	$( '.lsvr_document-post-archive--categorized-attachments .post-tree' ).each(function() {

		var expandSubmenuLabel = $(this).data( 'label-expand-submenu' ),
			collapseSubmenuLabel = $(this).data( 'label-collapse-submenu' );

		$(this).find( '.post-tree__item-toggle' ).each(function() {

			var $toggle = $(this),
				$parent = $toggle.parent(),
				$submenu = $parent.find( '> .post-tree__children' );

			$toggle.on( 'click', function() {

				$toggle.toggleClass( 'post-tree__item-toggle--active' );
				$parent.toggleClass( 'post-tree__item--active' );
				$submenu.slideToggle( 200 );

				if ( $toggle.hasClass( 'post-tree__item-toggle--active' ) ) {

					$toggle.attr( 'aria-label', collapseSubmenuLabel );
					$toggle.attr( 'aria-expanded', true );
					$submenu.attr( 'aria-expanded', true );

				} else {

					$toggle.attr( 'aria-label', expandSubmenuLabel );
					$toggle.attr( 'aria-expanded', false );
					$submenu.attr( 'aria-expanded', false );

				}

			});

		});

	});

		// Close mobile submenu on ESC key
		if ( $( '.lsvr_document-post-archive--categorized-attachments .post-tree' ).length > 0 ) {

			var expandSubmenuLabel = $( '.lsvr_document-post-archive--categorized-attachments .post-tree' ).data( 'label-expand-submenu' );

			$(document).on( 'keyup.lsvrPressvilleDocumentArchiveCategorizedAttachmentsCloseSubmenuOnEscKey', function(e) {

				if ( e.key === "Escape" ) {

					// Find focused link parent
					if ( $( '*:focus' ).closest( '.post-tree__item--active' ).length > 0 ) {

						$( '*:focus' ).closest( '.post-tree__item--active' ).each(function() {

							// Close active submenu
							$(this).removeClass( 'post-tree__item--active' );
							$(this).find( '> .post-tree__children' ).hide();
							$(this).find( '> .post-tree__item-toggle' ).removeClass( 'post-tree__item-toggle--active' );
							$(this).find( '> .post-tree__item-toggle' ).attr( 'aria-label', expandSubmenuLabel );
							$(this).find( '> .post-tree__item-toggle' ).attr( 'aria-expanded', false );
							$(this).find( '> .post-tree__children' ).attr( 'aria-expanded', false );

							// Change focus
							$(this).find( '> .post-tree__item-toggle' ).focus();

						});

					}

					// Otherwise hide all submenus
					else {

						$( '.post-tree__item' ).each(function() {

							$(this).removeClass( 'header-post-tree__item--active' );
							$(this).find( '> .post-tree__children' ).hide();
							$(this).find( '> .post-tree__item-toggle' ).removeClass( 'post-tree__item-toggle--active' );
							$(this).find( '> .post-tree__item-toggle' ).attr( 'aria-label', expandSubmenuLabel );
							$(this).find( '> .post-tree__item-toggle' ).attr( 'aria-expanded', false );
							$(this).find( '> .post-tree__children' ).attr( 'aria-expanded', false );

						});

					}

				}

			});

		}


/* -----------------------------------------------------------------------------

	5. OTHER

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		BACK TO TOP
	------------------------------------------------------------------------- */

	$( '.back-to-top' ).each(function() {

		var $this = $(this),
			$link = $this.find( '.back-to-top__link' ),
			threshold = $this.attr( 'data-threshold' ) ? parseInt( $this.data( 'threshold' ) ) : 100;

		// Show link after scrolled down
		if ( threshold > 0 && (
			$this.hasClass( 'back-to-top--type-enable' ) ||
			( $this.hasClass( 'back-to-top--type-desktop' ) && $.fn.lsvrPressvilleGetMediaQueryBreakpoint() > 991 ) ||
			( $this.hasClass( 'back-to-top--type-mobile' ) && $.fn.lsvrPressvilleGetMediaQueryBreakpoint() < 992 ) ) ) {

			$(window).on( 'scroll', function() {

	    		if ( $(window).scrollTop() > threshold && $this.is( ':hidden' ) ) {
	    			$this.fadeIn( 300 );
	    		} else if ( $(window).scrollTop() <= threshold && $this.is( ':visible' ) ) {
	    			$this.fadeOut( 300 );
	    		}

			});
		}

		// Click action
		$link.on( 'click', function() {
			$( 'html, body' ).animate({ scrollTop: 0 }, 100 );
			return false;
		});

	});

	/* -------------------------------------------------------------------------
		MAGNIFIC POPUP
	------------------------------------------------------------------------- */

	if ( $.fn.magnificPopup ) {

		// Lightbox config
		if ( 'undefined' !== typeof lsvr_pressville_js_labels && lsvr_pressville_js_labels.hasOwnProperty( 'magnific_popup' ) ) {

			var js_strings = lsvr_pressville_js_labels.magnific_popup;
			$.extend( true, $.magnificPopup.defaults, {
				tClose: js_strings.mp_tClose,
				tLoading: js_strings.mp_tLoading,
				gallery: {
					tPrev: js_strings.mp_tPrev,
					tNext: js_strings.mp_tNext,
					tCounter: '%curr% / %total%'
				},
				image: {
					tError: js_strings.mp_image_tError,
				},
				ajax: {
					tError: js_strings.mp_ajax_tError,
				}
			});

		}

		// Init lightbox
		$( '.lsvr-open-in-lightbox, body:not( .elementor-page ) .gallery .gallery-item a, .wp-block-gallery .blocks-gallery-item a' ).magnificPopup({
			type: 'image',
			removalDelay: 300,
			mainClass: 'mfp-fade',
			gallery: {
				enabled: true
			}
		});

	}

});
})(jQuery);

(function($){ "use strict";

/* -----------------------------------------------------------------------------

	6. SHORTCODES

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		PRESSVILLE POST GRID
	-------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPressvillePostGridShortcode ) {
		$.fn.lsvrPressvillePostGridShortcode = function() {
			if ( $.fn.slick ) {

				var $this = $(this),
					$slider = $this.find( '.lsvr-pressville-post-grid__list' ),
					$wrapper = $this.find( '.lsvr-pressville-post-grid__list-wrapper' ),
					isRTL = $( 'html' ).attr( 'dir' ) && 'rtl' === $( 'html' ).attr( 'dir' ) ? true : false,
					columnsCount = $slider.data( 'columns-count' ),
					columnsCountLg = columnsCount > 3 ? 3 : columnsCount,
					columnsCountMd = columnsCount > 2 ? 2 : columnsCount;

				// Remove loading
				$slider.on( 'init', function() {
					$slider.removeClass( 'lsvr-pressville-post-grid__list--loading' );
				});

				// Init Slick
				$slider.slick({
	  				infinite: true,
	  				rtl: isRTL,
	  				prevArrow: false,
	  				nextArrow: false,
	  				slidesToShow: columnsCount,
	  				slidesToScroll: columnsCount,
					responsive: [
						{
					  		breakpoint: 1199,
					  		settings: {
					    		slidesToShow: columnsCountLg,
					    		slidesToScroll: columnsCountLg
					  		}
						},
						{
					  		breakpoint: 991,
					  		settings: {
					    		slidesToShow: columnsCountMd,
					    		slidesToScroll: columnsCountMd
					  		}
						},
						{
					  		breakpoint: 767,
					  		settings: {
					    		slidesToShow: 1,
					    		slidesToScroll: 1
					  		}
						}
					],
				});

				// Prev
				$wrapper.find( '.lsvr-pressville-post-grid__list-button--prev' ).on( 'click', function() {
					$slider.slick( 'slickPrev' );
				});

				// Next
				$wrapper.find( '.lsvr-pressville-post-grid__list-button--next' ).on( 'click', function() {
					$slider.slick( 'slickNext' );
				});

			}
		};
	}

	/* -------------------------------------------------------------------------
		PRESSVILLE SITEMAP
	-------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPressvilleSitemapShortcode ) {
		$.fn.lsvrPressvilleSitemapShortcode = function() {

			$(this).find( '.lsvr-pressville-sitemap__nav' ).each(function() {

				var expandPopupLabel = $(this).data( 'label-expand-popup' ),
					collapsePopupLabel = $(this).data( 'label-collapse-popup' );

				$(this).find( '.lsvr-pressville-sitemap__submenu--level-1' ).each(function() {

					var $this = $(this),
						$parent = $this.parent(),
						$toggle = $parent.find( '.lsvr-pressville-sitemap__toggle' );

					$toggle.on( 'click', function() {
						$this.slideToggle( 200 );
						$toggle.toggleClass( 'lsvr-pressville-sitemap__toggle--active' );

						// Submenu expanded
						if ( $toggle.hasClass( 'lsvr-pressville-sitemap__toggle--active' ) ) {
							$toggle.attr( 'title', collapsePopupLabel ).attr( 'aria-expanded', true );
							$this.attr( 'aria-expanded', true );
						}

						// Submenu collapsed
						else {
							$toggle.attr( 'title', expandPopupLabel ).attr( 'aria-expanded', false );
							$this.attr( 'aria-expanded', false );
						}


					});

				});

			});

		};
	}


/* -----------------------------------------------------------------------------

	7. PLUGINS

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		MEDIA QUERY BREAKPOINT
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPressvilleGetMediaQueryBreakpoint ) {
		$.fn.lsvrPressvilleGetMediaQueryBreakpoint = function() {

			if ( $( '#lsvr-media-query-breakpoint' ).length < 1 ) {
				$( 'body' ).append( '<span id="lsvr-media-query-breakpoint" style="display: none;"></span>' );
			}
			var value = $( '#lsvr-media-query-breakpoint' ).css( 'font-family' );
			if ( typeof value !== 'undefined' ) {
				value = value.replace( "\"", "" ).replace( "\"", "" ).replace( "\'", "" ).replace( "\'", "" );
			}
			if ( isNaN( value ) ) {
				return $( window ).width();
			}
			else {
				return parseInt( value );
			}

		};
	}

	var lsvrPressvilleMediaQueryBreakpoint;
	if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint ) {
		lsvrPressvilleMediaQueryBreakpoint = $.fn.lsvrPressvilleGetMediaQueryBreakpoint();
		$(window).on( 'resize', function(){
			if ( $.fn.lsvrPressvilleGetMediaQueryBreakpoint() !== lsvrPressvilleMediaQueryBreakpoint ) {
				lsvrPressvilleMediaQueryBreakpoint = $.fn.lsvrPressvilleGetMediaQueryBreakpoint();
				$.event.trigger({
					type: 'lsvrPressvilleScreenTransition',
					message: 'Screen transition completed.',
					time: new Date()
				});
			}
		});
	}
	else {
		lsvrPressvilleMediaQueryBreakpoint = $(document).width();
	}

	/* -------------------------------------------------------------------------
		LEAFLET MAP
	-------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPressvilleMapLeaflet ) {
		$.fn.lsvrPressvilleMapLeaflet = function() {

			// Prepare params
			var $this = $(this).find( '.c-map__canvas' ),
				mapProvider = $this.data( 'map-provider' ) ? $this.data( 'map-provider' ) : 'osm',
				zoom = $this.data( 'zoom' ) ? $this.data( 'zoom' ) : 17,
				enableMouseWheel = $this.data( 'mousewheel' ) && true === String( $this.data( 'mousewheel' ) ) ? true : false,
				elementId = $this.attr( 'id' ),
				address = $this.data( 'address' ) ? $this.data( 'address' ) : false,
				latLong = $this.data( 'latlong' ) ? $this.data( 'latlong' ) : false,
				latitude = false, longitude = false;

			// Parse latitude and longitude
			if ( false !== latLong ) {
				var latLongArr = latLong.split( ',' );
				if ( latLongArr.length == 2 ) {
					latitude = latLongArr[0].trim();
					longitude = latLongArr[1].trim();
				}
			}

			// Proceed only if latitude and longitude were obtained
			if ( false !== latitude && false !== longitude ) {

				// Prepare map options
				var mapOptions = {
					center : [ latitude, longitude ],
					zoom : zoom,
					scrollWheelZoom : enableMouseWheel,
				};

				// Init the map object
				var map = L.map( elementId, mapOptions );
				$this.data( 'map', map );

				// Load tiles from Mapbox
				if ( 'mapbox' === mapProvider ) {

					var apiKey = typeof lsvr_pressville_mapbox_api_key !== 'undefined' ? lsvr_pressville_mapbox_api_key : false;
					if ( false !== apiKey ) {

						L.tileLayer( 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + apiKey, {
							attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
							id: 'mapbox/streets-v11',
							tileSize: 512,
							zoomOffset: -1,
							accessToken: apiKey
						}).addTo( map );

					}

				}

				// Load tiles from Open Street Map
				else if ( 'osm' === mapProvider ) {

					L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
					    subdomains: ['a','b','c']
					}).addTo( map );

				}

				// Marker HTML
	 			var marker = L.divIcon({
	 				iconAnchor : [15, 40],
	 				className : 'c-map__marker-wrapper',
	 				html : '<div class="c-map__marker"><div class="c-map__marker-inner"></div></div>'
	        	});

				// Add marker
				L.marker([ latitude, longitude ], {
					icon : marker
				}).addTo(map);

				// Remove loading
				$this.removeClass( 'c-map__canvas--loading' );

			}

			// Otherwise hide the map
			else {
				$this.hide();
			}

		};
	}

	/* -------------------------------------------------------------------------
		GOOGLE MAP
	-------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPressvilleMapGmaps ) {
		$.fn.lsvrPressvilleMapGmaps = function() {

			// Prepare params
			var $this = $(this).find( '.c-map__canvas' ),
				mapType = $this.data( 'maptype' ) ? $this.data( 'maptype' ) : 'terrain',
				zoom = $this.data( 'zoom' ) ? $this.data( 'zoom' ) : 17,
				enableMouseWheel = $this.data( 'mousewheel' ) && true === String( $this.data( 'mousewheel' ) ) ? true : false,
				elementId = $this.attr( 'id' ),
				address = $this.data( 'address' ) ? $this.data( 'address' ) : false,
				latLong = $this.data( 'latlong' ) ? $this.data( 'latlong' ) : false,
				latitude = false, longitude = false;

			// Parse latitude and longitude
			if ( false !== latLong ) {
				var latLongArr = latLong.split( ',' );
				if ( latLongArr.length == 2 ) {
					latitude = latLongArr[0].trim();
					longitude = latLongArr[1].trim();
				}
			}

			// Load Google Maps API
			if ( $.fn.lsvrPressvilleLoadGoogleMapsApi ) {
				$.fn.lsvrPressvilleLoadGoogleMapsApi();
			}

			// Set basic API settings
			var apiSetup = function() {

				// Get map type
				switch ( mapType ) {
					case 'roadmap':
						mapType = google.maps.MapTypeId.ROADMAP;
						break;
					case 'satellite':
						mapType = google.maps.MapTypeId.SATELLITE;
						break;
					case 'hybrid':
						mapType = google.maps.MapTypeId.HYBRID;
						break;
					default:
						mapType = google.maps.MapTypeId.TERRAIN;
				}

				// Prepare map options
				var mapOptions = {
					'zoom' : zoom,
					'mapTypeId' : mapType,
					'scrollwheel' : enableMouseWheel,
				};

				// Set custom styles
				if ( 'undefined' !== typeof lsvr_pressville_google_maps_style_json ) {
					mapOptions.styles = JSON.parse( lsvr_pressville_google_maps_style_json );
				}
				else if ( 'undefined' !== typeof lsvr_pressville_google_maps_style ) {
					mapOptions.styles = lsvr_pressville_google_maps_style;
				}

				// Init the map object
				var map = new google.maps.Map( document.getElementById( elementId ),
					mapOptions );
				$this.data( 'map', map );

				// If latitude and longitude were obtained, center the map
				if ( false !== latitude && false !== longitude ) {

					var location = new google.maps.LatLng( latitude, longitude );
 					map.setCenter( location );
 					var marker = new google.maps.Marker({
            			position: location,
            			map: map
        			});
 					$this.removeClass( 'c-map__canvas--loading' );

				}

				// Otherwise hide the map
				else {
					$this.hide();
				}

			};

			// Check if API is already loaded, if not, wait for trigger
			if ( 'object' === typeof google && 'object' === typeof google.maps ) {
				apiSetup();
			}
			else {
				$( document ).on( 'lsvrPressvilleGoogleMapsApiLoaded', function() {
					apiSetup();
				});
			}

		};
	}

	/* -------------------------------------------------------------------------
		LOAD GOOGLE MAPS API
	-------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPressvilleLoadGoogleMapsApi ) {
		$.fn.lsvrPressvilleLoadGoogleMapsApi = function() {

			// Check if Google Maps API isn't already loaded
			if ( ! $( 'body' ).hasClass( 'lsvr-google-maps-api-loaded' ) ) {

				// Check if Google Maps API object doesn't already exists
				if ( 'object' === typeof google && 'object' === typeof google.maps ) {
					$.fn.lsvrPressvilleGoogleMapsApiLoaded();
				}

				// If there is not existing instance of Google Maps API, let's create it
				else if ( ! $( 'body' ).hasClass( 'lsvr-google-maps-api-being-loaded' ) ) {

					$( 'body' ).addClass( 'lsvr-google-maps-api-being-loaded' );

					var script = document.createElement( 'script' ),
						apiKey = typeof lsvr_pressville_google_api_key !== 'undefined' ? lsvr_pressville_google_api_key : false,
						language = $( 'html' ).attr( 'lang' ) ? $( 'html' ).attr( 'lang' ) : 'en';

					// Parse language
					language = language.indexOf( '-' ) > 0 ? language.substring( 0, language.indexOf( '-' ) ) : language;

					// Append the script
					if ( apiKey !== false ) {
						script.type = 'text/javascript';
						script.src = 'https://maps.googleapis.com/maps/api/js?language=' + encodeURIComponent( language ) + '&key=' + encodeURIComponent( apiKey ) + '&callback=jQuery.fn.lsvrPressvilleGoogleMapsApiLoaded';
						document.body.appendChild( script );
					}

				}

			}

		};
	}

	// Trigger event
	if ( ! $.fn.lsvrPressvilleGoogleMapsApiLoaded ) {
		$.fn.lsvrPressvilleGoogleMapsApiLoaded = function() {

			// Make sure that Google Maps API object does exist
			if ( 'object' === typeof google && 'object' === typeof google.maps ) {

				// Trigger the event
				$.event.trigger({
					type: 'lsvrPressvilleGoogleMapsApiLoaded',
					message: 'Google Maps API is ready.',
					time: new Date()
				});

				// Add class to BODY element
				$( 'body' ).removeClass( 'lsvr-google-maps-api-being-loaded' );
				$( 'body' ).addClass( 'lsvr-google-maps-api-loaded' );

			}

		};
	}

})(jQuery);