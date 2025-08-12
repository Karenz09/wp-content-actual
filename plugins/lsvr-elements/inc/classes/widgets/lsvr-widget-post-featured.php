<?php
/**
 * LSVR Featured post widget
 *
 * Single post
 */
if ( ! class_exists( 'Lsvr_Widget_Post_Featured' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Post_Featured extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_post_featured',
			'classname' => 'lsvr-post-featured-widget',
			'title' => esc_html__( 'LSVR Featured Post', 'lsvr-elements' ),
			'description' => esc_html__( 'Single post', 'lsvr-elements' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-elements' ),
					'type' => 'text',
					'default' => esc_html__( 'Featured Post', 'lsvr-elements' ),
				),
				'post' => array(
					'label' => esc_html__( 'Post:', 'lsvr-elements' ),
					'description' => esc_html__( 'Choose post to display.', 'lsvr-elements' ),
					'type' => 'post',
					'post_type' => 'post',
                    'default_label' => esc_html__( 'Random', 'lsvr-elements' ),
				),
                'show_date' => array(
                    'label' => esc_html__( 'Display Date', 'lsvr-elements' ),
                    'type' => 'checkbox',
                    'default' => 'true',
                ),
                'show_category' => array(
                    'label' => esc_html__( 'Display Category', 'lsvr-elements' ),
                    'type' => 'checkbox',
                    'default' => 'true',
                ),
                'show_excerpt' => array(
                    'label' => esc_html__( 'Display Excerpt', 'lsvr-elements' ),
                    'type' => 'checkbox',
                    'default' => 'true',
                ),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-elements' ),
                    'description' => esc_html__( 'Link to post archive. Leave blank to hide.', 'lsvr-elements' ),
					'type' => 'text',
					'default' => esc_html__( 'More Posts', 'lsvr-elements' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

        // Show date
        $show_date = ! empty( $instance['show_date'] ) && ( true === $instance['show_date'] || 'true' === $instance['show_date'] || '1' === $instance['show_date'] ) ? true : false;

        // Show category
        $show_category = ! empty( $instance['show_category'] ) && ( true === $instance['show_category'] || 'true' === $instance['show_category'] || '1' === $instance['show_category'] ) ? true : false;

        // Show excerpt
        $show_excerpt = ! empty( $instance['show_excerpt'] ) && ( true === $instance['show_excerpt'] || 'true' === $instance['show_excerpt'] || '1' === $instance['show_excerpt'] ) ? true : false;

        // Get random post
        if ( empty( $instance['post'] ) || ( ! empty( $instance['post'] ) && 'none' === $instance['post'] ) ) {
            $post = get_posts( array(
                'post_type' => 'post',
                'orderby' => 'rand',
                'posts_per_page' => '1'
            ));
            $post = ! empty( $post[0] ) ? $post[0] : '';
        }

        // Get post
        elseif ( ! empty( $instance['post'] ) ) {
            $post = get_post( $instance['post'] );
        }

        // Prepare template vars
        global $lsvr_template_vars;
        $lsvr_template_vars = array(
            'instance' => $instance,
            'show_date' => $show_date,
            'show_category' => $show_category,
            'show_excerpt' => $show_excerpt,
            'blog_post' => $post,
        );

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
            lsvr_framework_load_template( apply_filters( 'lsvr_widget_post_featured_template_path', 'lsvr-elements/templates/widgets/post-featured.php' ) );
        }

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>