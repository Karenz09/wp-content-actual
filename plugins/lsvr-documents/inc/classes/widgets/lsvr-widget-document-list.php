<?php
/**
 * LSVR Documents widget
 *
 * Display list of lsvr_document posts
 */
if ( ! class_exists( 'Lsvr_Widget_Document_List' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Document_List extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_documents_document_list',
			'classname' => 'lsvr_document-list-widget',
			'title' => esc_html__( 'LSVR Documents', 'lsvr-documents' ),
			'description' => esc_html__( 'List of Document posts', 'lsvr-documents' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-documents' ),
					'type' => 'text',
					'default' => esc_html__( 'Documents', 'lsvr-documents' ),
				),
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-documents' ),
					'description' => esc_html__( 'Display only documents from a certain category.', 'lsvr-documents' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_document_cat',
					'default_label' => esc_html__( 'None', 'lsvr-documents' ),
				),
				'tags' => array(
					'label' => esc_html__( 'Tags:', 'lsvr-documents' ),
					'description' => esc_html__( 'Display only documents which contain certain tags. Separate tag slugs by comma.', 'lsvr-documents' ),
					'type' => 'text',
				),
				'limit' => array(
					'label' => esc_html__( 'Limit:', 'lsvr-documents' ),
					'description' => esc_html__( 'Number of documents to display.', 'lsvr-documents' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-documents' ), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					'default' => 4,
				),
				'order' => array(
					'label' => esc_html__( 'Order:', 'lsvr-documents' ),
					'description' => esc_html__( 'Order of document posts.', 'lsvr-documents' ),
					'type' => 'select',
					'choices' => array(
						'default' => esc_html__( 'Default', 'lsvr-documents' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-documents' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-documents' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-documents' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-documents' ),
                        'random' => esc_html__( 'Random', 'lsvr-documents' ),
					),
					'default' => 'default',
				),
				'show_date' => array(
					'label' => esc_html__( 'Display Date', 'lsvr-documents' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_attachment_count' => array(
					'label' => esc_html__( 'Display Attachment Count', 'lsvr-documents' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-documents' ),
					'description' => esc_html__( 'Link to document post archive. Leave blank to hide.', 'lsvr-documents' ),
					'type' => 'text',
					'default' => esc_html__( 'More Documents', 'lsvr-documents' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Show date
    	$show_date = ! empty( $instance['show_date'] ) && ( true === $instance['show_date'] || 'true' === $instance['show_date'] || '1' === $instance['show_date'] ) ? true : false;

    	// Show attachment count
    	$show_attachment_count = ! empty( $instance['show_attachment_count'] ) && ( true === $instance['show_attachment_count'] || 'true' === $instance['show_attachment_count'] || '1' === $instance['show_attachment_count'] ) ? true : false;

		// Set posts limit
		$limit = array_key_exists( 'limit', $instance ) && (int) $instance[ 'limit' ] > 0 ? $instance[ 'limit' ] : 1000;

    	// Get document posts
    	$query_args = array(
    		'post_type' => 'lsvr_document',
    		'posts_per_page' => $limit,
    		'suppress_filters' => false,
		);

		// Posts order
		if ( ! empty( $instance['order'] ) && 'default' !== $instance['order'] ) {
			if ( 'date_desc' == $instance['order'] ) {
				$query_args['orderby'] = 'date';
				$query_args['order'] = 'DESC';
			}
			elseif ( 'date_asc' == $instance['order'] ) {
				$query_args['orderby'] = 'date';
				$query_args['order'] = 'ASC';
			}
			elseif ( 'title_asc' == $instance['order'] ) {
				$query_args['orderby'] = 'title';
				$query_args['order'] = 'ASC';
			}
			elseif ( 'title_desc' == $instance['order'] ) {
				$query_args['orderby'] = 'title';
				$query_args['order'] = 'DESC';
			}
			elseif ( 'random' == $instance['order'] ) {
				$query_args['orderby'] = 'rand';
			}
		}

    	// Show posts only from a certain category
		if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'lsvr_document_cat',
					'field' => 'term_id',
					'terms' => $instance['category'],
				),
			);
		}

		// Exclude posts from certain categories
		else {
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
				$query_args[ 'tax_query' ] = array(
					array(
						'taxonomy' => 'lsvr_document_cat',
						'field' => 'term_id',
						'terms' => $excluded_categories,
						'operator' => 'NOT IN',
					),
				);
			}
		}

    	// Show posts only with certain tags
		if ( ! empty( $instance['tags'] ) ) {

			$tags_tax_query = array(
				array(
					'taxonomy' => 'lsvr_document_tag',
					'field' => 'slug',
					'terms' => array_map( 'trim', explode( ',', $instance['tags'] ) ),
				),
			);

			if ( ! empty( $query_args['tax_query'] ) ) {
				$query_args['tax_query'] = array_merge( $query_args['tax_query'], $tags_tax_query );
			} else {
				$query_args['tax_query'] = $tags_tax_query;
			}

		}

    	$posts = get_posts( $query_args );

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
  			'show_date' => $show_date,
  			'show_attachment_count' => $show_attachment_count,
  			'document_posts' => $posts,
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_document_list_template_path', 'lsvr-documents/templates/widgets/document-list.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>