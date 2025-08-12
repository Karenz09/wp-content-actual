<?php
/**
 * LSVR Event Calendar widget
 *
 * Display calendar with lsvr_event posts
 */
if ( ! class_exists( 'Lsvr_Widget_Event_Calendar' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Event_Calendar extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_events_event_calendar',
			'classname' => 'lsvr_event-calendar-widget',
			'title' => esc_html__( 'LSVR Event Calendar', 'lsvr-events' ),
			'description' => esc_html__( 'Calendar view of event posts', 'lsvr-events' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-events' ),
					'type' => 'text',
					'default' => esc_html__( 'Event Calendar', 'lsvr-events' ),
				),
				'location' => array(
					'label' => esc_html__( 'Location:', 'lsvr-events' ),
					'description' => esc_html__( 'Display events only from a certain location.', 'lsvr-events' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_event_location',
					'default_label' => esc_html__( 'None', 'lsvr-events' ),
				),
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-events' ),
					'description' => esc_html__( 'Display events only from a certain category.', 'lsvr-events' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_event_cat',
					'default_label' => esc_html__( 'None', 'lsvr-events' ),
				),
				'split_multiday' => array(
					'label' => esc_html__( 'Split Multiday Events', 'lsvr-events' ),
					'description' => esc_html__( 'Display multiday events under each day of the event duration.', 'lsvr-events' ),
					'type' => 'checkbox',
					'default' => false,
				),
				'year_month' => array(
					'label' => esc_html__( 'Calendar Month:', 'lsvr-events' ),
					'description' => esc_html__( 'Display a specific month. Use "YYYY-MM" format. For example: 2020-08 for August 2020. Leave blank if you want to use the current month.', 'lsvr-events' ),
					'type' => 'text',
					'default' => '',
				),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-events' ),
					'description' => esc_html__( 'Link to event post archive. Leave blank to hide.', 'lsvr-events' ),
					'type' => 'text',
					'default' => esc_html__( 'More Events', 'lsvr-events' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	$query_args = array();

		// Set location
		if ( ! empty( $instance['location'] ) && 'none' !== $instance['location'] ) {
			$query_args['location'] = $instance['location'];
		}

		// Set category
		if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {
			$query_args['category'] = $instance['category'];
		}

    	// Split multiday
    	$query_args['split_multiday_events'] = ! empty( $instance['split_multiday'] ) && ( true === $instance['split_multiday'] || 'true' === $instance['split_multiday'] || '1' === $instance['split_multiday'] ) ? true : false;

    	// Parse month
    	if ( ! empty( $instance[ 'year_month' ] ) ) {
    		$year_month = explode( '-', $instance[ 'year_month' ] );
    		$year = ! empty( $year_month[0] ) && is_numeric( $year_month[0] ) ? (int) $year_month[0] : false;
    		$month = ! empty( $year_month[1] ) && is_numeric( $year_month[1] ) ? (int) $year_month[1] : false;
		} else {
			$year = current_time( 'Y' );
    		$month = current_time( 'm' );
		}

    	// Set specific month
		$query_args['year'] = $year;
		$query_args['month'] = $month;

		// Get weekdays
		$weekdays = array(
			esc_html__( 'Sun', 'lsvr-events' ),
			esc_html__( 'Mon', 'lsvr-events' ),
			esc_html__( 'Tue', 'lsvr-events' ),
			esc_html__( 'Wed', 'lsvr-events' ),
			esc_html__( 'Thu', 'lsvr-events' ),
			esc_html__( 'Fri', 'lsvr-events' ),
			esc_html__( 'Sat', 'lsvr-events' ),
		);
    	$start_of_week = get_option( 'start_of_week' );
    	$weekdays = $start_of_week > 0 ? array_merge( array_slice( $weekdays, $start_of_week, count( $weekdays ) - $start_of_week ), array_slice( $weekdays, 0, $start_of_week ) ) : $weekdays;

		// Get event calendar
    	$event_calendar = lsvr_events_get_event_calendar( $query_args );

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
  			'calendar' => $event_calendar,
  			'year' => $year,
  			'month' => $month,
  			'weekdays' => $weekdays,
  			'unique_id' => rand( 1111, 9999 ),
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_event_calendar_template_path', 'lsvr-events/templates/widgets/event-calendar.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>