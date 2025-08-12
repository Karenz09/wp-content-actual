<?php
/**
 * LSVR Person categories widget
 *
 * Display list of lsvr_person_cat tax terms
 */
if ( ! class_exists( 'Lsvr_Widget_Person_Categories' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Person_Categories extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_people_person_categories',
			'classname' => 'lsvr_person-categories-widget',
			'title' => esc_html__( 'LSVR Person Categories', 'lsvr-people' ),
			'description' => esc_html__( 'List of Person Post categories', 'lsvr-people' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-people' ),
					'type' => 'text',
					'default' => esc_html__( 'Person Categories', 'lsvr-people' ),
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
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_person_categories_template_path', 'lsvr-people/templates/widgets/person-categories.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>