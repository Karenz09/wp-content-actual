<?php
/**
 * LSVR Listing List Widget Shortcode
 */
if ( ! class_exists( 'Lsvr_Shortcode_Listing_List_Widget' ) ) {
    class Lsvr_Shortcode_Listing_List_Widget {

        public static function shortcode( $atts = array(), $content = null, $tag = '' ) {

            // Merge default atts and received atts
            $args = shortcode_atts(
                array(
                    'title' => '',
                    'icon' => '',
                    'category' => 0,
                    'limit' => 4,
                    'order' => 'default',
                    'show_address' => 'true',
                    'show_category' => 'true',
                    'more_label' => '',
                    'id' => '',
                    'className' => '',
                    'editor_view' => false,
                ),
                $atts
            );

            // Check if editor view
            $editor_view = true === $args['editor_view'] || '1' === $args['editor_view'] || 'true' === $args['editor_view'] ? true : false;

            // Element class
            $class_arr = array( 'widget shortcode-widget lsvr_listing-list-widget lsvr_listing-list-widget--shortcode' );
            if ( true === $editor_view ) {
                array_push( $class_arr, 'lsvr_listing-list-widget--editor-view' );
            }
            if ( ! empty( $args['className'] ) ) {
                array_push( $class_arr, $args['className'] );
            }

            ob_start(); ?>

            <?php the_widget( 'Lsvr_Widget_Listing_List', array(
                'title' => $args['title'],
                'category' => $args['category'],
                'limit' => $args['limit'],
                'order' => $args['order'],
                'show_address' => $args['show_address'],
                'show_category' => $args['show_category'],
                'more_label' => $args['more_label'],
                'editor_view' => $args['editor_view'],
            ), array(
                'before_widget' => '<div' . ( ! empty( $args['id'] ) ? ' id="' . esc_attr( $args['id'] ) . '"' : '' ) . ' class="' . esc_attr( implode( ' ', $class_arr ) ) . '"><div class="widget__inner">',
                'after_widget' => '</div></div>',
                'before_title' => ! empty( $args['icon'] ) ? '<h3 class="widget__title widget__title--has-icon"><span class="widget__title-icon ' . esc_attr( $args['icon'] ) . '" aria-hidden="true"></span>' : '<h3 class="widget__title">',
                'after_title' => '</h3>',
            )); ?>

            <?php return ob_get_clean();

        }

        // Shortcode params
        public static function lsvr_shortcode_atts() {
            return array_merge( array(

                // Title
                array(
                    'name' => 'title',
                    'type' => 'text',
                    'label' => esc_html__( 'Title', 'lsvr-directory' ),
                    'description' => esc_html__( 'Title of this section.', 'lsvr-directory' ),
                    'default' => esc_html__( 'Directory', 'lsvr-directory' ),
                    'priority' => 10,
                ),

                // Category
                array(
                    'name' => 'category',
                    'type' => 'taxonomy',
                    'tax' => 'lsvr_listing_cat',
                    'label' => esc_html__( 'Category', 'lsvr-directory' ),
                    'description' => esc_html__( 'Display listings from a specific category.', 'lsvr-directory' ),
                    'priority' => 20,
                ),

                // Limit
                array(
                    'name' => 'limit',
                    'type' => 'select',
                    'label' => esc_html__( 'Limit', 'lsvr-directory' ),
                    'description' => esc_html__( 'How many listings to display.', 'lsvr-directory' ),
                    'choices' => array( 0 => esc_html__( 'All', 'lsvr-directory' ) ) + range( 0, 20, 1 ),
                    'default' => 4,
                    'priority' => 30,
                ),

                // Order
                array(
                    'name' => 'order',
                    'type' => 'select',
                    'label' => esc_html__( 'Order', 'lsvr-directory' ),
                    'description' => esc_html__( 'Order of listing posts.', 'lsvr-directory' ),
                    'choices' => array(
                        'default' => esc_html__( 'Default', 'lsvr-directory' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-directory' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-directory' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-directory' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-directory' ),
                        'random' => esc_html__( 'Random', 'lsvr-directory' ),
                    ),
                    'default' => 'default',
                    'priority' => 40,
                ),

                // Display address
                array(
                    'name' => 'show_address',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Address', 'lsvr-directory' ),
                    'default' => true,
                    'priority' => 50,
                ),

                // Display category
                array(
                    'name' => 'show_category',
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Display Category', 'lsvr-directory' ),
                    'default' => true,
                    'priority' => 60,
                ),

                // More label
                array(
                    'name' => 'more_label',
                    'type' => 'text',
                    'label' => esc_html__( 'More Link Label', 'lsvr-directory' ),
                    'description' => esc_html__( 'Link to directory archive. Leave blank to hide.', 'lsvr-directory' ),
                    'default' => esc_html__( 'More listings', 'lsvr-directory' ),
                    'priority' => 100,
                ),

                // ID
                array(
                    'name' => 'id',
                    'type' => 'text',
                    'label' => esc_html__( 'Unique ID', 'lsvr-directory' ),
                    'description' => esc_html__( 'You can use this ID to style this specific element with custom CSS, for example.', 'lsvr-directory' ),
                    'priority' => 200,
                ),

            ), apply_filters( 'lsvr_listing_list_widget_shortcode_atts', array() ) );
        }

    }
}
?>