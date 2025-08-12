<?php

add_action( 'customize_register', 'lsvr_pressville_notices_customize_register' );
if ( ! function_exists( 'lsvr_pressville_notices_customize_register' ) ) {
    function lsvr_pressville_notices_customize_register( $wp_customize ) {
        if ( class_exists( 'Lsvr_Customizer' ) ) {

            $lsvr_customizer = new Lsvr_Customizer( $wp_customize, 'lsvr_pressville_' );

            $lsvr_customizer->add_section( 'lsvr_notice_settings', array(
                'title' => esc_html__( 'Notices', 'pressville' ),
                'priority' => 125,
            ));

                // Archive settings
                $lsvr_customizer->add_info( 'lsvr_notice_archive_info', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Archive Settings', 'pressville' ),
                    'description' => esc_html__( 'The following settings apply to post archive page. You can change your default post archive URL under Settings / Permalinks. Scroll down for post detail page settings.', 'pressville' ),
                    'priority' => 1010,
                ));

                // Title
                $lsvr_customizer->add_field( 'lsvr_notice_archive_title', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Notice Archive Title', 'pressville' ),
                    'description' => esc_html__( 'This title will be used as the archive page headline and in breadcrumbs.', 'pressville' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Notices', 'pressville' ),
                    'priority' => 1020,
                ));

                // Archive posts per page
                $lsvr_customizer->add_field( 'lsvr_notice_archive_posts_per_page', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Posts Per Page', 'pressville' ),
                    'description' => esc_html__( 'How many notice posts should be displayed per page. Set to 0 to display all.', 'pressville' ),
                    'type' => 'lsvr-slider',
                    'choices' => array(
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ),
                    'default' => 10,
                    'priority' => 1030,
                ));

                // Archive items order
                $lsvr_customizer->add_field( 'lsvr_notice_archive_order', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Archive Order', 'pressville' ),
                    'description' => esc_html__( 'Choose how notices will be ordered on the archive page.', 'pressville' ),
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
                    'priority' => 1040,
                ));

                // Enable categories
                $lsvr_customizer->add_field( 'lsvr_notice_archive_categories_enable', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Display Archive Categories', 'pressville' ),
                    'description' => esc_html__( 'Display links to notice categories.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => false,
                    'priority' => 1050,
                ));

                // Enable author on archive
                $lsvr_customizer->add_field( 'lsvr_notice_archive_author_enable', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Display Author on Archive', 'pressville' ),
                    'description' => esc_html__( 'Display post author on archive page.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 1060,
                ));

                // Archive sidebar position
                $lsvr_customizer->add_field( 'lsvr_notice_archive_sidebar_position', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Archive Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Change the notice post archive sidebar position.', 'pressville' ),
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
                $lsvr_customizer->add_field( 'lsvr_notice_archive_sidebar_id', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Archive Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 1220,
                    'required' => array(
                        'setting' => 'lsvr_notice_archive_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

                // Separator
                $lsvr_customizer->add_separator( 'lsvr_notice_separator_2', array(
                    'section' => 'lsvr_notice_settings',
                    'priority' => 2000,
                ));

                // Detail settings
                $lsvr_customizer->add_info( 'lsvr_notice_single_info', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Detail Settings', 'pressville' ),
                    'description' => esc_html__( 'The following settings apply to post detail pages.', 'pressville' ),
                    'priority' => 2010,
                ));

                // Enable author on detail
                $lsvr_customizer->add_field( 'lsvr_notice_single_author_enable', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Display Author on Detail', 'pressville' ),
                    'description' => esc_html__( 'Display post author on detail page.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2020,
                ));

                // Enable post detail navigation
                $lsvr_customizer->add_field( 'lsvr_notice_single_post_navigation_enable', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Enable Post Detail Navigation', 'pressville' ),
                    'description' => esc_html__( 'Display links to previous and next posts at the bottom of the current post.', 'pressville' ),
                    'type' => 'checkbox',
                    'default' => true,
                    'priority' => 2030,
                ));

                // Single sidebar position
                $lsvr_customizer->add_field( 'lsvr_notice_single_sidebar_position', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Detail Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Change the notice post detail sidebar position.', 'pressville' ),
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
                $lsvr_customizer->add_field( 'lsvr_notice_single_sidebar_id', array(
                    'section' => 'lsvr_notice_settings',
                    'label' => esc_html__( 'Detail Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 2220,
                    'required' => array(
                        'setting' => 'lsvr_notice_single_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

        }
    }
}

?>