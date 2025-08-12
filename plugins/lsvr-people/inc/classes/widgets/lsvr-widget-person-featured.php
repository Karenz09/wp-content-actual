<?php
/**
 * LSVR Featured Person widget
 *
 * Display single lsvr_person post
 */
if ( ! class_exists( 'Lsvr_Widget_Person_Featured' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Person_Featured extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_people_person_featured',
			'classname' => 'lsvr_person-featured-widget',
			'title' => esc_html__( 'LSVR Featured Person', 'lsvr-people' ),
			'description' => esc_html__( 'Single Person post', 'lsvr-people' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-people' ),
					'type' => 'text',
					'default' => esc_html__( 'Featured Person', 'lsvr-people' ),
				),
				'post' => array(
					'label' => esc_html__( 'Person:', 'lsvr-people' ),
					'description' => esc_html__( 'Choose person to display', 'lsvr-people' ),
					'type' => 'post',
					'post_type' => 'lsvr_person',
					'default_label' => esc_html__( 'Random', 'lsvr-people' ),
				),
				'show_excerpt' => array(
					'label' => esc_html__( 'Display Excerpt', 'lsvr-people' ),
					'type' => 'checkbox',
					'default' => 'true',
				),
				'show_social' => array(
					'label' => esc_html__( 'Display Social Links', 'lsvr-people' ),
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

    	// Show excerpt
    	$show_excerpt = ! empty( $instance['show_excerpt'] ) && ( true === $instance['show_excerpt'] || 'true' === $instance['show_excerpt'] || '1' === $instance['show_excerpt'] ) ? true : false;

    	// Show social
    	$show_social = ! empty( $instance['show_social'] ) && ( true === $instance['show_social'] || 'true' === $instance['show_social'] || '1' === $instance['show_social'] ) ? true : false;

    	// Get random post
    	if ( empty( $instance['post'] ) || ( ! empty( $instance['post'] ) && 'none' === $instance['post'] ) ) {
    		$person_post = get_posts( array(
    			'post_type' => 'lsvr_person',
    			'orderby' => 'rand',
    			'posts_per_page' => '1'
			));
			$person_post = ! empty( $person_post[0] ) ? $person_post[0] : '';
    	}

    	// Get post
    	elseif ( ! empty( $instance['post'] ) ) {
    		$person_post = get_post( $instance['post'] );
    	}

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
  			'show_excerpt' => $show_excerpt,
  			'show_social' => $show_social,
  			'person_post' => ! empty( $person_post ) ? $person_post : '',
		);

        // Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_person_featured_template_path', 'lsvr-people/templates/widgets/person-featured.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance );

    }

}}

?>