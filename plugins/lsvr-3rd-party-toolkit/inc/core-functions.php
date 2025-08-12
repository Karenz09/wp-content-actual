<?php

// Get posts
if ( ! function_exists( 'lsvr_3rd_party_toolkit_get_posts' ) ) {
    function lsvr_3rd_party_toolkit_get_posts( $post_type = 'post' ) {

        $posts_parsed = array();

        if ( post_type_exists( $post_type ) ) {

            // Get posts
            $posts = get_posts(array(
                'post_type' => $post_type,
                'posts_per_page' => 1000,
                'orderby' => 'title',
                'order' => 'ASC',
            ));

            // Parse posts
            if ( ! empty( $posts ) ) {
                foreach ( $posts as $post ) {
                    $posts_parsed[ $post->ID ] = $post->post_title;
                }
            }

        }

        return ! empty( $posts_parsed ) ? $posts_parsed : array();

    }
}

// Get taxonomy terms
if ( ! function_exists( 'lsvr_3rd_party_toolkit_get_terms' ) ) {
	function lsvr_3rd_party_toolkit_get_terms( $taxonomy ) {

		$terms_parsed = array();

        if ( taxonomy_exists( $taxonomy ) ) {

        	// Get terms
            $tax_terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'orderby' => 'name',
                'hide_empty' => true,
            ));

            // Parse terms
            if ( ! empty( $tax_terms ) ) {
            	foreach ( $tax_terms as $term ) {
            		$terms_parsed[ $term->term_id ] = $term->name;
            	}
            }

        }

        return ! empty( $terms_parsed ) ? $terms_parsed : array();

    }
}

// Get menus
if ( ! function_exists( 'lsvr_3rd_party_toolkit_get_menus' ) ) {
	function lsvr_3rd_party_toolkit_get_menus() {

		$return = array();

		$menus = wp_get_nav_menus();
		if ( ! empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				if ( ! empty( $menu->term_id ) && ! empty( $menu->name ) ) {
					$return[ $menu->term_id ] = $menu->name;
				}
			}
		}

		return $return;

	}
}

// Parse shortcode attributes
if ( ! function_exists( 'lsvr_3rd_party_toolkit_parse_shortcode_atts' ) ) {
    function lsvr_3rd_party_toolkit_parse_shortcode_atts( $atts = array() ) {

        foreach ( $atts as $key => $value ) {

            // Post
            if ( 'post' === $value['type'] && ! empty( $value['post_type'] ) ) {
                $atts[ $key ]['type'] = 'select';
                $atts[ $key ]['choices'] = array( 'none' => esc_html__( '---', 'lsvr-3rd-party-toolkit' ) ) + lsvr_3rd_party_toolkit_get_posts( $value['post_type'] );
            }

            // Tax
            if ( 'taxonomy' === $value['type'] && ! empty( $value['tax'] ) ) {
                $atts[ $key ]['type'] = 'select';
                $atts[ $key ]['choices'] = array( 0 => esc_html__( '---', 'lsvr-3rd-party-toolkit' ) ) + lsvr_3rd_party_toolkit_get_terms( $value['tax'] );
            }

            // Menu
            if ( 'menu' === $value['type'] ) {
                $atts[ $key ]['type'] = 'select';
                $atts[ $key ]['choices'] = array( 'none' => esc_html__( '---', 'lsvr-3rd-party-toolkit' ) ) + lsvr_3rd_party_toolkit_get_menus();
            }

        }

        return $atts;

    }
}

// Convert LSVR shortcode param types to Elementor settings
if ( ! function_exists( 'lsvr_3rd_party_toolkit_shortcode_atts_to_elementor_settings' ) ) {
	function lsvr_3rd_party_toolkit_shortcode_atts_to_elementor_settings( $pointer, $atts = array() ) {

    	// Sort by priority
		usort( $atts, function( $a, $b ) {
			$a_priority = array_key_exists( 'priority', $a ) ? $a['priority'] : 0;
			$b_priority = array_key_exists( 'priority', $b ) ? $b['priority'] : 0;
			return $a_priority - $b_priority;
		});

        // Parse atts
        $shortcode_atts = lsvr_3rd_party_toolkit_parse_shortcode_atts( $atts );
		foreach ( $shortcode_atts as $atts ) {

            $atts['default'] = ! empty( $atts['default'] ) ? $atts['default'] : '';

			// Select
			if ( 'select' === $atts['type'] && ! empty( \Elementor\Controls_Manager::SELECT ) ) {
				$atts['type'] = \Elementor\Controls_Manager::SELECT;
			}

			// Checkbox
			elseif ( 'checkbox' === $atts['type'] && ! empty( \Elementor\Controls_Manager::SWITCHER ) ) {
				$atts['type'] = \Elementor\Controls_Manager::SWITCHER;
			}

			// Image
			elseif ( 'image' === $atts['type'] && ! empty( \Elementor\Controls_Manager::MEDIA ) ) {
				$atts['type'] = \Elementor\Controls_Manager::MEDIA;
                $atts['default'] = array();
			}

            // Textarea
            elseif ( 'textarea' === $atts['type'] && ! empty( \Elementor\Controls_Manager::TEXTAREA ) ) {
                $atts['type'] = \Elementor\Controls_Manager::TEXTAREA;
            }

			// Text
			elseif ( ! empty( \Elementor\Controls_Manager::TEXT ) ) {
				$atts['type'] = \Elementor\Controls_Manager::TEXT;
			}

			// Convert bool to string
			if ( ! empty( $atts['default'] ) && is_bool( $atts['default'] ) ) {
				$atts['default'] = true === $atts['default'] ? 'true' : 'false';
			}

			// ID attribute fix
			if ( 'id' === $atts['name'] ) {
				$atts['name'] = 'unique_id';
			}

			// Add control
			$pointer->add_control(
				$atts['name'], array(
					'type' => ! empty( $atts['type'] ) ? $atts['type'] : false,
					'label' => $atts['label'],
					'description' => ! empty( $atts['description'] ) ? $atts['description'] : '',
					'options' => ! empty( $atts['choices'] ) ? $atts['choices'] : false,
					'return_value' => 'true',
                    'label_on' => esc_html__( 'Yes', 'lsvr-3rd-party-toolkit' ),
                    'label_off' => esc_html__( 'No', 'lsvr-3rd-party-toolkit' ),
					'default' => $atts['default'],
				)
			);

		}

	}
}

// Convert Elementor settings to shortcode
if ( ! function_exists( 'lsvr_3rd_party_toolkit_elementor_settings_to_shortcode' ) ) {
	function lsvr_3rd_party_toolkit_elementor_settings_to_shortcode( $instance, $atts, $params ) {

		// Parse params
		$parsed_params = array();
		foreach ( $atts as $attribute ) {
			if ( array_key_exists( $attribute['name'], $params ) ) {
				$parsed_params[ $attribute['name'] ] = $params[ $attribute['name'] ];
			}
		}

		// ID attribute fix
		if ( ! empty( $params['unique_id'] ) ) {
			$parsed_params['id'] = $params['unique_id'];
		}

		// Print shortcode
		echo $instance::shortcode( $parsed_params );

	}
}


// Register VC elements
if ( ! function_exists( 'lsvr_3rd_party_toolkit_vc_map' ) ) {
    function lsvr_3rd_party_toolkit_vc_map( $params = array() ) {

    	// Sort by priority
		usort( $params['params'], function( $a, $b ) {
			$a_priority = array_key_exists( 'priority', $a ) ? $a['priority'] : 0;
			$b_priority = array_key_exists( 'priority', $b ) ? $b['priority'] : 0;
			return $a_priority - $b_priority;
		});

        // Parse atts
        $shortcode_atts = lsvr_3rd_party_toolkit_parse_shortcode_atts( $params[ 'params' ] );

        // Prepare params array
        $vc_params = array();

        // VC types convertor
        $vc_types = array(
            'html' => 'textarea_html',
            'text' => 'textfield',
            'select' => 'dropdown',
            'image' => 'attach_image',
        );

        // Check if element has content area
        if ( ! empty( $params['has_content'] ) && true === $params['has_content'] ) {
            array_push( $vc_params, array(
                'param_name' => 'content',
                'type' => 'textarea_html',
                'heading' => esc_html__( 'Content', 'lsvr-3rd-party-toolkit' ),
            ));
        }

        // Convert atts to VC params
        foreach ( $shortcode_atts as $key => $value ) {

            // Name
            $single_param = array(
                'param_name' => $value['name'],
            );

            // Type
            if ( ! empty( $value['type'] ) ) {
                $single_param['type'] = ! empty( $vc_types[ $value['type'] ] ) ? $vc_types[ $value['type'] ] : $value['type'];
            }

            // Label
            if ( ! empty( $value['label'] ) ) {
                $single_param['heading'] = $value['label'];
            }

            // Description
            if ( ! empty( $value['description'] ) ) {
                $single_param['description'] = $value['description'];
            }

            // Choices
            if ( ! empty( $value['choices'] ) ) {
                $single_param['value'] = array_flip( (array) $value['choices'] );
            }

            array_push( $vc_params, $single_param );

        }

        // Register element
        if ( function_exists( 'vc_map' ) ) {
	        vc_map( array(
	            'weight' => 2000,
	            'base' => $params[ 'base' ],
	            'name' => $params[ 'name' ],
	            'description' => ! empty( $params[ 'description' ] ) ? $params[ 'description' ] : '',
	            'category' => ! empty( $params[ 'category' ] ) ? $params[ 'category' ] : '',
	            'content_element' => true,
	            'show_settings_on_create' => true,
	            'params' => $vc_params,
	        ));
    	}

    }
}

?>