(function($){ "use strict";

/* -----------------------------------------------------------------------------

	INIT

----------------------------------------------------------------------------- */

	$(document).ready(function() {

	    /* ---------------------------------------------------------------------
	    	METAFIELDS DEPENDENCY
	    --------------------------------------------------------------------- */

		$( '.lsvr-post-metafield[data-required]' ).each(function() {

			var $this = $(this),
				requiredData = $this.data( 'required' ),
				dependencies,
				metaboxId = $this.parents( '.lsvr-post-metabox' ).data( 'metabox-id' );

			// Parse json
			try {
				dependencies = JSON.parse( requiredData );
			} catch (e) {
				dependencies = requiredData;
			}

			// If field has only one dependency, put it into array
			if ( dependencies.hasOwnProperty( 'id' ) ) {
				dependencies = [ dependencies ];
			}

			// Compare by operator
			var compareValues = {
				'==' : function( inputVal, requiredVal ) {

					// If array
					if ( 'object' == typeof( requiredVal ) ) {

						for ( var k in requiredVal ) {
    						if ( inputVal === requiredVal[ k ] ) {
        						return true;
    						}
						}
						return false;

					}

					// Else
					else {
						return inputVal == requiredVal;
					}

				},
				'!==' : function( inputVal, requiredVal ) { return inputVal !== requiredVal },
			};

			// Check if required condition is met and then show/hide this field
			var checkRequiredField = function( $requiredInput, requiredValue, operator ) {

				// Get input value
				if ( 'radio' === $requiredInput.attr( 'type' ) ) {
					var requiredInputVal = $requiredInput.filter( ':checked' ).val();
				} else {
					var requiredInputVal = $requiredInput.val();
				}

				// Compare input value and required value
				if ( compareValues[ operator ]( requiredInputVal, requiredValue ) ) {
					return true;
				} else {
					return false;
				}

			};

			// Check all dependencies of this field
			var checkAllDependencies = function( dependencies ) {

				var requiredInputId, $requiredInput,
					requiredInputVal, requiredValue, operator,
					valid = true;

				// Parse all dependencies
				for ( var i = 0; i < dependencies.length; i++ ) {

					requiredInputId = dependencies[ i ].id + '_input';
					$requiredInput = $( 'input[name="' + requiredInputId + '"]' );
					requiredValue = 'boolean' === typeof( dependencies[ i ].value ) ? dependencies[ i ].value.toString() : dependencies[ i ].value;
					operator = dependencies[ i ].hasOwnProperty( 'operator' ) ? dependencies[ i ].operator : '==';

					if ( false === checkRequiredField( $requiredInput, requiredValue, operator ) ) {
						valid = false;
					}

				}

				return valid;

			};

			// Test dependencies on refresh
			if ( true === checkAllDependencies( dependencies ) ) {
				$this.slideDown( 150 ).find( 'input' ).prop( 'disabled', false );
			} else {
				$this.slideUp( 150 ).find( 'input' ).prop( 'disabled', true );
			}

			// Test dependencies on change
			for ( var i = 0; i < dependencies.length; i++ ) {

				$( 'input[name="' + dependencies[ i ].id + '_input' + '"]' ).on( 'change', function() {

					if ( true === checkAllDependencies( dependencies ) ) {
						$this.slideDown( 150 ).find( 'input' ).prop( 'disabled', false );
					} else {
						$this.slideUp( 150 ).find( 'input' ).prop( 'disabled', true );
					}

				});

			}

		});

	    /* ---------------------------------------------------------------------
	    	INIT METAFIELDS
	    --------------------------------------------------------------------- */

	    // Attachment
		if (  $.fn.lsvrPostMetafieldAttachment ) {
			$( '.lsvr-post-metafield-attachment' ).each(function() {
				$(this).lsvrPostMetafieldAttachment();
			});
		}

    	// Date
    	if (  $.fn.lsvrPostMetafieldDate ) {
    		$( '.lsvr-post-metafield-date' ).each(function() {
    			$(this).lsvrPostMetafieldDate();
    		});
		}

    	// Datetime
    	if (  $.fn.lsvrPostMetafieldDatetime ) {
    		$( '.lsvr-post-metafield-datetime' ).each(function() {
    			$(this).lsvrPostMetafieldDatetime();
    		});
		}

    	// External Attachment
    	if (  $.fn.lsvrPostMetafieldExternalAttachment ) {
    		$( '.lsvr-post-metafield-ext-attachment' ).each(function() {
    			$(this).lsvrPostMetafieldExternalAttachment();
    		});
		}

	    // Gallery
		if (  $.fn.lsvrPostMetafieldGallery ) {
			$( '.lsvr-post-metafield-gallery' ).each(function() {
				$(this).lsvrPostMetafieldGallery();
			});
		}

		// Checkbox
		if ( $.fn.lsvrPostMetafieldCheckbox ) {
			$( '.lsvr-post-metafield-checkbox' ).each(function() {
				$(this).lsvrPostMetafieldCheckbox();
		    });
		}

		// Opening Hours
		if ( $.fn.lsvrPostMetafieldOpeningHours ) {
			$( '.lsvr-post-metafield-opening-hours' ).each(function() {
				$(this).lsvrPostMetafieldOpeningHours();
		    });
		}

		// Slider
		if ( $.fn.lsvrPostMetafieldSlider ) {
			$( '.lsvr-post-metafield-slider' ).each(function() {
				$(this).lsvrPostMetafieldSlider();
		    });
		}

		// Switch
		if ( $.fn.lsvrPostMetafieldSwitch ) {
			$( '.lsvr-post-metafield-switch' ).each(function() {
				$(this).lsvrPostMetafieldSwitch();
		    });
		}

		// Taxonomy
		if ( $.fn.lsvrPostMetafieldTaxonomy ) {
			$( '.lsvr-post-metafield-taxonomy' ).each(function() {
				$(this).lsvrPostMetafieldTaxonomy();
		    });
		}

	});

})(jQuery);

(function($){ "use strict";

/* -----------------------------------------------------------------------------

	METAFIELDS

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		ATTACHMENT
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPostMetafieldAttachment ) {
		$.fn.lsvrPostMetafieldAttachment = function() {

			var $this = $(this),
				$valueInput = $this.find( '.lsvr-post-metafield-attachment__value' ),
				$selectBtn = $this.find( '.lsvr-post-metafield-attachment__btn-select' ),
				$itemListWrapper = $this.find( '.lsvr-post-metafield-attachment__item-list-wrapper' ),
				$itemList = $this.find( '.lsvr-post-metafield-attachment__item-list' ),
				titleLabel = $this.data( 'title-label' ) ? $this.data( 'title-label' ) : '',
				allowMultiple = true === $this.data( 'allow-multiple' ) ? true : false,
				mediaTypeArr = $this.data( 'media-type' ) ? $this.data( 'media-type' ).split() : false,
				mediaType = {},
				mediaModal;

			// Convert array of allowed media types to object
			if ( false !== mediaTypeArr ) {
				for ( var i = 0; i < mediaTypeArr.length; i++ ) {
					mediaType[ i ] = mediaTypeArr[ i ];
				}
			}

			// Parse all current attachments and update value input with their IDs
			var refreshAttachments = function() {

				// Array with all item IDs
				var attachmentIds = new Array();

				// Parse all items and push IDs to array
				$itemList.find( '.lsvr-post-metafield-attachment__item' ).each(function() {
					if ( $(this).attr( 'data-attachment-id' ) ) {
						attachmentIds.push( $(this).attr( 'data-attachment-id' ) );
					}
				});

				// Save new order to value input
				if ( attachmentIds.length > 0 ) {
					$valueInput.val( attachmentIds.join( ',' ) );
				} else {
					$valueInput.val( '' );
				}

  				// Show list with currently selected media if needed
  				if ( $itemListWrapper.is( ':hidden' ) || $itemList.children().length > 0 ) {
  					$itemListWrapper.slideDown( 150 );
  				} else {
  					$itemListWrapper.slideUp( 150 );
  				}

			};

			// Make attachments sortable
			if ( $.fn.sortable ) {
				$itemList.sortable({
					update: function() {
						refreshAttachments();
					}
				});
			}

			// Init item remove buttons
			var initRemoveButtons = function() {
				$this.find( '.lsvr-post-metafield-attachment__btn-remove' ).each(function() {
					$(this).off( 'click' );
					$(this).on( 'click', function() {

						// Remove element from DOM
						$(this).parents( '.lsvr-post-metafield-attachment__item' ).remove();

						// Refresh attachments
						refreshAttachments();

					});
				});
			}
			initRemoveButtons();

			// Open modal on button click
			$selectBtn.on( 'click', function() {

				// If the media modal already exists, reopen it
				if ( mediaModal ) {
      				mediaModal.open();
      				return;
				}

				// Create a new media modal
				mediaModal = wp.media({
					title: titleLabel,
					multiple: true,
					library: mediaType,
				});

				// Make currently selected files pre-selected in modal
				mediaModal.on( 'open', function() {

					// Create array with currently selected
					var currentSelectionArr = '' !== $valueInput.val() ? $valueInput.val().split( ',' ) : false;

					// Check if there are any selected images
					if ( false !== currentSelectionArr ) {

						var selection = mediaModal.state().get( 'selection' );
						$.each( currentSelectionArr, function( index, id ) {
							var attachment = wp.media.attachment( id );
							attachment.fetch();
							selection.add( attachment );
						});

					}

				});

				// Select action
				mediaModal.on( 'select', function() {

					// Get media attachment details from the modal state
      				var attachments = mediaModal.state().get( 'selection' ).toJSON();

      				// Array with attachment IDs
      				var attachmentIds = new Array();

      				// Hide all currently selected attachments
      				$itemList.empty();

      				// Parse selected attachments
      				$.each( attachments, function( index, attachment ) {

						// Save media IDs into array
						attachmentIds.push( attachment.id );

						// Display selected attachments
						var html = '<li class="lsvr-post-metafield-attachment__item" data-attachment-id="' + attachment.id + '">';
						html += '<div class="lsvr-post-metafield-attachment__item-inner">';
						html += attachment.filename;

						// Add remove button
						html += '<button class="lsvr-post-metafield-attachment__btn-remove" type="button"><i class="dashicons dashicons-no-alt"></i></button>';
						html += '</div></li>';

						// Append HTML
						$itemList.append( html );

						// Init remove buttons
						initRemoveButtons();

	      				// Refresh attachment list
						refreshAttachments();

      				});

      				// Save list of attachment IDs into value input
					$valueInput.val( attachmentIds.join( ',' ) );

				});

				// Open media modal
				mediaModal.open();

			});

		};
	}

	/* -------------------------------------------------------------------------
		DATE
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPostMetafieldDate ) {
		$.fn.lsvrPostMetafieldDate = function() {
			if ( $.fn.datepicker ) {

				var $this = $(this),
				$valueInput = $this.find( '.lsvr-post-metafield-date__value' );

				// Show datepicker
				 $valueInput.datepicker({
					dateFormat: 'yy-mm-dd',
					//minDate: 0,
					beforeShow: function() {
						$( '#ui-datepicker-div' ).addClass( 'lsvr-post-metafield__datepicker' );
					},
				});

				$valueInput.parent().on( 'click', function() {
					$valueInput.datepicker( 'show' );
				});

			}
		}
	}

	/* -------------------------------------------------------------------------
		DATETIME
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPostMetafieldDatetime ) {
		$.fn.lsvrPostMetafieldDatetime = function() {
			if ( $.fn.datepicker ) {

				var $this = $(this),
					$valueInput = $this.find( '.lsvr-post-metafield-datetime__value' ),
					$dateInput = $this.find( '.lsvr-post-metafield-datetime__input-date' ),
					$hourInput = $this.find( '.lsvr-post-metafield-datetime__input-hour' ),
					$minuteInput = $this.find( '.lsvr-post-metafield-datetime__input-minute' );

				// Show datepicker
				 $dateInput.datepicker({
					dateFormat: 'yy-mm-dd',
					minDate: 0,
					beforeShow: function() {
						$( '#ui-datepicker-div' ).addClass( 'lsvr-post-metafield__datepicker' );
					},
				});

				$dateInput.parent().on( 'click', function() {
					$dateInput.datepicker( 'show' );
				});

				// Combine date and time values to single value
				$dateInput.on( 'change', function() {
					$getFuldate();
				});
				$hourInput.on( 'change', function() {
					$getFuldate();
				});
				$minuteInput.on( 'change', function() {
					$getFuldate();
				});
				var $getFuldate = function() {
					if ( $dateInput.val() !== '' ) {

						// Save date and time
						if ( $hourInput.val() !== '' && $minuteInput.val() !== '' ) {
							$valueInput.val( $dateInput.val() + ' ' + $hourInput.val() + ':' + $minuteInput.val() );
						}
						// Save date only
						else {
							$valueInput.val( $dateInput.val() );
						}

					} else {
						$valueInput.val( '' );
					}
				}

			}
		};
	}

	/* -------------------------------------------------------------------------
		EXTERNAL ATTACHMENT
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPostMetafieldExternalAttachment ) {
		$.fn.lsvrPostMetafieldExternalAttachment = function() {

			var $this = $(this),
				$valueInput = $this.find( '.lsvr-post-metafield-ext-attachment__value' ),
				$titleInput = $this.find( '.lsvr-post-metafield-ext-attachment__title-input' ),
				$urlInput = $this.find( '.lsvr-post-metafield-ext-attachment__url-input' ),
				$addBtn = $this.find( '.lsvr-post-metafield-ext-attachment__btn-add' ),
				$itemListWrapper = $this.find( '.lsvr-post-metafield-ext-attachment__item-list-wrapper' ),
				$itemList = $this.find( '.lsvr-post-metafield-ext-attachment__item-list' );

			// Parse all current attachments and update value input
			var refreshAttachments = function() {

				// Array with all item URLs
				var attachments = new Array();

				// Parse all items and push IDs to array
				$itemList.find( '.lsvr-post-metafield-ext-attachment__item' ).each(function() {
					if ( $(this).attr( 'data-encoded-url' ) ) {

						var attachment = {};
						attachment.url = $(this).attr( 'data-encoded-url' );

						if ( $(this).attr( 'data-title' ) ) {
							attachment.title = $(this).attr( 'data-title' );
						}

						attachments.push( attachment );

					}
				});


				// Save new order to value input
				if ( attachments.length > 0 ) {
					$valueInput.val( JSON.stringify( attachments ) );
				} else {
					$valueInput.val( '' );
				}

  				// Show list with currently selected media if needed
  				if ( $itemListWrapper.is( ':hidden' ) || $itemList.children().length > 0 ) {
  					$itemListWrapper.slideDown( 150 );
  				} else {
  					$itemListWrapper.slideUp( 150 );
  				}

			};

			// Init item remove buttons
			var initRemoveButtons = function() {
				$this.find( '.lsvr-post-metafield-ext-attachment__btn-remove' ).each(function() {
					$(this).off( 'click' );
					$(this).on( 'click', function() {

						// Remove element from DOM
						$(this).parents( '.lsvr-post-metafield-ext-attachment__item' ).remove();

						// Refresh attachments
						refreshAttachments();

					});
				});
			}
			initRemoveButtons();

			// Make attachments sortable
			if ( $.fn.sortable ) {
				$itemList.sortable({
					update: function() {
						refreshAttachments();
					}
				});
			}

			// Add new attachment on click
			$addBtn.on( 'click', function() {

				// Check if the input is not blank
				if ( '' !== $urlInput.val() ) {

					// Sanitize URL
					$this.append( '<span class="lsvr-sanitize-url" style="display: none;">' + $urlInput.val() + '</span>' );

					var escapedURL = $this.find( '.lsvr-sanitize-url' ).text(),
						title = '' !== $titleInput.val() ? $titleInput.val() : '';

					$this.find( '.lsvr-sanitize-url' ).remove();

					if ( '' !== escapedURL ) {

						// Display new attachments
						var html = '<li class="lsvr-post-metafield-ext-attachment__item"';
						html += title !== '' ? 'data-title="' + title + '"' : '';
						html += 'data-encoded-url="' + encodeURI( escapedURL ) + '">';
						html += '<div class="lsvr-post-metafield-ext-attachment__item-inner">';

						if ( title !== '' ) {

							html += title + ' (<em>' + escapedURL + '</em>)';

						} else {

							html += escapedURL;

						}

						// Add remove button
						html += '<button class="lsvr-post-metafield-ext-attachment__btn-remove" type="button"><i class="dashicons dashicons-no-alt"></i></button>';
						html += '</div></li>';

						// Append HTML
						$itemList.append( html );

						// Reset inputs
						$titleInput.val( '' );
						$urlInput.val( '' );

						// Init remove buttons
						initRemoveButtons();

	      				// Refresh attachment list
						refreshAttachments();

					}

				}

			});

		};
	}

	/* -------------------------------------------------------------------------
		GALLERY
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPostMetafieldGallery ) {
		$.fn.lsvrPostMetafieldGallery = function() {

			var $this = $(this),
				$valueInput = $this.find( '.lsvr-post-metafield-gallery__value' ),
				$selectBtn = $this.find( '.lsvr-post-metafield-gallery__btn-select' ),
				$itemListWrapper = $this.find( '.lsvr-post-metafield-gallery__item-list-wrapper' ),
				$itemList = $this.find( '.lsvr-post-metafield-gallery__item-list' ),
				titleLabel = $this.data( 'title-label' ) ? $this.data( 'title-label' ) : '',
				mediaModal;

			// Parse all current attachments and update value input with their IDs
			var refreshAttachments = function() {

				// Array with all item IDs
				var attachmentIds = new Array();

				// Parse all items and push IDs to array
				$itemList.find( '.lsvr-post-metafield-gallery__item' ).each(function() {
					if ( $(this).attr( 'data-attachment-id' ) ) {
						attachmentIds.push( $(this).attr( 'data-attachment-id' ) );
					}
				});

				// Save new order to value input
				if ( attachmentIds.length > 0 ) {
					$valueInput.val( attachmentIds.join( ',' ) );
				} else {
					$valueInput.val( '' );
				}

  				// Show list with currently selected media if needed
  				if ( $itemListWrapper.is( ':hidden' ) || $itemList.children().length > 0 ) {
  					$itemListWrapper.slideDown( 150 );
  				} else {
  					$itemListWrapper.slideUp( 150 );
  				}

			};

			// Make attachments sortable
			if ( $.fn.sortable ) {
				$itemList.sortable({
					update: function() {
						refreshAttachments();
					}
				});
			}

			// Init item remove buttons
			var initRemoveButtons = function() {
				$this.find( '.lsvr-post-metafield-gallery__btn-remove' ).each(function() {
					$(this).off( 'click' );
					$(this).on( 'click', function() {

						// Remove element from DOM
						$(this).parents( '.lsvr-post-metafield-gallery__item' ).remove();

						// Refresh attachments
						refreshAttachments();

					});
				});
			}
			initRemoveButtons();

			// Open modal on button click
			$selectBtn.on( 'click', function() {

				// If the media modal already exists, reopen it
				if ( mediaModal ) {
      				mediaModal.open();
      				return;
				}

				// Create a new media modal
				mediaModal = wp.media({
					title: titleLabel,
					multiple: true,
					library: [ 'image' ],
				});

				// Make current;y selected images pre-selected in modal
				mediaModal.on( 'open', function() {

					// Create array with currently selected
					var currentSelectionArr = '' !== $valueInput.val() ? $valueInput.val().split( ',' ) : false;

					// Check if there are any selected images
					if ( false !== currentSelectionArr ) {

						var selection = mediaModal.state().get( 'selection' );
						$.each( currentSelectionArr, function( index, id ) {
							var attachment = wp.media.attachment( id );
							attachment.fetch();
							selection.add( attachment );
						});

					}

				});

				// Select action
				mediaModal.on( 'select', function() {

					// Get media attachment details from the modal state
      				var attachments = mediaModal.state().get( 'selection' ).toJSON();

      				// Array with attachment IDs
      				var attachmentIds = new Array();

      				// Hide all currently selected attachments
      				$itemList.empty();

      				// Parse selected attachments
      				$.each( attachments, function( index, attachment ) {

						// Save media IDs into array
						attachmentIds.push( attachment.id );

						// Display selected attachments
						var thumbnailUrl = attachment.sizes.hasOwnProperty( 'thumbnail' ) ? attachment.sizes.thumbnail.url : attachment.sizes.full.url;
						var html = '<li class="lsvr-post-metafield-gallery__item" data-attachment-id="' + attachment.id + '">';
						html += '<div class="lsvr-post-metafield-gallery__item-inner">';
						html += '<img class="lsvr-post-metafield-gallery__image lsvr-post-metafield-gallery__image--thumb" src="' + thumbnailUrl + '" alt="">';

						// Add remove button
						html += '<button class="lsvr-post-metafield-gallery__btn-remove" type="button"><i class="dashicons dashicons-no-alt"></i></button>';
						html += '</div></li>';

						// Append HTML
						$itemList.append( html );

						// Init remove buttons
						initRemoveButtons();

	      				// Refresh attachment list
						refreshAttachments();

      				});

      				// Save list of attachment IDs into value input
					$valueInput.val( attachmentIds.join( ',' ) );

				});

				// Open media modal
				mediaModal.open();

			});

		};
	}

	/* -------------------------------------------------------------------------
		CHECKBOX
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPostMetafieldCheckbox ) {
		$.fn.lsvrPostMetafieldCheckbox = function() {

			var $this = $(this),
				$valueInput = $this.find( '.lsvr-post-metafield-checkbox__value' ),
				$checkboxes = $this.find( 'input[type=checkbox]' );

			$checkboxes.each(function() {
				$(this).on( 'change', function() {
					var value = $checkboxes.filter( ':checked' ).map(function() {
						return this.value;
					}).get();
					$valueInput.val( value.join() );
				});
			});

		};
	}

	/* -------------------------------------------------------------------------
		OPENING HOURS
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPostMetafieldOpeningHours ) {
		$.fn.lsvrPostMetafieldOpeningHours = function() {

			var $this = $(this),
				$valueInput = $this.find( '.lsvr-post-metafield-opening-hours__value' );

			// Parse all fields and save values into value input
			var update = function() {

				var valueArr = {};

				// Loop all rows
				$this.find( '.lsvr-post-metafield-opening-hours__row' ).each(function() {

					var $row = $(this),
						$closed = $row.find( '.lsvr-post-metafield-opening-hours__checkbox-closed' ),
						day = $row.data( 'day' ),
						breaksCount = $row.find( 'input.lsvr-post-metafield-opening-hours__breaks-input[type="radio"]:checked').length > 0 ? parseInt( $row.find( 'input.lsvr-post-metafield-opening-hours__breaks-input[type="radio"]:checked').val() ) : 0,
						timePeriod = '',
						hourFrom, minuteFrom,
						hourTo, minuteTo;

					// Check if hours are closed
					if ( $closed.length > 0 && $closed.is( ':checked' ) ) {
						valueArr[ day ] = 'closed';
					}

					// If hours are not closed get hours
					else {

						valueArr[ day ] = '';

						for ( var i = 1; i <= breaksCount + 1; i++ ) {

							// Get time from
							hourFrom = $row.find( '.lsvr-post-metafield-opening-hours__hour-from--' + i ).val();
							minuteFrom = $row.find( '.lsvr-post-metafield-opening-hours__minute-from--' + i ).val();

							// Get time to
							hourTo = $row.find( '.lsvr-post-metafield-opening-hours__hour-to--' + i ).val();
							minuteTo = $row.find( '.lsvr-post-metafield-opening-hours__minute-to--' + i ).val();

							// Create string
							timePeriod = hourFrom + ':' + minuteFrom + '-' + hourTo + ':' + minuteTo;

							// Push values to array
							if ( i > 1 ) {
								valueArr[ day ] += ',' + timePeriod;
							} else {
								valueArr[ day ] = timePeriod;
							}

						}

					}

				});

				// Save array to value
				$valueInput.val( JSON.stringify( valueArr ) );
				window.console.log( $valueInput.val() );

			};


			// Update the value when on fields change
			$this.find( 'select, input[type="checkbox"], input[type="radio"]' ).each(function() {
				$(this).on( 'change', function() {
					update();
				});
			});

			// Toggle breaks
			$this.find( '.lsvr-post-metafield-opening-hours__breaks input[type="radio"]' ).each(function() {

				var $radio = $(this),
					$row = $radio.parents( '.lsvr-post-metafield-opening-hours__row' ).first(),
					breaks_count;

				$radio.on( 'change', function() {

					breaks_count = parseInt( $(this).val() );

					for ( var i = 2; i <= 3; i++ ) {

						if ( i > breaks_count + 1 ) {
							$row.find( '.lsvr-post-metafield-opening-hours__time-wrapper--' + i ).slideUp( 150 );
							$row.find( '.lsvr-post-metafield-opening-hours__time-wrapper--' + i ).addClass( 'lsvr-post-metafield-opening-hours__time-wrapper--disabled' );
							$row.find( '.lsvr-post-metafield-opening-hours__time-wrapper--' + i + ' .lsvr-post-metafield-opening-hours__select' ).each(function() {
								$(this).prop( 'disabled', 'disabled' );
							});
						} else {
							$row.find( '.lsvr-post-metafield-opening-hours__time-wrapper--' + i ).slideDown( 150 );
							$row.find( '.lsvr-post-metafield-opening-hours__time-wrapper--' + i ).removeClass( 'lsvr-post-metafield-opening-hours__time-wrapper--disabled' );
							$row.find( '.lsvr-post-metafield-opening-hours__time-wrapper--' + i + ' .lsvr-post-metafield-opening-hours__select' ).each(function() {
								$(this).prop( 'disabled', false );
							});

						}

					}

				});

			});

			// Toggle disabled status for selectboxes and radio inputs on "closed" checkbox change
			$this.find( 'input.lsvr-post-metafield-opening-hours__checkbox-closed[type="checkbox"]' ).each(function() {

				var $checkbox = $(this),
					$row = $checkbox.parents( '.lsvr-post-metafield-opening-hours__row' ).first();

				$checkbox.on( 'change', function() {

					// Parse all selectboxes in row and change their status
					$row.find( '.lsvr-post-metafield-opening-hours__time-wrapper:not( .lsvr-post-metafield-opening-hours__time-wrapper--disabled ) .lsvr-post-metafield-opening-hours__select' ).each(function() {
						if ( $checkbox.is( ':checked' ) ) {
							$(this).prop( 'disabled', 'disabled' );
						} else {
							$(this).prop( 'disabled', false );
						}
					});

					// Parse radio inputs
					$row.find( '.lsvr-post-metafield-opening-hours__breaks input' ).each(function() {
						if ( $checkbox.is( ':checked' ) ) {
							$(this).prop( 'disabled', 'disabled' );
						} else {
							$(this).prop( 'disabled', false );
						}
					});

					// Toggle inputs
					if ( $checkbox.is( ':checked' ) ) {
						$row.find( '.lsvr-post-metafield-opening-hours__time-wrapper:not( .lsvr-post-metafield-opening-hours__time-wrapper--disabled ), .lsvr-post-metafield-opening-hours__breaks' ).slideUp( 150 );
					} else {
						$row.find( '.lsvr-post-metafield-opening-hours__time-wrapper:not( .lsvr-post-metafield-opening-hours__time-wrapper--disabled ), .lsvr-post-metafield-opening-hours__breaks' ).slideDown( 150 );
					}

				});

			});

		};
	}

	/* -------------------------------------------------------------------------
		SLIDER
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPostMetafieldSlider ) {
		$.fn.lsvrPostMetafieldSlider = function() {
	    	if ( $.fn.slider ) {

	    		var $this = $(this),
	    			$slider = $this.find( '.lsvr-post-metafield-slider__slider' ),
	    			$valueInput = $this.find( '.lsvr-post-metafield-slider__value' ),
	    			$sliderValue = $this.find( '.lsvr-post-metafield-slider__slider-value' ),
	    			min = $slider.data( 'min' ) ? $slider.data( 'min' ) : 0,
	    			max = $slider.data( 'max' ) ? $slider.data( 'max' ) : 100,
	    			step = $slider.data( 'step' ) ? $slider.data( 'step' ) : 1,
	    			value = $slider.data( 'value' ) ? $slider.data( 'value' ) : 1;

	    		// Init slider
	    		$slider.slider({
	    			min: min,
	    			max: max,
	    			step: step,
	    			value: value,
	    			slide: function( event, ui ) {
	    				$sliderValue.text( ui.value );
	    			},
	    			change: function( event, ui ) {
	    				$valueInput.val( ui.value );
	    				$valueInput.trigger( 'change' );
	    			}
    			});

			}
		};
	}

	/* -------------------------------------------------------------------------
		SWITCH
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPostMetafieldSwitch ) {
		$.fn.lsvrPostMetafieldSwitch = function() {

			var $this = $(this),
				$valueInput = $this.find( '.lsvr-post-metafield-switch__value' ),
				$checkbox = $this.find( 'input[type=checkbox]' );

			$checkbox.on( 'change', function() {

				if ( $(this).is( ':checked' ) ) {
					$valueInput.val( 'true' );
				} else {
					$valueInput.val( 'false' );
				}
				$valueInput.trigger( 'change' );

			});

		};
	}

	/* -------------------------------------------------------------------------
		TAXONOMY
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrPostMetafieldTaxonomy ) {
		$.fn.lsvrPostMetafieldTaxonomy = function() {

			var $this = $(this),
				$valueInput = $this.find( '.lsvr-post-metafield-taxonomy__value' ),
				$termSelect = $this.find( '.lsvr-post-metafield-taxonomy__select' ),
				taxonomySlug = $this.find( '.lsvr-post-metafield-taxonomy__slug' ).val();

			$termSelect.on( 'change', function() {

				if ( $(this).val() !== 'false' ) {
					$valueInput.val( taxonomySlug + ',' + $(this).val() );
				} else {
					$valueInput.val( taxonomySlug + ',false' );
				}

			});

		};
	}

})(jQuery);