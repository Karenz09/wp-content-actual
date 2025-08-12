<?php
/**
 * Main function to retrieve directory listings.
 *
 * @param array $args {
 *		Optional. An array of arguments. If not defined, function will return all listings.
 *
 *		@type int|array		$listing_id		Single ID or array of IDs of lsvr_listing post(s).
 *											Only these listings will be returned.
 *											Leave blank to retrieve all lsvr_listing posts.
 *
 *		@type int			$limit			Max number of listings to retrieve.
 *
 *		@type int|array		$category		Category or categories from which to retrieve listings.
 *
 *		@type int|array		$tag			Tag taxonomy from which to retrieve listings.
 *
 *		@type string		$orderby		Set how to order listings.
 *											Accepts standard values for orderby argument in WordPress get_posts function.
 *
 *		@type string		$order			Set order of returned listings as ascending or descending.
 *											Default 'DESC'. Accepts 'ASC', 'DESC'.
 *
 *		@type bool			$return_meta	If enabled, important listing meta data will be returned as well.
 *											Default 'false'.
 *
 * }
 * @return array 	Array with all listing posts.
 */
if ( ! function_exists( 'lsvr_directory_get_listings' ) ) {
	function lsvr_directory_get_listings( $args = array() ) {

		$query_args = array(
			'suppress_filters' => false,
		);

		// Switch language
		if ( ! empty( $args['language'] ) ) {
			global $sitepress;
			if ( is_object( $sitepress ) && method_exists( $sitepress, 'switch_lang' ) ) {
				$sitepress->switch_lang( $args['language'] );
			}
		}

		// Listing ID
		if ( ! empty( $args['listing_id'] ) ) {
			if ( is_array( $args['listing_id'] ) ) {
				$listing_id = array_map( 'intval', $args['listing_id'] );
			} else {
				$listing_id = array_map( 'intval', explode( ',', $args['listing_id'] ) );
			}
			$query_args['post__in'] = $listing_id;
		}

		// Get number of listings
		if ( ! empty( $args['limit'] ) && is_numeric( $args['limit'] ) ) {
			$limit = (int) $args['limit'];
		} else {
			$limit = 1000;
		}
		$query_args['posts_per_page'] = $limit;

		// Get category tax query
		if ( ! empty( $args['category'] ) ) {

			if ( is_array( $args['category'] ) ) {
				$category = array_map( 'intval', $args['category'] );
			} else {
				$category = array( (int) $args['category'] );
			}
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'lsvr_listing_cat',
					'field' => 'term_id',
					'terms' => $category,
				),
			);

		}

		// Get tag tax query
		if ( ! empty( $args['tag'] ) ) {

			if ( is_array( $args['tag'] ) ) {
				$tag = array_map( 'intval', $args['tag'] );
			} else {
				$tag = array( (int) $args['tag'] );
			}
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'lsvr_listing_tag',
					'field' => 'term_id',
					'terms' => $tag,
				),
			);

		}

		// Get search query
		if ( ! empty( $args['keyword'] ) ) {
			$query_args['s'] = wp_strip_all_tags( $args['keyword'] );
		}

		// Get orderby of listings
		if ( ! empty( $args['orderby'] ) ) {
			$orderby = esc_attr( $args['orderby'] );
		} else {
			$orderby = 'date';
		}
		$query_args['orderby'] = $orderby;

		// Get order of listings
		$query_args['order'] = ! empty( $args['order'] ) && 'ASC' === strtoupper( $args['order'] ) ? 'ASC' : 'DESC';

		// Get listing posts
		$listing_posts = get_posts(
			array_merge( array( 'post_type' => 'lsvr_listing' ), $query_args )
		);

		// Add listing posts to $return
		if ( ! empty( $listing_posts ) ) {
			$return = array();
			foreach ( $listing_posts as $listing_post ) {
				if ( ! empty( $listing_post->ID ) ) {
					$return[ $listing_post->ID ]['post'] = $listing_post;
				}
			}
		}

		// Add meta to $return
		$return_meta = ! empty( $args['return_meta'] ) && true === $args['return_meta'] ? true : false;
		if ( ! empty( $return ) && is_array( $return ) && true === $return_meta ) {
			foreach ( array_keys( $return ) as $post_id ) {

				// Get listing link
				$return[ $post_id ]['permalink'] = esc_url( get_permalink( $post_id ) );

				// Get listing meta
				$return[ $post_id ]['meta'] = lsvr_directory_get_listing_meta( $post_id );

			}
		}

		// Return listings
		return ! empty( $return ) ? $return : false;

	}
}

/**
 * Retrieve listing meta data.
 *
 * @param int 		$listing_id		ID of a lsvr_listing post.
 *
 * @return array 					Array with important meta data of a listing posts.
 */
if ( ! function_exists( 'lsvr_directory_get_listing_meta' ) ) {
	function lsvr_directory_get_listing_meta( $listing_id ) {

		$return = array();

		// Get map locating method
		$listing_locating_method = get_post_meta( $listing_id, 'lsvr_listing_map_locating_method', true );
		if ( 'latlong' === $listing_locating_method || 'address' === $listing_locating_method ) {
			$return['locating_method'] = $listing_locating_method;
		} else {
			$return['locating_method'] = false;
		}

		// Get accurrate address from meta
		$listing_accurate_address = get_post_meta( $listing_id, 'lsvr_listing_accurate_address', true );
		if ( ! empty( $listing_accurate_address ) ) {
			$return['accurate_address'] = $listing_accurate_address;
		}

		// Get latitude and longitude from meta
		$listing_latlong = get_post_meta( $listing_id, 'lsvr_listing_latlong', true );
		$listing_latlong = ! empty( $listing_latlong ) ? explode( ',', $listing_latlong ) : false;
		$listing_latitude = ! empty( $listing_latlong[0] ) ? trim( $listing_latlong[0] ) : false;
		$listing_longitude = ! empty( $listing_latlong[1] ) ? trim( $listing_latlong[1] ) : false;
		if ( ! empty( $listing_latitude ) && ! empty( $listing_longitude ) ) {
			$return['latitude'] = $listing_latitude;
			$return['longitude'] = $listing_longitude;
		}

		// Get geocoded latitude and longitude from meta
		$listing_latlong_geocoded = get_post_meta( $listing_id, 'lsvr_listing_latlong_geocoded', true );
		$listing_latlong_geocoded = ! empty( $listing_latlong_geocoded ) ? explode( ',', $listing_latlong_geocoded ) : false;
		$listing_latitude_geocoded = ! empty( $listing_latlong_geocoded[0] ) ? trim( $listing_latlong_geocoded[0] ) : false;
		$listing_longitude_geocoded = ! empty( $listing_latlong_geocoded[1] ) ? trim( $listing_latlong_geocoded[1] ) : false;
		if ( ! empty( $listing_latitude_geocoded ) && ! empty( $listing_longitude_geocoded ) ) {
			$return['latitude_geocoded'] = $listing_latitude_geocoded;
			$return['longitude_geocoded'] = $listing_longitude_geocoded;
		}

		// Get address from meta
		$listing_address = get_post_meta( $listing_id, 'lsvr_listing_address', true );
		if ( ! empty( $listing_address ) ) {
			$return['address'] = $listing_address;
		}

		return $return;

	}
}

/**
 * Return listing contact info.
 *
 * @param int 	$post_id		Post ID of lsvr_listing post.
 *
 * @return array 	Social links.
 */
if ( ! function_exists( 'lsvr_directory_get_listing_contact_info' ) ) {
	function lsvr_directory_get_listing_contact_info( $post_id ) {

		$contact_info = array();
		$default_contact_fields = array( 'phone', 'email', 'fax', 'website' );

		// Parse predefined fields
		foreach ( $default_contact_fields as $profile ) {

			$profile_label = get_post_meta( $post_id, 'lsvr_listing_contact_' . $profile, true );

			if ( ! empty( $profile_label ) ) {

				// Add default HTML for predefined fields
				if ( true === apply_filters( 'lsvr_listing_contact_info_parse_predefined', true ) && 0 === preg_match( "/<[^<]+>/", $profile_label, $m ) ) {

					// Email
					if ( 'email' === $profile ) {
						$profile_label = '<a href="mailto:' . esc_attr( $profile_label ) . '">' . $profile_label . '</a>';
						$profile_title = esc_html__( 'Email', 'lsvr-directory' );
					}

					// Phone
					if ( 'phone' === $profile ) {
						$profile_label = '<a href="tel:' . esc_attr( str_replace( array( ' ', '(', ')', '-' ), '', $profile_label ) ) . '">' . $profile_label . '</a>';
						$profile_title = esc_html__( 'Phone', 'lsvr-directory' );
					}

					// Fax
					if ( 'fax' === $profile ) {
						$profile_label = '<a href="tel:' . esc_attr( str_replace( array( ' ', '(', ')', '-' ), '', $profile_label ) ) . '">' . $profile_label . '</a>';
						$profile_title = esc_html__( 'Fax', 'lsvr-directory' );
					}

					// Website
					if ( 'website' === $profile ) {
						$profile_label = '<a href="' . esc_url( $profile_label ) . '" target="_blank">' . $profile_label . '</a>';
						$profile_title = esc_html__( 'Website', 'lsvr-directory' );
					}

				}

				$contact_info[ $profile ] = array( 'label' => $profile_label, 'title' => $profile_title );

			}

		}

		// Parse custom fields
		for ( $i = 1; $i < 4; $i++ ) {

			$profile_icon = get_post_meta( $post_id, 'lsvr_listing_custom_contact' . $i . '_icon', true );
			$profile_label = get_post_meta( $post_id, 'lsvr_listing_custom_contact' . $i . '_label', true );
			$profile_title = get_post_meta( $post_id, 'lsvr_listing_custom_contact' . $i . '_title', true );

			if ( ! empty( $profile_icon ) && ! empty( $profile_label ) ) {
				$contact_info[ 'custom' . $i ] = array(
					'icon' => $profile_icon,
					'label' => $profile_label,
				);
			}

			if ( ! empty( $profile_title ) ) {
				$contact_info[ 'custom' . $i ]['title'] = $profile_title;
			}

		}

		return array_merge( $contact_info, apply_filters( 'lsvr_listing_contact_info', array() ) );

	}
}

/**
 * Return listing social links.
 *
 * @param int 	$post_id		Post ID of lsvr_listing post.
 *
 * @return array 	Social links.
 */
if ( ! function_exists( 'lsvr_directory_get_listing_social_links' ) ) {
	function lsvr_directory_get_listing_social_links( $post_id ) {

		$social_links = array();
		$predefined_social_fields = array(
			'twitter' => esc_html__( 'Twitter', 'lsvr-directory' ),
			'facebook' => esc_html__( 'Facebook', 'lsvr-directory' ),
			'instagram' => esc_html__( 'Instagram', 'lsvr-directory' ),
			'yelp' => esc_html__( 'Yelp', 'lsvr-directory' ),
		);

		// Parse predefined fields
		foreach ( $predefined_social_fields as $profile => $label ) {

			$profile_url = get_post_meta( $post_id, 'lsvr_listing_social_' . $profile, true );

			if ( ! empty( $profile_url ) ) {
				$social_links[ $profile ] = array(
					'url' => $profile_url,
					'label' => $label,
				);
			}

		}

		// Parse custom fields
		for ( $i = 1; $i < 4; $i++ ) {

			$profile_icon = get_post_meta( $post_id, 'lsvr_listing_custom_social' . $i . '_icon', true );
			$profile_url = get_post_meta( $post_id, 'lsvr_listing_custom_social' . $i . '_url', true );
			$profile_label = get_post_meta( $post_id, 'lsvr_listing_custom_social' . $i . '_label', true );

			if ( ! empty( $profile_icon ) && ! empty( $profile_url ) ) {

				$social_links[ 'custom' . $i ] = array(
					'icon' => $profile_icon,
					'url' => $profile_url,
				);

				if ( ! empty( $profile_label ) ) {
					$social_links[ 'custom' . $i ]['label'] = $profile_label;
				}

			}

		}

		return array_merge( $social_links, apply_filters( 'lsvr_listing_social_links', array() ) );

	}
}

/**
 * Return images of a single listing.
 *
 * @param int 	$listing_id		Post ID of lsvr_listing post.
 *
 * @return array 	Array with single gallery post data.
 */
if ( ! function_exists( 'lsvr_directory_get_listing_gallery_images' ) ) {
	function lsvr_directory_get_listing_gallery_images( $listing_id ) {

		// Get listing ID
		$listing_id = empty( $listing_id ) ? get_the_ID() : $listing_id;

		// Get listing gallery images from meta
		$gallery_image_ids = explode( ',', get_post_meta( $listing_id, 'lsvr_listing_gallery', true ) );

		// Prepare array for gallery images data
		$gallery_images = array();

		// Parse all gallery images
		if ( ! empty( $gallery_image_ids ) ) {
			foreach ( $gallery_image_ids as $image_id ) {

				$fullsize_img = (array) wp_get_attachment_image_src( $image_id, 'full' );
				$fullsize_url = reset( $fullsize_img );
				$fullsize_width = ! empty( $fullsize_img[1] ) ? $fullsize_img[1] : '';
				$fullsize_height = ! empty( $fullsize_img[2] ) ? $fullsize_img[2] : '';
				$thumb_img = (array) wp_get_attachment_image_src( $image_id, 'thumbnail' );
				$thumb_url = reset( $thumb_img );
				$thumb_width = ! empty( $thumb_img[1] ) ? $thumb_img[1] : '';
				$thumb_height = ! empty( $thumb_img[2] ) ? $thumb_img[2] : '';
				$medium_img = (array) wp_get_attachment_image_src( $image_id, 'medium' );
				$medium_url = reset( $medium_img );
				$medium_width = ! empty( $medium_img[1] ) ? $medium_img[1] : '';
				$medium_height = ! empty( $medium_img[2] ) ? $medium_img[2] : '';
				$large_img = (array) wp_get_attachment_image_src( $image_id, 'large' );
				$large_url = reset( $large_img );
				$large_width = ! empty( $large_img[1] ) ? $large_img[1] : '';
				$large_height = ! empty( $large_img[2] ) ? $large_img[2] : '';

				if ( ! empty( $fullsize_url ) ) {
					$gallery_images[ $image_id ] = array(
						'full_url' => $fullsize_url,
						'full_width' => $fullsize_width,
						'full_height' => $fullsize_height,
						'thumb_url' => $thumb_url,
						'thumb_width' => $thumb_width,
						'thumb_height' => $thumb_height,
						'medium_url' => $medium_url,
						'medium_width' => $medium_width,
						'medium_height' => $medium_height,
						'large_url' => $large_url,
						'large_width' => $large_width,
						'large_height' => $large_height,
						'title' => get_post_field( 'post_title', $image_id ),
						'caption' => get_post_field( 'post_excerpt', $image_id ),
						'alt' => get_post_meta( $image_id, '_wp_attachment_image_alt', true ),
					);
				}

			}
		}

		return $gallery_images;

	}
}



if ( ! function_exists( 'lsvr_directory_has_post_terms' ) ) {
	function lsvr_directory_has_post_terms( $post_id, $taxonomy ) {

        $terms = wp_get_post_terms( $post_id, $taxonomy );
        return ! empty( $terms ) ? true : false;

	}
}

if ( ! function_exists( 'lsvr_directory_get_post_taxonomy_html' ) ) {
	function lsvr_directory_get_post_taxonomy_html( $post_id, $taxonomy = 'lsvr_listing_cat', $link_template = '<a href="%s">%s</a>' ) {

		$html_output = '';
        $terms = wp_get_post_terms( $post_id, $taxonomy );

        if ( ! empty( $terms ) ) {

            foreach ( $terms as $term ) {

				$html_output .= sprintf( $link_template, esc_url( get_term_link( $term->term_id, $taxonomy ) ), $term->name );
                $html_output .= $term !== end( $terms ) ? ', ' : '';

            }

        }

        return $html_output;

	}
}

// Get maps provider
if ( ! function_exists( 'lsvr_directory_get_maps_provider' ) ) {
	function lsvr_directory_get_maps_provider() {

		if ( 'gmaps' === get_theme_mod( 'maps_provider', 'disable' ) && ! empty( get_theme_mod( 'google_api_key' ) ) ) {
			return 'gmaps';
		}

		elseif ( 'mapbox' === get_theme_mod( 'maps_provider', 'disable' ) && ! empty( get_theme_mod( 'mapbox_api_key' ) ) ) {
			return 'mapbox';
		}

		elseif ( 'osm' === get_theme_mod( 'maps_provider', 'disable' ) ) {
			return 'osm';
		}

		else {
			return false;
		}

	}
}

// Has maps provider
if ( ! function_exists( 'lsvr_directory_has_maps_provider' ) ) {
	function lsvr_directory_has_maps_provider() {

		return ! empty( lsvr_directory_get_maps_provider() ) ? true : false;

	}
}

?>