<?php

/**
 * GENERAL
 */

	// Set current post type
	add_filter( 'lsvr_pressville_current_post_type', 'lsvr_pressville_listing_set_current_post_type' );
	if ( ! function_exists( 'lsvr_pressville_listing_set_current_post_type' ) ) {
		function lsvr_pressville_listing_set_current_post_type( $post_type ) {

			if ( lsvr_pressville_is_listing() ) {
				return 'lsvr_listing';
			}
			return $post_type;

		}
	}

	// Get post category taxonomy
	add_filter( 'lsvr_pressville_post_category_taxonomy', 'lsvr_pressville_listing_category_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_listing_category_taxonomy' ) ) {
		function lsvr_pressville_listing_category_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_listing() ) {
				return 'lsvr_listing_cat';
			}

			return $taxonomy;

		}
	}

	// Get post tag taxonomy
	add_filter( 'lsvr_pressville_post_tag_taxonomy', 'lsvr_pressville_listing_tag_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_listing_tag_taxonomy' ) ) {
		function lsvr_pressville_listing_tag_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_listing() ) {
				return 'lsvr_listing_tag';
			}

			return $taxonomy;

		}
	}

	// Document title
	add_filter( 'document_title_parts', 'lsvr_pressville_listing_title' );
	if ( ! function_exists( 'lsvr_pressville_listing_title' ) ) {
		function lsvr_pressville_listing_title( $title ) {

			if ( is_post_type_archive( 'lsvr_listing' ) ) {
				$title['title'] = sanitize_text_field( lsvr_pressville_get_listing_archive_title() );
			}
			return $title;

		}
	}

	// Load directory files
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_directory_load_js' );
	if ( ! function_exists( 'lsvr_pressville_directory_load_js' ) ) {
		function lsvr_pressville_directory_load_js() {

			$version = wp_get_theme( 'pressville' );
			$version = $version->Version;
			$suffix = defined( 'WP_DEBUG' ) && true == WP_DEBUG ? '' : '.min';

			// Google Maps platform
			if ( 'gmaps' === lsvr_pressville_get_maps_provider() &&
				lsvr_pressville_is_listing() && ! is_singular( 'lsvr_listing' ) &&
				true === get_theme_mod( 'lsvr_listing_archive_map_enable', true ) ) {

				wp_enqueue_script( 'google-markerclusterer', get_template_directory_uri() . '/assets/js/markerclusterer.min.js', false, $version, true );
				wp_enqueue_script( 'google-richmarker', get_template_directory_uri() . '/assets/js/richmarker.min.js', false, $version, true );
				wp_enqueue_script( 'google-infobox', get_template_directory_uri() . '/assets/js/infobox.min.js', false, $version, true );
				wp_enqueue_script( 'lsvr-pressville-directory-map-gmaps', get_template_directory_uri() . '/assets/js/pressville-ajax-directory-map-gmaps' . $suffix . '.js', array( 'jquery' ), $version, true );
				wp_localize_script( 'lsvr-pressville-directory-map-gmaps', 'lsvr_pressville_ajax_directory_map_var', array(
		    		'url' => admin_url( 'admin-ajax.php' ),
		    		'nonce' => wp_create_nonce( 'lsvr-pressville-ajax-directory-map-nonce' ),
				));

			}

			// Leaflet platform
			elseif ( lsvr_pressville_has_maps_leaflet_platform() &&
				lsvr_pressville_is_listing() && ! is_singular( 'lsvr_listing' ) &&
				true === get_theme_mod( 'lsvr_listing_archive_map_enable', true ) ) {

				wp_enqueue_script( 'leaflet', get_template_directory_uri() . '/assets/js/leaflet.min.js', false, $version, true );
				wp_enqueue_script( 'leaflet-markercluster', get_template_directory_uri() . '/assets/js/leaflet.markercluster.min.js', false, $version, true );
				wp_enqueue_script( 'lsvr-pressville-directory-map-leaflet', get_template_directory_uri() . '/assets/js/pressville-ajax-directory-map-leaflet' . $suffix . '.js', array( 'jquery' ), $version, true );
				wp_localize_script( 'lsvr-pressville-directory-map-leaflet', 'lsvr_pressville_ajax_directory_map_var', array(
		    		'url' => admin_url( 'admin-ajax.php' ),
		    		'nonce' => wp_create_nonce( 'lsvr-pressville-ajax-directory-map-nonce' ),
				));

			}

			// Leaflet on single
			elseif ( lsvr_pressville_has_maps_leaflet_platform() && is_singular( 'lsvr_listing' ) && true === get_theme_mod( 'lsvr_listing_single_map_enable', true ) ) {
				wp_enqueue_script( 'leaflet', get_template_directory_uri() . '/assets/js/leaflet.min.js', false, $version, true );
			}

			// Masonry
			if ( lsvr_pressville_is_listing() && ! is_singular( 'lsvr_listing' ) &&
				true === get_theme_mod( 'lsvr_listing_archive_masonry_enable', false ) ) {
				wp_enqueue_script( 'masonry' );
			}

		}
	}


/**
 * CORE
 */

	// Archive layout
	add_filter( 'lsvr_pressville_listing_archive_layout', 'lsvr_pressville_listing_archive_layout' );
	if ( ! function_exists( 'lsvr_pressville_listing_archive_layout' ) ) {
		function lsvr_pressville_listing_archive_layout() {

			$path_prefix = 'template-parts/lsvr_listing/archive-layout-';

			// Get layout from Customizer
			if ( ! empty( locate_template( $path_prefix . get_theme_mod( 'lsvr_listing_archive_layout', 'default' ) . '.php' ) ) ) {
				return get_theme_mod( 'lsvr_listing_archive_layout', 'default' );
			}

			// Default layout
			else {
				return 'default';
			}

		}
	}

	// Main header title
	add_filter( 'lsvr_pressville_main_header_title', 'lsvr_pressville_listing_main_header_title' );
	if ( ! function_exists( 'lsvr_pressville_listing_main_header_title' ) ) {
		function lsvr_pressville_listing_main_header_title( $title ) {

			if ( is_post_type_archive( 'lsvr_listing' ) ) {
				$title = lsvr_pressville_get_listing_archive_title();
			}

			return $title;

		}
	}

	// Add lsvr_listing to search filter
	add_filter( 'lsvr_pressville_header_search_filter', 'lsvr_pressville_listing_search_filter' );
	if ( ! function_exists( 'lsvr_pressville_listing_search_filter' ) ) {
		function lsvr_pressville_listing_search_filter( $filter ) {

			$filter = array_merge( $filter, array(
				array(
					'name' => 'lsvr_listing',
					'label' => esc_html__( 'listings', 'pressville' ),
				),
			));
			return $filter;

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_pressville_add_to_breadcrumbs', 'lsvr_pressville_listing_breadcrumbs' );
	if ( ! function_exists( 'lsvr_pressville_listing_breadcrumbs' ) ) {
		function lsvr_pressville_listing_breadcrumbs( $breadcrumbs ) {

			if ( lsvr_pressville_is_listing() && ! is_post_type_archive( 'lsvr_listing' ) ) {
				$breadcrumbs = array(
					array(
						'url' => get_post_type_archive_link( 'lsvr_listing' ),
						'label' => lsvr_pressville_get_listing_archive_title(),
					),
				);
			}
			return $breadcrumbs;

		}
	}

	// Listing archive pre_get_posts actions
	add_action( 'pre_get_posts', 'lsvr_pressville_listing_archive_pre_get_posts' );
	if ( ! function_exists( 'lsvr_pressville_listing_archive_pre_get_posts' ) ) {
		function lsvr_pressville_listing_archive_pre_get_posts( $query ) {
			if ( ! is_admin() && $query->is_main_query() && ( $query->is_post_type_archive( 'lsvr_listing' ) ||
				$query->is_tax( 'lsvr_listing_cat' ) || $query->is_tax( 'lsvr_listing_tag' ) ) ) {

				// Listing order
				$order = get_theme_mod( 'lsvr_listing_archive_order', 'default' );
				if ( 'date_asc' === $order ) {
					$query->set( 'orderby', 'date' );
					$query->set( 'order', 'ASC' );
				}
				else if ( 'date_desc' === $order ) {
					$query->set( 'orderby', 'date' );
					$query->set( 'order', 'DESC' );
				}
				else if ( 'title_asc' === $order ) {
					$query->set( 'orderby', 'title' );
					$query->set( 'order', 'ASC' );
				}
				else if ( 'title_desc' === $order ) {
					$query->set( 'orderby', 'title' );
					$query->set( 'order', 'DESC' );
				}
				else if ( 'random' === $order ) {
					$query->set( 'orderby', 'rand' );
				}

				// Posts per page
				if ( 0 === (int) get_theme_mod( 'lsvr_listing_archive_posts_per_page', 12 ) ) {
					$query->set( 'posts_per_page', 1000 );
				} else {
					$query->set( 'posts_per_page', esc_attr( get_theme_mod( 'lsvr_listing_archive_posts_per_page', 12 ) ) );
				}

			}
		}
	}

	// Enable archive categories
	add_filter( 'lsvr_pressville_post_archive_categories_enable', 'lsvr_pressville_listing_archive_categories_enable' );
	if ( ! function_exists( 'lsvr_pressville_listing_archive_categories_enable' ) ) {
		function lsvr_pressville_listing_archive_categories_enable( $enabled ) {

			if ( lsvr_pressville_is_listing() && true === get_theme_mod( 'lsvr_listing_archive_categories_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable archive thumbnail cropping
	add_filter( 'lsvr_pressville_post_archive_cropped_thumbnail_enable', 'lsvr_pressville_listing_archive_cropped_thumbnail_enable' );
	if ( ! function_exists( 'lsvr_pressville_listing_archive_cropped_thumbnail_enable' ) ) {
		function lsvr_pressville_listing_archive_cropped_thumbnail_enable( $enabled ) {

			if ( lsvr_pressville_is_listing() && true === get_theme_mod( 'lsvr_listing_archive_cropped_thumb_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Archive thumb size
	add_filter( 'lsvr_pressville_post_archive_thumbnail_size', 'lsvr_pressville_listing_archive_thumbnail_size' );
	if ( ! function_exists( 'lsvr_pressville_listing_archive_thumbnail_size' ) ) {
		function lsvr_pressville_listing_archive_thumbnail_size( $size ) {

			if ( lsvr_pressville_is_listing() ) {
				return (int) get_theme_mod( 'lsvr_listing_archive_grid_columns', 3 ) < 4 ? 'large' : 'medium';
			}

			return $size;

		}
	}

	// Enable detail thumbnail
	add_filter( 'lsvr_pressville_post_single_thumbnail_enable', 'lsvr_pressville_listing_single_thumbnail_enable' );
	if ( ! function_exists( 'lsvr_pressville_listing_single_thumbnail_enable' ) ) {
		function lsvr_pressville_listing_single_thumbnail_enable( $enabled ) {

			if ( lsvr_pressville_is_listing() && lsvr_pressville_has_listing_single_featured_image( get_the_ID() ) ) {
				return true;
			} elseif ( lsvr_pressville_is_listing() ) {
				return false;
			}

			return $enabled;

		}
	}

	// Sidebar position
	add_filter( 'lsvr_pressville_sidebar_position', 'lsvr_pressville_listing_sidebar_position' );
	if ( ! function_exists( 'lsvr_pressville_listing_sidebar_position' ) ) {
		function lsvr_pressville_listing_sidebar_position( $sidebar_position ) {

			// If listing single
			if ( is_singular( 'lsvr_listing' ) ) {
				$sidebar_position = get_theme_mod( 'lsvr_listing_single_sidebar_position', 'disable' );
			}

			// If listing archive
			else if ( lsvr_pressville_is_listing() ) {
				$sidebar_position = get_theme_mod( 'lsvr_listing_archive_sidebar_position', 'disable' );
			}

			return $sidebar_position;

		}
	}

	// Sidebar ID
	add_filter( 'lsvr_pressville_sidebar_id', 'lsvr_pressville_listing_sidebar_id' );
	if ( ! function_exists( 'lsvr_pressville_listing_sidebar_id' ) ) {
		function lsvr_pressville_listing_sidebar_id( $sidebar_id ) {

			// Is listing single
			if ( is_singular( 'lsvr_listing' ) ) {
				$sidebar_id = get_theme_mod( 'lsvr_listing_single_sidebar_id' );
			}

			// Is listing archive
			else if ( lsvr_pressville_is_listing() ) {
				$sidebar_id = get_theme_mod( 'lsvr_listing_archive_sidebar_id' );
			}

			return $sidebar_id;

		}
	}


/**
 * META DATA
 */

	// Add post meta data
	add_action( 'lsvr_pressville_listing_single_bottom', 'lsvr_pressville_add_listing_single_meta' );
	if ( ! function_exists( 'lsvr_pressville_add_listing_single_meta' ) ) {
		function lsvr_pressville_add_listing_single_meta() {

			if ( true === get_post_meta( get_the_ID(), 'lsvr_listing_meta_enable', true ) || 'true' === get_post_meta( get_the_ID(), 'lsvr_listing_meta_enable', true ) ) { ?>

				<?php $social_links = lsvr_pressville_get_listing_social_links( get_the_ID() );
				$postal_address = lsvr_pressville_get_listing_meta_postal_address( get_the_ID() ); ?>

				<script type="application/ld+json">
				{
					"@context" : "http://schema.org",
					"@type" : "<?php echo esc_attr( lsvr_pressville_get_listing_meta_business_type( get_the_ID() ) ); ?>",
					"name": "<?php echo esc_attr( get_the_title() ); ?>",
					"url" : "<?php echo esc_url( get_permalink() ); ?>",
					"mainEntityOfPage" : "<?php echo esc_url( get_permalink() ); ?>",
				 	"description" : "<?php echo esc_attr( get_the_excerpt() ); ?>"

				 	<?php if ( lsvr_pressville_has_listing_map_location( get_the_ID() ) ) : ?>
				 	,"hasMap": "<?php echo esc_url( lsvr_pressville_get_listing_map_link( get_the_ID() ) ); ?>"
				 	<?php endif; ?>

					<?php if ( lsvr_pressville_has_listing_phone( get_the_ID() ) ) : ?>
					,"telephone" : "<?php echo esc_attr( lsvr_pressville_get_listing_phone( get_the_ID() ) ); ?>"
					<?php endif; ?>

					<?php if ( ! empty( $postal_address ) ) : ?>
					,"address": {
						"@type": "PostalAddress"

						<?php if ( ! empty( $postal_address['country'] ) ) : ?>
						,"addressCountry": "<?php echo esc_attr( $postal_address['country'] ); ?>"
						<?php endif; ?>

						<?php if ( ! empty( $postal_address['locality'] ) ) : ?>
						,"addressLocality": "<?php echo esc_attr( $postal_address['locality'] ); ?>"
						<?php endif; ?>

						<?php if ( ! empty( $postal_address['region'] ) ) : ?>
						,"addressRegion": "<?php echo esc_attr( $postal_address['region'] ); ?>"
						<?php endif; ?>

						<?php if ( ! empty( $postal_address['postalcode'] ) ) : ?>
						,"postalCode": "<?php echo esc_attr( $postal_address['postalcode'] ); ?>"
						<?php endif; ?>

						<?php if ( ! empty( $postal_address['street'] ) ) : ?>
						,"streetAddress": "<?php echo esc_attr( $postal_address['street'] ); ?>"
						<?php endif; ?>

					}
					<?php endif; ?>

					<?php if ( lsvr_pressville_has_listing_map_location( get_the_ID() ) ) : ?>
					,"geo": {
						"@type": "GeoCoordinates",
						"latitude": "<?php echo esc_attr( lsvr_pressville_get_listing_map_location( get_the_ID(), 'latitude' ) ); ?>",
						"longitude": "<?php echo esc_attr( lsvr_pressville_get_listing_map_location( get_the_ID(), 'longitude' ) ); ?>"
					}
					<?php endif; ?>

					<?php if ( has_post_thumbnail() ) : ?>
				 	,"image": {
				 		"@type" : "ImageObject",
				 		"url" : "<?php the_post_thumbnail_url( 'full' ); ?>",
				 		"width" : "<?php echo esc_attr( lsvr_pressville_get_image_width( get_post_thumbnail_id( get_the_ID() ), 'full' ) ); ?>",
				 		"height" : "<?php echo esc_attr( lsvr_pressville_get_image_height( get_post_thumbnail_id( get_the_ID() ), 'full' ) ); ?>",
				 		"thumbnailUrl" : "<?php the_post_thumbnail_url( 'thumbnail' ); ?>"
				 	}
				 	<?php endif; ?>

					<?php if ( lsvr_pressville_has_listing_social_links( get_the_ID() ) ) : ?>
					,"sameAs" : [
						<?php foreach ( $social_links as $social_link ) : ?>
				    		"<?php echo esc_url( $social_link ); ?>"<?php if ( $social_link !== end( $social_links ) ) { echo ','; } ?>
						<?php ; endforeach; ?>
				  	]
				  	<?php endif; ?>

				}
				</script>

			<?php }

		}
	}

?>