<?php

// Theme Demo Import plugin is required for this functionality to work
// https://wordpress.org/plugins/one-click-demo-import/
add_filter( 'pt-ocdi/import_files', 'lsvr_pressville_demo_import' );
if ( ! function_exists( 'lsvr_pressville_demo_import' ) ) {
	function lsvr_pressville_demo_import() {

    	return array(
	        array(
	            'import_file_name' => esc_html__( 'Pressville Content', 'pressville' ),
	            'local_import_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/content.xml',
	            'import_notice' => esc_html__( 'Please note that demo images are not included. After you import this demo, don\'t forget to regenerate your events under Tools / Regen. Events.', 'pressville' ),
	        ),
	        array(
	            'import_file_name' => esc_html__( 'Pressville Customizer', 'pressville' ),
	            'local_import_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/content-blank.xml',
				'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/customizer.dat',
	            'import_notice' => esc_html__( 'Please note that demo images are not included. After you import this demo, don\'t forget to regenerate your events under Tools / Regen. Events.', 'pressville' ),
	        ),
	        array(
	            'import_file_name' => esc_html__( 'Pressville Widgets', 'pressville' ),
	            'local_import_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/content-blank.xml',
	            'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'inc/demo-import/widgets.wie',
	            'import_notice' => esc_html__( 'Please note that demo images are not included. After you import this demo, don\'t forget to regenerate your events under Tools / Regen. Events.', 'pressville' ),
	        ),
        );

	}
}

add_action( 'pt-ocdi/after_import', 'lsvr_pressville_after_import_setup' );
if ( ! function_exists( 'lsvr_pressville_after_import_setup' ) ) {
function lsvr_pressville_after_import_setup() {

	    // Set menus
	    $primary_header_menu = get_term_by( 'name', 'Primary Header Menu', 'nav_menu' );
	    $secondary_header_menu = get_term_by( 'name', 'Secondary Header Menu', 'nav_menu' );
	    if ( ! empty( $primary_header_menu->term_id ) && ! empty( $secondary_header_menu->term_id ) ) {
		    set_theme_mod( 'nav_menu_locations', array(
		            'lsvr-pressville-header-menu-primary' => $primary_header_menu->term_id,
		            'lsvr-pressville-header-menu-secondary' => $secondary_header_menu->term_id,
		        )
		    );
		}

	    // Assign front page and posts page (blog page).
	    update_option( 'show_on_front', 'page' );
	    $front_page_id = get_page_by_title( 'Front Page' );
	    if ( ! empty( $front_page_id->ID ) ) {
	    	update_option( 'page_on_front', $front_page_id->ID );
		}
	    $blog_page_id  = get_page_by_title( 'News' );
		if ( ! empty( $blog_page_id->ID ) ) {
	    	update_option( 'page_for_posts', $blog_page_id->ID );
		}

	}
}
?>