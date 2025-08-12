<?php
/**
 * LSVR Event locations widget
 *
 * Display list of lsvr_event_location tax terms
 */
if ( ! class_exists( 'Lsvr_Widget_Event_Locations' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Event_Locations extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_events_event_locations',
			'classname' => 'lsvr_event-locations-widget',
			'title' => esc_html__( 'LSVR Event Locations', 'lsvr-events' ),
			'description' => esc_html__( 'List of Event Locations', 'lsvr-events' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-events' ),
					'type' => 'text',
					'default' => esc_html__( 'Event Locations', 'lsvr-events' ),
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
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_event_locations_template_path', 'lsvr-events/templates/widgets/event-locations.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>