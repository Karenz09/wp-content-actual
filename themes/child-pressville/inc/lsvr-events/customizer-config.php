<?php

add_action( 'customize_register', 'lsvr_pressville_events_customize_register' );
if ( ! function_exists( 'lsvr_pressville_events_customize_register' ) ) {
    function lsvr_pressville_events_customize_register( $wp_customize ) {
        if ( class_exists( 'Lsvr_Customizer' ) ) {

            $lsvr_customizer = new Lsvr_Customizer( $wp_customize, 'lsvr_pressville_' );

            $lsvr_customizer->add_section( 'lsvr_events_settings', array(
                'title' => esc_html__( 'Events', 'pressville' ),
                'priority' => 140,
            ));

                // Archive settings
                $lsvr_customizer->add_info( 'lsvr_event_archive_info', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Archive Settings', 'pressville' ),
                    'description' => esc_html__( 'The following settings apply to post archive page. You can change your default post archive URL under Settings / Permalinks. Scroll down for post detail page settings.', 'pressville' ),
                    'priority' => 1010,
                ));

                // Title
                $lsvr_customizer->add_field( 'lsvr_event_archive_title', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Event Archive Title', 'pressville' ),
                    'description' => esc_html__( 'This title will be used as the archive page headline and in breadcrumbs.', 'pressville' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Events', 'pressville' ),
                    'priority' => 1020,
                ));

                // Archive layout
                $lsvr_customizer->add_field( 'lsvr_event_archive_layout', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Archive Layout', 'pressville' ),
                    'description' => esc_html__( 'Change layout for event archive page.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'pressville' ),
                        'grid' => esc_html__( 'Grid', 'pressville' ),
                        'timeline' => esc_html__( 'Timeline', 'pressville' ),
                    ),
                    'default' => 'default',
                    'priority' => 1030,
                ));

                // Archive posts per page
                $lsvr_customizer->add_field( 'lsvr_event_archive_posts_per_page', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Posts Per Page', 'pressville' ),
                    'description' => esc_html__( 'How many event posts should be displayed per page. Set to 0 to display all.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ),
                    'default' => 12,
                    'priority' => 1040,
                ));

                // Archive grid columns
                $lsvr_customizer->add_field( 'lsvr_event_archive_grid_columns', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Number of Columns', 'pressville' ),
                    'description' => esc_html__( 'Divide layout into several columns.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 1,
                        'max' => 4,
                        'step' => 1,
                    ),
                    'default' => 3,
                    'priority' => 1050,
                    'required' => array(
                        'setting' => 'lsvr_event_archive_layout',
                        'operator' => '==',
                        'value' => 'default,grid',
                    ),
                ));

                // Enable categories
                $lsvr_customizer->add_field( 'lsvr_event_archive_categories_enable', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Display Archive Categories', 'pressville' ),
                    'description' => esc_html__( 'Display links to event categories.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1110,
                ));

                // Enable filter
                $lsvr_customizer->add_field( 'lsvr_event_archive_filter_enable', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Display Filter', 'pressville' ),
                    'description' => esc_html__( 'Allow your visitors to filter events by date.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1120,
                ));

                // Group by month
                $lsvr_customizer->add_field( 'lsvr_event_archive_group_enable', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Group By Month', 'pressville' ),
                    'description' => esc_html__( 'Divide the archive page into month sections.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1130,
                    'required' => array(
                        'setting' => 'lsvr_event_archive_layout',
                        'operator' => '==',
                        'value' => 'default,grid',
                    ),
                ));

                // Enable masonry
                $lsvr_customizer->add_field( 'lsvr_event_archive_masonry_enable', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Enable Masonry', 'pressville' ),
                    'description' => esc_html__( 'Display events in masonry.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 1140,
                    'required' => array(
                        'setting' => 'lsvr_event_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Crop thumbnail
                $lsvr_customizer->add_field( 'lsvr_event_archive_cropped_thumb_enable', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Crop Thumbnails', 'pressville' ),
                    'description' => esc_html__( 'Make each event thumbnail the same size.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1150,
                    'required' => array(
                        'setting' => 'lsvr_event_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Archive sidebar position
                $lsvr_customizer->add_field( 'lsvr_event_archive_sidebar_position', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Archive Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Change the event post archive sidebar position.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'pressville' ),
                        'left' => esc_html__( 'Left', 'pressville' ),
                        'right' => esc_html__( 'Right', 'pressville' ),
                    ),
                    'default' => 'disable',
                    'priority' => 1210,
                ));

                // Archive sidebar ID
                $lsvr_customizer->add_field( 'lsvr_event_archive_sidebar_id', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Archive Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 1220,
                    'required' => array(
                        'setting' => 'lsvr_event_archive_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'lsvr_event_separator_2', array(
                    'section' => 'lsvr_events_settings',
                    'priority' => 2000,
                ));

                // Detail settings
                $lsvr_customizer->add_info( 'lsvr_event_single_info', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Detail Settings', 'pressville' ),
                    'description' => esc_html__( 'The following settings apply to post detail pages.', 'pressville' ),
                    'priority' => 2010,
                ));

                // Enable featured image
                $lsvr_customizer->add_field( 'lsvr_event_single_featured_image_enable', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Display Featured Image on Detail', 'pressville' ),
                    'description' => esc_html__( 'Display featured image on event detail page.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2010,
                ));

                // Enable map
                $lsvr_customizer->add_field( 'lsvr_event_single_map_enable', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Display Map On Detail', 'pressville' ),
                    'description' => esc_html__( 'Display the event location on event detail page.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2020,
                    'required' => array(
                        'setting' => 'maps_provider',
                        'operator' => '!=',
                        'value' => 'disable',
                    ),
                ));

                // Single map type
                $lsvr_customizer->add_field( 'lsvr_event_single_map_type', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Detail Map Type', 'pressville' ),
                    'description' => esc_html__( 'Choose the type of map on event detail page.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'roadmap' => esc_html__( 'Roadmap', 'pressville' ),
                        'terrain' => esc_html__( 'Terrain', 'pressville' ),
                        'satellite' => esc_html__( 'Satellite', 'pressville' ),
                        'hybrid' => esc_html__( 'Hybrid', 'pressville' ),
                    ),
                    'default' => 'roadmap',
                    'priority' => 2030,
                    'required' => array(
                        array(
                            'setting' => 'maps_provider',
                            'operator' => '==',
                            'value' => 'gmaps',
                        ),
                        array(
                            'setting' => 'lsvr_event_single_map_enable',
                            'operator' => '==',
                            'value' => true,
                        ),
                    ),
                ));

                // Single map zoom level
                $lsvr_customizer->add_field( 'lsvr_event_single_map_zoom', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Detail Map Zoom', 'pressville' ),
                    'description' => esc_html__( 'Set zoom level for the map.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 15,
                        'max' => 20,
                        'step' => 1,
                    ),
                    'default' => 17,
                    'priority' => 2040,
                    'required' => array(
                        array(
                            'setting' => 'maps_provider',
                            'operator' => '!=',
                            'value' => 'disable',
                        ),
                        array(
                            'setting' => 'lsvr_event_single_map_enable',
                            'operator' => '==',
                            'value' => true,
                        ),
                    ),
                ));

                // Single sidebar position
                $lsvr_customizer->add_field( 'lsvr_event_single_sidebar_position', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Detail Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Change the event post detail sidebar position.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'pressville' ),
                        'left' => esc_html__( 'Left', 'pressville' ),
                        'right' => esc_html__( 'Right', 'pressville' ),
                    ),
                    'default' => 'disable',
                    'priority' => 2210,
                ));

                // Single sidebar ID
                $lsvr_customizer->add_field( 'lsvr_event_single_sidebar_id', array(
                    'section' => 'lsvr_events_settings',
                    'label' => esc_html__( 'Detail Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 2220,
                    'required' => array(
                        'setting' => 'lsvr_event_single_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

        }
    }
}

?>