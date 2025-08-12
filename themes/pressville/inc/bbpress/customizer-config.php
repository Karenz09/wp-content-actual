<?php

add_action( 'customize_register', 'lsvr_pressville_bbpress_customize_register' );
if ( ! function_exists( 'lsvr_pressville_bbpress_customize_register' ) ) {
    function lsvr_pressville_bbpress_customize_register( $wp_customize ) {
        if ( class_exists( 'Lsvr_Customizer' ) ) {

            $lsvr_customizer = new Lsvr_Customizer( $wp_customize, 'lsvr_pressville_' );

            $lsvr_customizer->add_section( 'lsvr_bbpress_settings', array(
                'title' => esc_html__( 'bbPress', 'pressville' ),
                'priority' => 180,
            ));

                // Title
                $lsvr_customizer->add_field( 'lsvr_bbpress_archive_title', array(
                    'section' => 'lsvr_bbpress_settings',
                    'label' => esc_html__( 'Archive Title', 'pressville' ),
                    'description' => esc_html__( 'This title will be used as the archive page headline and in breadcrumbs.', 'pressville' ),
                    'type' => 'text',
                    'default' => esc_html__( 'Forums', 'pressville' ),
                    'priority' => 1010,
                ));

                // Sidebar position
                $lsvr_customizer->add_field( 'lsvr_bbpress_sidebar_position', array(
                    'section' => 'lsvr_bbpress_settings',
                    'label' => esc_html__( 'Sidebar Position', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar position for bbPress pages.', 'pressville' ),
                    'type' => 'select',
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'pressville' ),
                        'left' => esc_html__( 'Left', 'pressville' ),
                        'right' => esc_html__( 'Right', 'pressville' ),
                    ),
                    'default' => 'disable',
                    'priority' => 1020,
                ));

                // Sidebar ID
                $lsvr_customizer->add_field( 'lsvr_bbpress_sidebar_id', array(
                    'section' => 'lsvr_bbpress_settings',
                    'label' => esc_html__( 'Sidebar', 'pressville' ),
                    'description' => esc_html__( 'Choose sidebar to display.', 'pressville' ),
                    'type' => 'select',
                    'choices' => lsvr_pressville_get_sidebars(),
                    'priority' => 1030,
                    'required' => array(
                        'setting' => 'lsvr_bbpress_sidebar_position',
                        'operator' => '==',
                        'value' => 'left,right',
                    ),
                ));

        }
    }
}

?>