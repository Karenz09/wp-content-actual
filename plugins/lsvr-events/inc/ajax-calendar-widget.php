<?php

/**
 * Function fired during AJAX request to display calendar in LSVR Event Calendar widget.
 *
 * @return HTML 	HTML of the calendar widget with new params
 */

add_action( 'wp_ajax_nopriv_lsvr-events-ajax-event-calendar-widget', 'lsvr_events_ajax_event_calendar_widget' );
add_action( 'wp_ajax_lsvr-events-ajax-event-calendar-widget', 'lsvr_events_ajax_event_calendar_widget' );
if ( ! function_exists( 'lsvr_events_ajax_event_calendar_widget' ) ) {
	function lsvr_events_ajax_event_calendar_widget() {

		// Test nonce
		$nonce = ! empty( $_POST['nonce'] ) ? $_POST['nonce'] : false;
		if ( ! wp_verify_nonce( $nonce, 'lsvr-events-ajax-nonce' ) ) {
			die ( esc_html__( 'You do not have permission to access this data.', 'lsvr-events' ) );
		}

		if ( ! empty( $_POST['data']['instance'] ) && ! empty( $_POST['data']['year'] ) && ! empty( $_POST['data']['month'] ) ) {

			$_POST['data']['instance']['year_month'] = $_POST['data']['year'] . '-' . str_pad( $_POST['data']['month'], 2, 0, STR_PAD_LEFT );

            ob_start(); ?>

            <?php the_widget( 'Lsvr_Widget_Event_Calendar',
            	$_POST['data']['instance'], array(
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => '',
            )); ?>

            <?php echo ob_get_clean();

		}

		wp_die();

	}
}

?>