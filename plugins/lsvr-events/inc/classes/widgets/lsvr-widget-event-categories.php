<?php
/**
 * LSVR Event categories widget
 *
 * Display list of lsvr_event_cat tax terms
 */
if ( ! class_exists( 'Lsvr_Widget_Event_Categories' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Event_Categories extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_events_event_categories',
			'classname' => 'lsvr_event-categories-widget',
			'title' => esc_html__( 'LSVR Event Categories', 'lsvr-events' ),
			'description' => esc_html__( 'List of Event categories', 'lsvr-events' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-events' ),
					'type' => 'text',
					'default' => esc_html__( 'Event Categories', 'lsvr-events' ),
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
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_event_categories_template_path', 'lsvr-events/templates/widgets/event-categories.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>