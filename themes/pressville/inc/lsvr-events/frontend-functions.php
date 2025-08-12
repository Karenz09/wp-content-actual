<?php

// Event archive grid begin
if ( ! function_exists( 'lsvr_pressville_the_event_post_archive_grid_begin' ) ) {
	function lsvr_pressville_the_event_post_archive_grid_begin( $event_occurrence, $i ) {

		global $lsvr_pressville_event_archive_group_date;
		$lsvr_pressville_event_archive_group_date = empty( $lsvr_pressville_event_archive_group_date ) ? false : $lsvr_pressville_event_archive_group_date;

		// No date grouping
		if ( false === get_theme_mod( 'lsvr_event_archive_group_enable', true ) && $i === 1 ) {
			echo '<div class="' . lsvr_pressville_get_event_post_archive_grid_class() . '">';
		}

		// Date grouping
		elseif ( true === get_theme_mod( 'lsvr_event_archive_group_enable', true ) &&
			$lsvr_pressville_event_archive_group_date !== date_i18n( 'Y-m', strtotime( $event_occurrence['start'] ) ) ) {

			$lsvr_pressville_event_archive_group_date = date_i18n( 'Y-m', strtotime( $event_occurrence['start'] ) );
			if ( $i > 1 ) {
				echo '</div>';
			}

			echo '<h2 class="post-archive__date">' . esc_html( date_i18n( 'F Y', strtotime( $event_occurrence['start'] ) ) ) . '</h2><div class="' . lsvr_pressville_get_event_post_archive_grid_class() . '">';

		}

	}
}

// Event archive grid end
if ( ! function_exists( 'lsvr_pressville_the_event_post_archive_grid_end' ) ) {
	function lsvr_pressville_the_event_post_archive_grid_end( $i, $count ) {

		if ( $i === $count ) {
			echo '</div>';
		}

	}
}

// Event archive grid column class
if ( ! function_exists( 'lsvr_pressville_the_event_post_archive_grid_column_class' ) ) {
	function lsvr_pressville_the_event_post_archive_grid_column_class() {

		$number_of_columns = ! empty( get_theme_mod( 'lsvr_event_archive_grid_columns', 3 ) ) ? (int) get_theme_mod( 'lsvr_event_archive_grid_columns', 3 ) : 3;
		$span = 12 / $number_of_columns;

		// Get medium span class
		$span_md_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--md-span-6' : '';

		// Get small span class
		$span_sm_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--sm-span-6' : '';

		echo 'lsvr-grid__col lsvr-grid__col--span-' . esc_attr( $span . $span_md_class . $span_sm_class );

	}
}

// Event post class
if ( ! function_exists( 'lsvr_pressville_the_event_post_class' ) ) {
	function lsvr_pressville_the_event_post_class( $post_id, $class = '' ) {

		$classes = [ 'post', 'lsvr_event', 'post-' . $post_id ];

		if ( has_post_thumbnail( $post_id ) ) {
			array_push( $classes, 'has-post-thumbnail' );
		}

		if ( ! empty( $class ) ) {
			array_push( $classes, $class );
		}

		echo ' class="' . esc_attr( implode( ' ', $classes ) ) . '"';

	}
}

// Event post background thumbnail
if ( ! function_exists( 'lsvr_pressville_the_event_post_archive_background_thumbnail' ) ) {
	function lsvr_pressville_the_event_post_archive_background_thumbnail( $post_id ) {

		if ( has_post_thumbnail( $post_id ) ) {
			$thumb_size = (int) get_theme_mod( 'lsvr_event_archive_grid_columns', 3 ) < 4 ? 'large' : 'medium';
			echo ' style="background-image: url( \'' . esc_url( get_the_post_thumbnail_url( $post_id, $thumb_size ) ) . '\' );"';
		}

	}
}

// Event start date
if ( ! function_exists( 'lsvr_pressville_the_event_start_date' ) ) {
	function lsvr_pressville_the_event_start_date( $post_id ) {

		// Recurring event
		if ( lsvr_pressville_is_recurring_event( $post_id ) && lsvr_pressville_has_next_event_occurrences( $post_id ) ) {
			$next_occurrence = lsvr_pressville_get_next_event_occurrences( $post_id, 1 );
			if ( ! empty( $next_occurrence[0]['start'] ) ) {
				$start_date =$next_occurrence[0]['start'];
			}
		}

		// Ended recurring event
		else if ( lsvr_pressville_is_recurring_event( $post_id ) ) {
			$last_occurrence = lsvr_pressville_get_recent_event_occurrences( $post_id, 1 );
			if ( ! empty( $last_occurrence[0]['start'] ) ) {
				$start_date = $last_occurrence[0]['start'];
			}
		}

		// Standard event
		else {
			$start_date = get_date_from_gmt( get_post_meta( $post_id, 'lsvr_event_start_date_utc', true ) );
		}

		echo ! empty( $start_date ) ? esc_html( date_i18n( get_option( 'date_format' ), strtotime( $start_date ) ) ) : '';


	}
}

// Event end date
if ( ! function_exists( 'lsvr_pressville_the_event_end_date' ) ) {
	function lsvr_pressville_the_event_end_date( $post_id ) {

		// Recurring event
		if ( lsvr_pressville_is_recurring_event( $post_id ) && lsvr_pressville_has_next_event_occurrences( $post_id ) ) {
			$next_occurrence = lsvr_pressville_get_next_event_occurrences( $post_id, 1 );
			if ( ! empty( $next_occurrence[0]['end'] ) ) {
				$end_date = $next_occurrence[0]['end'];
			}
		}

		// Ended recurring event
		else if ( lsvr_pressville_is_recurring_event( $post_id ) ) {
			$last_occurrence = lsvr_pressville_get_recent_event_occurrences( $post_id, 1 );
			if ( ! empty( $last_occurrence[0]['end'] ) ) {
				$end_date = $last_occurrence[0]['end'];
			}
		}

		// Standard event
		else {
			$end_date = get_date_from_gmt( get_post_meta( $post_id, 'lsvr_event_end_date_utc', true ) );
		}

		echo ! empty( $end_date ) ? esc_html( date_i18n( get_option( 'date_format' ), strtotime( $end_date ) ) ) : '';

	}
}

// Event start time
if ( ! function_exists( 'lsvr_pressville_the_event_start_time' ) ) {
	function lsvr_pressville_the_event_start_time( $post_id , $template = '%s' ) {
		if ( function_exists( 'lsvr_events_get_event_local_start_time' ) ) {

			echo sprintf( $template, lsvr_events_get_event_local_start_time( $post_id ) );

		}
	}
}

// Event end time
if ( ! function_exists( 'lsvr_pressville_the_event_end_time' ) ) {
	function lsvr_pressville_the_event_end_time( $post_id, $template = '%s' ) {
		if ( function_exists( 'lsvr_events_get_event_local_end_time' ) ) {

			echo sprintf( $template, lsvr_events_get_event_local_end_time( $post_id ) );

		}
	}
}

// Event time
if ( ! function_exists( 'lsvr_pressville_the_event_time' ) ) {
	function lsvr_pressville_the_event_time( $post_id, $template = '%s - %s' ) {
		if ( function_exists( 'lsvr_events_get_event_local_start_time' ) &&
			function_exists( 'lsvr_events_get_event_local_end_time' ) ) {

			$allday_event = 'true' === get_post_meta( $post_id, 'lsvr_event_allday', true ) ? true : false;
			$endtime_enable = 'true' === get_post_meta( $post_id, 'lsvr_event_end_time_enable', true ) ? true : false;

			// All-day
			if ( true === $allday_event ) {
				esc_html_e( 'All-day event', 'pressville' );
			}

			// Display both start and end
			else if ( true === $endtime_enable ) {

				echo sprintf( $template,
					lsvr_events_get_event_local_start_time( $post_id ),
	                lsvr_events_get_event_local_end_time( $post_id )
				);

			}

			// Do not display end time
			else {
				echo lsvr_events_get_event_local_start_time( $post_id );
			}

		}
	}
}

// Event archive time
if ( ! function_exists( 'lsvr_pressville_the_event_archive_time' ) ) {
	function lsvr_pressville_the_event_archive_time( $occurrence, $template = '%s - %s' ) {
		if ( function_exists( 'lsvr_events_get_event_local_start_time' ) &&
			function_exists( 'lsvr_events_get_event_local_end_time' ) ) {

			if ( ! empty( $occurrence['allday'] ) && true === $occurrence['allday'] ) {
				esc_html_e( 'All-day event', 'pressville' );
			}
			else if ( ! empty( $occurrence['postid'] ) && lsvr_pressville_has_event_end_time( $occurrence['postid'] ) ) {
				echo sprintf( $template,
					lsvr_events_get_event_local_start_time( $occurrence['postid'] ),
	                lsvr_events_get_event_local_end_time( $occurrence['postid'] )
				);
			}
			else {
				echo lsvr_events_get_event_local_start_time( $occurrence['postid'] );
			}

		}
	}
}

// Event location linked
if ( ! function_exists( 'lsvr_pressville_the_event_location_linked' ) ) {
	function lsvr_pressville_the_event_location_linked( $post_id, $template = '%s' ) {

		$event_location_term = wp_get_post_terms( $post_id, 'lsvr_event_location' );
		if ( ! empty( $event_location_term[0]->term_id ) ) {

			// Get location term ID
			$location_term_id = $event_location_term[0]->term_id;

			// Get term data
			$location_data = get_term( $location_term_id, 'lsvr_event_location' );
			$location_permalink = get_term_link( $location_term_id, 'lsvr_event_location' );

			if ( ! empty( $location_data->name ) ) {
				echo sprintf( $template, '<a href="' . esc_attr( $location_permalink ) . '" class="post__location-link">' . esc_html( $location_data->name ) . '</a>' );
			}

		}

	}
}

// Event location address
if ( ! function_exists( 'lsvr_pressville_the_event_location_address' ) ) {
	function lsvr_pressville_the_event_location_address( $post_id, $nl2br = true ) {

		$location_address = lsvr_pressville_get_event_location_address( $post_id );
		if ( ! empty( $location_address ) ) {
			echo true === $nl2br ? nl2br( esc_html( $location_address ) ) : esc_html( $location_address );
		}

	}
}

?>