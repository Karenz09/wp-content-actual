<?php

//Display the event time
if ( ! function_exists( 'lsvr_events_the_event_time' ) ) {
	function lsvr_events_the_event_time( $event_occurrence ) {

		// All-day event
        if ( ! empty( $event_occurrence['allday'] ) && true === $event_occurrence['allday'] ) {

            esc_html_e( 'All-day event', 'lsvr-events' );

        }

        // Display start and end time
        elseif ( ! empty( $event_occurrence['postid'] ) && 'true' === get_post_meta( $event_occurrence['postid'], 'lsvr_event_end_time_enable', true ) ) {

            echo sprintf( esc_html__( '%s - %s', 'lsvr-events' ),
                lsvr_events_get_event_local_start_time( $event_occurrence['postid'] ),
                lsvr_events_get_event_local_end_time( $event_occurrence['postid'] )
            );

        }

        // Display only start time
        else {

            echo esc_html( lsvr_events_get_event_local_start_time( $event_occurrence['postid'] ) );

        }

    }
}

// Display events calendar widget day class
if ( ! function_exists( 'lsvr_events_the_event_calendar_widget_day_class' ) ) {
    function lsvr_events_the_event_calendar_widget_day_class( $day_key, $day_data, $classes = '' ) {

        $class_arr = array( 'lsvr_event-calendar-widget__day lsvr_event-calendar-widget__day--' . $day_data['status'] );

        if ( ! empty( $classes ) ) {
            $class_arr[] = $classes;
        }

        if ( ! empty( $day_data['occurrences'] ) ) {
            $class_arr[] = 'lsvr_event-calendar-widget__day--has-events';
        }

        if ( strtotime( $day_key ) < strtotime( current_time( 'Y-m-d' ) ) ) {
            $class_arr[] = 'lsvr_event-calendar-widget__day--past';
        }

        if ( $day_key === current_time( 'Y-m-d' ) ) {
            $class_arr[] = 'lsvr_event-calendar-widget__day--today';
        }

        if ( in_array( strtolower( date( 'D', strtotime( $day_key ) ) ), array( 'sat', 'sun' ) ) ) {
            $class_arr[] = 'lsvr_event-calendar-widget__day--weekend';
        }

        if ( is_singular( 'lsvr_event' ) && ! empty( $day_data['occurrences'] ) ) {
            foreach ( $day_data['occurrences'] as $occurrences ) {
                if ( get_the_ID() === (int) $occurrences['postid'] ) {
                    $class_arr[] = 'lsvr_event-calendar-widget__day--current';
                    break;
                }
            }
        }

        echo ' class="' . implode( ' ', $class_arr ) . '"';

    }
}

?>