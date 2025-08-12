<?php
/**
 * Pricing Table Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Pricing_Table' ) ) {
    class Lsvr_Shortcode_Pricing_Table {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Prepare default atts
            $default_atts = array(
                'title' => '',
                'price' => '',
                'price_description' => '',
                'text' => '',
                'more_label' => '',
                'more_link' => '',
                'id' => '',
                'className' => '',
                'editor_view' => false,
            );

            // Merge default atts with custom atts
            if ( ! empty( apply_filters( 'lsvr_pricing_table_shortcode_atts', array() ) ) ) {

                $default_atts = array_merge(
                    $default_atts,
                    array_fill_keys( array_column( apply_filters( 'lsvr_pricing_table_shortcode_atts', array() ), 'name' ), '' )
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
            $class = array( 'lsvr-pricing-table' );
            if ( true === $editor_view ) {
                array_push( $class, 'lsvr-pricing-table--editor-view' );
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
                lsvr_framework_load_template( apply_filters( 'lsvr_shortcode_pricing_table_template_path', 'lsvr-elements/templates/shortcodes/pricing-table.php' ) );
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
                    'default' => esc_html__( 'Pricing Table', 'lsvr-elements' ),
                    'priority' => 10,
                ),

                // Price
                array(
                    'name' => 'price',
                    'type' => 'text',
                    'label' => esc_html__( 'Price', 'lsvr-elements' ),
                    'default' => esc_html__( '$99', 'lsvr-elements' ),
                    'priority' => 20,
                ),

                // Price description
                array(
                    'name' => 'price_description',
                    'type' => 'text',
                    'label' => esc_html__( 'Price Description', 'lsvr-elements' ),
                    'default' => esc_html__( 'per year', 'lsvr-elements' ),
                    'priority' => 30,
                ),

                // Text
                array(
                    'name' => 'text',
                    'type' => 'textarea',
                    'label' => esc_html__( 'Text', 'lsvr-elements' ),
                    'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 'lsvr-elements' ),
                    'priority' => 40,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Label', 'lsvr-elements' ),
                    'default' => esc_html__( 'Learn more', 'lsvr-elements' ),
                    'priority' => 50,
                ),

                // More link
                array(
                    'name' => 'more_link',
                    'type' => 'text',
                    'label' => esc_html__( 'More Button Link', 'lsvr-elements' ),
                    'default' => esc_html__( 'http://www.example.org', 'lsvr-elements' ),
                    'priority' => 60,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-elements' ),
                    'priority' => 100,
                ),

            ), apply_filters( 'lsvr_pricing_table_shortcode_atts', array() ) );
        }

    }
}
?>