<?php

// Add Sidebar Settings to pages
if ( class_exists( 'Lsvr_Post_Metabox' ) ) {
	$lsvr_pressville_page_sidebar_settings_metabox = new Lsvr_Post_Metabox(array(
		'id' => 'lsvr_pressville_page_sidebar_settings',
		'wp_args' => array(
			'title' => __( 'Sidebar Settings', 'pressville' ),
			'screen' => 'page',
		),
		'fields' => array(

			// Sidebar
			'lsvr_pressville_page_sidebar' => array(
				'type' => 'select',
				'title' => esc_html__( 'Choose Sidebar To Display', 'pressville' ),
				'description' => esc_html__( 'Sidebar will be displayed only if the selected page template supports sidebars. You can manage sidebar widgets under Appearance / Widgets.', 'pressville' ),
				'choices' => array_merge( array( 'disable' => esc_html__( 'Disable', 'pressville' ) ),
					lsvr_pressville_get_sidebars() ),
				'default' => 'disable',
				'priority' => 10,
			),

		),
	));
}

?>