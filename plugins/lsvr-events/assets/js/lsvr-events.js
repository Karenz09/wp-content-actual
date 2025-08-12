(function($){ "use strict";
$(document).ready( function() {

/* -----------------------------------------------------------------------------

	WIDGETS

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		EVENTS CALENDAR
	-------------------------------------------------------------------------- */

	$( '.lsvr_event-calendar-widget' ).each(function() {

		var $this = $(this),
			$calendar = $this.find( '.lsvr_event-calendar-widget__calendar' ),
			$calendarTitleMonth = $this.find( '.lsvr_event-calendar-widget__calendar-title-month' ),
			$calendarTitleYear = $this.find( '.lsvr_event-calendar-widget__calendar-title-year' ),
			$dayList = $this.find( '.lsvr_event-calendar-widget__day-list' ),
			$prevBtn = $this.find( '.lsvr_event-calendar-widget__nav-btn--prev' ),
			$nextBtn = $this.find( '.lsvr_event-calendar-widget__nav-btn--next' ),
			instance = $calendar.data( 'instance-json' ) ? $calendar.data( 'instance-json' ) : false,
			monthNames = $calendar.data( 'month-names' ) ? $calendar.data( 'month-names' ) : [],
			year = $calendar.data( 'year' ) ? parseInt( $calendar.data( 'year' ) ) : new Date().getFullYear(),
			monthIndex = $calendar.data( 'month' ) ? parseInt( $calendar.data( 'month' ) ) - 1 : new Date().getMonth(),
			queryTimeout, ajaxParams = false, $temp;

		// Change month
		var changeMonth = function( year, month ) {

			// Prepare Ajax params
			ajaxParams = { 'instance' : instance, 'year' : year, 'month' : month };

			// Ajax request
	        if ( false !== ajaxParams && 'undefined' !== typeof lsvr_events_ajax_var ) {

	        	// Add loading
        		$calendar.addClass( 'lsvr_event-calendar-widget__calendar--loading' );

        		// Make request
	        	jQuery.ajax({
	            	type: 'post',
	            	dataType: 'HTML',
	            	url: lsvr_events_ajax_var.url,
	            	data: {
	            		action: 'lsvr-events-ajax-event-calendar-widget',
	            		nonce: encodeURIComponent( lsvr_events_ajax_var.nonce ),
	            		data: ajaxParams,
	            	},
	            	success: function( response ) {

	            		// Replace calendar
	            		$this.append( '<div class="lsvr_event-calendar-widget__calendar-ajax-temp" style="display: none;"></div>' );
	            		$temp = $this.find( '.lsvr_event-calendar-widget__calendar-ajax-temp');
	            		$temp.append( response );
	            		$dayList.replaceWith( $temp.find( '.lsvr_event-calendar-widget__day-list' ) );
	            		$temp.remove();
	            		$dayList = $this.find( '.lsvr_event-calendar-widget__day-list' ),

	        			// Remove loading
        				$calendar.removeClass( 'lsvr_event-calendar-widget__calendar--loading' );

	            	},
	            	error: function() {

	        			// Remove loading
        				$calendar.removeClass( 'lsvr_event-calendar-widget__calendar--loading' );

	            	}
	            });

	        }

		};

		// Previous month
		$prevBtn.on( 'click', function() {

    		if ( ! $calendar.hasClass( 'lsvr_event-calendar-widget__calendar--loading' ) ) {

				// Change current month
				monthIndex = ( monthIndex - 1 ) >= 0 ? monthIndex - 1 : 11;
				$calendarTitleMonth.text( monthNames[ monthIndex ] );

				// Change current year
				if ( 11 === monthIndex ) {
					year = year - 1;
					$calendarTitleYear.text( year );
				}

				// Change to previous month
				clearTimeout( queryTimeout );
				queryTimeout = setTimeout( function(){
					changeMonth( year, monthIndex + 1 );
				}, 800 );

			}

		});

		// Next month
		$nextBtn.on( 'click', function() {

			if ( ! $calendar.hasClass( 'lsvr_event-calendar-widget__calendar--loading' ) ) {

				// Change current month
				monthIndex = ( monthIndex + 1 ) < 12 ? monthIndex + 1 : 0;
				$calendarTitleMonth.text( monthNames[ monthIndex ] );

				// Change current year
				if ( 0 === monthIndex ) {
					year = year + 1;
					$calendarTitleYear.text( year );
				}

				// Change to next month
				clearTimeout( queryTimeout );
				queryTimeout = setTimeout( function(){
					changeMonth( year, monthIndex + 1 );
				}, 800 );

			}

		});

	});

	/* -------------------------------------------------------------------------
		EVENTS FILTER
	-------------------------------------------------------------------------- */

	$( '.lsvr_event-filter-widget' ).each(function() {

		var $this = $(this),
			$form = $this.find( '.lsvr_event-filter-widget__form' );

		// Datepicker
		if ( $.fn.datepicker ) {

			$this.find( '.lsvr_event-filter-widget__input--datepicker' ).each(function() {

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

	});

});
})(jQuery);