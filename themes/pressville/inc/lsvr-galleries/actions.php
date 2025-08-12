<?php

/**
 * GENERAL
 */

	// Set current post type
	add_filter( 'lsvr_pressville_current_post_type', 'lsvr_pressville_gallery_set_current_post_type' );
	if ( ! function_exists( 'lsvr_pressville_gallery_set_current_post_type' ) ) {
		function lsvr_pressville_gallery_set_current_post_type( $post_type ) {

			if ( lsvr_pressville_is_gallery() ) {
				return 'lsvr_gallery';
			}
			return $post_type;

		}
	}

	// Get post category taxonomy
	add_filter( 'lsvr_pressville_post_category_taxonomy', 'lsvr_pressville_gallery_category_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_gallery_category_taxonomy' ) ) {
		function lsvr_pressville_gallery_category_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_gallery() ) {
				return 'lsvr_gallery_cat';
			}

			return $taxonomy;

		}
	}

	// Get post tag taxonomy
	add_filter( 'lsvr_pressville_post_tag_taxonomy', 'lsvr_pressville_gallery_tag_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_gallery_tag_taxonomy' ) ) {
		function lsvr_pressville_gallery_tag_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_gallery() ) {
				return 'lsvr_gallery_tag';
			}

			return $taxonomy;

		}
	}

	// Document title
	add_filter( 'document_title_parts', 'lsvr_pressville_gallery_title' );
	if ( ! function_exists( 'lsvr_pressville_gallery_title' ) ) {
		function lsvr_pressville_gallery_title( $title ) {

			if ( is_post_type_archive( 'lsvr_gallery' ) ) {
				$title['title'] = sanitize_text_field( lsvr_pressville_get_gallery_archive_title() );
			}
			return $title;

		}
	}

	// Load gallery JS files
	add_action( 'lsvr_pressville_load_assets', 'lsvr_pressville_gallery_load_js' );
	if ( ! function_exists( 'lsvr_pressville_gallery_load_js' ) ) {
		function lsvr_pressville_gallery_load_js() {

			// Masonry
			if ( ( is_singular( 'lsvr_gallery' ) && true === get_theme_mod( 'lsvr_gallery_single_masonry_enable', true ) ) ||
				( ( lsvr_pressville_is_gallery() && ! is_singular( 'lsvr_gallery' ) ) &&
				true === get_theme_mod( 'lsvr_gallery_archive_masonry_enable', false ) &&
				'default' === get_theme_mod( 'lsvr_gallery_archive_layout', 'default' ) ) ) {
				wp_enqueue_script( 'masonry' );
			}

		}
	}


/**
 * CORE
 */

	// Archive layout
	add_filter( 'lsvr_pressville_gallery_archive_layout', 'lsvr_pressville_gallery_archive_layout' );
	if ( ! function_exists( 'lsvr_pressville_gallery_archive_layout' ) ) {
		function lsvr_pressville_gallery_archive_layout() {

			$path_prefix = 'template-parts/lsvr_gallery/archive-layout-';

			// Get layout from Customizer
			if ( ! empty( locate_template( $path_prefix . get_theme_mod( 'lsvr_gallery_archive_layout', 'default' ) . '.php' ) ) ) {
				return get_theme_mod( 'lsvr_gallery_archive_layout', 'default' );
			}

			// Default layout
			else {
				return 'default';
			}

		}
	}

	// Main header title
	add_filter( 'lsvr_pressville_main_header_title', 'lsvr_pressville_gallery_main_header_title' );
	if ( ! function_exists( 'lsvr_pressville_gallery_main_header_title' ) ) {
		function lsvr_pressville_gallery_main_header_title( $title ) {

			if ( is_post_type_archive( 'lsvr_gallery' ) ) {
				$title = lsvr_pressville_get_gallery_archive_title();
			}

			return $title;

		}
	}

	// Add lsvr_gallery to search filter
	add_filter( 'lsvr_pressville_header_search_filter', 'lsvr_pressville_gallery_search_filter' );
	if ( ! function_exists( 'lsvr_pressville_gallery_search_filter' ) ) {
		function lsvr_pressville_gallery_search_filter( $filter ) {

			$filter = array_merge( $filter, array(
				array(
					'name' => 'lsvr_gallery',
					'label' => esc_html__( 'galleries', 'pressville' ),
				),
			));
			return $filter;

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_pressville_add_to_breadcrumbs', 'lsvr_pressville_gallery_breadcrumbs' );
	if ( ! function_exists( 'lsvr_pressville_gallery_breadcrumbs' ) ) {
		function lsvr_pressville_gallery_breadcrumbs( $breadcrumbs ) {

			if ( lsvr_pressville_is_gallery() && ! is_post_type_archive( 'lsvr_gallery' ) ) {
				$breadcrumbs = array(
					array(
						'url' => get_post_type_archive_link( 'lsvr_gallery' ),
						'label' => lsvr_pressville_get_gallery_archive_title(),
					),
				);
			}
			return $breadcrumbs;

		}
	}

	// Archive pre_get_posts actions
	add_action( 'pre_get_posts', 'lsvr_pressville_gallery_archive_pre_get_posts' );
	if ( ! function_exists( 'lsvr_pressville_gallery_archive_pre_get_posts' ) ) {
		function lsvr_pressville_gallery_archive_pre_get_posts( $query ) {
			if ( ! is_admin() && $query->is_main_query() && ( $query->is_post_type_archive( 'lsvr_gallery' ) ||
				$query->is_tax( 'lsvr_gallery_cat' ) || $query->is_tax( 'lsvr_gallery_tag' ) ) ) {

				// Posts order
				$order = get_theme_mod( 'lsvr_gallery_archive_order', 'default' );
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
				if ( 0 === (int) get_theme_mod( 'lsvr_gallery_archive_posts_per_page', 12 ) ) {
					$query->set( 'posts_per_page', 1000 );
				} else {
					$query->set( 'posts_per_page', esc_attr( get_theme_mod( 'lsvr_gallery_archive_posts_per_page', 12 ) ) );
				}

			}
		}
	}

	// Enable archive categories
	add_filter( 'lsvr_pressville_post_archive_categories_enable', 'lsvr_pressville_gallery_archive_categories_enable' );
	if ( ! function_exists( 'lsvr_pressville_gallery_archive_categories_enable' ) ) {
		function lsvr_pressville_gallery_archive_categories_enable( $enabled ) {

			if ( lsvr_pressville_is_gallery() && true === get_theme_mod( 'lsvr_gallery_archive_categories_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post date on archive
	add_filter( 'lsvr_pressville_post_archive_post_meta_date_enable', 'lsvr_pressville_gallery_archive_post_meta_date_enable' );
	if ( ! function_exists( 'lsvr_pressville_gallery_archive_post_meta_date_enable' ) ) {
		function lsvr_pressville_gallery_archive_post_meta_date_enable( $enabled ) {

			if ( lsvr_pressville_is_gallery() && true === get_theme_mod( 'lsvr_gallery_archive_date_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post date on detail
	add_filter( 'lsvr_pressville_post_single_post_meta_date_enable', 'lsvr_pressville_gallery_single_post_meta_date_enable' );
	if ( ! function_exists( 'lsvr_pressville_gallery_single_post_meta_date_enable' ) ) {
		function lsvr_pressville_gallery_single_post_meta_date_enable( $enabled ) {

			if ( lsvr_pressville_is_gallery() && true === get_theme_mod( 'lsvr_gallery_single_date_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable single post single navigation
	add_filter( 'lsvr_pressville_post_single_navigation_enable', 'lsvr_pressville_gallery_single_post_navigation_enable' );
	if ( ! function_exists( 'lsvr_pressville_gallery_single_post_navigation_enable' ) ) {
		function lsvr_pressville_gallery_single_post_navigation_enable( $enabled ) {

			if ( lsvr_pressville_is_gallery() && true === get_theme_mod( 'lsvr_gallery_single_navigation_enable', true ) ) {
				$enabled = true;
			}

			return $enabled;

		}
	}

	// Sidebar position
	add_filter( 'lsvr_pressville_sidebar_position', 'lsvr_pressville_gallery_sidebar_position' );
	if ( ! function_exists( 'lsvr_pressville_gallery_sidebar_position' ) ) {
		function lsvr_pressville_gallery_sidebar_position( $sidebar_position ) {

			// Is gallery single
			if ( is_singular( 'lsvr_gallery' ) ) {
				$sidebar_position = get_theme_mod( 'lsvr_gallery_single_sidebar_position', 'disable' );
			}

			// Is gallery archive
			else if ( lsvr_pressville_is_gallery() ) {
				$sidebar_position = get_theme_mod( 'lsvr_gallery_archive_sidebar_position', 'disable' );
			}

			return $sidebar_position;

		}
	}

	// Sidebar ID
	add_filter( 'lsvr_pressville_sidebar_id', 'lsvr_pressville_gallery_sidebar_id' );
	if ( ! function_exists( 'lsvr_pressville_gallery_sidebar_id' ) ) {
		function lsvr_pressville_gallery_sidebar_id( $sidebar_id ) {

			// Is gallery single
			if ( is_singular( 'lsvr_gallery' ) ) {
				$sidebar_id = get_theme_mod( 'lsvr_gallery_single_sidebar_id' );
			}

			// Is gallery archive
			else if ( lsvr_pressville_is_gallery() ) {
				$sidebar_id = get_theme_mod( 'lsvr_gallery_archive_sidebar_id' );
			}

			return $sidebar_id;

		}
	}


/**
 * META DATA
 */

	// Add post meta data
	add_action( 'lsvr_pressville_gallery_single_bottom', 'lsvr_pressville_add_gallery_single_meta' );
	if ( ! function_exists( 'lsvr_pressville_add_gallery_single_meta' ) ) {
		function lsvr_pressville_add_gallery_single_meta() { ?>

			<script type="application/ld+json">
			{
				"@context" : "http://schema.org",
				"@type" : "ImageGallery",
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

			 	<?php if ( lsvr_pressville_has_post_terms( get_the_ID(), 'lsvr_gallery_tag' ) ) : ?>
				,"keywords": "<?php echo esc_attr( implode( ',', lsvr_pressville_get_post_term_names( get_the_ID(), 'lsvr_gallery_tag' ) ) ); ?>"
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

			 	<?php if ( lsvr_pressville_has_gallery_images( get_the_ID() ) ) : ?>
			 		,"associatedMedia" : [
			 		<?php $i = 1; foreach ( lsvr_pressville_get_gallery_images( get_the_ID() ) as $image ) : ?>
						{
				 			"@type" : "ImageObject",
				 			"url" : "<?php echo esc_url( $image['full_url'] ); ?>",
				 			"width" : "<?php echo esc_attr( $image['full_width'] ); ?>",
				 			"height" : "<?php echo esc_attr( $image['full_height'] ); ?>",
				 			"thumbnailUrl" : "<?php echo esc_url( $image['thumb_url'] ); ?>"
				 		}<?php if ( $i < count( lsvr_pressville_get_gallery_images( get_the_ID() ) ) ) { echo ','; } ?>
			 		<?php $i++; endforeach; ?>
			 		]
			 	<?php endif; ?>

			}
			</script>

		<?php }
	}

?>