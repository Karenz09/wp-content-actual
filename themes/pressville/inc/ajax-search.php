<?php

// Ajax search
add_action( 'wp_ajax_nopriv_lsvr-pressville-ajax-search', 'lsvr_pressville_ajax_search' );
add_action( 'wp_ajax_lsvr-pressville-ajax-search', 'lsvr_pressville_ajax_search' );
if ( ! function_exists( 'lsvr_pressville_ajax_search' ) ) {
	function lsvr_pressville_ajax_search() {

		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'lsvr-pressville-ajax-search-nonce' ) ) {
			die ( esc_html__( 'You do not have permission to search', 'pressville' ) );
		}

		// Get search query
		if ( isset( $_POST['search_query'] ) && ! empty( $_POST['search_query'] ) ) {
			$search_query = sanitize_text_field( $_POST['search_query'] );
		} else {
			$search_query = '';
		}

		// Get post type
		if ( isset( $_POST['post_type'] ) && ! empty( $_POST['post_type'] ) ) {
			$post_type = array_filter( array_map( 'sanitize_key', explode( ',', $_POST['post_type'] ) ) );
		} else {
			$post_type = 'any';
		}

		if ( ! empty( $search_query ) ) {

			// Search query args
			$args = array(
				'posts_per_page' => (int) get_theme_mod( 'header_search_ajax_results_limit', 5 ) + 1,
				'post_type' => $post_type,
				's' => $search_query,
				'suppress_filters' => false,
			);

			// Do search query
			$search_results = get_posts( $args );

			// If has results
			if ( ! empty( $search_results ) ) {

				$search_results_sliced = array_slice( $search_results, 0, get_theme_mod( 'header_search_ajax_results_limit', 15 ) );
				$search_results_parsed = [];
				foreach ( $search_results_sliced as $result ) {

					$result_details = array(
						'ID' => $result->ID,
						'post_title' => $result->post_title,
						'permalink' => get_permalink( $result->ID ),
						'post_type' => $result->post_type,
						'icon_class' => lsvr_pressville_get_post_type_icon_class( $result->post_type ),
					);

					// If post is a bbPress reply CPT, we need to get title of its parent topic
					if ( function_exists( 'bbp_get_reply_topic_title' ) && 'reply' === $result->post_type ) {
						$topic_title = bbp_get_reply_topic_title( $result->ID );
						$result_details['post_title'] = sprintf( esc_html__( 'Reply To: %s', 'pressville' ), $topic_title );
					}

					$search_results_parsed[] = $result_details;

				}

				// Prepare array with search results
				if ( ! empty( $search_results_parsed ) ) {

					$response = array(
	        			'status' => 'ok',
	        			'results' => $search_results_parsed,
	        			'list_title' => esc_html__( 'Search results', 'pressville' ),
	    			);

					// Add "more link" to response if needed
	    			if ( count( $search_results ) > get_theme_mod( 'header_search_ajax_results_limit', 15 ) ) {
	    				$response['more_label'] =  esc_html__( 'Show all results', 'pressville' );
	    				$response['more_link'] = esc_url( add_query_arg( array(
	    					's' => $search_query,
	    					'lsvr-search-filter-serialized' => implode( ',', $post_type ),
						), home_url( '/' ) ) );
	    			}

				}

				// No results
				else {
					$response = array(
	        			'status' => 'noresults',
        				'message' => esc_html__( 'Sorry, no results were found', 'pressville' ),
	    			);
				}

    			// echo JSON response
				echo json_encode( $response );

			}

			// If no results
			else {

				echo json_encode(array(
        			'status' => 'noresults',
        			'message' => esc_html__( 'Sorry, no results were found', 'pressville' ),
    			));

			}

		}

		wp_die();

	}
}

?>