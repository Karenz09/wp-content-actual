<?php
/**
 * Button Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Button' ) ) {
    class Lsvr_Shortcode_Button {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Prepare default atts
            $default_atts = array(
                'label' => '',
                'link' => '',
                'size' => '',
                'open_in_new_window' => '',
                'id' => '',
                'className' => '',
                'editor_view' => false,
            );

            // Merge default atts with custom atts
            if ( ! empty( apply_filters( 'lsvr_button_shortcode_atts', array() ) ) ) {

                $default_atts = array_merge(
                    $default_atts,
                    array_fill_keys( array_column( apply_filters( 'lsvr_button_shortcode_atts', array() ), 'name' ), '' )
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
            $class = array( 'lsvr-button' );
            if ( true === $editor_view ) {
                array_push( $class, 'lsvr-button--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class, $args['className'] );
            }
            if ( ! empty( $args['size'] ) ) {
                array_push( $class, 'lsvr-button--' . $args['size'] );
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
                lsvr_framework_load_template( apply_filters( 'lsvr_shortcode_button_template_path', 'lsvr-elements/templates/shortcodes/button.php' ) );
            }

            return ob_get_clean();

        }

        // Shortcode params
        public static function lsvr_shortcode_atts() {
            return array_merge( array(

                // Label
                array(
                    'name' => 'label',
                    'type' => 'text',
                    'label' => esc_html__( 'Label', 'lsvr-elements' ),
                    'description' => esc_html__( 'Button label.', 'lsvr-elements' ),
                    'default' =>  esc_html__( 'Button', 'lsvr-elements' ),
                    'priority' => 10,
                ),

                // Link
                array(
                    'name' => 'link',
                    'type' => 'text',
                    'label' => esc_html__( 'Link', 'lsvr-elements' ),
                    'description' => esc_html__( 'Button URL.', 'lsvr-elements' ),
                    'default' =>  esc_html__( 'http://www.example.org', 'lsvr-elements' ),
                    'priority' => 20,
                ),

                // Size
                array(
                    'name' => 'size',
                    'type' => 'select',
                    'label' => esc_html__( 'Size', 'lsvr-elements' ),
                    'description' => esc_html__( 'Button size.', 'lsvr-elements' ),
                    'choices' => array(
                        'small' => esc_html__( 'Small', 'lsvr-elements' ),
                        'medium' => esc_html__( 'Medium', 'lsvr-elements' ),
                        'large' => esc_html__( 'Large', 'lsvr-elements' ),
                    ),
                    'default' => 'medium',
                    'priority' => 30,
                ),

                // Open in a new window
                array(
                    'name' => 'open_in_new_window',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Open link in a new window', 'lsvr-townpress-toolkit' ),
                    'default' => false,
                    'priority' => 40,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-elements' ),
                    'priority' => 50,
                ),

            ), apply_filters( 'lsvr_button_shortcode_atts', array() ) );
        }

    }
}
?>