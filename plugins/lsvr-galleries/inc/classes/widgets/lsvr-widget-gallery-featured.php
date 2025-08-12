<?php
/**
 * LSVR Featured Gallery widget
 *
 * Single lsvr_gallery post
 */
if ( ! class_exists( 'Lsvr_Widget_Gallery_Featured' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Gallery_Featured extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_galleries_gallery_featured',
			'classname' => 'lsvr_gallery-featured-widget',
			'title' => esc_html__( 'LSVR Featured Gallery', 'lsvr-galleries' ),
			'description' => esc_html__( 'Single Gallery post', 'lsvr-galleries' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-galleries' ),
					'type' => 'text',
					'default' => esc_html__( 'Featured Gallery', 'lsvr-galleries' ),
				),
				'post' => array(
					'label' => esc_html__( 'Gallery:', 'lsvr-galleries' ),
					'description' => esc_html__( 'Choose gallery to display.', 'lsvr-galleries' ),
					'type' => 'post',
					'post_type' => 'lsvr_gallery',
					'default_label' => esc_html__( 'Random', 'lsvr-galleries' ),
				),
				'show_date' => array(
					'label' => esc_html__( 'Display Date', 'lsvr-galleries' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_image_count' => array(
					'label' => esc_html__( 'Display Image Count', 'lsvr-galleries' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_excerpt' => array(
					'label' => esc_html__( 'Display Excerpt', 'lsvr-galleries' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-galleries' ),
					'description' => esc_html__( 'Link to gallery post archive. Leave blank to hide.', 'lsvr-galleries' ),
					'type' => 'text',
					'default' => esc_html__( 'More Galleries', 'lsvr-galleries' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Show date
    	$show_date = ! empty( $instance['show_date'] ) && ( true === $instance['show_date'] || 'true' === $instance['show_date'] || '1' === $instance['show_date'] ) ? true : false;

    	// Show image count
    	$show_image_count = ! empty( $instance['show_image_count'] ) && ( true === $instance['show_image_count'] || 'true' === $instance['show_image_count'] || '1' === $instance['show_image_count'] ) ? true : false;

    	// Show excerpt
    	$show_excerpt = ! empty( $instance['show_excerpt'] ) && ( true === $instance['show_excerpt'] || 'true' === $instance['show_excerpt'] || '1' === $instance['show_excerpt'] ) ? true : false;

    	// Get random post
    	if ( empty( $instance['post'] ) || ( ! empty( $instance['post'] ) && 'none' === $instance['post'] ) ) {
    		$gallery_post = get_posts( array(
    			'post_type' => 'lsvr_gallery',
    			'orderby' => 'rand',
    			'posts_per_page' => '1'
			));
			$gallery_post = ! empty( $gallery_post[0] ) ? $gallery_post[0] : '';
    	}

    	// Get post
    	else if ( ! empty( $instance['post'] ) ) {
    		$gallery_post = get_post( $instance['post'] );
    	}

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
  			'show_date' => $show_date,
  			'show_image_count' => $show_image_count,
  			'show_excerpt' => $show_excerpt,
  			'gallery_post' => ! empty( $gallery_post ) ? $gallery_post : '',
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_gallery_featured_template_path', 'lsvr-galleries/templates/widgets/gallery-featured.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>