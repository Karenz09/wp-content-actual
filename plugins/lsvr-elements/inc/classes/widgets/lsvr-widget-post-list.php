<?php
/**
 * LSVR Posts widget
 *
 * Display list of posts
 */
if ( ! class_exists( 'Lsvr_Widget_Post_List' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Post_List extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_post_list',
			'classname' => 'lsvr-post-list-widget',
			'title' => esc_html__( 'LSVR Posts', 'lsvr-elements' ),
			'description' => esc_html__( 'List of posts', 'lsvr-elements' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-elements' ),
					'type' => 'text',
					'default' => esc_html__( 'News', 'lsvr-elements' ),
				),
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-elements' ),
					'description' => esc_html__( 'Display posts only from certain category.', 'lsvr-elements' ),
					'type' => 'taxonomy',
					'taxonomy' => 'category',
					'default_label' => esc_html__( 'None', 'lsvr-elements' ),
				),
				'tags' => array(
					'label' => esc_html__( 'Tags:', 'lsvr-elements' ),
					'description' => esc_html__( 'Display only posts with specific tags (add slugs delimited by comma).', 'lsvr-elements' ),
					'type' => 'text',
				),
				'limit' => array(
					'label' => esc_html__( 'Limit:', 'lsvr-elements' ),
					'description' => esc_html__( 'Number of posts to display.', 'lsvr-elements' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-elements' ) ) + range( 0, 10, 1 ),
					'default' => 4,
				),
				'show_thumb' => array(
					'label' => esc_html__( 'Display Thumbnail', 'lsvr-elements' ),
					'type' => 'checkbox',
					'default' => 'true',
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

    	// Show thumb
    	$show_thumb = ! empty( $instance['show_thumb'] ) && ( true === $instance['show_thumb'] || 'true' === $instance['show_thumb'] || '1' === $instance['show_thumb'] ) ? true : false;

    	// Show date
    	$show_date = ! empty( $instance['show_date'] ) && ( true === $instance['show_date'] || 'true' === $instance['show_date'] || '1' === $instance['show_date'] ) ? true : false;

    	// Show category
    	$show_category = ! empty( $instance['show_category'] ) && ( true === $instance['show_category'] || 'true' === $instance['show_category'] || '1' === $instance['show_category'] ) ? true : false;

    	// Get posts
    	$query_args = array(
    		'post_type' => 'post',
    		'posts_per_page' => ! empty( $instance['limit'] ) && (int) $instance[ 'limit' ] > 0 ? (int) $instance[ 'limit' ] : 1000,
    		'suppress_filters' => false,
		);

		// Get categories
		if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {

			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'term_id',
					'terms' => $instance['category'],
				),
			);

		}

        // Get tags
        if ( ! empty( $instance['tags'] ) ) {

        	$tags_query = array(
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => array_map( 'trim', explode( ',', $instance['tags'] ) ),
            );

        	if ( ! empty( $query_args['tax_query'] ) ) {
	            array_push( $query_args['tax_query'], $tags_query );
        	}

        	else {
            	$query_args['tax_query'] = array( $tags_query );
        	}

        }

        // Get posts
    	$posts = new WP_Query( $query_args );
    	wp_reset_query();

        // Prepare template vars
        global $lsvr_template_vars;
        $lsvr_template_vars = array(
            'instance' => $instance,
            'show_thumb' => $show_thumb,
            'show_date' => $show_date,
            'show_category' => $show_category,
            'blog_posts' => ! empty( $posts->posts ) ? $posts->posts : false,
        );

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
            lsvr_framework_load_template( apply_filters( 'lsvr_widget_post_list_template_path', 'lsvr-elements/templates/widgets/post-list.php' ) );
        }

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>