<?php
/**
 * LSVR Pressville Container Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Pressville_Container' ) ) {
    class Lsvr_Shortcode_Pressville_Container {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'margin_top' => '',
                    'margin_bottom' => '',
                    'wpautop' => '',
                    'id' => '',
                ),
                $atts
            );

            // Check if wpautop
            $wpautop = '1' === $args['wpautop'] || 'true' === $args['wpautop'] ? true : false;

            // Element class
            $class_arr = array( 'lsvr-pressville-container' );
            if ( ! empty( $args['margin_top'] ) && 'disable' !== $args['margin_top'] ) {
                array_push( $class_arr, 'lsvr-pressville-container--margin-top-' . $args['margin_top'] );
            }
            if ( ! empty( $args['margin_bottom'] ) && 'disable' !== $args['margin_bottom'] ) {
                array_push( $class_arr, 'lsvr-pressville-container--margin-bottom-' . $args['margin_bottom'] );
            }

            $html = '';
            if ( ! empty( $content ) ) {

                $html = '<div class="' . esc_attr( implode( ' ', $class_arr ) ) . '"';
                $html .= ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '">' : '>';
                $html .= '<div class="lsvr-container">';
                $html .= true === $wpautop ? do_shortcode( wpautop( $content ) ) : do_shortcode( $content );
                $html .= '</div></div>';

            }
            return $html;

        }

        // Shortcode params
        public static function lsvr_shortcode_atts() {
            return array_merge( array(

                // Margin top
                array(
                    'name' => 'margin_top',
                    'type' => 'select',
                    'label' => esc_html__( 'Top Margin', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Add top margin to this element.', 'lsvr-pressville-toolkit' ),
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lsvr-pressville-toolkit' ),
                        'small' => esc_html__( 'Small', 'lsvr-pressville-toolkit' ),
                        'medium' => esc_html__( 'Medium', 'lsvr-pressville-toolkit' ),
                    ),
                    'default' => 'disable',
                    'priority' => 10,
                ),

                // Margin bottom
                array(
                    'name' => 'margin_bottom',
                    'type' => 'select',
                    'label' => esc_html__( 'Bottom Margin', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'Add bottom margin to this element.', 'lsvr-pressville-toolkit' ),
                    'choices' => array(
                        'disable' => esc_html__( 'Disable', 'lsvr-pressville-toolkit' ),
                        'small' => esc_html__( 'Small', 'lsvr-pressville-toolkit' ),
                        'medium' => esc_html__( 'Medium', 'lsvr-pressville-toolkit' ),
                    ),
                    'default' => 'disable',
                    'priority' => 20,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-pressville-toolkit' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-pressville-toolkit' ),
                    'priority' => 30,
                ),

            ), apply_filters( 'lsvr_pressville_container_shortcode_atts', array() ) );
        }

    }
}
?>