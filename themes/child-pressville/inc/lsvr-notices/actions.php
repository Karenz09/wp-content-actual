<?php

/**
 * GENERAL
 */

	// Set current post type
	add_filter( 'lsvr_pressville_current_post_type', 'lsvr_pressville_notice_set_current_post_type' );
	if ( ! function_exists( 'lsvr_pressville_notice_set_current_post_type' ) ) {
		function lsvr_pressville_notice_set_current_post_type( $post_type ) {

			if ( lsvr_pressville_is_notice() ) {
				return 'lsvr_notice';
			}
			return $post_type;

		}
	}

	// Get post category taxonomy
	add_filter( 'lsvr_pressville_post_category_taxonomy', 'lsvr_pressville_notice_category_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_notice_category_taxonomy' ) ) {
		function lsvr_pressville_notice_category_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_notice() ) {
				return 'lsvr_notice_cat';
			}

			return $taxonomy;

		}
	}

	// Get post tag taxonomy
	add_filter( 'lsvr_pressville_post_tag_taxonomy', 'lsvr_pressville_notice_tag_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_notice_tag_taxonomy' ) ) {
		function lsvr_pressville_notice_tag_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_notice() ) {
				return 'lsvr_notice_tag';
			}

			return $taxonomy;

		}
	}

	// Document title
	add_filter( 'document_title_parts', 'lsvr_pressville_notice_title' );
	if ( ! function_exists( 'lsvr_pressville_notice_title' ) ) {
		function lsvr_pressville_notice_title( $title ) {

			if ( is_post_type_archive( 'lsvr_notice' ) ) {
				$title['title'] = sanitize_text_field( lsvr_pressville_get_notice_archive_title() );
			}
			return $title;

		}
	}


/**
 * CORE
 */

	// Archive layout
	add_filter( 'lsvr_pressville_notice_archive_layout', 'lsvr_pressville_notice_archive_layout' );
	if ( ! function_exists( 'lsvr_pressville_notice_archive_layout' ) ) {
		function lsvr_pressville_notice_archive_layout() {

			return 'default';

		}
	}

	// Main header title
	add_filter( 'lsvr_pressville_main_header_title', 'lsvr_pressville_notice_main_header_title' );
	if ( ! function_exists( 'lsvr_pressville_notice_main_header_title' ) ) {
		function lsvr_pressville_notice_main_header_title( $title ) {

			if ( is_post_type_archive( 'lsvr_notice' ) ) {
				$title = lsvr_pressville_get_notice_archive_title();
			}

			return $title;

		}
	}

	// Add lsvr_notice to search filter
	add_filter( 'lsvr_pressville_header_search_filter', 'lsvr_pressville_notice_search_filter' );
	if ( ! function_exists( 'lsvr_pressville_notice_search_filter' ) ) {
		function lsvr_pressville_notice_search_filter( $filter ) {

			$filter = array_merge( $filter, array(
				array(
					'name' => 'lsvr_notice',
					'label' => esc_html__( 'notices', 'pressville' ),
				),
			));
			return $filter;

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_pressville_add_to_breadcrumbs', 'lsvr_pressville_notice_breadcrumbs' );
	if ( ! function_exists( 'lsvr_pressville_notice_breadcrumbs' ) ) {
		function lsvr_pressville_notice_breadcrumbs( $breadcrumbs ) {

			if ( lsvr_pressville_is_notice() && ! is_post_type_archive( 'lsvr_notice' ) ) {
				$breadcrumbs = array(
					array(
						'url' => get_post_type_archive_link( 'lsvr_notice' ),
						'label' => lsvr_pressville_get_notice_archive_title(),
					),
				);
			}
			return $breadcrumbs;

		}
	}

	// Archive pre_get_posts actions
	add_action( 'pre_get_posts', 'lsvr_pressville_notice_archive_pre_get_posts' );
	if ( ! function_exists( 'lsvr_pressville_notice_archive_pre_get_posts' ) ) {
		function lsvr_pressville_notice_archive_pre_get_posts( $query ) {
			if ( ! is_admin() && $query->is_main_query() && ( $query->is_post_type_archive( 'lsvr_notice' ) ||
				$query->is_tax( 'lsvr_notice_cat' ) || $query->is_tax( 'lsvr_notice_tag' ) ) ) {

				// Posts order
				$order = get_theme_mod( 'lsvr_notice_archive_order', 'default' );
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
				if ( 0 === (int) get_theme_mod( 'lsvr_notice_archive_posts_per_page', 10 ) ) {
					$query->set( 'posts_per_page', 1000 );
				} else {
					$query->set( 'posts_per_page', esc_attr( get_theme_mod( 'lsvr_notice_archive_posts_per_page', 10 ) ) );
				}

			}
		}
	}

	// Enable archive categories
	add_filter( 'lsvr_pressville_post_archive_categories_enable', 'lsvr_pressville_notice_archive_categories_enable' );
	if ( ! function_exists( 'lsvr_pressville_notice_archive_categories_enable' ) ) {
		function lsvr_pressville_notice_archive_categories_enable( $enabled ) {

			if ( lsvr_pressville_is_notice() && true === get_theme_mod( 'lsvr_notice_archive_categories_enable', false ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post date on archive
	add_filter( 'lsvr_pressville_post_archive_post_meta_date_enable', 'lsvr_pressville_notice_archive_post_meta_date_enable' );
	if ( ! function_exists( 'lsvr_pressville_notice_archive_post_meta_date_enable' ) ) {
		function lsvr_pressville_notice_archive_post_meta_date_enable( $enabled ) {

			if ( lsvr_pressville_is_notice() ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post author on archive
	add_filter( 'lsvr_pressville_post_archive_post_meta_author_enable', 'lsvr_pressville_notice_archive_post_meta_author_enable' );
	if ( ! function_exists( 'lsvr_pressville_notice_archive_post_meta_author_enable' ) ) {
		function lsvr_pressville_notice_archive_post_meta_author_enable( $enabled ) {


			if ( lsvr_pressville_is_notice() && true === get_theme_mod( 'lsvr_notice_archive_author_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post date on detail
	add_filter( 'lsvr_pressville_post_single_post_meta_date_enable', 'lsvr_pressville_notice_single_post_meta_date_enable' );
	if ( ! function_exists( 'lsvr_pressville_notice_single_post_meta_date_enable' ) ) {
		function lsvr_pressville_notice_single_post_meta_date_enable( $enabled ) {

			if ( lsvr_pressville_is_notice() ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post author on detail
	add_filter( 'lsvr_pressville_post_single_post_meta_author_enable', 'lsvr_pressville_notice_single_post_meta_author_enable' );
	if ( ! function_exists( 'lsvr_pressville_notice_single_post_meta_author_enable' ) ) {
		function lsvr_pressville_notice_single_post_meta_author_enable( $enabled ) {

			if ( lsvr_pressville_is_notice() && true === get_theme_mod( 'lsvr_notice_single_author_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post single navigation
	add_filter( 'lsvr_pressville_post_single_navigation_enable', 'lsvr_pressville_notice_single_post_navigation_enable' );
	if ( ! function_exists( 'lsvr_pressville_notice_single_post_navigation_enable' ) ) {
		function lsvr_pressville_notice_single_post_navigation_enable( $enabled ) {

			if ( lsvr_pressville_is_notice() && true === get_theme_mod( 'lsvr_notice_single_post_navigation_enable', true ) ) {
				$enabled = true;
			}

			return $enabled;

		}
	}

	// Sidebar position
	add_filter( 'lsvr_pressville_sidebar_position', 'lsvr_pressville_notice_sidebar_position' );
	if ( ! function_exists( 'lsvr_pressville_notice_sidebar_position' ) ) {
		function lsvr_pressville_notice_sidebar_position( $sidebar_position ) {

			// Is notice single
			if ( is_singular( 'lsvr_notice' ) ) {
				$sidebar_position = get_theme_mod( 'lsvr_notice_single_sidebar_position', 'disable' );
			}

			// Is notice archive
			else if ( lsvr_pressville_is_notice() ) {
				$sidebar_position = get_theme_mod( 'lsvr_notice_archive_sidebar_position', 'disable' );
			}

			return $sidebar_position;

		}
	}

	// Sidebar ID
	add_filter( 'lsvr_pressville_sidebar_id', 'lsvr_pressville_notice_sidebar_id' );
	if ( ! function_exists( 'lsvr_pressville_notice_sidebar_id' ) ) {
		function lsvr_pressville_notice_sidebar_id( $sidebar_id ) {

			// Is notice single
			if ( is_singular( 'lsvr_notice' ) ) {
				$sidebar_id = get_theme_mod( 'lsvr_notice_single_sidebar_id' );
			}

			// Is notice archive
			else if ( lsvr_pressville_is_notice() ) {
				$sidebar_id = get_theme_mod( 'lsvr_notice_archive_sidebar_id' );
			}

			return $sidebar_id;

		}
	}


/**
 * META DATA
 */

	// Add post meta data
	add_action( 'lsvr_pressville_notice_single_bottom', 'lsvr_pressville_add_notice_single_meta' );
	if ( ! function_exists( 'lsvr_pressville_add_notice_single_meta' ) ) {
		function lsvr_pressville_add_notice_single_meta() { ?>

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

			 	<?php if ( lsvr_pressville_has_post_terms( get_the_ID(), 'lsvr_notice_tag' ) ) : ?>
				,"keywords": "<?php echo esc_attr( implode( ',', lsvr_pressville_get_post_term_names( get_the_ID(), 'lsvr_notice_tag' ) ) ); ?>"
			 	<?php endif; ?>

			}
			</script>

		<?php }
	}

?>