<?php

/**
 * GENERAL
 */

	// Set current post type
	add_filter( 'lsvr_pressville_current_post_type', 'lsvr_pressville_event_set_current_post_type' );
	if ( ! function_exists( 'lsvr_pressville_event_set_current_post_type' ) ) {
		function lsvr_pressville_event_set_current_post_type( $post_type ) {

			if ( lsvr_pressville_is_event() ) {
				return 'lsvr_event';
			}
			return $post_type;

		}
	}

	// Get post category taxonomy
	add_filter( 'lsvr_pressville_post_category_taxonomy', 'lsvr_pressville_event_category_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_event_category_taxonomy' ) ) {
		function lsvr_pressville_event_category_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_event() ) {
				return 'lsvr_event_cat';
			}

			return $taxonomy;

		}
	}

	// Get post tag taxonomy
	add_filter( 'lsvr_pressville_post_tag_taxonomy', 'lsvr_pressville_event_tag_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_event_tag_taxonomy' ) ) {
		function lsvr_pressville_event_tag_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_event() ) {
				return 'lsvr_event_tag';
			}

			return $taxonomy;

		}
	}

	// Document title
	add_filter( 'document_title_parts', 'lsvr_pressville_event_title' );
	if ( ! function_exists( 'lsvr_pressville_event_title' ) ) {
		function lsvr_pressville_event_title( $title ) {

			if ( is_post_type_archive( 'lsvr_event' ) ) {
				$title['title'] = sanitize_text_field( lsvr_pressville_get_event_archive_title() );
			}
			return $title;

		}
	}

	// Load event JS files
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_event_load_js' );
	if ( ! function_exists( 'lsvr_pressville_event_load_js' ) ) {
		function lsvr_pressville_event_load_js() {

			$version = wp_get_theme( 'pressville' );
			$version = $version->Version;

			// Leaflet
			if ( lsvr_pressville_has_maps_leaflet_platform() && is_singular( 'lsvr_event' ) && true === get_theme_mod( 'lsvr_event_single_map_enable', true ) ) {
				wp_enqueue_script( 'leaflet', get_template_directory_uri() . '/assets/js/leaflet.min.js', false, $version, true );
			}

			// Masonry
			if ( lsvr_pressville_is_event() && ! is_singular( 'lsvr_event' ) &&
				true === get_theme_mod( 'lsvr_event_archive_masonry_enable', false ) &&
				'default' === get_theme_mod( 'lsvr_event_archive_layout', 'default' ) ) {
				wp_enqueue_script( 'masonry' );
			}

			// Datepicker
			if ( lsvr_pressville_is_event() && ! is_singular( 'lsvr_event' ) ) {
				wp_enqueue_script( 'jquery-ui-datepicker' );
			}

		}
	}


/**
 * CORE
 */

	// Archive layout
	add_filter( 'lsvr_pressville_event_archive_layout', 'lsvr_pressville_event_archive_layout' );
	if ( ! function_exists( 'lsvr_pressville_event_archive_layout' ) ) {
		function lsvr_pressville_event_archive_layout() {

			$path_prefix = 'template-parts/lsvr_event/archive-layout-';

			// Get layout from Customizer
			if ( ! empty( locate_template( $path_prefix . get_theme_mod( 'lsvr_event_archive_layout', 'default' ) . '.php' ) ) ) {
				return get_theme_mod( 'lsvr_event_archive_layout', 'default' );
			}

			// Default layout
			else {
				return 'default';
			}

		}
	}

	// Main header title
	add_filter( 'lsvr_pressville_main_header_title', 'lsvr_pressville_event_main_header_title' );
	if ( ! function_exists( 'lsvr_pressville_event_main_header_title' ) ) {
		function lsvr_pressville_event_main_header_title( $title ) {

			if ( is_post_type_archive( 'lsvr_event' ) ) {
				$title = lsvr_pressville_get_event_archive_title();
			}

			return $title;

		}
	}

	// Add lsvr_event to search filter
	add_filter( 'lsvr_pressville_header_search_filter', 'lsvr_pressville_event_search_filter' );
	if ( ! function_exists( 'lsvr_pressville_event_search_filter' ) ) {
		function lsvr_pressville_event_search_filter( $filter ) {

			$filter = array_merge( $filter, array(
				array(
					'name' => 'lsvr_event',
					'label' => esc_html__( 'events', 'pressville' ),
				),
			));
			return $filter;

		}
	}

	// Events Filter language
	add_action( 'lsvr_pressville_event_archive_filter_form_fields_before', 'lsvr_pressville_event_archive_filter_wpml_language' );
	if ( ! function_exists( 'lsvr_pressville_event_archive_filter_wpml_language' ) ) {
		function lsvr_pressville_event_archive_filter_wpml_language() {

			if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
				echo '<input type="hidden" name="lang" value="' . ICL_LANGUAGE_CODE . '">';
			}

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_pressville_add_to_breadcrumbs', 'lsvr_pressville_event_breadcrumbs' );
	if ( ! function_exists( 'lsvr_pressville_event_breadcrumbs' ) ) {
		function lsvr_pressville_event_breadcrumbs( $breadcrumbs ) {

			if ( lsvr_pressville_is_event() && ! is_post_type_archive( 'lsvr_event' ) ) {
				$breadcrumbs = array(
					array(
						'url' => get_post_type_archive_link( 'lsvr_event' ),
						'label' => lsvr_pressville_get_event_archive_title(),
					),
				);
			}
			return $breadcrumbs;

		}
	}

	// Enable archive categories
	add_filter( 'lsvr_pressville_post_archive_categories_enable', 'lsvr_pressville_event_archive_categories_enable' );
	if ( ! function_exists( 'lsvr_pressville_event_archive_categories_enable' ) ) {
		function lsvr_pressville_event_archive_categories_enable( $enabled ) {

			if ( lsvr_pressville_is_event() && true === get_theme_mod( 'lsvr_event_archive_categories_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Get archive categories URL args
	add_filter( 'lsvr_pressville_post_archive_categories_url_args', 'lsvr_pressville_event_archive_categories_url_args' );
	if ( ! function_exists( 'lsvr_pressville_event_archive_categories_url_args' ) ) {
		function lsvr_pressville_event_archive_categories_url_args() {

			$url_args = array();

			// Add date from and date to params to URL
			if ( isset( $_GET['date_from'] ) ) {
				$url_args['date_from'] = preg_replace( '/[^0-9-]/', '', $_GET['date_from'] );
			}
			if ( isset( $_GET['date_to'] ) ) {
				$url_args['date_to'] = preg_replace( '/[^0-9-]/', '', $_GET['date_to'] );
			}

			return $url_args;

		}
	}

	// Archive thumb size
	add_filter( 'lsvr_pressville_event_archive_thumbnail_size', 'lsvr_pressville_event_archive_thumbnail_size' );
	if ( ! function_exists( 'lsvr_pressville_event_archive_thumbnail_size' ) ) {
		function lsvr_pressville_event_archive_thumbnail_size() {

			return (int) get_theme_mod( 'lsvr_event_archive_grid_columns', 2 ) < 4 ? 'large' : 'medium';

		}
	}

	// Enable detail thumbnail
	add_filter( 'lsvr_pressville_post_single_thumbnail_enable', 'lsvr_pressville_event_single_thumbnail_enable' );
	if ( ! function_exists( 'lsvr_pressville_event_single_thumbnail_enable' ) ) {
		function lsvr_pressville_event_single_thumbnail_enable( $enabled ) {

			if ( lsvr_pressville_is_event() && true === get_theme_mod( 'lsvr_event_single_featured_image_enable', true ) ) {
				return true;
			} elseif ( lsvr_pressville_is_event() ) {
				return false;
			}

			return $enabled;

		}
	}

	// Sidebar position
	add_filter( 'lsvr_pressville_sidebar_position', 'lsvr_pressville_event_sidebar_position' );
	if ( ! function_exists( 'lsvr_pressville_event_sidebar_position' ) ) {
		function lsvr_pressville_event_sidebar_position( $sidebar_position ) {

			// Is event single
			if ( is_singular( 'lsvr_event' ) ) {
				$sidebar_position = get_theme_mod( 'lsvr_event_single_sidebar_position', 'disable' );
			}

			// Is event archive
			else if ( lsvr_pressville_is_event() ) {
				$sidebar_position = get_theme_mod( 'lsvr_event_archive_sidebar_position', 'disable' );
			}

			return $sidebar_position;

		}
	}

	// Sidebar ID
	add_filter( 'lsvr_pressville_sidebar_id', 'lsvr_pressville_event_sidebar_id' );
	if ( ! function_exists( 'lsvr_pressville_event_sidebar_id' ) ) {
		function lsvr_pressville_event_sidebar_id( $sidebar_id ) {

			// Is event single
			if ( is_singular( 'lsvr_event' ) ) {
				$sidebar_id = get_theme_mod( 'lsvr_event_single_sidebar_id' );
			}

			// Is event archive
			else if ( lsvr_pressville_is_event() ) {
				$sidebar_id = get_theme_mod( 'lsvr_event_archive_sidebar_id' );
			}

			return $sidebar_id;

		}
	}


/**
 * META DATA
 */

	// Add post meta data
	add_action( 'lsvr_pressville_event_single_bottom', 'lsvr_pressville_add_event_single_meta' );
	if ( ! function_exists( 'lsvr_pressville_add_event_single_meta' ) ) {
		function lsvr_pressville_add_event_single_meta() { ?>

			<script type="application/ld+json">
			{
				"@context" : "http://schema.org",
				"@type" : "Event",
				"eventStatus" : "EventScheduled",
				"name": "<?php echo esc_attr( get_the_title() ); ?>",
				"url" : "<?php echo esc_url( get_permalink() ); ?>",
				"mainEntityOfPage" : "<?php echo esc_url( get_permalink() ); ?>",
			 	"description" : "<?php echo esc_attr( get_the_excerpt() ); ?>",
			 	"startDate" : "<?php echo lsvr_pressville_get_next_event_occurrence_start( get_the_ID(), 'Y-m-d H:i:s' ); ?>",
			 	"endDate" : "<?php echo lsvr_pressville_get_next_event_occurrence_end( get_the_ID(), 'Y-m-d H:i:s' ); ?>"

			 	<?php if ( lsvr_pressville_has_event_location( get_the_ID() ) ) : ?>
				,"location" : {
				    "@type" : "Place",
				    "name" : "<?php echo esc_attr( lsvr_pressville_get_event_location_name( get_the_ID() ) ); ?>",
				    <?php if ( lsvr_pressville_has_event_location_acurrate_address( get_the_ID() ) ) : ?>
				    "address" : "<?php echo esc_attr( lsvr_pressville_get_event_location_accurate_address( get_the_ID() ) ); ?>"
				    <?php elseif ( lsvr_pressville_has_event_location_address( get_the_ID() ) ) : ?>
				    "address" : "<?php echo esc_attr( preg_replace( "/\r|\n/", "", lsvr_pressville_get_event_location_address( get_the_ID() ) ) ); ?>"
				    <?php endif; ?>
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

			}
			</script>

		<?php }
	}

?>