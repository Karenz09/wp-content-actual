<?php
/**
 * LSVR Gallery categories widget
 *
 * Display list of lsvr_gallery_cat tax terms
 */
if ( ! class_exists( 'Lsvr_Widget_Gallery_Categories' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Gallery_Categories extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_galleries_gallery_categories',
			'classname' => 'lsvr_gallery-categories-widget',
			'title' => esc_html__( 'LSVR Gallery Categories', 'lsvr-galleries' ),
			'description' => esc_html__( 'List of Gallery categories', 'lsvr-galleries' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-galleries' ),
					'type' => 'text',
					'default' => esc_html__( 'Gallery Categories', 'lsvr-galleries' ),
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
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_gallery_categories_template_path', 'lsvr-galleries/templates/widgets/gallery-categories.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>