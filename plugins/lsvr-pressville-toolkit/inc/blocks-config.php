<?php

// Register custom category
add_filter( 'block_categories_all', 'lsvr_pressville_toolkit_register_blocks_category' );
if ( ! function_exists( 'lsvr_pressville_toolkit_register_blocks_category' ) ) {
	function lsvr_pressville_toolkit_register_blocks_category( $categories ) {

	    return array_merge( $categories, array(
	        array(
	            'slug' => 'lsvr-pressville-toolkit',
	            'title' => esc_html__( 'Pressville', 'lsvr-pressville-toolkit' ),
	        ),
	    ));

	}
}

// Register blocks
add_action( 'init', 'lsvr_pressville_toolkit_register_blocks', 20 );
if ( ! function_exists( 'lsvr_pressville_toolkit_register_blocks' ) ) {
	function lsvr_pressville_toolkit_register_blocks() {

		if ( function_exists( 'register_block_type' ) && function_exists( 'lsvr_framework_register_shortcode_block' ) ) {

    		// Directory
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Directory' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-pressville-toolkit/directory', array(
					'attributes' => Lsvr_Shortcode_Pressville_Directory::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Pressville_Directory', 'shortcode' ),
				));
			}

    		// Events
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Events' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-pressville-toolkit/events', array(
					'attributes' => Lsvr_Shortcode_Pressville_Events::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Pressville_Events', 'shortcode' ),
				));
			}

    		// Galleries
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Galleries' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-pressville-toolkit/galleries', array(
					'attributes' => Lsvr_Shortcode_Pressville_Galleries::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Pressville_Galleries', 'shortcode' ),
				));
			}

    		// Posts
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Posts' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-pressville-toolkit/posts', array(
					'attributes' => Lsvr_Shortcode_Pressville_Posts::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Pressville_Posts', 'shortcode' ),
				));
			}

    		// Sidebar
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Sidebar' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-pressville-toolkit/sidebar', array(
					'attributes' => Lsvr_Shortcode_Pressville_Sidebar::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Pressville_Sidebar', 'shortcode' ),
				));
			}

    		// Sitemap
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Sitemap' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-pressville-toolkit/sitemap', array(
					'attributes' => Lsvr_Shortcode_Pressville_Sitemap::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Pressville_Sitemap', 'shortcode' ),
				));
			}

    		// Weather widget
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Weather_Widget' ) ) {
				lsvr_framework_register_shortcode_block( 'lsvr-pressville-toolkit/weather', array(
					'attributes' => Lsvr_Shortcode_Pressville_Weather_Widget::lsvr_shortcode_atts(),
					'render_callback' => array( 'Lsvr_Shortcode_Pressville_Weather_Widget', 'shortcode' ),
				));
			}

		}

	}
}

// Register blocks JSON
add_filter( 'lsvr_framework_register_shortcode_blocks_json', 'lsvr_pressville_toolkit_register_blocks_json' );
if ( ! function_exists( 'lsvr_pressville_toolkit_register_blocks_json' ) ) {
	function lsvr_pressville_toolkit_register_blocks_json( $data = array() ) {

		$data = empty( $data ) ? array() : $data;

		if ( function_exists( 'register_block_type' ) && function_exists( 'lsvr_framework_register_shortcode_block_json' ) ) {

			// Directory
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Directory' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-pressville-toolkit/directory',
					'tag' => 'lsvr_pressville_directory',
					'title' => esc_html__( 'Pressville Directory', 'lsvr-pressville-toolkit' ),
		        	'description' => esc_html__( 'List of Listings', 'lsvr-pressville-toolkit' ),
		        	'category' => 'lsvr-pressville-toolkit',
		        	'icon' => 'location-alt',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-pressville-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Pressville_Directory::lsvr_shortcode_atts(),
				)));
			}

			// Events
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Events' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-pressville-toolkit/events',
					'tag' => 'lsvr_pressville_events',
					'title' => esc_html__( 'Pressville Events', 'lsvr-pressville-toolkit' ),
		        	'description' => esc_html__( 'List of Events', 'lsvr-pressville-toolkit' ),
		        	'category' => 'lsvr-pressville-toolkit',
		        	'icon' => 'calendar-alt',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-pressville-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Pressville_Events::lsvr_shortcode_atts(),
				)));
			}

			// Galleries
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Galleries' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-pressville-toolkit/galleries',
					'tag' => 'lsvr_pressville_galleries',
					'title' => esc_html__( 'Pressville Galleries', 'lsvr-pressville-toolkit' ),
		        	'description' => esc_html__( 'List of Galleries', 'lsvr-pressville-toolkit' ),
		        	'category' => 'lsvr-pressville-toolkit',
		        	'icon' => 'format-gallery',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-pressville-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Pressville_Galleries::lsvr_shortcode_atts(),
				)));
			}

			// Posts
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Posts' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-pressville-toolkit/posts',
					'tag' => 'lsvr_pressville_posts',
					'title' => esc_html__( 'Pressville Posts', 'lsvr-pressville-toolkit' ),
		        	'description' => esc_html__( 'List of Posts', 'lsvr-pressville-toolkit' ),
		        	'category' => 'lsvr-pressville-toolkit',
		        	'icon' => 'admin-post',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-pressville-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Pressville_Posts::lsvr_shortcode_atts(),
				)));
			}

			// Sidebar
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Sidebar' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-pressville-toolkit/sidebar',
					'tag' => 'lsvr_pressville_sidebar',
					'title' => esc_html__( 'Pressville Sidebar', 'lsvr-pressville-toolkit' ),
		        	'description' => esc_html__( 'Sidebar with widgets', 'lsvr-pressville-toolkit' ),
		        	'category' => 'lsvr-pressville-toolkit',
		        	'icon' => 'screenoptions',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-pressville-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Pressville_Sidebar::lsvr_shortcode_atts(),
				)));
			}

			// Sitemap
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Sitemap' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-pressville-toolkit/sitemap',
					'tag' => 'lsvr_pressville_sitemap',
					'title' => esc_html__( 'Pressville Sitemap', 'lsvr-pressville-toolkit' ),
		        	'description' => esc_html__( 'Custom menu', 'lsvr-pressville-toolkit' ),
		        	'category' => 'lsvr-pressville-toolkit',
		        	'icon' => 'networking',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-pressville-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Pressville_Sitemap::lsvr_shortcode_atts(),
				)));
			}

			// Weather widget
			if ( class_exists( 'Lsvr_Shortcode_Pressville_Weather_Widget' ) ) {
				array_push( $data, lsvr_framework_register_shortcode_block_json( array(
					'name' => 'lsvr-pressville-toolkit/weather',
					'tag' => 'lsvr_pressville_weather_widget',
					'title' => esc_html__( 'Pressville Weather Widget', 'lsvr-pressville-toolkit' ),
		        	'description' => esc_html__( 'Weather forecast', 'lsvr-pressville-toolkit' ),
		        	'category' => 'lsvr-pressville-toolkit',
		        	'icon' => 'cloud',
		        	'panel_title' => esc_html__( 'Settings', 'lsvr-pressville-toolkit' ),
		        	'attributes' => Lsvr_Shortcode_Pressville_Weather_Widget::lsvr_shortcode_atts(),
				)));
			}

		}

		return $data;

	}
}

?>