<?php

/**
 * GENERAL
 */

	// Alert message
	if ( ! function_exists( 'lsvr_pressville_the_alert_message' ) ) {
		function lsvr_pressville_the_alert_message( $message ) {

			echo '<p class="c-alert-message">' . esc_html( $message ) . '</p>';

		}
	}

	// Post terms
	if ( ! function_exists( 'lsvr_pressville_the_post_terms' ) ) {
		function lsvr_pressville_the_post_terms( $post_id, $taxonomy, $template = '%s', $separator = ', ', $limit = 0 ) {

			if ( 'post_tag' === $taxonomy && true === apply_filters( 'lsvr_pressville_the_post_terms_the_tags_enable', false ) ) {
				the_tags();
			}

			else {

				$terms = wp_get_post_terms( $post_id, $taxonomy );
				$terms_parsed = array();
				if ( ! empty( $terms ) ) {
					foreach ( $terms as $term ) {
						array_push( $terms_parsed, '<a href="' . esc_url( get_term_link( $term->term_id, $taxonomy ) ) . '" class="post__term-link">' . esc_html( $term->name ) . '</a>' );
					}
					if ( $limit > 0 && count( $terms_parsed ) > $limit ) {
						$terms_parsed = array_slice( $terms_parsed, 0, $limit );
					}
				}

				$separator = ! empty( $separator ) ? '<span class="post__terms-separator" aria-hidden="true">' . $separator . '</span>' : '';

				if ( ! empty( $terms_parsed ) ) { ?>

					<span class="post__terms post__terms--<?php echo esc_attr( $taxonomy ); ?>">
						<?php echo sprintf( $template, implode( $separator, $terms_parsed ) ); ?>
					</span>

				<?php }

			}

		}
	}


/**
 * HEADER
 */

	// Header titlebar class
	if ( ! function_exists( 'lsvr_pressville_the_header_titlebar_class' ) ) {
		function lsvr_pressville_the_header_titlebar_class() {

			$classes = array( 'header-titlebar' );

			// Large header
			if ( ( is_front_page() && true === get_theme_mod( 'header_large_enable', true ) )
				|| ( ! empty( $_GET['lsvr-large-header'] ) && 'true' === $_GET['lsvr-large-header'] ) ) {
				array_push( $classes, 'header-titlebar--large' );
			}

			// Has topbar
			if ( has_nav_menu( 'lsvr-pressville-header-menu-secondary' ) || lsvr_pressville_has_languages() ) {
				array_push( $classes, 'header-titlebar--has-topbar' );
			}

			// Has logo
			if ( has_custom_logo() ) {
				array_push( $classes, 'header-titlebar--has-logo' );
			}

			// Center logo
			if ( true === get_theme_mod( 'header_logo_centered_enable', false ) ) {
				array_push( $classes, 'header-titlebar--centered' );
			}

			if ( ! empty( $classes ) ) {
				echo ' class="' . implode( ' ', $classes ) . '"';
			}

		}
	}

	// Header titlebar overlay
	if ( ! function_exists( 'lsvr_pressville_the_header_titlebar_overlay_opacity' ) ) {
		function lsvr_pressville_the_header_titlebar_overlay_opacity() {

			$overlay_opacity = (int) get_theme_mod( 'header_background_overlay_opacity', 80 ) / 100;
			$opacity_css = 'opacity: ' . $overlay_opacity . ';'; // For modern browsers
			$opacity_filter_css = 'filter: alpha(opacity=' . $overlay_opacity . ');'; // For IE

			echo ' style="' . esc_attr( $opacity_css . $opacity_filter_css ) . '"';

		}
	}

	// Header navbar class
	if ( ! function_exists( 'lsvr_pressville_the_header_navbar_class' ) ) {
		function lsvr_pressville_the_header_navbar_class() {

			$classes = array( 'header-navbar' );

			// Sticky navbar
			if ( true === get_theme_mod( 'sticky_navbar_enable', true ) ) {
				array_push( $classes, 'header-navbar--is-sticky' );
			}

			// Animated primary menu
			if ( true == apply_filters( 'lsvr_pressville_header_menu_primary_animated', false ) ) {
				array_push( $classes, 'header-navbar--animated-primary-menu' );
			}

			if ( ! empty( $classes ) ) {
				echo ' class="' . implode( ' ', $classes ) . '"';
			}

		}
	}


/**
 * FOOTER
 */

	// Footer background image
	if ( ! function_exists( 'lsvr_pressville_the_footer_background_image' ) ) {
		function lsvr_pressville_the_footer_background_image() {

			$image_url = get_theme_mod( 'footer_background_image', '' );
			if ( ! empty( $image_url )  ) {
				echo ' style="background-image: url( \'' . esc_url( $image_url ) . '\' );"';
			}

		}
	}

	// Footer background overlay
	if ( ! function_exists( 'lsvr_pressville_the_footer_overlay' ) ) {
		function lsvr_pressville_the_footer_overlay() {

			$overlay_opacity = (int) get_theme_mod( 'footer_background_overlay_opacity', 80 );
			$opacity_css = 'opacity: ' . $overlay_opacity / 100 . ';'; // For modern browsers
			$opacity_filter_css = 'filter: alpha(opacity=' . $overlay_opacity . ');'; // For IE
			echo '<div class="footer__overlay" style="' . esc_attr( $opacity_css . ' ' . $opacity_filter_css ) . '"></div>';

		}
	}

	// Footer widgets class
	if ( ! function_exists( 'lsvr_pressville_the_footer_widgets_class' ) ) {
		function lsvr_pressville_the_footer_widgets_class() {

			$classes = array( 'footer-widgets' );

			// Wider first col
			if ( true === get_theme_mod( 'footer_widgets_wider_col_enable', false ) && 4 === (int) get_theme_mod( 'footer_widgets_columns', 4 ) ) {
				array_push( $classes, 'lsvr-grid--wider-first-col' );
			}

			if ( ! empty( $classes ) ) {
				echo ' class="' . esc_attr( implode( ' ', $classes ) ) . '"';
			}

		}
	}

	// Footer widgets grid class
	if ( ! function_exists( 'lsvr_pressville_the_footer_widgets_grid_class' ) ) {
		function lsvr_pressville_the_footer_widgets_grid_class() {

			$classes = array( 'lsvr-grid' );
			$columns = get_theme_mod( 'footer_widgets_columns', 4 );

			// Cols
			array_push( $classes, 'lsvr-grid--' . $columns . '-cols' );

			// Cold md
			if ( $columns >= 2 ) {
				array_push( $classes, 'lsvr-grid--md-2-cols' );
			}

			if ( ! empty( $classes ) ) {
				echo ' class="' . esc_attr( implode( ' ', $classes ) ) . '"';
			}

		}
	}


/**
 * BLOG
 */

	// Blog post archive grid class
	if ( ! function_exists( 'lsvr_pressville_the_blog_post_archive_grid_class' ) ) {
		function lsvr_pressville_the_blog_post_archive_grid_class() {

			echo 'lsvr-grid';

		}
	}

	// Blog post grid column class
	if ( ! function_exists( 'lsvr_pressville_the_blog_post_archive_grid_column_class' ) ) {
		function lsvr_pressville_the_blog_post_archive_grid_column_class( $post_id ) {

			global $paged;

			$number_of_columns = ! empty( get_theme_mod( 'blog_archive_grid_columns', 3 ) ) ? (int) get_theme_mod( 'blog_archive_grid_columns', 3 ) : 3;
			$span = 12 / $number_of_columns;

			// Get large span class
			$span_lg_class =  3 === $span ? ' lsvr-grid__col--lg-span-4' : '';

			// Get medium span class
			$span_md_class =  3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--md-span-6' : '';

			echo 'lsvr-grid__col lsvr-grid__col--span-' . esc_attr( $span . $span_lg_class . $span_md_class );

		}
	}

	// Blog post background thumbnail
	if ( ! function_exists( 'lsvr_pressville_the_blog_post_background_thumbnail' ) ) {
		function lsvr_pressville_the_blog_post_background_thumbnail( $post_id ) {

			if ( has_post_thumbnail( $post_id ) ) {
				echo ' style="background-image: url( \'' . esc_url( get_the_post_thumbnail_url( $post_id, 'large' ) ) . '\' );"';
			}

		}
	}

?>