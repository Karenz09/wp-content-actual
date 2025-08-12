<?php
/**
 * Get location latitude and longitude from address and save them into meta.
 */
add_action( 'save_post', 'lsvr_directory_geocode_listing', 100 );
if ( ! function_exists( 'lsvr_directory_geocode_listing' ) ) {
	function lsvr_directory_geocode_listing( $post_id ) {

		$post_type = get_post_type( $post_id );

		if ( 'lsvr_listing' === $post_type && lsvr_directory_has_maps_provider() ) {

			// Get locating method
			$locating_method = get_post_meta( $post_id, 'lsvr_listing_map_locating_method', true );

			// Get accurate address from meta
			$accurate_address = get_post_meta( $post_id, 'lsvr_listing_accurate_address', true );

			// Proceed only if locating method is set to 'address' and accurate address is not blank
			if ( 'address' === $locating_method && ! empty( $accurate_address ) ) {

				// Get last geocoded accurate address from meta
				$accurate_address_geocoded = get_post_meta( $post_id, 'lsvr_listing_accurate_address_geocoded', true );

				// Get geocoded latitude and longitude
				$latlong_geocoded = get_post_meta( $post_id, 'lsvr_listing_latlong_geocoded', true );

				// Make sure the address changed from the last geocoding request to avoid unnecessary request
				// or if geocoded latitude and longitude are blank
				if ( ( $accurate_address !== $accurate_address_geocoded ) || empty( $latlong_geocoded ) ) {

					// Prepare query URL for Google Maps
					if ( 'gmaps' === lsvr_directory_get_maps_provider() ) {
						$query_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode( esc_attr( $accurate_address ) ) . '&key=' . esc_attr( get_theme_mod( 'google_api_key', '' ) );
					}

					// Prepare query URL for Mapbox
					elseif ( 'mapbox' === lsvr_directory_get_maps_provider() ) {
						$query_url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' . urlencode( esc_attr( $accurate_address ) ) . '.json?autocomplete=false&limit=1&access_token=' . esc_attr( get_theme_mod( 'mapbox_api_key', '' ) );
					}

					// Prepare query URL for Open Street Map
					elseif ( 'osm' === lsvr_directory_get_maps_provider() ) {
						$query_url = 'https://nominatim.openstreetmap.org/search/?q=' . urlencode( esc_attr( $accurate_address ) ) . '&format=json&limit=1';
					}

					// Error message
					else {
						set_transient( 'lsvr_directory_geocode_error_message', array( esc_html( 'No valid maps provider chosen or missing API key.', 'lsvr-directory' ) ), 45 );
						return false;
					}

					// Make request
					sleep(1);
					$response = wp_remote_get( esc_url_raw( $query_url ) );

					// Check for errors
					if ( is_wp_error( $response ) ) {

						$error_messages_arr = array();

						foreach ( $response->get_error_messages( $code ) as $error ) {
							array_push( $error_messages_arr, $error );
						}

						set_transient( 'lsvr_directory_geocode_error_message', $error_messages_arr, 45 );

						return false;

					}

					// If no errors, proceed to response parsing
					else {

						// Parse Google Maps response
						if ( 'gmaps' === lsvr_directory_get_maps_provider() && is_array( $response ) && ! empty( $response['body'] ) ) {

							$response = json_decode( $response['body'] );

							// Check for data
							if ( is_object( $response ) && property_exists( $response, 'results' ) ) {

								$results = $response->results;
								$results = is_array( $results ) ? reset( $results ) : $results;

								// Check for data
								if ( ! empty( $results->geometry->location->lat ) && ! empty( $results->geometry->location->lng ) ) {

									$latitude_geocoded = $results->geometry->location->lat;
									$longitude_geocoded = $results->geometry->location->lng;

								}

							}

							// Error message
							if ( is_object( $response ) && property_exists( $response, 'error_message' ) ) {
								set_transient( 'lsvr_directory_geocode_error_message', $response->error_message, 45 );
							}

						}

						// Parse Mapbox response
						elseif ( 'mapbox' === lsvr_directory_get_maps_provider() && is_array( $response ) && ! empty( $response['body'] ) ) {

							$response = json_decode( $response['body'] );

							if ( is_object( $response ) && property_exists( $response, 'features' ) ) {

								$results = $response->features;
								$results = is_array( $results ) ? reset( $results ) : $results;

								// Check for data
								if ( ! empty( $results->geometry->coordinates ) && is_array( $results->geometry->coordinates ) ) {

									$latitude_geocoded = $results->geometry->coordinates[1];
									$longitude_geocoded = $results->geometry->coordinates[0];

								}

							}

						}

						// Parse Open Street Map response
						elseif ( 'osm' === lsvr_directory_get_maps_provider() && is_array( $response ) && ! empty( $response['body'] ) ) {

							$response = json_decode( $response['body'] );
							$results = is_array( $response ) ? reset( $response ) : $response;

							// Check for data
							if ( is_object( $results ) && ! empty( $results->lat ) && ! empty( $results->lon ) ) {

								$latitude_geocoded = $results->lat;
								$longitude_geocoded = $results->lon;

							}

						}

						// Throw error
						else {
							set_transient( 'lsvr_directory_geocode_error_message', array( esc_html( 'No data retrieved', 'lsvr-directory' ) ), 45 );
						}

					}

					// If geocoded latitude and longitude are retrieved, save them into meta
					if ( ! empty( $latitude_geocoded ) && ! empty( $longitude_geocoded ) ) {

						// Save geocoded latitude & longitude
						if ( ! empty( get_post_meta( $post_id, 'lsvr_listing_latlong_geocoded' ) ) ) {
							update_post_meta( $post_id, 'lsvr_listing_latlong_geocoded', sanitize_text_field( $latitude_geocoded . ', ' . $longitude_geocoded ) );
						} else {
							add_post_meta( $post_id, 'lsvr_listing_latlong_geocoded', sanitize_text_field( $latitude_geocoded . ', ' . $longitude_geocoded ), true );
						}

						// Copy the accurate_address into accurate_address_geocoded meta to prevent unnecesarry request
						// if the listing will be saved without address changing in the future
						if ( ! empty( get_post_meta( $post_id, 'lsvr_listing_accurate_address_geocoded' ) ) ) {
							update_post_meta( $post_id, 'lsvr_listing_accurate_address_geocoded', sanitize_text_field( $accurate_address ) );
						} else {
							add_post_meta( $post_id, 'lsvr_listing_accurate_address_geocoded', sanitize_text_field( $accurate_address ), true );
						}

					}

					// Error message
					else {
						set_transient( 'lsvr_directory_geocode_error_message', array( esc_html( 'No data retrieved', 'lsvr-directory' ) ), 45 );
					}


				}

			}

			// If locating method is not set to 'address' or accurate address is blank, remove geocoded meta values
			else {
				delete_post_meta( $post_id, 'lsvr_listing_latlong_geocoded' );
				delete_post_meta( $post_id, 'lsvr_listing_accurate_address_geocoded' );
			}

		}

	}
}

// Error message
add_action( 'admin_notices', 'lsvr_directory_geocode_error_message' );
if ( ! function_exists( 'lsvr_directory_geocode_error_message' ) ) {
	function lsvr_directory_geocode_error_message() {

		$error_message_arr = get_transient( 'lsvr_directory_geocode_error_message' );

		if ( ! empty( $error_message_arr ) ) {

			$class = 'notice notice-error';
			$title = esc_html__( 'Geocoding request failed', 'lsvr-directory' );
			$message_html = implode( '<br>', $error_message_arr );

			printf( '<div class="%1$s"><p><strong>' . $title . '</strong><br>%2$s</p></div>', esc_attr( $class ), wp_kses( $message_html, array( 'br' => array() ) ) );

			delete_transient( 'lsvr_directory_geocode_error_message' );

		}

	}
}

?>