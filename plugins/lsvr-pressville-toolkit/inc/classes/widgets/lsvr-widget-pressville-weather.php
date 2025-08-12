<?php
/**
 * Pressville Weather widget
 *
 * Display a weather forecast from openweather.org
 */
if ( ! class_exists( 'Lsvr_Widget_Pressville_Weather' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Pressville_Weather extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_pressville_weather',
			'classname' => 'lsvr-pressville-weather-widget',
			'title' => esc_html__( 'Pressville Weather', 'lsvr-pressville-toolkit' ),
			'description' => esc_html__( 'Weather forecast', 'lsvr-pressville-toolkit' ),
			'fields' => array(
				'info' => array(
					'type' => 'info',
					'content' => esc_html__( 'Please insert your OpenWeatherMap.org API Key under Appearance / Customizer / Misc. Also, don\'t forget to set your basic locale settings under Settings / General (especially Timezone).', 'lsvr-pressville-toolkit' ),
				),
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-pressville-toolkit' ),
					'type' => 'text',
					'default' => esc_html__( 'Weather', 'lsvr-pressville-toolkit' ),
				),
				'address' => array(
					'label' => esc_html__( 'Address:', 'lsvr-pressville-toolkit' ),
					'type' => 'text',
					'description' => esc_html__( 'For example: "stowe,us". You can search for your location on openweathermap.org to see if it\'s in the database.', 'lsvr-pressville-toolkit' ),
				),
				'latitude' => array(
					'label' => esc_html__( 'Latitude:', 'lsvr-pressville-toolkit' ),
					'type' => 'text',
					'description' => esc_html__( 'Use if you are unable to get your local weather using just the address.', 'lsvr-pressville-toolkit' ),
				),
				'longitude' => array(
					'label' => esc_html__( 'Longitude:', 'lsvr-pressville-toolkit' ),
					'type' => 'text',
					'description' => esc_html__( 'Use if you are unable to get your local weather using just the address.', 'lsvr-pressville-toolkit' ),
				),
				'forecast_length' => array(
					'label' => esc_html__( 'Forecast Length:', 'lsvr-pressville-toolkit' ),
					'type' => 'select',
					'description' => esc_html__( 'How many days of forecast will be displayed.', 'lsvr-pressville-toolkit' ),
					'choices' => array(
						'0' => esc_html__( 'No forecast', 'lsvr-pressville-toolkit' ),
						'1' => esc_html__( '1 day', 'lsvr-pressville-toolkit' ),
						'2' => esc_html__( '2 days', 'lsvr-pressville-toolkit' ),
						'3' => esc_html__( '3 days', 'lsvr-pressville-toolkit' ),
					),
					'default' => '3',
				),
				'units_format' => array(
					'label' => esc_html__( 'Units Format:', 'lsvr-pressville-toolkit' ),
					'type' => 'select',
					'choices' => array(
						'metric' => esc_html__( 'Metric', 'lsvr-pressville-toolkit' ),
						'imperial' => esc_html__( 'Imperial', 'lsvr-pressville-toolkit' ),
					),
					'default' => 'metric',
				),
				'update_interval' => array(
					'label' => esc_html__( 'Update Interval:', 'lsvr-pressville-toolkit' ),
					'type' => 'select',
					'description' => esc_html__( 'How often should be weather data pulled from openweathermap.org.', 'lsvr-pressville-toolkit' ),
					'choices' => array(
						'10min' => esc_html__( 'Every 10 minutes', 'lsvr-pressville-toolkit' ),
						'30min' => esc_html__( 'Every 30 minutes', 'lsvr-pressville-toolkit' ),
						'1hour' => esc_html__( 'Every hour', 'lsvr-pressville-toolkit' ),
						'3hours' => esc_html__( 'Every 3 hours', 'lsvr-pressville-toolkit' ),
						'12hours' => esc_html__( 'Every 12 hours', 'lsvr-pressville-toolkit' ),
						'24hours' => esc_html__( 'Every 24 hours', 'lsvr-pressville-toolkit' ),
						'disable' => esc_html__( 'On each page load (not recommended)', 'lsvr-pressville-toolkit' ),
					),
					'default' => '1hour',
				),
				'show_time' => array(
					'label' => esc_html__( 'Show Local Time', 'lsvr-pressville-toolkit' ),
					'description' => esc_html__( 'You can change your Timezone and Time Format under Settings / General.', 'lsvr-pressville-toolkit' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'bottom_text' => array(
					'label' => esc_html__( 'Bottom Text:', 'lsvr-pressville-toolkit' ),
					'description' => esc_html__( 'Custom text which will be displayed at the bottom of the widget content.', 'lsvr-pressville-toolkit' ),
					'type' => 'textarea',
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Check if show time
        $show_time = ! empty( $instance['show_time'] ) && ( true === $instance['show_time'] || '1' === $instance['show_time'] || 'true' === $instance['show_time'] ) ? true : false;

    	// Check if editor view
        $editor_view = ! empty( $instance['editor_view'] ) && ( true === $instance['editor_view'] || '1' === $instance['editor_view'] || 'true' === $instance['editor_view'] ) ? true : false;

		// Prepare ajax query
		$ajax_params = array(
			'address' => ! empty( $instance['address'] ) ? $instance['address'] : '',
			'latitude' => ! empty( $instance['latitude'] ) ? $instance['latitude'] : '',
			'longitude' => ! empty( $instance['longitude'] ) ? $instance['longitude'] : '',
			'forecast_length' => ! empty( $instance['forecast_length'] ) ? intval( $instance['forecast_length'] ) : 0,
			'units_format' => ! empty( $instance['units_format'] ) ? $instance['units_format'] : 'metric',
			'update_interval' => ! empty( $instance['update_interval'] ) ? $instance['update_interval'] : '1hour',
		);

		if ( ! empty( $ajax_params['address'] ) || ( ! empty( $ajax_params['latitude'] ) && ! empty( $ajax_params['longitude'] ) ) ) {
			$ajax_params_json = json_encode( $ajax_params );
		} else {
			$ajax_params_json = false;
		}

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
  			'show_time' => $show_time,
  			'ajax_params' => $ajax_params,
  			'ajax_params_json' => $ajax_params_json,
  			'editor_view' => $editor_view,
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_pressville_weather_template_path', 'lsvr-pressville-toolkit/templates/widgets/pressville-weather.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>