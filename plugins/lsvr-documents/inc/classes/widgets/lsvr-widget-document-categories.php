<?php
/**
 * LSVR Document categories widget
 *
 * Display list of lsvr_document_cat tax terms
 */
if ( ! class_exists( 'Lsvr_Widget_Document_Categories' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Document_Categories extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_documents_document_categories',
			'classname' => 'lsvr_document-categories-widget',
			'title' => esc_html__( 'LSVR Document Categories', 'lsvr-documents' ),
			'description' => esc_html__( 'List of Document categories', 'lsvr-documents' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-documents' ),
					'type' => 'text',
					'default' => esc_html__( 'Document Categories', 'lsvr-documents' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Prepare excluded categories
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

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
  			'excluded_categories' => $excluded_categories,
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_document_categories_template_path', 'lsvr-documents/templates/widgets/document-categories.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>