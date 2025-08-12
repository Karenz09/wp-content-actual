<?php
/**
 * Get event location latitude and longitude from address and save them into meta.
 */
add_action( 'create_lsvr_event_location', 'lsvr_events_geocode_event_location', 100 );
add_action( 'edited_lsvr_event_location', 'lsvr_events_geocode_event_location', 100 );
if ( ! function_exists( 'lsvr_events_geocode_event_location' ) ) {
	function lsvr_events_geocode_event_location( $term_id ) {

		if ( ! empty( $term_id  ) && lsvr_events_has_maps_provider() ) {

			// Get term meta
			$term_meta = get_option( 'lsvr_event_location_term_' . (int) $term_id . '_meta' );

			// Get accurate address from meta
			$accurate_address = ! empty( $term_meta['accurate_address'] ) ? $term_meta['accurate_address'] : false;

			// Get latitude and longitude from meta
			$latlong = ! empty( $term_meta['latlong'] ) ? array_map( 'trim', explode( ',', $term_meta['latlong'] ) ) : false;
			$latlong = ! empty( $latlong ) && 2 === count( $latlong ) ? $latlong : false;

			// Proceed only if accurate address is not blank and latitude and longitude field is either blank or in bad format
			if ( ! empty( $accurate_address ) && empty( $latlong ) ) {

				// Get last geocoded accurate address from meta
				$accurate_address_geocoded = ! empty( $term_meta['accurate_address_geocoded'] ) ? $term_meta['accurate_address_geocoded'] : false;

				// Get geocoded latitude and longitude
				$latlong_geocoded = ! empty( $term_meta['latlong_geocoded'] ) ? $term_meta['latlong_geocoded'] : false;

				// Make sure the address changed from the last geocoding request to avoid unnecessary request
				// or if geocoded latitude and longitude are blank
				if ( ( $accurate_address !== $accurate_address_geocoded ) || empty( $latlong_geocoded ) ) {

					// Prepare query URL for Google Maps
					if ( 'gmaps' === lsvr_events_get_maps_provider() ) {
						$query_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode( esc_attr( $accurate_address ) ) . '&key=' . esc_attr( get_theme_mod( 'google_api_key', '' ) );
					}

					// Prepare query URL for Mapbox
					elseif ( 'mapbox' === lsvr_events_get_maps_provider() ) {
						$query_url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/' . urlencode( esc_attr( $accurate_address ) ) . '.json?autocomplete=false&limit=1&access_token=' . esc_attr( get_theme_mod( 'mapbox_api_key', '' ) );
					}

					// Prepare query URL for Open Street Map
					elseif ( 'osm' === lsvr_events_get_maps_provider() ) {
						$query_url = 'https://nominatim.openstreetmap.org/search/?q=' . urlencode( esc_attr( $accurate_address ) ) . '&format=json&limit=1';
					}

					// Error message
					else {
						set_transient( 'lsvr_events_geocode_error_message', array( esc_html( 'No valid maps provider chosen or missing API key.', 'lsvr-events' ) ), 45 );
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

						set_transient( 'lsvr_events_geocode_error_message', $error_messages_arr, 45 );

						return false;

					}

					// If no errors, proceed to response parsing
					else {

						// Parse Google Maps response
						if ( 'gmaps' === lsvr_events_get_maps_provider() && is_array( $response ) && ! empty( $response['body'] ) ) {

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
								set_transient( 'lsvr_events_geocode_error_message', $response->error_message, 45 );
							}

						}

						// Parse Mapbox response
						elseif ( 'mapbox' === lsvr_events_get_maps_provider() && is_array( $response ) && ! empty( $response['body'] ) ) {

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
						elseif ( 'osm' === lsvr_events_get_maps_provider() && is_array( $response ) && ! empty( $response['body'] ) ) {

							$response = json_decode( $response['body'] );
							$results = is_array( $response ) ? reset( $response ) : $response;

							// Check for data
							if ( is_object( $results ) && ! empty( $results->lat ) && ! empty( $results->lon ) ) {

								$latitude_geocoded = $results->lat;
								$longitude_geocoded = $results->lon;

							}

						}

					}

					// If geocoded latitude and longitude are retrieved, save them into meta
					if ( ! empty( $latitude_geocoded ) && ! empty( $longitude_geocoded ) ) {

						// Save geocoded latitude & longitude to term meta var
						$term_meta['latlong_geocoded'] = sanitize_text_field( $latitude_geocoded . ', ' . $longitude_geocoded );

						// Copy the accurate_address into accurate_address_geocoded meta var to prevent unnecesarry request
						// if the listing will be saved without address changing in the future
						$term_meta['accurate_address_geocoded'] = sanitize_text_field( $accurate_address );

					}

					// Error message
					else {
						set_transient( 'lsvr_events_geocode_error_message', array( esc_html( 'No data retrieved', 'lsvr-events' ) ), 45 );
					}

				}

			}

			// If locating method is not set to 'address' or accurate address is blank, remove geocoded meta values from meta
			else {

				if ( is_array( $term_meta ) && array_key_exists( 'latlong_geocoded', $term_meta ) ) {
					unset( $term_meta['latlong_geocoded'] );
				}
				if ( is_array( $term_meta ) && array_key_exists( 'accurate_address_geocoded', $term_meta ) ) {
					unset( $term_meta['accurate_address_geocoded'] );
				}

			}

			// Save meta to options table
			if ( ! empty( $term_meta ) ) {
				update_option( 'lsvr_event_location_term_' . (int) $term_id . '_meta', $term_meta );
			}

		}

	}
}

// Error message
add_action( 'admin_notices', 'lsvr_events_geocode_error_message' );
if ( ! function_exists( 'lsvr_events_geocode_error_message' ) ) {
	function lsvr_events_geocode_error_message() {

		$error_message_arr = get_transient( 'lsvr_events_geocode_error_message' );

		if ( ! empty( $error_message_arr ) ) {

			$class = 'notice notice-error';
			$title = esc_html__( 'Geocoding request failed', 'lsvr-events' );
			$message_html = implode( '<br>', $error_message_arr );

			printf( '<div class="%1$s"><p><strong>' . $title . '</strong><br>%2$s</p></div>', esc_attr( $class ), wp_kses( $message_html, array( 'br' => array() ) ) );

			delete_transient( 'lsvr_events_geocode_error_message' );

		}

	}
}

?>