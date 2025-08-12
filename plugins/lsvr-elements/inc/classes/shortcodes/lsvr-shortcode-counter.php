<?php
/**
 * Counter Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Counter' ) ) {
    class Lsvr_Shortcode_Counter {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Prepare default atts
            $default_atts = array(
                'number' => '',
                'number_unit' => '',
                'label' => '',
                'id' => '',
                'className' => '',
                'editor_view' => false,
            );

            // Merge default atts with custom atts
            if ( ! empty( apply_filters( 'lsvr_counter_shortcode_atts', array() ) ) ) {

                $default_atts = array_merge(
                    $default_atts,
                    array_fill_keys( array_column( apply_filters( 'lsvr_counter_shortcode_atts', array() ), 'name' ), '' )
                );

            }

            // Merge default atts and received atts
            $args = shortcode_atts(
                $default_atts,
                $atts
            );

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Get class
            $class = array( 'lsvr-counter' );
            if ( true === $editor_view ) {
                array_push( $class, 'lsvr-counter--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class, $args['className'] );
            }

            // Prepare template vars
            global $lsvr_template_vars;
            $lsvr_template_vars = array(
                'args' => $args,
                'class' => $class,
                'editor_view' => $editor_view,
            );

            ob_start();

            // Load template
            if ( function_exists( 'lsvr_framework_load_template' ) ) {
                lsvr_framework_load_template( apply_filters( 'lsvr_shortcode_counter_template_path', 'lsvr-elements/templates/shortcodes/counter.php' ) );
            }

            return ob_get_clean();

        }

        // Shortcode params
        public static function lsvr_shortcode_atts() {
            return array_merge( array(

                // Number
                array(
                    'name' => 'number',
                    'type' => 'text',
                    'label' => esc_html__( 'Number', 'lsvr-elements' ),
                    'description' => esc_html__( 'Counter number.', 'lsvr-elements' ),
                    'default' => 50,
                    'priority' => 10,
                ),

                // Number unit
                array(
                    'name' => 'number_unit',
                    'type' => 'text',
                    'label' => esc_html__( 'Unit', 'lsvr-elements' ),
                    'description' => esc_html__( 'Number unit.', 'lsvr-elements' ),
                    'default' => esc_html__( '%', 'lsvr-elements' ),
                    'priority' => 20,
                ),

                // Label
                array(
                    'name' => 'label',
                    'type' => 'text',
                    'label' => esc_html__( 'Label', 'lsvr-elements' ),
                    'description' => esc_html__( 'Short text description.', 'lsvr-elements' ),
                    'default' => esc_html__( 'Counter', 'lsvr-elements' ),
                    'priority' => 30,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-elements' ),
                    'priority' => 40,
                ),

            ), apply_filters( 'lsvr_counter_shortcode_atts', array() ) );
        }

    }
}
?>