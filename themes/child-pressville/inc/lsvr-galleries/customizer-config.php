<?php

add_action( 'customize_register', 'lsvr_pressville_galleries_customize_register' );
if ( ! function_exists( 'lsvr_pressville_galleries_customize_register' ) ) {
    function lsvr_pressville_galleries_customize_register( $wp_customize ) {
        if ( class_exists( 'Lsvr_Customizer' ) ) {

            $lsvr_customizer = new Lsvr_Customizer( $wp_customize, 'lsvr_pressville_' );

            $lsvr_customizer->add_section( 'lsvr_gallery_settings', array(
                'title' => esc_html__( 'Galleries', 'pressville' ),
                'priority' => 150,
            ));

                // Archive settings
                $lsvr_customizer->add_info( 'lsvr_gallery_archive_info', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Archive Settings', 'pressville' ),
                    'description' => esc_html__( 'The following settings apply to post archive page. You can change your default post archive URL under Settings / Permalinks. Scroll down for post detail page settings.', 'pressville' ),
                    'priority' => 1010,
                ));

                // Title
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_title', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Gallery Archive Title', 'pressville' ),
                    'description' => esc_html__( 'This title will be used as the archive page headline and in breadcrumbs.', 'pressville' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Galleries', 'pressville' ),
                    'priority' => 1020,
                ));

                // Archive layout
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_layout', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Archive Layout', 'pressville' ),
                    'description' => esc_html__( 'Change layout for gallery archive page.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'pressville' ),
                        'grid' => esc_html__( 'Grid', 'pressville' ),
                    ),
                    'default' => 'default',
                    'priority' => 1030,
                ));

                // Archive posts per page
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_posts_per_page', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Posts Per Page', 'pressville' ),
                    'description' => esc_html__( 'How many gallery posts should be displayed per page. Set to 0 to display all.', 'pressville' ),
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
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_grid_columns', array(
                    'section' => 'lsvr_gallery_settings',
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
                ));

                // Archive items order
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_order', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Archive Order', 'pressville' ),
                    'description' => esc_html__( 'Choose how galleries will be ordered on the archive page.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'pressville' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'pressville' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'pressville' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'pressville' ),
                        'title_desc' => esc_html__( 'By title, descending', 'pressville' ),
                        'random' => esc_html__( 'Random', 'pressville' ),
                    ),
                    'default' => 'default',
                    'priority' => 1060,
                ));

                // Enable categories
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_categories_enable', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Display Archive Categories', 'pressville' ),
                    'description' => esc_html__( 'Display links to gallery categories.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1110,
                ));

                // Enable masonry
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_masonry_enable', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Enable Archive Masonry', 'pressville' ),
                    'description' => esc_html__( 'Display gallery posts in masonry.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 1120,
                    'required' => array(
                        'setting' => 'lsvr_gallery_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Crop thumbnail
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_cropped_thumb_enable', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Crop Thumbnails', 'pressville' ),
                    'description' => esc_html__( 'Make each gallery thumbnail the same size.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1130,
                    'required' => array(
                        'setting' => 'lsvr_gallery_archive_layout',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ));

                // Enable archive date
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_date_enable', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Display Date on Archive', 'pressville' ),
                    'description' => esc_html__( 'Display the gallery post date on post archive.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1140,
                ));

                // Enable archive images count
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_image_count_enable', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Display Image Count on Archive', 'pressville' ),
                    'description' => esc_html__( 'Display the number of gallery images on post archive.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1150,
                ));

                // Archive sidebar position
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_sidebar_position', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Archive Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Change the gallery post archive sidebar position.', 'pressville' ),
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
                $lsvr_customizer->add_field( 'lsvr_gallery_archive_sidebar_id', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Archive Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 1220,
                    'required' => array(
                        'setting' => 'lsvr_gallery_archive_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'lsvr_gallery_separator_2', array(
                    'section' => 'lsvr_gallery_settings',
                    'priority' => 2000,
                ));

                // Detail settings
                $lsvr_customizer->add_info( 'lsvr_gallery_single_info', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Detail Settings', 'pressville' ),
                    'description' => esc_html__( 'The following settings apply to post detail pages.', 'pressville' ),
                    'priority' => 2010,
                ));

                // Single grid columns
                $lsvr_customizer->add_field( 'lsvr_gallery_single_grid_columns', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Number of Columns', 'pressville' ),
                    'description' => esc_html__( 'Divide layout into several columns.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 1,
                        'max' => 4,
                        'step' => 1,
                    ),
                    'default' => 4,
                    'priority' => 2020,
                ));

                // Enable masonry
                $lsvr_customizer->add_field( 'lsvr_gallery_single_masonry_enable', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Enable Masonry on Detail', 'pressville' ),
                    'description' => esc_html__( 'Display gallery images in masonry layout.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2030,
                ));

                // Enable date
                $lsvr_customizer->add_field( 'lsvr_gallery_single_date_enable', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Display Date on Detail', 'pressville' ),
                    'description' => esc_html__( 'Display the gallery post date on post detail.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2035,
                ));

                // Enable post detail navigation
                $lsvr_customizer->add_field( 'lsvr_gallery_single_navigation_enable', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Enable Gallery Detail Navigation', 'pressville' ),
                    'description' => esc_html__( 'Display links to previous and next posts at the bottom of the current gallery.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2040,
                ));

                // Single sidebar position
                $lsvr_customizer->add_field( 'lsvr_gallery_single_sidebar_position', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Detail Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Change the gallery post detail sidebar position.', 'pressville' ),
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
                $lsvr_customizer->add_field( 'lsvr_gallery_single_sidebar_id', array(
                    'section' => 'lsvr_gallery_settings',
                    'label' => esc_html__( 'Detail Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 2220,
                    'required' => array(
                        'setting' => 'lsvr_gallery_single_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

        }
    }
}

?>