<?php

/**
 * GENERAL
 */

	// Set current post type
	add_filter( 'lsvr_pressville_current_post_type', 'lsvr_pressville_person_set_current_post_type' );
	if ( ! function_exists( 'lsvr_pressville_person_set_current_post_type' ) ) {
		function lsvr_pressville_person_set_current_post_type( $post_type ) {

			if ( lsvr_pressville_is_person() ) {
				return 'lsvr_person';
			}
			return $post_type;

		}
	}

	// Get post category taxonomy
	add_filter( 'lsvr_pressville_post_category_taxonomy', 'lsvr_pressville_person_category_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_person_category_taxonomy' ) ) {
		function lsvr_pressville_person_category_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_person() ) {
				return 'lsvr_person_cat';
			}

			return $taxonomy;

		}
	}

	// Document title
	add_filter( 'document_title_parts', 'lsvr_pressville_person_title' );
	if ( ! function_exists( 'lsvr_pressville_person_title' ) ) {
		function lsvr_pressville_person_title( $title ) {

			if ( is_post_type_archive( 'lsvr_person' ) ) {
				$title['title'] = sanitize_text_field( lsvr_pressville_get_person_archive_title() );
			}
			return $title;

		}
	}


/**
 * CORE
 */

	// Archive layout
	add_filter( 'lsvr_pressville_person_archive_layout', 'lsvr_pressville_person_archive_layout' );
	if ( ! function_exists( 'lsvr_pressville_person_archive_layout' ) ) {
		function lsvr_pressville_person_archive_layout() {

			return 'default';

		}
	}

	// Main header title
	add_filter( 'lsvr_pressville_main_header_title', 'lsvr_pressville_person_main_header_title' );
	if ( ! function_exists( 'lsvr_pressville_person_main_header_title' ) ) {
		function lsvr_pressville_person_main_header_title( $title ) {

			if ( is_post_type_archive( 'lsvr_person' ) ) {
				$title = lsvr_pressville_get_person_archive_title();
			}

			return $title;

		}
	}

	// Add lsvr_person to search filter
	add_filter( 'lsvr_pressville_header_search_filter', 'lsvr_pressville_person_header_search_filter' );
	if ( ! function_exists( 'lsvr_pressville_person_header_search_filter' ) ) {
		function lsvr_pressville_person_header_search_filter( $filter ) {

			$filter = array_merge( $filter, array(
				array(
					'name' => 'lsvr_person',
					'label' => esc_html__( 'people', 'pressville' ),
				),
			));

			return $filter;

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_pressville_add_to_breadcrumbs', 'lsvr_pressville_person_breadcrumbs' );
	if ( ! function_exists( 'lsvr_pressville_person_breadcrumbs' ) ) {
		function lsvr_pressville_person_breadcrumbs( $breadcrumbs ) {

			if ( lsvr_pressville_is_person() && ! is_post_type_archive( 'lsvr_person' ) ) {
				$breadcrumbs = array(
					array(
						'url' => get_post_type_archive_link( 'lsvr_person' ),
						'label' => lsvr_pressville_get_person_archive_title(),
					),
				);
			}
			return $breadcrumbs;

		}
	}

	// Archive pre_get_posts actions
	add_action( 'pre_get_posts', 'lsvr_pressville_person_archive_pre_get_posts' );
	if ( ! function_exists( 'lsvr_pressville_person_archive_pre_get_posts' ) ) {
		function lsvr_pressville_person_archive_pre_get_posts( $query ) {
			if ( ! is_admin() && $query->is_main_query() && ( $query->is_post_type_archive( 'lsvr_person' ) || $query->is_tax( 'lsvr_person_cat' ) ) ) {

				// Posts order
				$order = get_theme_mod( 'lsvr_person_archive_order', 'default' );
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
				if ( 0 === (int) get_theme_mod( 'lsvr_person_archive_posts_per_page', 0 ) ) {
					$query->set( 'posts_per_page', 1000 );
				} else {
					$query->set( 'posts_per_page', esc_attr( get_theme_mod( 'lsvr_person_archive_posts_per_page', 0 ) ) );
				}

			}
		}
	}

	// Enable archive categories
	add_filter( 'lsvr_pressville_post_archive_categories_enable', 'lsvr_pressville_person_archive_categories_enable' );
	if ( ! function_exists( 'lsvr_pressville_person_archive_categories_enable' ) ) {
		function lsvr_pressville_person_archive_categories_enable( $enabled ) {

			if ( lsvr_pressville_is_person() && true === get_theme_mod( 'lsvr_person_archive_categories_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Archive thumb size
	add_filter( 'lsvr_pressville_post_archive_thumbnail_size', 'lsvr_pressville_person_archive_thumbnail_size' );
	if ( ! function_exists( 'lsvr_pressville_person_archive_thumbnail_size' ) ) {
		function lsvr_pressville_person_archive_thumbnail_size( $size ) {

			if ( lsvr_pressville_is_person() ) {
				return 'thumbnail';
			}

			return $size;

		}
	}

	// Detail thumb size
	add_filter( 'lsvr_pressville_post_single_thumbnail_size', 'lsvr_pressville_person_single_thumbnail_size' );
	if ( ! function_exists( 'lsvr_pressville_person_single_thumbnail_size' ) ) {
		function lsvr_pressville_person_single_thumbnail_size( $size ) {

			if ( lsvr_pressville_is_person() ) {
				return 'thumbnail';
			}

			return $size;

		}
	}

	// Sidebar position
	add_filter( 'lsvr_pressville_sidebar_position', 'lsvr_pressville_person_sidebar_position' );
	if ( ! function_exists( 'lsvr_pressville_person_sidebar_position' ) ) {
		function lsvr_pressville_person_sidebar_position( $sidebar_position ) {

			// Is person single
			if ( is_singular( 'lsvr_person' ) ) {
				$sidebar_position = get_theme_mod( 'lsvr_person_single_sidebar_position', 'disable' );
			}

			// Is person archive
			else if ( lsvr_pressville_is_person() ) {
				$sidebar_position = get_theme_mod( 'lsvr_person_archive_sidebar_position', 'disable' );
			}

			return $sidebar_position;

		}
	}

	// Sidebar ID
	add_filter( 'lsvr_pressville_sidebar_id', 'lsvr_pressville_person_sidebar_id' );
	if ( ! function_exists( 'lsvr_pressville_person_sidebar_id' ) ) {
		function lsvr_pressville_person_sidebar_id( $sidebar_id ) {

			// Is person single
			if ( is_singular( 'lsvr_person' ) ) {
				$sidebar_id = get_theme_mod( 'lsvr_person_single_sidebar_id' );
			}

			// Is person archive
			else if ( lsvr_pressville_is_person() ) {
				$sidebar_id = get_theme_mod( 'lsvr_person_archive_sidebar_id' );
			}

			return $sidebar_id;

		}
	}


/**
 * META DATA
 */

	// Add post meta data
	add_action( 'lsvr_pressville_person_single_bottom', 'lsvr_pressville_add_person_single_meta' );
	if ( ! function_exists( 'lsvr_pressville_add_person_single_meta' ) ) {
		function lsvr_pressville_add_person_single_meta() { ?>

			<script type="application/ld+json">
			{
				"@context" : "http://schema.org",
				"@type" : "Person",
				"name" : "<?php the_title(); ?>"

				<?php if ( lsvr_pressville_has_person_role( get_the_ID() ) ) : ?>
				,"jobTitle" : "<?php echo esc_attr( lsvr_pressville_get_person_role( get_the_ID() ) ); ?>"
				<?php endif; ?>

				<?php if ( lsvr_pressville_has_person_email( get_the_ID() ) ) : ?>
				,"email" : "<?php echo esc_attr( lsvr_pressville_get_person_email( get_the_ID() ) ); ?>"
				<?php endif; ?>

				<?php if ( lsvr_pressville_has_person_phone( get_the_ID() ) ) : ?>
				,"telephone" : "<?php echo esc_attr( lsvr_pressville_get_person_phone( get_the_ID() ) ); ?>"
				<?php endif; ?>

				<?php if ( lsvr_pressville_has_person_website( get_the_ID() ) ) : ?>
				,"url" : "<?php echo esc_url( lsvr_pressville_get_person_website( get_the_ID() ) ); ?>"
				<?php endif; ?>

				<?php if ( lsvr_pressville_has_person_social_links( get_the_ID() ) ) : ?>
				,"sameAs" : [
					<?php $i = 1; foreach( lsvr_pressville_get_person_social_links( get_the_ID() ) as $profile => $fields ) : ?>
			    		"<?php echo esc_url( $fields['url'] ); ?>"
			    		<?php if ( $i < count( lsvr_pressville_get_person_social_links( get_the_ID() ) ) ) { echo ','; } ?>
					<?php $i++; endforeach; ?>
			  	]
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