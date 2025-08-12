<?php
/**
 * Plugin Name: LSVR 3rd Party Toolkit
 * Description: Adds 3rd party functionality
 * Version: 1.2.3
 * Author: LSVRthemes
 * Author URI: http://themeforest.net/user/LSVRthemes/portfolio
 * Text Domain: lsvr-3rd-party-toolkit
 * Domain Path: /languages
 * License: http://themeforest.net/licenses
 * License URI: http://themeforest.net/licenses
*/

// Include additional functions and classes
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( 'inc/core-functions.php' );
require_once( 'inc/elementor-config.php' );
require_once( 'inc/vc-config.php' );

// Load textdomain
load_plugin_textdomain( 'lsvr-3rd-party-toolkit', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );

?>