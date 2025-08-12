<?php

/**
 * GENERAL
 */

	// Set current post type
	add_filter( 'lsvr_pressville_current_post_type', 'lsvr_pressville_document_set_current_post_type' );
	if ( ! function_exists( 'lsvr_pressville_document_set_current_post_type' ) ) {
		function lsvr_pressville_document_set_current_post_type( $post_type ) {

			if ( lsvr_pressville_is_document() ) {
				return 'lsvr_document';
			}
			return $post_type;

		}
	}

	// Get post category taxonomy
	add_filter( 'lsvr_pressville_post_category_taxonomy', 'lsvr_pressville_document_category_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_document_category_taxonomy' ) ) {
		function lsvr_pressville_document_category_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_document() ) {
				return 'lsvr_document_cat';
			}

			return $taxonomy;

		}
	}

	// Get post tag taxonomy
	add_filter( 'lsvr_pressville_post_tag_taxonomy', 'lsvr_pressville_document_tag_taxonomy' );
	if ( ! function_exists( 'lsvr_pressville_document_tag_taxonomy' ) ) {
		function lsvr_pressville_document_tag_taxonomy( $taxonomy ) {

			if ( lsvr_pressville_is_document() ) {
				return 'lsvr_document_tag';
			}

			return $taxonomy;

		}
	}

	// Document title
	add_filter( 'document_title_parts', 'lsvr_pressville_document_title' );
	if ( ! function_exists( 'lsvr_pressville_document_title' ) ) {
		function lsvr_pressville_document_title( $title ) {

			if ( is_post_type_archive( 'lsvr_document' ) ) {
				$title['title'] = sanitize_text_field( lsvr_pressville_get_document_archive_title() );
			}
			return $title;

		}
	}


/**
 * CORE
 */

	// Archive layout
	add_filter( 'lsvr_pressville_document_archive_layout', 'lsvr_pressville_document_archive_layout' );
	if ( ! function_exists( 'lsvr_pressville_document_archive_layout' ) ) {
		function lsvr_pressville_document_archive_layout() {

			$path_prefix = 'template-parts/lsvr_document/archive-layout-';

			// Get layout from Customizer
			if ( ! empty( locate_template( $path_prefix . get_theme_mod( 'lsvr_document_archive_layout', 'default' ) . '.php' ) ) ) {
				return get_theme_mod( 'lsvr_document_archive_layout', 'default' );
			}

			// Default layout
			else {
				return 'default';
			}

		}
	}

	// Main header title
	add_filter( 'lsvr_pressville_main_header_title', 'lsvr_pressville_document_main_header_title' );
	if ( ! function_exists( 'lsvr_pressville_document_main_header_title' ) ) {
		function lsvr_pressville_document_main_header_title( $title ) {

			if ( is_post_type_archive( 'lsvr_document' ) ) {
				$title = lsvr_pressville_get_document_archive_title();
			}

			return $title;

		}
	}

	// Add lsvr_document to search filter
	add_filter( 'lsvr_pressville_header_search_filter', 'lsvr_pressville_document_search_filter' );
	if ( ! function_exists( 'lsvr_pressville_document_search_filter' ) ) {
		function lsvr_pressville_document_search_filter( $filter ) {

			$filter = array_merge( $filter, array(
				array(
					'name' => 'lsvr_document',
					'label' => esc_html__( 'documents', 'pressville' ),
				),
			));
			return $filter;

		}
	}

	// Breadcrumbs
	add_filter( 'lsvr_pressville_add_to_breadcrumbs', 'lsvr_pressville_document_breadcrumbs' );
	if ( ! function_exists( 'lsvr_pressville_document_breadcrumbs' ) ) {
		function lsvr_pressville_document_breadcrumbs( $breadcrumbs ) {

			if ( lsvr_pressville_is_document() && ! is_post_type_archive( 'lsvr_document' ) ) {
				$breadcrumbs = array(
					array(
						'url' => get_post_type_archive_link( 'lsvr_document' ),
						'label' => lsvr_pressville_get_document_archive_title(),
					),
				);
			}
			return $breadcrumbs;

		}
	}

	// Archive pre_get_posts actions
	add_action( 'pre_get_posts', 'lsvr_pressville_document_archive_pre_get_posts' );
	if ( ! function_exists( 'lsvr_pressville_document_archive_pre_get_posts' ) ) {
		function lsvr_pressville_document_archive_pre_get_posts( $query ) {
			if ( ! is_admin() && $query->is_main_query() && ( $query->is_post_type_archive( 'lsvr_document' ) ||
				$query->is_tax( 'lsvr_document_cat' ) || $query->is_tax( 'lsvr_document_tag' ) ) ) {

				// Posts per page
				if ( 0 === (int) get_theme_mod( 'lsvr_document_archive_posts_per_page', 20 ) ) {
					$query->set( 'posts_per_page', 1000 );
				} else {
					$query->set( 'posts_per_page', esc_attr( get_theme_mod( 'lsvr_document_archive_posts_per_page', 20 ) ) );
				}

				// Order
				$order = get_theme_mod( 'lsvr_document_archive_posts_order', 'default' );
				if ( 'date_asc' === $order ) {
					$query->set( 'orderby', 'date' );
					$query->set( 'order', 'ASC' );
				}
				elseif ( 'date_desc' === $order ) {
					$query->set( 'orderby', 'date' );
					$query->set( 'order', 'DESC' );
				}
				elseif ( 'title_asc' === $order ) {
					$query->set( 'orderby', 'title' );
					$query->set( 'order', 'ASC' );
				}
				elseif ( 'title_desc' === $order ) {
					$query->set( 'orderby', 'title' );
					$query->set( 'order', 'DESC' );
				}
				else if ( 'random' === $order ) {
					$query->set( 'orderby', 'rand' );
				}

				// Exclude posts from certain categories
				if ( ! $query->is_tax( 'lsvr_document_cat' ) ) {

		    		$excluded_categories = array();
		    		$excluded_categories_data = get_theme_mod( 'lsvr_document_excluded_categories', '' );
		    		if ( ! empty( $excluded_categories_data ) ) {
		    			$excluded_categories_arr = array_map( 'trim', explode( ',', $excluded_categories_data ) );
		    			foreach ( $excluded_categories_arr as $excluded ) {
		    				if ( is_numeric( $excluded ) ) {
		    					array_push( $excluded_categories, (int) $excluded );
		    				} else {
		    					 $term = get_term_by( 'slug', $excluded, 'lsvr_document_cat' );
		    					 if ( ! empty( $term->term_id ) ) {
		    					 	array_push( $excluded_categories, $term->term_id );
		    					 }
		    				}
		    			}
		    		}
		    		if ( ! empty( $excluded_categories ) ) {
						$query->set( 'tax_query', array(
							array(
								'taxonomy' => 'lsvr_document_cat',
								'field' => 'term_id',
								'terms' => $excluded_categories,
								'operator' => 'NOT IN',
							)
						));
		    		}

	    		}

			}
		}
	}

	// Exclude categories from archive category list
	add_filter( 'lsvr_pressville_post_archive_categories_excluded', 'lsvr_pressville_document_post_archive_categories_excluded' );
	if ( ! function_exists( 'lsvr_pressville_document_post_archive_categories_excluded' ) ) {
		function lsvr_pressville_document_post_archive_categories_excluded() {

			$excluded_categories = array();

			if ( lsvr_pressville_is_document() ) {

				$excluded_categories_data = get_theme_mod( 'lsvr_document_excluded_categories', '' );
	    		if ( ! empty( $excluded_categories_data ) ) {
	    			$excluded_categories_arr = array_map( 'trim', explode( ',', $excluded_categories_data ) );
	    			foreach ( $excluded_categories_arr as $excluded ) {
	    				if ( is_numeric( $excluded ) ) {
	    					array_push( $excluded_categories, (int) $excluded );
	    				} else {
	    					 $term = get_term_by( 'slug', $excluded, 'lsvr_document_cat' );
	    					 if ( ! empty( $term->term_id ) ) {
	    					 	array_push( $excluded_categories, $term->term_id );
	    					 }
	    				}
	    			}
	    		}

			}

			return $excluded_categories;

		}
	}

	// Enable archive categories
	add_filter( 'lsvr_pressville_post_archive_categories_enable', 'lsvr_pressville_document_archive_categories_enable' );
	if ( ! function_exists( 'lsvr_pressville_document_archive_categories_enable' ) ) {
		function lsvr_pressville_document_archive_categories_enable( $enabled ) {

			if ( lsvr_pressville_is_document() && true === get_theme_mod( 'lsvr_document_archive_categories_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post date on archive
	add_filter( 'lsvr_pressville_post_archive_post_meta_date_enable', 'lsvr_pressville_document_archive_post_meta_date_enable' );
	if ( ! function_exists( 'lsvr_pressville_document_archive_post_meta_date_enable' ) ) {
		function lsvr_pressville_document_archive_post_meta_date_enable( $enabled ) {

			if ( lsvr_pressville_is_document() && true === get_theme_mod( 'lsvr_document_archive_date_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post author on archive
	add_filter( 'lsvr_pressville_post_archive_post_meta_author_enable', 'lsvr_pressville_document_archive_post_meta_author_enable' );
	if ( ! function_exists( 'lsvr_pressville_document_archive_post_meta_author_enable' ) ) {
		function lsvr_pressville_document_archive_post_meta_author_enable( $enabled ) {


			if ( lsvr_pressville_is_document() && true === get_theme_mod( 'lsvr_document_archive_author_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post date on detail
	add_filter( 'lsvr_pressville_post_single_post_meta_date_enable', 'lsvr_pressville_document_single_post_meta_date_enable' );
	if ( ! function_exists( 'lsvr_pressville_document_single_post_meta_date_enable' ) ) {
		function lsvr_pressville_document_single_post_meta_date_enable( $enabled ) {

			if ( lsvr_pressville_is_document() && true === get_theme_mod( 'lsvr_document_single_date_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Enable post author on detail
	add_filter( 'lsvr_pressville_post_single_post_meta_author_enable', 'lsvr_pressville_document_single_post_meta_author_enable' );
	if ( ! function_exists( 'lsvr_pressville_document_single_post_meta_author_enable' ) ) {
		function lsvr_pressville_document_single_post_meta_author_enable( $enabled ) {

			if ( lsvr_pressville_is_document() && true === get_theme_mod( 'lsvr_document_single_author_enable', true ) ) {
				return true;
			}

			return $enabled;

		}
	}

	// Sidebar position
	add_filter( 'lsvr_pressville_sidebar_position', 'lsvr_pressville_document_sidebar_position' );
	if ( ! function_exists( 'lsvr_pressville_document_sidebar_position' ) ) {
		function lsvr_pressville_document_sidebar_position( $sidebar_position ) {

			// Is document single
			if ( is_singular( 'lsvr_document' ) ) {
				$sidebar_position = get_theme_mod( 'lsvr_document_single_sidebar_position', 'disable' );
			}

			// Is document archive
			else if ( lsvr_pressville_is_document() ) {
				$sidebar_position = get_theme_mod( 'lsvr_document_archive_sidebar_position', 'disable' );
			}

			return $sidebar_position;

		}
	}

	// Sidebar ID
	add_filter( 'lsvr_pressville_sidebar_id', 'lsvr_pressville_document_sidebar_id' );
	if ( ! function_exists( 'lsvr_pressville_document_sidebar_id' ) ) {
		function lsvr_pressville_document_sidebar_id( $sidebar_id ) {

			// Is document single
			if ( is_singular( 'lsvr_document' ) ) {
				$sidebar_id = get_theme_mod( 'lsvr_document_single_sidebar_id' );
			}

			// Is document archive
			else if ( lsvr_pressville_is_document() ) {
				$sidebar_id = get_theme_mod( 'lsvr_document_archive_sidebar_id' );
			}

			return $sidebar_id;

		}
	}


/**
 * META DATA
 */

	// Add post meta data
	add_action( 'lsvr_pressville_document_single_bottom', 'lsvr_pressville_add_document_single_meta' );
	if ( ! function_exists( 'lsvr_pressville_add_document_single_meta' ) ) {
		function lsvr_pressville_add_document_single_meta() { ?>

			<script type="application/ld+json">
			{
				"@context" : "http://schema.org",
				"@type" : "DataCatalog",
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

			 	<?php if ( lsvr_pressville_has_post_terms( get_the_ID(), 'lsvr_document_tag' ) ) : ?>
				,"keywords": "<?php echo esc_attr( implode( ',', lsvr_pressville_get_post_term_names( get_the_ID(), 'lsvr_document_tag' ) ) ); ?>"
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

			 	<?php if ( lsvr_pressville_has_document_attachments( get_the_ID() ) ) : ?>
			 		,"associatedMedia" : [
			 		<?php $i = 1; foreach ( lsvr_pressville_get_document_attachments( get_the_ID() ) as $attachment ) : ?>
						{
				 			"@type" : "DataDownload",
				 			"url" : "<?php echo esc_url( $attachment['url'] ); ?>"
				 		}<?php if ( $i < count( lsvr_pressville_get_document_attachments( get_the_ID() ) ) ) { echo ','; } ?>
			 		<?php $i++; endforeach; ?>
			 		]
			 	<?php endif; ?>

			}
			</script>

		<?php }
	}

?>