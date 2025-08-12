<?php
/**
 * LSVR Directory widget
 *
 * Display list of lsvr_listing posts
 */
if ( ! class_exists( 'Lsvr_Widget_Listing_List' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Listing_List extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct( array(
			'id' => 'lsvr_directory_listing_list',
			'classname' => 'lsvr_listing-list-widget',
			'title' => esc_html__( 'LSVR Directory', 'lsvr-directory' ),
			'description' => esc_html__( 'List of Directory listing posts', 'lsvr-directory' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-directory' ),
					'type' => 'text',
					'default' => esc_html__( 'Directory', 'lsvr-directory' ),
				),
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-directory' ),
					'description' => esc_html__( 'Display listings only from a certain category.', 'lsvr-directory' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_listing_cat',
					'default_label' => esc_html__( 'None', 'lsvr-directory' ),
				),
				'limit' => array(
					'label' => esc_html__( 'Limit:', 'lsvr-directory' ),
					'description' => esc_html__( 'Number of listings to display.', 'lsvr-directory' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-directory' ), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					'default' => 4,
				),
				'order' => array(
					'label' => esc_html__( 'Order:', 'lsvr-directory' ),
					'description' => esc_html__( 'Order of listing posts.', 'lsvr-directory' ),
					'type' => 'select',
					'choices' => array(
						'default' => esc_html__( 'Default', 'lsvr-directory' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-directory' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-directory' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-directory' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-directory' ),
                        'random' => esc_html__( 'Random', 'lsvr-directory' ),
					),
					'default' => 'default',
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

		// Set posts limit
		$limit = array_key_exists( 'limit', $instance ) && (int) $instance[ 'limit' ] > 0 ? $instance[ 'limit' ] : 1000;

    	// Get person posts
    	$query_args = array(
    		'post_type' => 'lsvr_listing',
    		'posts_per_page' => $limit,
    		'suppress_filters' => false,
		);
		if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'lsvr_listing_cat',
					'field' => 'term_id',
					'terms' => $instance['category'],
				),
			);
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
    	$posts = get_posts( $query_args );

        // Prepare template vars
        global $lsvr_template_vars;
        $lsvr_template_vars = array(
            'instance' => $instance,
            'show_address' => $show_address,
            'show_category' => $show_category,
            'listing_posts' => $posts,
        );

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
            lsvr_framework_load_template( apply_filters( 'lsvr_widget_listing_list_template_path', 'lsvr-directory/templates/widgets/listing-list.php' ) );
        }

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>