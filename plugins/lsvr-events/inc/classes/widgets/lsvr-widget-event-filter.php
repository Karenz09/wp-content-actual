<?php
/**
 * LSVR Event Filter widget
 *
 * Display list form for filtering lsvr_event posts
 */
if ( ! class_exists( 'Lsvr_Widget_Event_Filter' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Event_Filter extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_events_event_filter',
			'classname' => 'lsvr_event-filter-widget',
			'title' => esc_html__( 'LSVR Event Filter', 'lsvr-events' ),
			'description' => esc_html__( 'Filter event posts', 'lsvr-events' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-events' ),
					'type' => 'text',
					'default' => esc_html__( 'Filter Events', 'lsvr-events' ),
				),
				'submit_label' => array(
					'label' => esc_html__( 'Submit Button Label:', 'lsvr-events' ),
					'type' => 'text',
					'default' => esc_html__( 'Filter', 'lsvr-events' ),
				),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-events' ),
					'description' => esc_html__( 'Link to event post archive. Leave blank to hide.', 'lsvr-events' ),
					'type' => 'text',
					'default' => esc_html__( 'All Events', 'lsvr-events' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

		// Get filter form action
		if ( is_tax( 'lsvr_event_cat' ) || is_tax( 'lsvr_event_tag' ) || is_tax( 'lsvr_event_location' ) ) {
			$taxonomy = get_query_var( 'taxonomy' );
			$form_action = get_term_link( get_queried_object_id(), $taxonomy );
		} else {
			$form_action = get_post_type_archive_link( 'lsvr_event' );
		}

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
  			'form_action' => $form_action,
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_event_filter_template_path', 'lsvr-events/templates/widgets/event-filter.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>