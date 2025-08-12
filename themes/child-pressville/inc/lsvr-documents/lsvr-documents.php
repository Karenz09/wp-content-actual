<?php

// Include additional files
require_once( get_template_directory() . '/inc/lsvr-documents/classes/lsvr-pressville-document-categorized-attachments.php' );
require_once( get_template_directory() . '/inc/lsvr-documents/actions.php' );
require_once( get_template_directory() . '/inc/lsvr-documents/customizer-config.php' );
require_once( get_template_directory() . '/inc/lsvr-documents/deprecated.php' );

// Is document page
if ( ! function_exists( 'lsvr_pressville_is_document' ) ) {
	function lsvr_pressville_is_document() {

		if ( is_post_type_archive( 'lsvr_document' ) || is_tax( 'lsvr_document_cat' ) || is_tax( 'lsvr_document_tag' ) ||
			is_singular( 'lsvr_document' ) ) {
			return true;
		} else {
			return false;
		}

	}
}

// Get document archive title
if ( ! function_exists( 'lsvr_pressville_get_document_archive_title' ) ) {
	function lsvr_pressville_get_document_archive_title() {

		return get_theme_mod( 'lsvr_document_archive_title', esc_html__( 'Documents', 'pressville' ) );

	}
}

// Get document attachments
if ( ! function_exists( 'lsvr_pressville_get_document_attachments' ) ) {
	function lsvr_pressville_get_document_attachments( $post_id, $limit = 0 ) {
		if ( function_exists( 'lsvr_documents_get_document_attachments' ) ) {

			return lsvr_documents_get_document_attachments( $post_id, $limit );

		}
	}
}

// Has document attachments
if ( ! function_exists( 'lsvr_pressville_has_document_attachments' ) ) {
	function lsvr_pressville_has_document_attachments( $post_id ) {

		$attachments = lsvr_pressville_get_document_attachments( $post_id );
		return ! empty( $attachments ) ? true : false;

	}
}

// Get document attachments of current archive page
if ( ! function_exists( 'lsvr_pressville_get_document_archive_attachments' ) ) {
	function lsvr_pressville_get_document_archive_attachments() {

        // Main archive
        if ( is_post_type_archive( 'lsvr_document' ) ) {

	        $document_ids_args = array(
	        	'post_type' => 'lsvr_document',
	            'posts_per_page' => 1000,
	            'fields' => 'ids',
	            'has_password' => false,
	            'suppress_filters' => false,
	            'tax_query' => array(
	                array(
	                    'taxonomy' => 'lsvr_document_cat',
	                    'terms' => get_terms( 'lsvr_document_cat', array( 'fields' => 'ids'  ) ),
	                    'operator' => 'NOT IN',
	                )
	            ),
	        );

        }

        // Category or tag archive
        else if ( is_tax( 'lsvr_document_cat' ) || is_tax( 'lsvr_document_tag' ) ) {

        	$taxonomy = is_tax( 'lsvr_document_cat' ) ? 'lsvr_document_cat' : 'lsvr_document_tag';
	        $document_ids_args = array(
	            'posts_per_page' => 1000,
	            'post_type' => 'lsvr_document',
	            'fields' => 'ids',
	            'tax_query' => array(
	                array(
	                    'taxonomy' => $taxonomy,
	                    'terms' => get_queried_object_id(),
	                    'operator' => 'IN',
	                    'include_children' => false,
	                )
	            ),
	        );

        }

        // Order of posts
        $posts_order = get_theme_mod( 'lsvr_document_archive_attachments_order', 'default' );
        if ( 'date_asc' === $posts_order ) {
            $document_ids_args['order'] = 'ASC';
            $document_ids_args['orderby'] = 'date';
        }
        elseif ( 'date_desc' === $posts_order ) {
            $document_ids_args['order'] = 'DESC';
            $document_ids_args['orderby'] = 'date';
        }

        // Get posts
        $document_ids = get_posts( $document_ids_args );

        // Get all attachments from documents not belonging to any category
        $attachments = array();
        if ( ! empty( $document_ids ) ) {
            foreach ( $document_ids as $document_id ) {
                $document_attachments = lsvr_documents_get_document_attachments( $document_id );
                if ( ! empty( $document_attachments ) ) {
                	foreach( $document_attachments as $attachment ) {
                		array_push( $attachments, $attachment );
                	}
                }
            }
        }

        // If documents order is set to 'title', sort attachments by filename
        $attachments_order = get_theme_mod( 'lsvr_document_archive_attachments_order', 'default' );
        if ( ! empty( $attachments ) ) {

            if ( 'filename_asc' === $attachments_order ) {
                usort( $attachments, function( $a, $b ) {
                    return strcmp( $a['filename'], $b['filename'] );
                });
            }
            elseif ( 'filename_desc' === $attachments_order ) {
                usort( $attachments, function( $a, $b ) {
                    return strcmp( $b['filename'], $a['filename'] );
                });
            }
            elseif ( 'title_asc' === $attachments_order ) {
                usort( $attachments, function( $a, $b ) {
                    return strcmp( $a['title'], $b['title'] );
                });
            }
            elseif ( 'title_desc' === $attachments_order ) {
                usort( $attachments, function( $a, $b ) {
                    return strcmp( $b['title'], $a['title'] );
                });
            }

        }

        return $attachments;

	}
}

// Get categorized attachments query args
if ( ! function_exists( 'lsvr_pressville_get_document_categorized_attachments_query_args' ) ) {
	function lsvr_pressville_get_document_categorized_attachments_query_args() {

    	// Query args
    	$query_args = [
        	'taxonomy' => 'lsvr_document_cat',
        	'title_li' => '',
        	'show_option_none' => false,
        	'orderby' => 'name',
        	'order' => 'ASC',
        	'walker' => new Lsvr_Pressville_Document_Categorized_Attachments_Walker,
    	];

        // Main archive
        if ( is_post_type_archive( 'lsvr_document' ) ) {

        	// Get exluded categories
        	$excluded_categories = [];
        	if ( lsvr_pressville_is_document() && ! is_tax( 'lsvr_document_category' ) ) {
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

        	// Exclude categories
        	if ( ! empty( $excluded_categories ) ) {
        		$query_args['exclude'] = $excluded_categories;
        	}

		}

    	// Category archive
    	elseif ( is_tax( 'lsvr_document_cat' ) ) {
			$query_args['child_of'] = get_queried_object_id();
    	}

    	return $query_args;

	}
}

?>