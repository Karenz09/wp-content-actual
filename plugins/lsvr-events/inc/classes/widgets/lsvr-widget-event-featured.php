<?php
/**
 * LSVR Featured Event widget
 *
 * Display single lsvr_event posts
 */
if ( ! class_exists( 'Lsvr_Widget_Event_Featured' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Event_Featured extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_events_event_featured',
			'classname' => 'lsvr_event-featured-widget',
			'title' => esc_html__( 'LSVR Featured Event', 'lsvr-events' ),
			'description' => esc_html__( 'Single Event post', 'lsvr-events' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-events' ),
					'type' => 'text',
					'default' => esc_html__( 'Featured Event', 'lsvr-events' ),
				),
				'post' => array(
					'label' => esc_html__( 'Event:', 'lsvr-events' ),
					'description' => esc_html__( 'Choose event to display.', 'lsvr-events' ),
					'type' => 'post',
					'post_type' => 'lsvr_event',
                    'default_label' => esc_html__( 'Random', 'lsvr-events' ),
				),
                'show_excerpt' => array(
                    'label' => esc_html__( 'Display Excerpt', 'lsvr-events' ),
                    'type' => 'checkbox',
                    'default' => 'true',
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

        // Show excerpt
        $show_excerpt = ! empty( $instance['show_excerpt'] ) && ( true === $instance['show_excerpt'] || 'true' === $instance['show_excerpt'] || '1' === $instance['show_excerpt'] ) ? true : false;

        // Get random post
        if ( empty( $instance['post'] ) || ( ! empty( $instance['post'] ) && 'none' === $instance['post'] ) ) {

            // Try to get an upcoming random event
            $event_ids = lsvr_events_get( array(
                'period' => 'future',
                'to_return' => array( 'event_id' ),
            ));

            if ( ! empty( $event_ids['event_id'] ) ) {

                $random_index = array_rand( $event_ids['event_id'] );
                $event_post = get_post( $event_ids['event_id'][ $random_index ] );

            }

            // If no upcoming event found, get any event
            if ( empty( $event_post ) ) {

                $event_post = get_posts( array(
                    'post_type' => 'lsvr_event',
                    'orderby' => 'rand',
                    'posts_per_page' => '1',
                ));
                $event_post = ! empty( $event_post[0] ) ? $event_post[0] : '';

            }

        }

        // Get post
        else if ( ! empty( $instance['post'] ) ) {
            $event_post = get_post( $instance['post'] );
        }

        // Prepare template vars
        global $lsvr_template_vars;
        $lsvr_template_vars = array(
            'instance' => $instance,
            'show_excerpt' => $show_excerpt,
            'event_post' => ! empty( $event_post ) ? $event_post : '',
        );

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
            lsvr_framework_load_template( apply_filters( 'lsvr_widget_event_featured_template_path', 'lsvr-events/templates/widgets/event-featured.php' ) );
        }

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>