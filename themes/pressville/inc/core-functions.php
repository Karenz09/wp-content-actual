<?php

/**
 * GENERAL
 */

	// Get languages
	if ( ! function_exists( 'lsvr_pressville_get_languages' ) ) {
		function lsvr_pressville_get_languages() {

			$languages = array();

			// WPML Generated
			if ( 'wpml' == get_theme_mod( 'language_switcher', 'disable' ) ) {

				$wpml_languages = apply_filters( 'wpml_active_languages', false, 'skip_missing=0&orderby=id&order=desc' );

				if ( is_array( $wpml_languages ) && count( $wpml_languages ) > 1 ) {
					foreach ( $wpml_languages as $lang ) {

						$language = array();
						$language['label'] = ! empty( $lang['language_code'] ) ? $lang['language_code'] : '';
						$language['url'] = ! empty( $lang['url'] ) ? $lang['url'] : '';
						$language['active'] = isset( $lang['active'] ) && true === (bool) $lang['active'] ? true : false;
						array_push( $languages, $language );

					}
				}

			}

			// Custom links
			elseif ( 'custom' == get_theme_mod( 'language_switcher', 'disable' ) ) {

				for ( $i = 1; $i <= 5; $i++ ) {
					if ( ! empty( get_theme_mod( 'language_custom' . $i . '_label', '' ) ) &&
						! empty( get_theme_mod( 'language_custom' . $i . '_url', '' ) ) ) {

						$language = array();
						$language['label'] = get_theme_mod( 'language_custom' . $i . '_label', '' );
						$language['url'] = get_theme_mod( 'language_custom' . $i . '_url', '' );
						if ( ! empty( get_theme_mod( 'language_custom' . $i . '_code', '' ) ) &&
							get_locale() === get_theme_mod( 'language_custom' . $i . '_code', '' ) ) {

							$language['active'] = true;

						} else {
							$language['active'] = false;
						}

						array_push( $languages, $language );

					}
				}

			}

			return ! empty( $languages ) ? $languages : false;

		}
	}

	// Get active language
	if ( ! function_exists( 'lsvr_pressville_get_active_language' ) ) {
		function lsvr_pressville_get_active_language() {

			$languages = lsvr_pressville_get_languages();
			if ( ! empty( $languages ) ) {
				foreach ( $languages as $language ) {
					if ( ! empty( $language['active'] ) ) {
						$active_language = $language;
					}
				}
				$active_language = empty( $active_language ) ? reset( $languages ) : $active_language;
			}

			return ! empty( $active_language ) ? $active_language : false;

		}
	}

	// Get active language label
	if ( ! function_exists( 'lsvr_pressville_get_active_language_label' ) ) {
		function lsvr_pressville_get_active_language_label() {

			$languages = lsvr_pressville_get_languages();
			if ( ! empty( $languages ) ) {
				foreach ( $languages as $language ) {
					if ( ! empty( $language['active'] ) ) {
						$active_language = $language;
					}
				}
				$active_language = empty( $active_language ) ? reset( $languages ) : $active_language;
			}

			return ! empty( $active_language['label'] ) ? $active_language['label'] : false;

		}
	}

	// Has languages
	if ( ! function_exists( 'lsvr_pressville_has_languages' ) ) {
		function lsvr_pressville_has_languages() {

			$languages = lsvr_pressville_get_languages();
			return ! empty( $languages ) ? true : false;

		}
	}

	// Get menus
	if ( ! function_exists( 'lsvr_pressville_get_menus' ) ) {
		function lsvr_pressville_get_menus() {

			$return = array();

			$menus = wp_get_nav_menus();
			if ( ! empty( $menus ) ) {
				foreach ( $menus as $menu ) {
					if ( ! empty( $menu->term_id ) && ! empty( $menu->name ) ) {
						$return[ $menu->term_id ] = $menu->name;
					}
				}
			}

			return $return;

		}
	}

	// Get custom sidebars
	if ( ! function_exists( 'lsvr_pressville_get_custom_sidebars' ) ) {
		function lsvr_pressville_get_custom_sidebars() {

			$return = array();

			$custom_sidebars = get_theme_mod( 'custom_sidebars' );
			if ( ! empty( $custom_sidebars ) && '{' === substr( $custom_sidebars, 0, 1 ) ) {

				$custom_sidebars = (array) json_decode( $custom_sidebars );
				if ( ! empty( $custom_sidebars['sidebars'] ) ) {
					$custom_sidebars = $custom_sidebars['sidebars'];
					foreach ( $custom_sidebars as $sidebar ) {
						$sidebar = (array) $sidebar;
						if ( ! empty( $sidebar['id'] ) ) {

							$sidebar_label = ! empty( $sidebar['label'] ) ? $sidebar['label'] : sprintf( esc_html__( 'Custom Sidebar %d', 'pressville' ), (int) $sidebar['id'] );
							$return[ 'lsvr-pressville-custom-sidebar-' . $sidebar['id'] ] = $sidebar_label;

						}
					}
				}

			}

			return $return;

		}
	}

	// Get sidebars
	if ( ! function_exists( 'lsvr_pressville_get_sidebars' ) ) {
		function lsvr_pressville_get_sidebars() {

			$sidebar_list = array( 'lsvr-pressville-default-sidebar' => esc_html__( 'Default Sidebar', 'pressville'  ) );
			$custom_sidebars = lsvr_pressville_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) ) {
				$sidebar_list = array_merge( $sidebar_list, $custom_sidebars );
			}

            return $sidebar_list;

		}
	}

	// Get menu name by location
	if ( ! function_exists( 'lsvr_pressville_get_menu_name_by_location' ) ) {
		function lsvr_pressville_get_menu_name_by_location( $location ) {

			$theme_locations = get_nav_menu_locations();
			$menu_obj = ! empty( $theme_locations[ $location ] ) ? get_term( $theme_locations[ $location ], 'nav_menu' ) : false;

			return ! empty( $menu_obj->name ) ? $menu_obj->name : false;

		}
	}

	// Get image URL
	if ( ! function_exists( 'lsvr_pressville_get_image_url' ) ) {
		function lsvr_pressville_get_image_url( $image_id, $size = 'full' ) {

			$image_src = wp_get_attachment_image_src( $image_id, $size );
			return ! empty( $image_src[0] ) ? $image_src[0] : '';

		}
	}

	// Get image width
	if ( ! function_exists( 'lsvr_pressville_get_image_width' ) ) {
		function lsvr_pressville_get_image_width( $image_id, $size = 'full' ) {

			$image_src = wp_get_attachment_image_src( $image_id, $size );
			return ! empty( $image_src[1] ) ? $image_src[1] : '';

		}
	}

	// Get image height
	if ( ! function_exists( 'lsvr_pressville_get_image_height' ) ) {
		function lsvr_pressville_get_image_height( $image_id, $size = 'full' ) {

			$image_src = wp_get_attachment_image_src( $image_id, $size );
			return ! empty( $image_src[2] ) ? $image_src[2] : '';

		}
	}

	// Get image alt
	if ( ! function_exists( 'lsvr_pressville_get_image_alt' ) ) {
		function lsvr_pressville_get_image_alt( $image_id ) {

			$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			return ! empty( $image_alt ) ? $image_alt : '';

		}
	}

	// Get social links
	if ( ! function_exists( 'lsvr_pressville_get_social_links' ) ) {
		function lsvr_pressville_get_social_links() {

			$social_links = array();
			$custom_social_links = array();

			// Custom social links
			for ( $i = 1; $i <= 3; $i++ ) {

				$custom_social_link_arr = array();
				$custom_social_link_icon = get_theme_mod( 'custom_social_link' . $i . '_icon', '' );
				$custom_social_link_url = get_theme_mod( 'custom_social_link' . $i . '_url', '' );
				$custom_social_link_label = get_theme_mod( 'custom_social_link' . $i . '_label', '' );
				$custom_social_link_name = 'custom' . $i;

				if ( ! empty( $custom_social_link_icon ) && ! empty( $custom_social_link_url ) ) {

					$custom_social_link_arr[ 'icon' ] = $custom_social_link_icon;
					$custom_social_link_arr[ 'url' ] = $custom_social_link_url;
					$custom_social_link_arr[ 'name' ] = $custom_social_link_name;

					if ( ! empty( $custom_social_link_label ) ) {
						$custom_social_link_arr[ 'label' ] = $custom_social_link_label;
					}

					array_push( $custom_social_links, (array) $custom_social_link_arr );

				}

			}

			// Predefined social links
			$predefined_social_links = ! empty( get_theme_mod( 'social_links', '' ) ) ? (array) @json_decode( get_theme_mod( 'social_links', '' ) ) : '';
			if ( ! empty( $predefined_social_links ) ) {
				foreach ( $predefined_social_links as $name => $predefined_social_link_arr ) {
					array_push( $social_links, (array) $predefined_social_link_arr + array( 'name' => $name )  );
				}
			}

			// Merge custom and predefined
			$custom_social_links = array_merge( $custom_social_links, apply_filters( 'lsvr_pressville_add_custom_social_links', array() ) );
			$social_links = true === apply_filters( 'lsvr_pressville_custom_social_links_before_predefined', true ) ? array_merge( $custom_social_links, $social_links ) : array_merge( $social_links, $custom_social_links );

			return $social_links;

		}
	}

	// Get tax term description
	if ( ! function_exists( 'lsvr_pressville_get_tax_term_description' ) ) {
		function lsvr_pressville_get_tax_term_description( $term_id, $taxonomy ) {

			$description = term_description( $term_id, $taxonomy );
			if ( ! empty( $description ) ) {
				return $description;
			}
			else {
				return '';
			}

		}
	}

	// Has tax term description
	if ( ! function_exists( 'lsvr_pressville_has_tax_term_description' ) ) {
		function lsvr_pressville_has_tax_term_description( $term_id, $taxonomy ) {

			$description = lsvr_pressville_get_tax_term_description( $term_id, $taxonomy );
			if ( ! empty( $description ) ) {
				return true;
			}
			else {
				return false;
			}

		}
	}

	// Get parents of taxonomy term
	if ( ! function_exists( 'lsvr_pressville_get_term_parents' ) ) {
		function lsvr_pressville_get_term_parents( $term_id, $taxonomy, $max_limit = 5 ) {

			$term = get_term( $term_id, $taxonomy );
			if ( 0 !== $term->parent ) {

				$parents_arr = [];
				$counter = 0;
				$parent_id = $term->parent;

				while ( 0 !== $parent_id && $counter < $max_limit ) {
					array_unshift( $parents_arr, $parent_id );
					$parent = get_term( $parent_id, $taxonomy );
					$parent_id = $parent->parent;
					$counter++;
				}
				return $parents_arr;

			}
			else {
				return false;
			}

		}
	}

	// Post type icon class
	if ( ! function_exists( 'lsvr_pressville_get_post_type_icon_class' ) ) {
		function lsvr_pressville_get_post_type_icon_class( $post_type ) {

			// Default icons
			$default_post_type_icons = array(
				'post' => 'icon-post-pin',
				'page' => 'icon-file-default',
				'lsvr_notice' => 'icon-post-pin',
				'lsvr_listing' => 'icon-location-pin',
				'lsvr_event' => 'icon-calendar',
				'lsvr_gallery' => 'icon-file-landscape-image',
				'lsvr_document' => 'icon-file-2',
				'lsvr_person' => 'icon-user',
				'forum' => 'icon-forum-comment',
				'topic' => 'icon-forum-comment',
			);

			// Make icons list editable via filters
			$post_type_icons = array_merge( $default_post_type_icons, apply_filters( 'lsvr_pressville_post_type_icons', array() ) );

			// Return icon
			if ( ! empty( $post_type_icons[ $post_type ] ) ) {
				return $post_type_icons[ $post_type ];
			}
			else {
				return apply_filters( 'lsvr_pressville_post_type_icon_default', 'icon-file-default' );
			}

		}
	}

	// Get post terms names
	if ( ! function_exists( 'lsvr_pressville_get_post_term_names' ) ) {
		function lsvr_pressville_get_post_term_names( $post_id, $taxonomy ) {

			$terms = wp_get_post_terms( $post_id, $taxonomy );
			$term_names = array();

			if ( ! empty( $terms ) && is_array( $terms ) ) {
				foreach ( $terms as $tag ) {
					array_push( $term_names, $tag->name );
				}
			}
			return ! empty( $term_names ) ? $term_names : false;

		}
	}

	// Has post terms
	if ( ! function_exists( 'lsvr_pressville_has_post_terms' ) ) {
		function lsvr_pressville_has_post_terms( $post_id, $taxonomy ) {

			$terms = wp_get_post_terms( $post_id, $taxonomy );
			return ! empty( $terms ) ? true : false;

		}
	}

	// Get post comments count
	if ( ! function_exists( 'lsvr_pressville_get_post_comments_count' ) ) {
		function lsvr_pressville_get_post_comments_count( $post_id = false ) {

			$post_id = ! empty( $post_id ) ? $post_id : get_the_ID();

            $comments_count = get_comment_count( $post_id );
            $approved_count = ! empty( $comments_count['approved'] ) ? (int) $comments_count['approved'] : false;

			return ! empty( $approved_count ) ? $approved_count : 0;

		}
	}

	// Has post comments
	if ( ! function_exists( 'lsvr_pressville_has_post_comments' ) ) {
		function lsvr_pressville_has_post_comments( $post_id = false ) {

			$post_id = ! empty( $post_id ) ? $post_id : get_the_ID();

            $comments_count = get_comment_count( $post_id );
            $approved_count = ! empty( $comments_count['approved'] ) ? (int) $comments_count['approved'] : false;

			return ! empty( $approved_count ) ? true : false;

		}
	}

	// Day name
	if ( ! function_exists( 'lsvr_pressville_get_day_name' ) ) {
		function lsvr_pressville_get_day_name( $day, $format = 'l' ) {

			return date_i18n( $format, strtotime( $day ) );

		}
	}

	// Has previous post
	if ( ! function_exists( 'lsvr_pressville_has_previous_post' ) ) {
		function lsvr_pressville_has_previous_post() {

			$previous_post = get_adjacent_post( false, '', false );
			return ! empty( $previous_post ) ? true : false;

		}
	}

	// Get previous post ID
	if ( ! function_exists( 'lsvr_pressville_get_previous_post_url' ) ) {
		function lsvr_pressville_get_previous_post_url() {

			$previous_post = get_adjacent_post( false, '', false );
			return ! empty( $previous_post->ID ) ? get_permalink( $previous_post->ID ) : false;

		}
	}

	// Get previous post title
	if ( ! function_exists( 'lsvr_pressville_get_previous_post_title' ) ) {
		function lsvr_pressville_get_previous_post_title() {

			$previous_post = get_adjacent_post( false, '', false );
			return ! empty( $previous_post->post_title ) ? $previous_post->post_title : false;

		}
	}

	// Has next post
	if ( ! function_exists( 'lsvr_pressville_has_next_post' ) ) {
		function lsvr_pressville_has_next_post() {

			$next_post = get_adjacent_post( false, '', true );
			return ! empty( $next_post ) ? true : false;

		}
	}

	// Get next post ID
	if ( ! function_exists( 'lsvr_pressville_get_next_post_url' ) ) {
		function lsvr_pressville_get_next_post_url() {

			$next_post = get_adjacent_post( false, '', true );
			return ! empty( $next_post->ID ) ? get_permalink( $next_post->ID ) : false;

		}
	}

	// Get next post title
	if ( ! function_exists( 'lsvr_pressville_get_next_post_title' ) ) {
		function lsvr_pressville_get_next_post_title() {

			$next_post = get_adjacent_post( false, '', true );
			return ! empty( $next_post->post_title ) ? $next_post->post_title : false;

		}
	}

	// Convert hex color to RGB
	if ( ! function_exists( 'lsvr_pressville_hex2rgb' ) ) {
		function lsvr_pressville_hex2rgb( $hex ) {

			$hex = ltrim( $hex, '#' );
			$rgb = array();
			if ( 6 === strlen( $hex ) ) {
				array_push( $rgb, substr( $hex, 0, 2 ) );
				array_push( $rgb, substr( $hex, 2, 2 ) );
				array_push( $rgb, substr( $hex, 4, 2 ) );
				return array_map( 'hexdec', $rgb );
			}

		}
	}

	// Custom colors CSS
	if ( ! function_exists( 'lsvr_pressville_get_custom_colors_css' ) ) {
		function lsvr_pressville_get_custom_colors_css( $is_editor = false ) {

			$custom_colors = array(
				'accent1' => get_theme_mod( 'colors_custom_accent1', '#cd4335' ),
				'accent2' => get_theme_mod( 'colors_custom_accent2', '#2d93c5' ),
				'body-link' => get_theme_mod( 'colors_custom_link', '#2d93c5' ),
				'body-font' => get_theme_mod( 'colors_custom_text', '#545e69' ),
			);

			$theme_version = wp_get_theme( 'pressville' );
			$theme_version = $theme_version->Version;

			// Check if CSS with same colors doesn't exists in DB
			$saved_colors = get_option( 'lsvr_pressville_custom_colors' );
			$saved_css = get_option( 'lsvr_pressville_custom_colors_css' );
			$saved_editor_css = get_option( 'lsvr_pressville_custom_editor_colors_css' );
			$saved_version = get_option( 'lsvr_pressville_custom_colors_version' );

			if ( ! empty( $saved_colors ) && ! empty( $saved_css ) && ! empty( $saved_editor_css ) && $saved_colors === $custom_colors && $theme_version === $saved_version ) {
				if ( true === $is_editor ) {
					return $saved_editor_css;
				} else {
					return $saved_css;
				}
			}

			// If there is no CSS for selected colors, generate it
			else {

				$css_template = lsvr_pressville_get_custom_colors_template();
				$css_editor_template = lsvr_pressville_get_editor_custom_colors_template();

				if ( ! empty( $css_template ) ) {

					// Get RGB accents
					$accent1_rgb = implode( ', ', lsvr_pressville_hex2rgb( $custom_colors[ 'accent1' ] ) );
					$accent2_rgb = implode( ', ', lsvr_pressville_hex2rgb( $custom_colors[ 'accent2' ] ) );

					// Replace RGBA first
					$custom_css = str_replace(
						array( 'rgba( $accent1', 'rgba( $accent2' ),
						array( 'rgba( ' . $accent1_rgb, 'rgba( ' . $accent2_rgb ),
						$css_template
					);
					$custom_editor_css = str_replace(
						array( 'rgba( $accent1', 'rgba( $accent2' ),
						array( 'rgba( ' . $accent1_rgb, 'rgba( ' . $accent2_rgb ),
						$css_editor_template
					);

					// Replace the rest
					$custom_css = str_replace(
						array( '$accent1', '$accent2', '$body-link', '$body-font', "\r", "\n", "\t" ),
						array( $custom_colors[ 'accent1' ], $custom_colors[ 'accent2' ], $custom_colors[ 'body-link' ], $custom_colors[ 'body-font' ], '', '', '' ),
						$custom_css
					);
					$custom_editor_css = str_replace(
						array( '$accent1', '$accent2', '$body-link', '$body-font', "\r", "\n", "\t" ),
						array( $custom_colors[ 'accent1' ], $custom_colors[ 'accent2' ], $custom_colors[ 'body-link' ], $custom_colors[ 'body-font' ], '', '', '' ),
						$custom_editor_css
					);

					// Save colors and CSS to DB
					update_option( 'lsvr_pressville_custom_colors', $custom_colors );
					update_option( 'lsvr_pressville_custom_colors_css', $custom_css );
					update_option( 'lsvr_pressville_custom_editor_colors_css', $custom_editor_css );
					update_option( 'lsvr_pressville_custom_colors_version', $theme_version );

					if ( true === $is_editor ) {
						return $custom_editor_css;
					} else {
						return $custom_css;
					}

				} else {
					return '';
				}

			}

		}
	}

	// Get maps provider
	if ( ! function_exists( 'lsvr_pressville_get_maps_provider' ) ) {
		function lsvr_pressville_get_maps_provider() {

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
	if ( ! function_exists( 'lsvr_pressville_has_maps_provider' ) ) {
		function lsvr_pressville_has_maps_provider() {

			return ! empty( lsvr_pressville_get_maps_provider() ) ? true : false;

		}
	}

	// Get maps platform
	if ( ! function_exists( 'lsvr_pressville_get_maps_platform' ) ) {
		function lsvr_pressville_get_maps_platform() {

			if ( 'gmaps' === get_theme_mod( 'maps_provider', 'disable' ) && ! empty( get_theme_mod( 'google_api_key' ) ) ) {
				return 'gmaps';
			}

			elseif ( 'disable' !== get_theme_mod( 'maps_provider', 'disable' ) && 'gmaps' !== get_theme_mod( 'maps_provider', 'disable' ) ) {
				return 'leaflet';
			}

			else {
				return false;
			}

		}
	}

	// Has maps leaflet platform
	if ( ! function_exists( 'lsvr_pressville_has_maps_leaflet_platform' ) ) {
		function lsvr_pressville_has_maps_leaflet_platform() {

			return 'leaflet' === lsvr_pressville_get_maps_platform() ? true : false;

		}
	}


/**
 * HEADER
 */

	// Has header site title
	if ( ! function_exists( 'lsvr_pressville_has_header_site_title' ) ) {
		function lsvr_pressville_has_header_site_title() {

			$site_title = get_bloginfo( 'name' );
			return ! empty( $site_title ) && true === get_theme_mod( 'header_site_title_enable', true ) ? true : false;

		}
	}

	// Has header tagline
	if ( ! function_exists( 'lsvr_pressville_has_header_description' ) ) {
		function lsvr_pressville_has_header_description() {

			$site_description = get_bloginfo( 'description' );

			// Enable via URL
			if ( ! empty( $site_description ) && ! empty( $_GET['lsvr-title-description'] ) && 'true' === $_GET['lsvr-title-description'] ) {
				return true;
			}

			if ( ! empty( $site_description ) && true === get_theme_mod( 'header_site_description_enable', true ) ) {

				// Front page only
				if ( true === get_theme_mod( 'header_site_description_frontpage_only_enable', true ) && is_front_page() ) {
					return true;
				}

				// Not front page
				elseif ( true === get_theme_mod( 'header_site_description_frontpage_only_enable', true ) ) {
					return false;
				}

				// Display everywhere
				else {
					return true;
				}

			} else {
				return false;
			}

		}
	}

	// Get titlebar background class
	if ( ! function_exists( 'lsvr_pressville_get_header_titlebar_background_class' ) ) {
		function lsvr_pressville_get_header_titlebar_background_class() {

			$titlebar_background_class_arr = array( 'header-titlebar__background' );
			array_push( $titlebar_background_class_arr, 'header-titlebar__background--align-' . get_theme_mod( 'header_background_vertical_align', 'top' ) );
			array_push( $titlebar_background_class_arr, 'header-titlebar__background--' . get_theme_mod( 'header_background_type', 'single' ) );
 			if ( ( is_front_page() && true === get_theme_mod( 'header_background_animated_enable', false ) ) ||
 				( ! empty( $_GET['lsvr-animated-header'] ) && 'true' === $_GET['lsvr-animated-header'] ) ) {
 				array_push( $titlebar_background_class_arr, 'header-titlebar__background--animated' );
 			}

 			return implode( ' ', $titlebar_background_class_arr );

		}
	}

	// Get titlebar background images
	if ( ! function_exists( 'lsvr_pressville_get_header_titlebar_background_images' ) ) {
		function lsvr_pressville_get_header_titlebar_background_images() {

			$images = array();

			// Get background type
			$background_type = get_theme_mod( 'header_background_type', 'single' );

 			// If is page and has featured image, use it instead of image defined via Customizer
 			if ( is_page() && has_post_thumbnail( get_the_ID() ) ) {
				array_push( $images, get_the_post_thumbnail_url( get_the_ID() ) );
 			}

 			// Get image from Customizer
 			else {

				// Get default image
				$default_image_url = get_theme_mod( 'header_background_image', '' );
				if ( ! empty( $default_image_url )  ) {
					array_push( $images, $default_image_url );
				}

				// Get additional images
				if ( 'slideshow' === $background_type || 'random' === $background_type ||
					( 'slideshow-home' === $background_type && is_front_page() ) ) {

					for ( $i = 2; $i <= 5; $i++ ) {

						$image_url = get_theme_mod( 'header_background_image_' . $i, '' );
						if ( ! empty( $image_url )  ) {
							array_push( $images, $image_url );
						}

					}

				}

			}

			return $images;

		}
	}

	// Get header search active filter
	if ( ! function_exists( 'lsvr_pressville_get_header_search_active_filters' ) ) {
		function lsvr_pressville_get_header_search_active_filters() {

			if ( isset( $_GET['lsvr-search-filter'] ) ) {
				$active_filters = (array) $_GET['lsvr-search-filter'];
			} elseif ( isset( $_GET['lsvr-search-filter-serialized'] ) ) {
				$active_filters = explode( ',', esc_attr( $_GET['lsvr-search-filter-serialized'] ) );
			} else {
				$active_filters = array();
			}

			return ! empty( $active_filters ) ? $active_filters : array();

		}
	}


/**
 * FOOTER
 */

	// Footer widgets before widget
	if ( ! function_exists( 'lsvr_pressville_get_footer_widgets_before_widget' ) ) {
		function lsvr_pressville_get_footer_widgets_before_widget() {

			$columns = (int) get_theme_mod( 'footer_widgets_columns', 4 );

			// Wider first col
			if ( 4 === $columns && true === get_theme_mod( 'footer_widgets_wider_col_enable', false ) ) {

				$span = 2;
				$span_lg = $columns >= 2 ? 6 : 12;

			}

			// Equal cols
			else {
				$span = 12 / $columns;
				$span_lg = $columns >= 2 ? 6 : 12;
			}

			$return = '<div class="footer-widgets__column lsvr-grid__col lsvr-grid__col--span-' . esc_attr( $span );
			$return .= ' lsvr-grid__col--lg lsvr-grid__col--lg-span-' . esc_attr( $span_lg ) . '">';
			$return .= '<div class="footer-widgets__column-inner"><div id="%1$s" class="footer-widget %2$s"><div class="footer-widget__inner">';

			return $return;

		}
	}

	// Footer widgets after widget
	if ( ! function_exists( 'lsvr_pressville_get_footer_widgets_after_widget' ) ) {
		function lsvr_pressville_get_footer_widgets_after_widget() {

			return '</div></div></div></div>';

		}
	}

	// Has footer social links
	if ( ! function_exists( 'lsvr_pressville_has_footer_social_links' ) ) {
		function lsvr_pressville_has_footer_social_links() {

			$social_links = lsvr_pressville_get_social_links();
			return ! empty( $social_links ) && true === get_theme_mod( 'footer_social_links_enable', true ) ? true : false;

		}
	}

	// Back to top button class
	if ( ! function_exists( 'lsvr_pressville_get_back_to_top_button_class' ) ) {
		function lsvr_pressville_get_back_to_top_button_class() {

			$class = array( 'back-to-top' );
			array_push( $class, 'back-to-top--type-' . get_theme_mod( 'back_to_top_button_enable', 'disable' ) );
			array_push( $class, 'back-to-top--threshold-' . strval( get_theme_mod( 'back_to_top_button_threshold', 100 ) ) );

			return implode( ' ', $class );

		}
	}


/**
 * BLOG
 */

	// Is blog page
	if ( ! function_exists( 'lsvr_pressville_is_blog' ) ) {
		function lsvr_pressville_is_blog() {

			if ( is_home() || is_post_type_archive( 'post' ) || is_category() || is_singular( 'post' ) ||
				is_tag() || is_day() || is_month() || is_year() || is_author() ) {
				return true;
			} else {
				return false;
			}

		}
	}

	// Get blog archive title
	if ( ! function_exists( 'lsvr_pressville_get_blog_archive_title' ) ) {
		function lsvr_pressville_get_blog_archive_title() {

			if ( ! is_home() && ! is_post_type_archive( 'post' ) ) {
				return get_the_archive_title();
			} else if ( get_option( 'page_for_posts' ) ) {
				return esc_html( get_the_title( get_option( 'page_for_posts' ) ) );
			} else {
				return esc_html__( 'News', 'pressville' );
			}

		}
	}

?>