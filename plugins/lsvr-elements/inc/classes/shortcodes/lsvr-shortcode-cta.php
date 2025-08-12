<?php
/**
 * CTA Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_CTA' ) ) {
    class Lsvr_Shortcode_CTA {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Prepare default atts
            $default_atts = array(
                'title' => '',
                'text' => '',
                'more_label' => '',
                'more_link' => '',
                'open_in_new_window' => '',
                'id' => '',
                'className' => '',
                'editor_view' => false,
            );

            // Merge default atts with custom atts
            if ( ! empty( apply_filters( 'lsvr_cta_shortcode_atts', array() ) ) ) {

                $default_atts = array_merge(
                    $default_atts,
                    array_fill_keys( array_column( apply_filters( 'lsvr_cta_shortcode_atts', array() ), 'name' ), '' )
                );

            }

            // Merge default atts and received atts
            $args = shortcode_atts(
                $default_atts,
                $atts
            );

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Check if open in new window
            $open_in_new_window = true === $args['open_in_new_window'] || '1' === $args['open_in_new_window'] || 'true' === $args['open_in_new_window'] ? true : false;

            // Get class
            $class = array( 'lsvr-cta' );
            if ( true === $editor_view ) {
                array_push( $class, 'lsvr-cta--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class, $args['className'] );
            }
            if ( ! empty( $args['more_label'] ) && ! empty( $args['more_link'] ) ) {
                array_push( $class, 'lsvr-cta--has-button' );
            }

            // Prepare template vars
            global $lsvr_template_vars;
            $lsvr_template_vars = array(
                'args' => $args,
                'open_in_new_window' => $open_in_new_window,
                'class' => $class,
                'editor_view' => $editor_view,
            );

            ob_start();

            // Load template
            if ( function_exists( 'lsvr_framework_load_template' ) ) {
                lsvr_framework_load_template( apply_filters( 'lsvr_shortcode_cta_template_path', 'lsvr-elements/templates/shortcodes/cta.php' ) );
            }

            return ob_get_clean();

        }

        // Shortcode params
        public static function lsvr_shortcode_atts() {
            return array_merge( array(

                // Title
                array(
                    'name' => 'title',
                    'type' => 'text',
                    'label' => esc_html__( 'Title', 'lsvr-elements' ),
                    'default' => esc_html__( 'CTA', 'lsvr-elements' ),
                    'priority' => 10,
                ),

                // Text
                array(
                    'name' => 'text',
                    'type' => 'textarea',
                    'label' => esc_html__( 'Text', 'lsvr-elements' ),
                    'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 'lsvr-elements' ),
                    'priority' => 20,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Label', 'lsvr-elements' ),
                    'default' => esc_html__( 'Learn more', 'lsvr-elements' ),
                    'priority' => 30,
                ),

                // More link
                array(
                    'name' => 'more_link',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Link', 'lsvr-elements' ),
                    'default' => esc_html__( 'http://www.example.org', 'lsvr-elements' ),
                    'priority' => 40,
                ),

                // Open in a new window
                array(
                    'name' => 'open_in_new_window',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Open link in a new window', 'lsvr-elements' ),
                    'default' => false,
                    'priority' => 50,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-elements' ),
                    'priority' => 100,
                ),

            ), apply_filters( 'lsvr_cta_shortcode_atts', array() ) );
        }

    }
}
?>