<?php
/**
 * LSVR Pressville Sitemap Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Pressville_Sitemap' ) ) {
    class Lsvr_Shortcode_Pressville_Sitemap {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Prepare default atts
            $default_atts = array(
                'id' => '',
                'bg_image' => '',
                'menu_id' => '',
                'columns_count' => 2,
                'className' => '',
                'editor_view' => false,
            );

            // Merge default atts with custom atts
            if ( ! empty( apply_filters( 'lsvr_pressville_sitemap_shortcode_atts', array() ) ) ) {

                $default_atts = array_merge(
                    $default_atts,
                    array_fill_keys( array_column( apply_filters( 'lsvr_pressville_sitemap_shortcode_atts', array() ), 'name' ), '' )
                );

            }

            // Merge default atts and received atts
            $args = shortcode_atts(
                $default_atts,
                $atts
            );

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Prepare bg image
            if ( ( ! empty( $args['bg_image'] ) && is_numeric( $args['bg_image'] ) && (int) $args['bg_image'] > 0 )
                || ( is_array( $args['bg_image'] ) && ! empty( $args['bg_image']['id'] ) ) ) {

                $image_id = is_array( $args['bg_image'] ) && ! empty( $args['bg_image']['id'] ) ? (int) $args['bg_image']['id'] : (int) $args['bg_image'];
                $image_data = wp_get_attachment_image_src( $image_id, 'full' );

                if ( ! empty( $image_data[0] ) ) {
                    $bg_image_url = $image_data[0];
                }

            } elseif ( ! empty( $args['bg_image'] ) && ! is_array( $args['bg_image'] ) ) {
                $bg_image_url = $args['bg_image'];
            }

            // Element class
            $class_arr = array( 'lsvr-pressville-sitemap' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr-pressville-sitemap--editor-view' );
            }
            if ( ! empty( $bg_image_url ) ) {
                array_push( $class_arr, 'lsvr-pressville-sitemap--has-bg' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            // Prepare template vars
            global $lsvr_template_vars;
            $lsvr_template_vars = array(
                'args' => $args,
                'bg_image_url' => ! empty( $bg_image_url ) ? $bg_image_url : '',
                'class_arr' => $class_arr,
                'editor_view' => $editor_view,
            );

            ob_start();

            // Load template
            if ( function_exists( 'lsvr_framework_load_template' ) ) {
                lsvr_framework_load_template( apply_filters( 'lsvr_shortcode_pressville_sitemap_template_path', 'lsvr-pressville-toolkit/templates/shortcodes/pressville-sitemap.php' ) );
            }

            return ob_get_clean();

        }

        // Shortcode params
        public static function lsvr_shortcode_atts() {
            return array_merge( array(

                // Menu ID
                array(
                    'name' => 'menu_id',
                    'type' => 'menu',
                    'label' => esc_html__( 'Menu', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Choose which menu will be used to create the sitemap. You can manage menus under Appearance / Menus.', 'lsvr-pressville-toolkit' ),
                    'default' => 'none',
                    'priority' => 10,
                ),

                // Background image
                array(
                    'name' => 'bg_image',
                    'type' => 'image',
                    'label' => esc_html__( 'Background Image', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Optimal resolution is about 2000x1600px or more.', 'lsvr-pressville-toolkit' ),
                    'priority' => 20,
                ),

                // Columns count
                array(
                    'name' => 'columns_count',
                    'type' => 'select',
                    'label' => esc_html__( 'Number of Columns', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'How many columns should be used to display the sitemap.', 'lsvr-pressville-toolkit' ),
                    'choices' => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
                    'default' => 2,
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

            ), apply_filters( 'lsvr_pressville_sitemap_shortcode_atts', array() ) );
        }

    }
}
?>