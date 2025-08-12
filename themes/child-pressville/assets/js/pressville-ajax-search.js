(function($){ "use strict";
$(document).ready(function(){

	// Trigger search
	$( '.header-search--ajaxed .header-search__form' ).each(function(){

		var $form = $(this),
			$input = $form.find( '.header-search__input' ),
			$filter = $form.find( '.header-search__filter' ),
			$langInput = $form.find( '.header-search__lang-input' ),
			searchQuery = '',
			postType,
			postTypeArr = [],
			lang;

		// Post type filter
		$filter.find( 'input:checked' ).each(function(){
			postTypeArr.push( $(this).val() );
		});
		postType = postTypeArr.length < 1 ? 'any' : postTypeArr.join();
		postTypeArr = [];

		// Set language
		lang = $langInput.length ? $langInput.val() : false;

		// Change, keyup & paste events
		$input.on( 'change keyup paste', function(e){

			var newSearchQuery = $(this).val();
			if ( ( newSearchQuery !== searchQuery ) && ! ( 38 === e.which || 40 === e.which || 13 === e.which ) ) {
				searchQuery = newSearchQuery.trim();
				lsvrPressvilleAjaxSearchGetResults( $form, postType, searchQuery, lang );
			}

		});

		// Focus event
		$input.on( 'focus', function(e){

			var newSearchQuery = $(this).val();

			// Show already existing but hidden search results
			if ( ( newSearchQuery === searchQuery ) && $form.find( '.header-search__results' ).length > 0 ) {
				$form.find( '.header-search__results' ).slideDown( 300 );
			}
			// If there are no results, send request
			else {
				searchQuery = newSearchQuery.trim();
				lsvrPressvilleAjaxSearchGetResults( $form, postType, searchQuery, lang );
			}

		});

		// Change post type filter
		$filter.find( 'input[type="checkbox"]' ).on( 'change', function(){

			$filter.find( 'input:checked' ).each(function(){
				postTypeArr.push( $(this).val() );
			});
			postType = postTypeArr.length < 1 ? 'any' : postTypeArr.join();
			postTypeArr = [];

			lsvrPressvilleAjaxSearchGetResults( $form, postType, searchQuery, lang );

		});

		// Keyboard navigation
		$input.on( 'keydown', function(e) {

			var $searchResults = $form.find( '.header-search__results' ),
				$active = $searchResults.find( '.header-search__results-item--active' );

			// Arrow down
			if ( 40 === e.which ) {

				if ( $active.length < 1 || $active.filter( ':last-child' ).length ) {
					$active.removeClass( 'header-search__results-item--active' );
					$searchResults.find( '.header-search__results-item:first-child' ).addClass( 'header-search__results-item--active' );
				}
				else {
					$active.removeClass( 'header-search__results-item--active' );
					$active.next().addClass( 'header-search__results-item--active' );
				}

				e.preventDefault();
                e.stopPropagation();

			}

			// Arrow up
			if ( 38 === e.which ) {

				if ( $active.length < 1 || $active.filter( ':first-child' ).length ) {
					$active.removeClass( 'header-search__results-item--active' );
					$searchResults.find( '.header-search__results-item:last-child' ).addClass( 'header-search__results-item--active' );
				}
				else {
					$active.removeClass( 'header-search__results-item--active' );
					$active.prev().addClass( 'header-search__results-item--active' );
				}

				e.preventDefault();
                e.stopPropagation();

			}

			// Enter
			if ( 13 === e.which ) {

				if ( $active.length ) {
					window.location.href = $active.find( 'a' ).attr( 'href' );
					e.preventDefault();
                	e.stopPropagation();
				}

			}

		});

	});

	// Get search results
	var lsvrPressvilleAjaxRequest = null;
	function lsvrPressvilleAjaxSearchGetResults( $form, postType, searchQuery, lang ) {

		var searchQuery = searchQuery.trim();
		var lang = lang !== false ? '&lang=' + lang : '';

		// Check minimum search query length
		if ( searchQuery.length > 1 ) {

			// Delay before sending request
			clearTimeout( $form.data( 'ajax-search-timer' ) );
			$form.data( 'ajax-search-timer', setTimeout( function(){

				$form.addClass( 'header-search__form--loading' );
				$form.find( '.header-search__spinner' ).fadeIn( 150 );

		        // Ajax request
		        if ( null !== lsvrPressvilleAjaxRequest ) { lsvrPressvilleAjaxRequest.abort(); }
		        lsvrPressvilleAjaxRequest = jQuery.ajax({
		            type: 'post',
		            url: lsvr_pressville_ajax_search_var.url,
		            data: 'action=lsvr-pressville-ajax-search&nonce=' + lsvr_pressville_ajax_search_var.nonce + '&post_type=' + postType + '&search_query=' + searchQuery + lang,
		            success: function( response ){

		            	if ( '' !== response ) {

							var responseJson = false;

		            		// Parse JSON
		            		try {
								responseJson = JSON.parse( response );
							}

							// Invalid response
							catch(e) {
								console.log( 'Ajax Search Response: INVALID JSON' );
							}

							// Show results
							if ( responseJson ) {
								lsvrPressvilleAjaxSearchShowResults( $form, responseJson );
							}

		            	} else {
		            		console.log( 'Ajax Search Response: BLANK' );
		            	}

						$form.removeClass( 'header-search__form--loading' );
						$form.find( '.header-search__spinner' ).fadeOut( 150 );

		            },
		            error: function() {
		            	$form.removeClass( 'header-search__form--loading' );
		            	$form.find( '.header-search__spinner' ).fadeOut( 150 );
						console.log( 'Ajax Search Response: ERROR' );
		            }
		        });

	        }, 500 ));

		}

	}

	// Show search results
	function lsvrPressvilleAjaxSearchShowResults( $form, json ) {
		if ( json.hasOwnProperty( 'status' ) ) {

			var status = json.status,
				listTitle = json.hasOwnProperty( 'list_title' ) ? json.list_title : '',
				$input = $form.find( '.header-search__input' ),
				output = '';

			// If has results
			if ( 'ok' === status && json.hasOwnProperty( 'results' ) ) {

				$.each( json.results, function(){

					var rating = '';

					if ( this.hasOwnProperty( 'post_title' ) && this.hasOwnProperty( 'permalink' ) &&
						this.hasOwnProperty( 'post_type' ) && this.hasOwnProperty( 'icon_class' ) ) {

						output += '<li class="header-search__results-item">';
						output += '<span class="header-search__results-item-icon ' + this.icon_class + '" aria-hidden="true"></span>';
						output += '<a href="' + this.permalink + '" class="header-search__results-item-link">';
						output += this.post_title;
						output += '</a></li>';

					}

				});
				output = '<ul class="header-search__results-list" title="' + listTitle + '">' + output + '</ul>';

				// More link
				if ( json.hasOwnProperty( 'more_label' ) && json.hasOwnProperty( 'more_link' ) ) {
					output += '<p class="header-search__results-more">';
					output += '<a href="' + json.more_link + '" class="c-button c-button--small header-search__results-more-link">' + json.more_label + '</a></p>';
				}

			}

			// No results
			else if ( 'noresults' === status ) {
				var message = json.hasOwnProperty( 'message' ) ? json.message : '';
				if ( '' !== message ) {
					output = '<p class="header-search__results-message">' + message + '</p>';
				}
			}

			// Display results
			if ( '' !== output ) {

				if ( $form.find( '.header-search__results' ).length > 0 ) {
					$form.find( '.header-search__results' ).first().html( output );
				} else {
					$form.append( '<div class="header-search__results">' + output + '</div>' );
				}
				if ( $form.find( '.header-search__results' ).is( ':hidden' ) ) {
					$form.find( '.header-search__results' ).slideDown( 300 );
				}

			}

		}
	}

});
})(jQuery);