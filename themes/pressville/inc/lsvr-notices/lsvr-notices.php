<?php

// Include additional files
require_once( get_template_directory() . '/inc/lsvr-notices/actions.php' );
require_once( get_template_directory() . '/inc/lsvr-notices/customizer-config.php' );
require_once( get_template_directory() . '/inc/lsvr-notices/deprecated.php' );

// Is notice page
if ( ! function_exists( 'lsvr_pressville_is_notice' ) ) {
	function lsvr_pressville_is_notice() {

		return is_post_type_archive( 'lsvr_notice' ) || is_tax( 'lsvr_notice_cat' ) || is_tax( 'lsvr_notice_tag' ) || is_singular( 'lsvr_notice' ) ? true : false;

	}
}

// Get notice archive title
if ( ! function_exists( 'lsvr_pressville_get_notice_archive_title' ) ) {
	function lsvr_pressville_get_notice_archive_title() {

		return get_theme_mod( 'lsvr_notice_archive_title', esc_html__( 'Notices', 'pressville' ) );

	}
}

?>