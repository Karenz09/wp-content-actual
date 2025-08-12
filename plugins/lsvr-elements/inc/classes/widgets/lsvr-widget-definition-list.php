<?php
/**
 * LSVR Definition List widget
 *
 * Display list of definitions
 */
if ( ! class_exists( 'Lsvr_Widget_Definition_List' ) && class_exists( 'Lsvr_Widget' ) ) {
class Lsvr_Widget_Definition_List extends Lsvr_Widget {

    public function __construct() {

    	// Init widget
		parent::__construct(array(
			'id' => 'lsvr_definition_list',
			'classname' => 'lsvr-definition-list-widget',
			'title' => esc_html__( 'LSVR Definition List', 'lsvr-elements' ),
			'description' => esc_html__( 'List of definitions', 'lsvr-elements' ),
			'fields' => array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item1_title' => array(
					'label' => esc_html__( 'Item 1 Title:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item1_text' => array(
					'label' => esc_html__( 'Item 1 Text:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item1_text_link' => array(
					'label' => esc_html__( 'Item 1 Text Link:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item2_title' => array(
					'label' => esc_html__( 'Item 2 Title:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item2_text' => array(
					'label' => esc_html__( 'Item 2 Text:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item2_text_link' => array(
					'label' => esc_html__( 'Item 2 Text Link:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item3_title' => array(
					'label' => esc_html__( 'Item 3 Title:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item3_text' => array(
					'label' => esc_html__( 'Item 3 Text:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item3_text_link' => array(
					'label' => esc_html__( 'Item 3 Text Link:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item4_title' => array(
					'label' => esc_html__( 'Item 4 Title:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item4_text' => array(
					'label' => esc_html__( 'Item 4 Text:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item4_text_link' => array(
					'label' => esc_html__( 'Item 4 Text Link:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item5_title' => array(
					'label' => esc_html__( 'Item 5 Title:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item5_text' => array(
					'label' => esc_html__( 'Item 5 Text:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'item5_text_link' => array(
					'label' => esc_html__( 'Item 5 Text Link:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'more_label' => array(
					'label' => esc_html__( 'More Button Label:', 'lsvr-elements' ),
					'type' => 'text',
				),
				'more_link' => array(
					'label' => esc_html__( 'More Button Link:', 'lsvr-elements' ),
					'type' => 'text',
				),
			),
		));

    }

    function widget( $args, $instance ) {

    	// Prepare template vars
    	global $lsvr_template_vars;
  		$lsvr_template_vars = array(
  			'instance' => $instance,
		);

		// Before widget content
        parent::before_widget_content( $args, $instance );

        // Load template
        if ( function_exists( 'lsvr_framework_load_template' ) ) {
			lsvr_framework_load_template( apply_filters( 'lsvr_widget_definition_list_template_path', 'lsvr-elements/templates/widgets/definition-list.php' ) );
		}

        // After widget content
        parent::after_widget_content( $args, $instance ); ?>

        <?php

    }

}}

?>