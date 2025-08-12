<?php
/**
 * LSVR Document Attachments widget
 *
 * Display list of lsvr_document attachments
 */
if ( ! class_exists( 'Lsvr_Widget_Document_Attachments' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Document_Attachments extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_documents_document_attachments',
			'classname' => 'lsvr_document-attachments-widget',
			'title' => esc_html__( 'LSVR Document Attachments', 'lsvr-documents' ),
			'description' => esc_html__( 'List of Document Attachments', 'lsvr-documents' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-documents' ),
					'type' => 'text',
					'default' => esc_html__( 'Attachments', 'lsvr-documents' ),
				),
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-documents' ),
					'description' => esc_html__( 'Display only attachments from a certain category.', 'lsvr-documents' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_document_cat',
					'default_label' => esc_html__( 'None', 'lsvr-documents' ),
				),
				'tags' => array(
					'label' => esc_html__( 'Tags:', 'lsvr-documents' ),
					'description' => esc_html__( 'Display only attachments which contain certain tags. Separate tag slugs by comma.', 'lsvr-documents' ),
					'type' => 'text',
				),
				'limit' => array(
					'label' => esc_html__( 'Limit:', 'lsvr-documents' ),
					'description' => esc_html__( 'Number of attachments to display.', 'lsvr-documents' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-documents' ), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					'default' => 4,
				),
				'show_attachment_titles' => array(
					'label' => esc_html__( 'Display Attachment Titles', 'lsvr-documents' ),
					'description' => esc_html__( 'Display titles instead of file names. You can edit titles under Media.', 'lsvr-documents' ),
					'type' => 'checkbox',
					'default' => 'false',
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

    	// Show attachment titles
    	$show_attachment_titles = ! empty( $instance['show_attachment_titles'] ) && ( true === $instance['show_attachment_titles'] || 'true' === $instance['show_attachment_titles'] || '1' === $instance['show_attachment_titles'] ) ? true : false;

		// Set posts limit
		$limit = array_key_exists( 'limit', $instance ) && (int) $instance[ 'limit' ] > 0 ? $instance[ 'limit' ] : 1000;

    	// Get document posts
    	$query_args = array(
    		'post_type' => 'lsvr_document',
    		'posts_per_page' => $limit,
    		'has_password' => false,
    		'suppress_filters' => false,
		);

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
  			'show_attachment_titles' => $show_attachment_titles,
  			'limit' => $limit,
  			'document_posts' => $posts,
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_document_attachments_template_path', 'lsvr-documents/templates/widgets/document-attachments.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>