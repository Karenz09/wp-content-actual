<?php
/**
 * LSVR Listing categories widget
 *
 * Display list of lsvr_listing_cat tax terms
 */
if ( ! class_exists( 'Lsvr_Widget_Listing_Categories' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Listing_Categories extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_directory_listing_categories',
			'classname' => 'lsvr_listing-categories-widget',
			'title' => esc_html__( 'LSVR Directory Listing Categories', 'lsvr-directory' ),
			'description' => esc_html__( 'List of Listing categories', 'lsvr-directory' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-directory' ),
					'type' => 'text',
					'default' => esc_html__( 'Listing Categories', 'lsvr-directory' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_listing_categories_template_path', 'lsvr-directory/templates/widgets/listing-categories.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>