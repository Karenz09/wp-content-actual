<?php
/**
 * LSVR Galleries widget
 *
 * Display list of lsvr_gallery posts
 */
if ( ! class_exists( 'Lsvr_Widget_Gallery_List' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Gallery_List extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_galleries_gallery_list',
			'classname' => 'lsvr_gallery-list-widget',
			'title' => esc_html__( 'LSVR Galleries', 'lsvr-galleries' ),
			'description' => esc_html__( 'List of Gallery posts', 'lsvr-galleries' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-galleries' ),
					'type' => 'text',
					'default' => esc_html__( 'Galleries', 'lsvr-galleries' ),
				),
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-galleries' ),
					'description' => esc_html__( 'Display galleries only from a certain category.', 'lsvr-galleries' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_gallery_cat',
					'default_label' => esc_html__( 'None', 'lsvr-galleries' ),
				),
				'limit' => array(
					'label' => esc_html__( 'Limit:', 'lsvr-galleries' ),
					'description' => esc_html__( 'Number of galleries to display.', 'lsvr-galleries' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-galleries' ), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					'default' => 4,
				),
				'order' => array(
					'label' => esc_html__( 'Order:', 'lsvr-galleries' ),
					'description' => esc_html__( 'Order of Gallery posts.', 'lsvr-galleries' ),
					'type' => 'select',
					'choices' => array(
						'default' => esc_html__( 'Default', 'lsvr-galleries' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-galleries' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-galleries' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-galleries' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-galleries' ),
                        'random' => esc_html__( 'Random', 'lsvr-galleries' ),
					),
					'default' => 'default',
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

    	// Get gallery posts
    	$query_args = array(
    		'limit' => array_key_exists( 'limit', $instance ) ? (int) $instance[ 'limit' ] : 4,
		);
		if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {
			$query_args['category'] = $instance['category'];
		}
		if ( ! empty( $instance['order'] ) && 'default' !== $instance['order'] ) {
			if ( 'date_desc' == $instance['order'] ) {
				$query_args['orderby'] = 'date';
				$query_args['order'] = 'DESC';
			}
			elseif ( 'date_asc' == $instance['order'] ) {
				$query_args['orderby'] = 'date';
				$query_args['order'] = 'ASC';
			}
			elseif ( 'title_asc' == $instance['order'] ) {
				$query_args['orderby'] = 'title';
				$query_args['order'] = 'ASC';
			}
			elseif ( 'title_desc' == $instance['order'] ) {
				$query_args['orderby'] = 'title';
				$query_args['order'] = 'DESC';
			}
			elseif ( 'random' == $instance['order'] ) {
				$query_args['orderby'] = 'rand';
			}
		}
    	$posts = lsvr_galleries_get( $query_args );

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
  			'show_date' => $show_date,
  			'show_image_count' => $show_image_count,
  			'gallery_posts' => $posts,
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_gallery_list_template_path', 'lsvr-galleries/templates/widgets/gallery-list.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>