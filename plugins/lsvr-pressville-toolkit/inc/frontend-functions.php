<?php

// Post categories
if ( ! function_exists( 'lsvr_pressville_toolkit_the_post_categories' ) ) {
	function lsvr_pressville_toolkit_the_post_categories( $post_id, $taxonomy, $template = '%s', $separator = ', ', $limit = 0 ) {

		$terms = wp_get_post_terms( $post_id, $taxonomy );
		$terms_parsed = array();
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				array_push( $terms_parsed, '<a href="' . esc_url( get_term_link( $term->term_id, $taxonomy ) ) . '" class="post__category-link">' . esc_html( $term->name ) . '</a>' );
			}
			if ( $limit > 0 && count( $terms_parsed ) > $limit ) {
				$terms_parsed = array_slice( $terms_parsed, 0, $limit );
			}
		}

		if ( ! empty( $terms_parsed ) ) { ?>

			<span class="post__categories">
				<?php echo sprintf( $template, implode( ', ', $terms_parsed ) ); ?>
			</span>

		<?php }

	}
}

// Listing address
if ( ! function_exists( 'lsvr_pressville_toolkit_the_listing_address' ) ) {
	function lsvr_pressville_toolkit_the_listing_address( $post_id, $nl2br = true ) {

		$location_address = lsvr_pressville_toolkit_get_listing_address( $post_id );
		if ( ! empty( $location_address ) ) {
			echo true === $nl2br ? nl2br( esc_html( $location_address ) ) : esc_html( $location_address );
		}

	}
}

// Event post class
if ( ! function_exists( 'lsvr_pressville_toolkit_the_event_post_class' ) ) {
	function lsvr_pressville_toolkit_the_event_post_class( $post_id, $class = '' ) {

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

// Event archive time
if ( ! function_exists( 'lsvr_pressville_toolkit_the_event_archive_time' ) ) {
	function lsvr_pressville_toolkit_the_event_archive_time( $occurrence, $template = '%s - %s' ) {

		if ( ! empty( $occurrence['allday'] ) && true === $occurrence['allday'] ) {
			esc_html_e( 'All-day event', 'lsvr-pressville-toolkit' );
		}
		else if ( ! empty( $occurrence['postid'] ) && lsvr_pressville_toolkit_has_event_end_time( $occurrence['postid'] ) ) {
			echo sprintf( $template,
				date_i18n( get_option( 'time_format' ), strtotime( $occurrence['start'] ) ),
				date_i18n( get_option( 'time_format' ), strtotime( $occurrence['end'] ) )
			);
		}
		else {
			echo esc_html( date_i18n( get_option( 'time_format' ), strtotime( $occurrence['start'] ) ) );
		}

	}
}

// Event location linked
if ( ! function_exists( 'lsvr_pressville_toolkit_the_event_location_linked' ) ) {
	function lsvr_pressville_toolkit_the_event_location_linked( $post_id, $template = '%s' ) {

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


?>