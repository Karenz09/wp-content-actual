(function($){ "use strict";

/* -----------------------------------------------------------------------------

	INIT

----------------------------------------------------------------------------- */

	$(document).on( 'ready widget-added widget-updated', function() {

	    /* ---------------------------------------------------------------------
	    	INIT WIDGET FIELDS
	    --------------------------------------------------------------------- */

	    // Checkbox list
		if ( $.fn.lsvrWidgetFieldCheckboxList ) {
			$( '.lsvr-widget-field--checkbox-list' ).not( '.lsvr-widget-field--init' ).each(function() {
				$(this).addClass( 'lsvr-widget-field--init' );
				$(this).lsvrWidgetFieldCheckboxList();
			});
		}

	    // Image
		if ( $.fn.lsvrWidgetFieldImage ) {
			$( '.lsvr-widget-field--image' ).not( '.lsvr-widget-field--init' ).each(function() {
				$(this).addClass( 'lsvr-widget-field--init' );
				$(this).lsvrWidgetFieldImage();
			});
		}

	});

})(jQuery);


(function($){ "use strict";

/* -----------------------------------------------------------------------------

	WIDGET FIELDS

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		CHECKBOX LIST
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrWidgetFieldCheckboxList ) {
		$.fn.lsvrWidgetFieldCheckboxList = function() {

			var $this = $(this),
				$input = $this.find( '.lsvr-widget-field__input' ),
				$checkboxes = $this.find( '.lsvr-widget-field__checkbox-list-input' );

			// Save values
			var saveValues = function() {

				var values = [];

				// Parse all checked checkboxes
				$checkboxes.filter( ':checked' ).each(function() {
					values.push( $(this).val() );
				});

				// Save values to input
				values = values.length > 0 ? JSON.stringify( values ) : '';
				$input.val( values ).trigger( 'change' );

			};

			// Click checkbox
			$checkboxes.each(function() {
				$(this).on( 'change', function() {
					saveValues();
				});
			});

		};
	}

	/* -------------------------------------------------------------------------
		IMAGE
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrWidgetFieldImage ) {
		$.fn.lsvrWidgetFieldImage = function() {
			if ( typeof wp.media !== 'undefined' ) {

				var $this = $(this),
					$input = $this.find( '.lsvr-widget-field__input' ),
					$container = $this.find( '.lsvr-widget-field__image' ),
					$imagePreview = $this.find( '.lsvr-widget-field__image-preview' ),
					$imagePlaceholder = $this.find( '.lsvr-widget-field__image-placeholder' ),
					$addButton = $this.find( '.lsvr-widget-field__image-add' ),
					$removeButton = $this.find( '.lsvr-widget-field__image-remove' ),
					mediaFrame;

				// Choose image
				$addButton.on( 'click', function() {

					// Open media modal
					if ( mediaFrame ) {
						mediaFrame.open();
					}

					// Init media modal
					else {

						mediaFrame = wp.media.frames.file_frame = wp.media({
							multiple: false
						});

						// When a file is selected, grab the URL and set it as the text field's value
						mediaFrame.on( 'select', function() {
							var attachment = mediaFrame.state().get( 'selection' ).first().toJSON();
							if ( attachment.sizes.hasOwnProperty( 'thumbnail' ) ) {
								$imagePlaceholder.html( '<img src="' + attachment.sizes.thumbnail.url + '" alt="">' );
							} else {
								$imagePlaceholder.html( '<img src="' + attachment.sizes.full.url + '" alt="">' );
							}
							$container.addClass( 'lsvr-widget-field__image--has-image' );
							$input.val( attachment.id ).trigger( 'change' );
						});

						mediaFrame.open();

					}

				});

				// Remove image
				$removeButton.on( 'click', function() {
					$imagePlaceholder.html( '' );
					$container.removeClass( 'lsvr-widget-field__image--has-image' );
					$input.val( '' );
				});

			}
		};
	}

})(jQuery);