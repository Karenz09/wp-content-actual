<?php
/**
 * LSVR Notice categories widget
 *
 * Display list of lsvr_notice_cat tax terms
 */
if ( ! class_exists( 'Lsvr_Widget_Notice_Categories' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Notice_Categories extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_notices_notice_categories',
			'classname' => 'lsvr_notice-categories-widget',
			'title' => esc_html__( 'LSVR Notice Categories', 'lsvr-notices' ),
			'description' => esc_html__( 'List of Notice Post categories', 'lsvr-notices' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-notices' ),
					'type' => 'text',
					'default' => esc_html__( 'Notice Categories', 'lsvr-notices' ),
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
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_notice_categories_template_path', 'lsvr-notices/templates/widgets/notice-categories.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>