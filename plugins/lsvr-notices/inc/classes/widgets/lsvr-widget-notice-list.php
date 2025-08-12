<?php
/**
 * LSVR Notice widget
 *
 * Display list of lsvr_notice posts
 */
if ( ! class_exists( 'Lsvr_Widget_Notice_List' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Notice_List extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_notices_notice_list',
			'classname' => 'lsvr_notice-list-widget',
			'title' => esc_html__( 'LSVR Notices', 'lsvr-notices' ),
			'description' => esc_html__( 'List of Notice posts', 'lsvr-notices' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-notices' ),
					'type' => 'text',
					'default' => esc_html__( 'Notices', 'lsvr-notices' ),
				),
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-notices' ),
					'description' => esc_html__( 'Display notices only from a certain category.', 'lsvr-notices' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_notice_cat',
					'default_label' => esc_html__( 'None', 'lsvr-notices' ),
				),
				'limit' => array(
					'label' => esc_html__( 'Limit:', 'lsvr-notices' ),
					'description' => esc_html__( 'Number of notices to display.', 'lsvr-notices' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-notices' ), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					'default' => 4,
				),
				'order' => array(
					'label' => esc_html__( 'Order:', 'lsvr-notices' ),
					'description' => esc_html__( 'Order of notice posts.', 'lsvr-notices' ),
					'type' => 'select',
					'choices' => array(
						'default' => esc_html__( 'Default', 'lsvr-notices' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-notices' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-notices' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-notices' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-notices' ),
                        'random' => esc_html__( 'Random', 'lsvr-notices' ),
					),
					'default' => 'default',
				),
				'show_date' => array(
					'label' => esc_html__( 'Display Date', 'lsvr-notices' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_category' => array(
					'label' => esc_html__( 'Display Category', 'lsvr-notices' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-notices' ),
					'description' => esc_html__( 'Link to notice post archive. Leave blank to hide.', 'lsvr-notices' ),
					'type' => 'text',
					'default' => esc_html__( 'More Notices', 'lsvr-notices' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Show date
    	$show_date = ! empty( $instance['show_date'] ) && ( true === $instance['show_date'] || 'true' === $instance['show_date'] || '1' === $instance['show_date'] ) ? true : false;

    	// Show category
    	$show_category = ! empty( $instance['show_category'] ) && ( true === $instance['show_category'] || 'true' === $instance['show_category'] || '1' === $instance['show_category'] ) ? true : false;

		// Set posts limit
		$limit = array_key_exists( 'limit', $instance ) && (int) $instance[ 'limit' ] > 0 ? $instance[ 'limit' ] : 1000;

    	// Get notice posts
    	$query_args = array(
    		'post_type' => 'lsvr_notice',
    		'posts_per_page' => $limit,
    		'suppress_filters' => false,
		);
		if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'lsvr_notice_cat',
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
  			'show_date' => $show_date,
  			'show_category' => $show_category,
  			'notice_posts' => $posts,
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_notice_list_template_path', 'lsvr-notices/templates/widgets/notice-list.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>