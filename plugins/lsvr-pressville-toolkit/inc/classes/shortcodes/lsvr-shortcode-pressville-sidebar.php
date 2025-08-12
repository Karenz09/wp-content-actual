<?php
/**
 * LSVR Pressville Sidebar Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Pressville_Sidebar' ) ) {
    class Lsvr_Shortcode_Pressville_Sidebar {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Prepare default atts
            $default_atts = array(
                'id' => '',
                'sidebar_id' => 'lsvr-pressville-default-sidebar',
                'columns_count' => 3,
                'enable_dark_bg' => '',
                'className' => '',
                'editor_view' => false,
            );

            // Merge default atts with custom atts
            if ( ! empty( apply_filters( 'lsvr_pressville_sidebar_shortcode_atts', array() ) ) ) {

                $default_atts = array_merge(
                    $default_atts,
                    array_fill_keys( array_column( apply_filters( 'lsvr_pressville_sidebar_shortcode_atts', array() ), 'name' ), '' )
                );

            }

            // Merge default atts and received atts
            $args = shortcode_atts(
                $default_atts,
                $atts
            );

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Check if dark BG
            $enable_dark_bg = true === $args['enable_dark_bg'] || '1' === $args['enable_dark_bg'] || 'true' === $args['enable_dark_bg'] ? true : false;

            // Element class
            $class_arr = array( 'lsvr-pressville-sidebar' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-pressville-sidebar--editor-view' );
            }
            if ( true === $enable_dark_bg ) {
                array_push( $class_arr, 'lsvr-pressville-sidebar--dark-bg' );
            } else {
                array_push( $class_arr, 'lsvr-pressville-sidebar--no-bg' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            // Prepare template vars
            global $lsvr_template_vars;
            $lsvr_template_vars = array(
                'args' => $args,
                'enable_dark_bg' => $enable_dark_bg,
                'class_arr' => $class_arr,
                'editor_view' => $editor_view,
            );

            ob_start();

            // Load template
            if ( function_exists( 'lsvr_framework_load_template' ) ) {
                lsvr_framework_load_template( apply_filters( 'lsvr_shortcode_pressville_sidebar_template_path', 'lsvr-pressville-toolkit/templates/shortcodes/pressville-sidebar.php' ) );
            }

            return ob_get_clean();

        }

        // Shortcode params
        public static function lsvr_shortcode_atts() {
            return array_merge( array(

                // Sidebar ID
                array(
                    'name' => 'sidebar_id',
                    'type' => 'select',
                    'label' => esc_html__( 'Sidebar', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Choose which sidebar will be used to create this section. You can manage custom sidebars under Customizer / Custom Sidebars and populate them with widgets under Appearance / Widgets.', 'lsvr-pressville-toolkit' ),
                    'choices' => lsvr_pressville_toolkit_get_sidebars(),
                    'default' => 'lsvr-pressville-default-sidebar',
                    'priority' => 10,
                ),

                // Columns count
                array(
                    'name' => 'columns_count',
                    'type' => 'select',
                    'label' => esc_html__( 'Number of Columns', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'How many columns should be used to display the widgets.', 'lsvr-pressville-toolkit' ),
                    'choices' => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
                    'default' => 3,
                    'priority' => 20,
                ),

                // Enable dark BG
                array(
                    'name' => 'enable_dark_bg',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Darken Background', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Darken the background color of this element.', 'lsvr-pressville-toolkit' ),
                    'priority' => 30,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-pressville-toolkit' ),
                    'priority' => 40,
                ),

            ), apply_filters( 'lsvr_pressville_sidebar_shortcode_atts', array() ) );
        }

    }
}
?>