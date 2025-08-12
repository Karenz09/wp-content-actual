<?php
/**
 * LSVR Featured Document widget
 *
 * Single lsvr_document post
 */
if ( ! class_exists( 'Lsvr_Widget_Document_Featured' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Document_Featured extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_documents_document_featured',
			'classname' => 'lsvr_document-featured-widget',
			'title' => esc_html__( 'LSVR Featured Document', 'lsvr-documents' ),
			'description' => esc_html__( 'Single Document post', 'lsvr-documents' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-documents' ),
					'type' => 'text',
					'default' => esc_html__( 'Featured Document', 'lsvr-documents' ),
				),
				'post' => array(
					'label' => esc_html__( 'Document:', 'lsvr-documents' ),
					'description' => esc_html__( 'Choose document to display.', 'lsvr-documents' ),
					'type' => 'post',
					'post_type' => 'lsvr_document',
					'default_label' => esc_html__( 'Random', 'lsvr-documents' ),
				),
				'show_date' => array(
					'label' => esc_html__( 'Display Date', 'lsvr-documents' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_category' => array(
					'label' => esc_html__( 'Display Category', 'lsvr-documents' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_excerpt' => array(
					'label' => esc_html__( 'Display Excerpt', 'lsvr-documents' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_attachments' => array(
					'label' => esc_html__( 'Display Attachments', 'lsvr-documents' ),
					'type' => 'checkbox',
					'default' => 'true',
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

    	// Show date
    	$show_date = ! empty( $instance['show_date'] ) && ( true === $instance['show_date'] || 'true' === $instance['show_date'] || '1' === $instance['show_date'] ) ? true : false;

    	// Show category
    	$show_category = ! empty( $instance['show_category'] ) && ( true === $instance['show_category'] || 'true' === $instance['show_category'] || '1' === $instance['show_category'] ) ? true : false;

		// Show excerpt
    	$show_excerpt = ! empty( $instance['show_excerpt'] ) && ( true === $instance['show_excerpt'] || 'true' === $instance['show_excerpt'] || '1' === $instance['show_excerpt'] ) ? true : false;

		// Show attachments
    	$show_attachments = ! empty( $instance['show_attachments'] ) && ( true === $instance['show_attachments'] || 'true' === $instance['show_attachments'] || '1' === $instance['show_attachments'] ) ? true : false;

		// Show attachment title
    	$show_attachment_titles = ! empty( $instance['show_attachment_titles'] ) && ( true === $instance['show_attachment_titles'] || 'true' === $instance['show_attachment_titles'] || '1' === $instance['show_attachment_titles'] ) ? true : false;

    	// Get random post
    	if ( empty( $instance['post'] ) || ( ! empty( $instance['post'] ) && 'none' === $instance['post'] ) ) {
    		$document_post = get_posts( array(
    			'post_type' => 'lsvr_document',
    			'orderby' => 'rand',
    			'posts_per_page' => '1'
			));
			$document_post = ! empty( $document_post[0] ) ? $document_post[0] : '';
    	}

    	// Get post
    	else if ( ! empty( $instance['post'] ) ) {
    		$document_post = get_post( $instance['post'] );
    	}

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
  			'show_date' => $show_date,
  			'show_category' => $show_category,
  			'show_excerpt' => $show_excerpt,
  			'show_attachments' => $show_attachments,
  			'show_attachment_titles' => $show_attachment_titles,
  			'document_post' => ! empty( $document_post ) ? $document_post : '',
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_document_featured_template_path', 'lsvr-documents/templates/widgets/document-featured.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>