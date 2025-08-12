<?php
/**
 * Plugin Name: LSVR Pressville Theme Toolkit
 * Description: Adds theme-specific functionality
 * Version: 1.9.8
 * Author: LSVRthemes
 * Author URI: http://themeforest.net/user/LSVRthemes/portfolio
 * Text Domain: lsvr-pressville-toolkit
 * Domain Path: /languages
 * License: http://themeforest.net/licenses
 * License URI: http://themeforest.net/licenses
*/

// Include additional functions and classes
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( 'inc/classes/lsvr-pressville-sitemap-walker.php' );
require_once( 'inc/ajax-weather-widget.php' );
require_once( 'inc/core-functions.php' );
require_once( 'inc/frontend-functions.php' );
require_once( 'inc/blocks-config.php' );

// Load textdomain
load_plugin_textdomain( 'lsvr-pressville-toolkit', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );

// Load CSS & JS
add_action( 'wp_enqueue_scripts', 'lsvr_pressville_toolkit_load_assets' );
if ( ! function_exists( 'lsvr_pressville_toolkit_load_assets' ) ) {
	function lsvr_pressville_toolkit_load_assets() {

		$plugin_data = get_plugin_data( __FILE__ );
		$plugin_version = ! empty( $plugin_data['Version'] ) ? $plugin_data['Version'] : false;
		$suffix = defined( 'WP_DEBUG' ) && true == WP_DEBUG ? '' : '.min';

		if ( apply_filters( 'lsvr_pressville_toolkit_weather_widget_enable', true ) ) {
			wp_enqueue_script( 'lsvr-pressville-toolkit-weather-widget', plugin_dir_url( __FILE__ ) . 'assets/js/lsvr-pressville-toolkit-weather-widget' . $suffix . '.js', array( 'jquery' ), $plugin_version );
			wp_localize_script( 'lsvr-pressville-toolkit-weather-widget', 'lsvr_pressville_toolkit_ajax_weather_widget_var', array(
	    		'url' => admin_url( 'admin-ajax.php' ),
	    		'nonce' => wp_create_nonce( 'lsvr-pressville-toolkit-ajax-weather-widget-nonce' ),
			));
		}

	}
}

// Register widgets
add_action( 'widgets_init', 'lsvr_pressville_toolkit_register_widgets' );
if ( ! function_exists( 'lsvr_pressville_toolkit_register_widgets' ) ) {
	function lsvr_pressville_toolkit_register_widgets() {

		// Weather
		require_once( 'inc/classes/widgets/lsvr-widget-pressville-weather.php' );
		if ( class_exists( 'Lsvr_Widget_Pressville_Weather' ) ) {
			register_widget( 'Lsvr_Widget_Pressville_Weather' );
		}

	}
}

// Register shortcodes
add_action( 'init', 'lsvr_pressville_toolkit_register_shortcodes' );
if ( ! function_exists( 'lsvr_pressville_toolkit_register_shortcodes' ) ) {
	function lsvr_pressville_toolkit_register_shortcodes() {

    	// Container
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-pressville-container.php' );
		if ( class_exists( 'Lsvr_Shortcode_Pressville_Container' ) ) {
			add_shortcode( 'lsvr_pressville_container', array( 'Lsvr_Shortcode_Pressville_Container', 'shortcode' ) );
		}

    	// Directory
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-pressville-directory.php' );
		if ( class_exists( 'Lsvr_Shortcode_Pressville_Directory' ) ) {
			add_shortcode( 'lsvr_pressville_directory', array( 'Lsvr_Shortcode_Pressville_Directory', 'shortcode' ) );
		}

    	// Events
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-pressville-events.php' );
		if ( class_exists( 'Lsvr_Shortcode_Pressville_Events' ) ) {
			add_shortcode( 'lsvr_pressville_events', array( 'Lsvr_Shortcode_Pressville_Events', 'shortcode' ) );
		}

    	// Galleries
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-pressville-galleries.php' );
		if ( class_exists( 'Lsvr_Shortcode_Pressville_Galleries' ) ) {
			add_shortcode( 'lsvr_pressville_galleries', array( 'Lsvr_Shortcode_Pressville_Galleries', 'shortcode' ) );
		}

    	// Posts
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-pressville-posts.php' );
		if ( class_exists( 'Lsvr_Shortcode_Pressville_Posts' ) ) {
			add_shortcode( 'lsvr_pressville_posts', array( 'Lsvr_Shortcode_Pressville_Posts', 'shortcode' ) );
		}

    	// Sidebar
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-pressville-sidebar.php' );
		if ( class_exists( 'Lsvr_Shortcode_Pressville_Sidebar' ) ) {
			add_shortcode( 'lsvr_pressville_sidebar', array( 'Lsvr_Shortcode_Pressville_Sidebar', 'shortcode' ) );
		}

    	// Sitemap
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-pressville-sitemap.php' );
		if ( class_exists( 'Lsvr_Shortcode_Pressville_Sitemap' ) ) {
			add_shortcode( 'lsvr_pressville_sitemap', array( 'Lsvr_Shortcode_Pressville_Sitemap', 'shortcode' ) );
		}

    	// Weather widget
		require_once( 'inc/classes/shortcodes/lsvr-shortcode-pressville-weather-widget.php' );
		if ( class_exists( 'Lsvr_Shortcode_Pressville_Weather_Widget' ) ) {
			add_shortcode( 'lsvr_pressville_weather_widget', array( 'Lsvr_Shortcode_Pressville_Weather_Widget', 'shortcode' ) );
		}

	}
}

?>