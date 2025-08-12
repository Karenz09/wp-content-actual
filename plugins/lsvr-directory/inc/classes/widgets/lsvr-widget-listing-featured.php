<?php
/**
 * LSVR Featured Listing widget
 *
 * Single lsvr_listing post
 */
if ( ! class_exists( 'Lsvr_Widget_Listing_Featured' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Listing_Featured extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_directory_listing_featured',
			'classname' => 'lsvr_listing-featured-widget',
			'title' => esc_html__( 'LSVR Featured Directory Listing', 'lsvr-directory' ),
			'description' => esc_html__( 'Single directory Listing post', 'lsvr-directory' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-directory' ),
					'type' => 'text',
					'default' => esc_html__( 'Featured Listing', 'lsvr-directory' ),
				),
				'post' => array(
					'label' => esc_html__( 'Listing:', 'lsvr-directory' ),
					'description' => esc_html__( 'Choose listing to display.', 'lsvr-directory' ),
					'type' => 'post',
					'post_type' => 'lsvr_listing',
                    'default_label' => esc_html__( 'Random', 'lsvr-directory' ),
				),
                'show_address' => array(
                    'label' => esc_html__( 'Display Address', 'lsvr-directory' ),
                    'type' => 'checkbox',
                    'default' => 'true',
                ),
                'show_category' => array(
                    'label' => esc_html__( 'Display Category', 'lsvr-directory' ),
                    'type' => 'checkbox',
                    'default' => 'true',
                ),
                'show_excerpt' => array(
                    'label' => esc_html__( 'Display Excerpt', 'lsvr-directory' ),
                    'type' => 'checkbox',
                    'default' => 'false',
                ),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-directory' ),
                    'description' => esc_html__( 'Link to listing post archive. Leave blank to hide.', 'lsvr-directory' ),
					'type' => 'text',
					'default' => esc_html__( 'More Listings', 'lsvr-directory' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

        // Show address
        $show_address = ! empty( $instance['show_address'] ) && ( true === $instance['show_address'] || 'true' === $instance['show_address'] || '1' === $instance['show_address'] ) ? true : false;

        // Show category
        $show_category = ! empty( $instance['show_category'] ) && ( true === $instance['show_category'] || 'true' === $instance['show_category'] || '1' === $instance['show_category'] ) ? true : false;

        // Show excerpt
        $show_excerpt = ! empty( $instance['show_excerpt'] ) && ( true === $instance['show_excerpt'] || 'true' === $instance['show_excerpt'] || '1' === $instance['show_excerpt'] ) ? true : false;

        // Get random post
        if ( empty( $instance['post'] ) || ( ! empty( $instance['post'] ) && 'none' === $instance['post'] ) ) {
            $listing_post = get_posts( array(
                'post_type' => 'lsvr_listing',
                'orderby' => 'rand',
                'posts_per_page' => '1'
            ));
            $listing_post = ! empty( $listing_post[0] ) ? $listing_post[0] : '';
        }

        // Get post
        else if ( ! empty( $instance['post'] ) ) {
            $listing_post = get_post( $instance['post'] );
        }

        // Prepare template vars
        global $lsvr_template_vars;
        $lsvr_template_vars = array(
            'instance' => $instance,
            'show_address' => $show_address,
            'show_category' => $show_category,
            'show_excerpt' => $show_excerpt,
            'listing_post' => ! empty( $listing_post ) ? $listing_post : '',
        );

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
            lsvr_framework_load_template( apply_filters( 'lsvr_widget_listing_featured_template_path', 'lsvr-directory/templates/widgets/listing-featured.php' ) );
        }

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>