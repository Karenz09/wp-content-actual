<?php
/**
 * LSVR People widget
 *
 * Display list of lsvr_person posts
 */
if ( ! class_exists( 'Lsvr_Widget_Person_List' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Person_List extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_people_person_list',
			'classname' => 'lsvr_person-list-widget',
			'title' => esc_html__( 'LSVR People', 'lsvr-people' ),
			'description' => esc_html__( 'List of Person posts', 'lsvr-people' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-people' ),
					'type' => 'text',
					'default' => esc_html__( 'People', 'lsvr-people' ),
				),
				'category' => array(
					'label' => esc_html__( 'Category:', 'lsvr-people' ),
					'description' => esc_html__( 'Display people only from a certain category', 'lsvr-people' ),
					'type' => 'taxonomy',
					'taxonomy' => 'lsvr_person_cat',
					'default_label' => esc_html__( 'None', 'lsvr-people' ),
				),
				'limit' => array(
					'label' => esc_html__( 'Limit:', 'lsvr-people' ),
					'description' => esc_html__( 'Number of people to display', 'lsvr-people' ),
					'type' => 'select',
					'choices' => array( 0 => esc_html__( 'All', 'lsvr-people' ), 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ),
					'default' => 4,
				),
				'order' => array(
					'label' => esc_html__( 'Order:', 'lsvr-people' ),
					'description' => esc_html__( 'Order of Person posts.', 'lsvr-people' ),
					'type' => 'select',
					'choices' => array(
						'default' => esc_html__( 'Default', 'lsvr-people' ),
                        'date_desc' => esc_html__( 'By date, newest first', 'lsvr-people' ),
                        'date_asc' => esc_html__( 'By date, oldest first', 'lsvr-people' ),
                        'title_asc' => esc_html__( 'By title, ascending', 'lsvr-people' ),
                        'title_desc' => esc_html__( 'By title, descending', 'lsvr-people' ),
                        'random' => esc_html__( 'Random', 'lsvr-people' ),
					),
					'default' => 'default',
				),
				'show_social' => array(
					'label' => esc_html__( 'Display Social Links', 'lsvr-documents' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-people' ),
					'description' => esc_html__( 'Link to person post archive. Leave blank to hide', 'lsvr-people' ),
					'type' => 'text',
					'default' => esc_html__( 'More People', 'lsvr-people' ),
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Show social
    	$show_social = ! empty( $instance['show_social'] ) && ( true === $instance['show_social'] || 'true' === $instance['show_social'] || '1' === $instance['show_social'] ) ? true : false;

		// Set posts limit
		$limit = array_key_exists( 'limit', $instance ) && (int) $instance[ 'limit' ] > 0 ? $instance[ 'limit' ] : 1000;

    	// Get person posts
    	$query_args = array(
    		'post_type' => 'lsvr_person',
    		'posts_per_page' => $limit,
    		'suppress_filters' => false,
		);
		if ( ! empty( $instance['category'] ) && 'none' !== $instance['category'] ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'lsvr_person_cat',
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
  			'show_social' => $show_social,
  			'person_posts' => $posts,
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_person_list_template_path', 'lsvr-people/templates/widgets/person-list.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>