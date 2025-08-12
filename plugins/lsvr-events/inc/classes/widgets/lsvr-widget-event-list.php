<?php
/**
 * LSVR Events widget
 *
 * Display list of lsvr_event posts
 */
if ( ! class_exists( 'Lsvr_Widget_Event_List' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Event_List extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_events_event_list',
			'classname' => 'lsvr_event-list-widget',
			'title' => esc_html__( 'LSVR Events', 'lsvr-events' ),
			'description' => esc_html__( 'List of Event posts', 'lsvr-events' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-events' ),
					'type' => 'text',
					'default' => esc_html__( 'Upcoming Events', 'lsvr-events' ),
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
				'limit' => array(
					'label' => esc_html__( 'Limit:', 'lsvr-events' ),
					'description' => esc_html__( 'Number of events to display.', 'lsvr-events' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-events' ), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					'default' => 4,
				),
                'bold_date' => array(
                    'label' => esc_html__( 'Bold Date', 'lsvr-events' ),
                    'description' => esc_html__( 'Display date in more graphical style. Thumbnail image won\'t be displayed.', 'lsvr-events' ),
                    'type' => 'checkbox',
                    'default' => 'false',
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

    	// Bold date
    	$bold_date = ! empty( $instance['bold_date'] ) && ( true === $instance['bold_date'] || 'true' === $instance['bold_date'] || '1' === $instance['bold_date'] ) ? true : false;

    	// Get posts
    	$query_args = array(
    		'period' => 'future',
			'orderby' => 'start',
			'to_return' => 'occurrences',
    		'limit' => array_key_exists( 'limit', $instance ) ? $instance[ 'limit' ] : 4,
		);
		if ( ! empty( $instance['location'] ) && 'none' !== $instance['location'] ) {
			$query_args['location'] = $instance['location'];
		}
		if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {
			$query_args['category'] = $instance['category'];
		}
    	$posts = lsvr_events_get( $query_args );

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
  			'bold_date' => $bold_date,
  			'event_posts' => $posts,
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_event_list_template_path', 'lsvr-events/templates/widgets/event-list.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>