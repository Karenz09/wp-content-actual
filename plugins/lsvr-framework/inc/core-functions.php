<?php

// Load template
if ( ! function_exists( 'lsvr_framework_load_template' ) ) {
    function lsvr_framework_load_template( $relative_path ) {

        $template_found = false;

        // Check the child theme first
        if ( is_child_theme() && file_exists( trailingslashit( get_stylesheet_directory() ) . $relative_path ) ) {
            load_template( trailingslashit( get_stylesheet_directory() ) . $relative_path, false );
            $template_found = true;
        }

        // Check parent theme
        if ( ! $template_found && file_exists( trailingslashit( get_template_directory() ) . $relative_path ) ) {
            load_template( trailingslashit( get_template_directory() ) . $relative_path, false );
            $template_found = true;
        }

        // Otherwise, load the default template from the plugin
        if ( ! $template_found && file_exists( trailingslashit( WP_PLUGIN_DIR ) . $relative_path ) ) {
            load_template( trailingslashit( WP_PLUGIN_DIR ) . $relative_path, false );
            $template_found = true;
        }

        // Trigger error message if template was not found
        if ( ! $template_found ) {
            trigger_error( esc_html__( 'The required template was not found! Please reinstall all LSVR plugins.', 'lsvr-framework' )  );
        }

    }
}

// Get posts
if ( ! function_exists( 'lsvr_framework_get_posts' ) ) {
    function lsvr_framework_get_posts( $post_type = 'post' ) {

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
if ( ! function_exists( 'lsvr_framework_get_terms' ) ) {
	function lsvr_framework_get_terms( $taxonomy ) {

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
if ( ! function_exists( 'lsvr_framework_get_menus' ) ) {
	function lsvr_framework_get_menus() {

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
if ( ! function_exists( 'lsvr_framework_parse_shortcode_atts' ) ) {
    function lsvr_framework_parse_shortcode_atts( $atts = array() ) {

        foreach ( $atts as $key => $value ) {

            // Post
            if ( 'post' === $value['type'] && ! empty( $value['post_type'] ) ) {
                $atts[ $key ]['type'] = 'select';
                $atts[ $key ]['choices'] = array( 'none' => esc_html__( '---', 'lsvr-framework' ) ) + lsvr_framework_get_posts( $value['post_type'] );
            }

            // Tax
            if ( 'taxonomy' === $value['type'] && ! empty( $value['tax'] ) ) {
                $atts[ $key ]['type'] = 'select';
                $atts[ $key ]['choices'] = array( 0 => esc_html__( '---', 'lsvr-framework' ) ) + lsvr_framework_get_terms( $value['tax'] );
            }

            // Menu
            if ( 'menu' === $value['type'] ) {
                $atts[ $key ]['type'] = 'select';
                $atts[ $key ]['choices'] = array( 'none' => esc_html__( '---', 'lsvr-framework' ) ) + lsvr_framework_get_menus();
            }

        }

        return $atts;

    }
}

// Register shortcode block
if ( ! function_exists( 'lsvr_framework_register_shortcode_block' ) ) {
    function lsvr_framework_register_shortcode_block( $name, $params ) {

        if ( function_exists( 'register_block_type' ) ) {

            // Sort by priority
            usort( $params['attributes'], function( $a, $b ) {
                $a_priority = array_key_exists( 'priority', $a ) ? $a['priority'] : 0;
                $b_priority = array_key_exists( 'priority', $b ) ? $b['priority'] : 0;
                return $a_priority - $b_priority;
            });

            // Parse atts
            $shortcode_atts = lsvr_framework_parse_shortcode_atts( $params[ 'attributes' ] );

            // Prepare array for PHP registration
            $php_attributes = array();
            foreach ( $shortcode_atts as $attribute ) {

                $attribute_name = $attribute['name'];

                $php_attributes[ $attribute_name ] = array(
                    'type' => $attribute['type'] === 'checkbox' ? 'boolean' : 'string',
                );

                if ( ! empty( $attribute['default'] ) ) {
                    $php_attributes[ $attribute_name ]['default'] = $attribute['default'];
                }

            }

            // Add className attribute
            $php_attributes['className'] = array(
                'type' => 'string',
            );

            // Prepare args
            $args = array(
                'attributes' => $php_attributes,
            );

            if ( ! empty( $params[ 'render_callback' ] ) ) {
                $args['render_callback'] = $params[ 'render_callback' ];
            }

            // Register block
            register_block_type( $name, $args );

        }

    }
}

// Register shortcode block JSON
if ( ! function_exists( 'lsvr_framework_register_shortcode_block_json' ) ) {
    function lsvr_framework_register_shortcode_block_json( $params = array() ) {

        // Sort by priority
        usort( $params['attributes'], function( $a, $b ) {
            $a_priority = array_key_exists( 'priority', $a ) ? $a['priority'] : 0;
            $b_priority = array_key_exists( 'priority', $b ) ? $b['priority'] : 0;
            return $a_priority - $b_priority;
        });

        // Parse params
        $shortcode_atts = lsvr_framework_parse_shortcode_atts( $params['attributes'] );

        $attributes = array();
        foreach ( $shortcode_atts as $attribute ) {

            // Parse selectbox and radio choices
            if ( 'select' === $attribute['type'] || 'radio' === $attribute['type'] ) {
                $parsed_choices = array();
                foreach ( $attribute['choices'] as $choice_key => $choice_value ) {
                    array_push( $parsed_choices, array(
                        'value' => $choice_key,
                        'label' => $choice_value,
                    ) );
                }
                $attribute['choices'] = $parsed_choices;
            }

            array_push( $attributes, $attribute );

        }

        $params['attributes'] = $attributes;

        return $params;

    }
}

// Get calendar days
if ( ! function_exists( 'lsvr_framework_get_calendar_days' ) ) {
    function lsvr_framework_get_calendar_days( $year = false, $month = false ) {

        $calendar_arr = array();

        // If no year and month are defined, get current month
        if ( empty( $year ) || empty( $month ) ) {

            $year = current_time( 'Y' );
            $month = current_time( 'm' );

        }

        // Get first day of week
        $start_of_week = get_option( 'start_of_week' );

        // Get list of weekdays
        $weekdays = array( 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat' );
        $start_of_week = get_option( 'start_of_week' );
        $weekdays = $start_of_week > 0 ? array_merge( array_slice( $weekdays, $start_of_week, count( $weekdays ) - $start_of_week ), array_slice( $weekdays, 0, $start_of_week ) ) : $weekdays;

        // Get days of month
        $start_date = $year . '-' . $month . '-01';
        $start_time = strtotime( $start_date );
        $end_time = strtotime( '+1 month', $start_time );
        $current_month_days = array();
        for ( $i = $start_time; $i < $end_time; $i += 86400 ) {
            $current_month_days[] = date( 'Y-m-d', $i );
        }
        $calendar_arr[ 'current' ] = $current_month_days;

        // Get start of the month week day
        $current_month_start_day = strtolower( date( 'D', strtotime( $current_month_days[0] ) ) );
        $current_month_start_day_index = array_search( $current_month_start_day, $weekdays );

        // Number of pre days
        $pre_length = $current_month_start_day_index;

        // Generate pre days
        $pre_month_days = array();
        if ( $pre_length > 0 ) {
            for ( $i = $pre_length; $i > 0; $i -= 1 ) {
                $pre_month_days[] = date( 'Y-m-d', strtotime( $current_month_days[0] . ' -' . $i . ' days') );
            }

        }
        $calendar_arr[ 'pre' ] = $pre_month_days;

        // Get end of the month week day name
        $current_month_end_day = strtolower( date( 'D', strtotime( end( $current_month_days ) ) ) );
        $current_month_end_day_index = array_search( $current_month_end_day, $weekdays );
        reset( $current_month_days );

        // Number of post days
        $post_length = 6 - $current_month_end_day_index;

        // There always has to be 42 days visible (7 days x 6 rows), add additional post days if needed
        if ( ( count( $current_month_days ) + count( $pre_month_days ) + $post_length ) < 42 ) {
            $post_length = 42 - ( count( $current_month_days ) + count( $pre_month_days ) );
        }

        // Generate post days
        $post_month_days = array();
        if ( $post_length > 0 ) {
            for ( $i = 1; $i <= $post_length; $i += 1 ) {
                $post_month_days[] = date( 'Y-m-d', strtotime( end( $current_month_days ) . ' +' . $i . ' days') );
            }
        }
        reset( $current_month_days );
        $calendar_arr[ 'post' ] = $post_month_days;

        return $calendar_arr;

    }
}

// Get first calendar day
if ( ! function_exists( 'lsvr_framework_get_calendar_first_day' ) ) {
    function lsvr_framework_get_calendar_first_day( $year = false, $month = false ) {

        $calendar_days = lsvr_framework_get_calendar_days( $year, $month );

        if ( ! empty( $calendar_days['pre'][0] ) ) {

            return $calendar_days['pre'][0];

        } elseif ( ! empty( $calendar_days['current'][0] ) ) {

            return $calendar_days['current'][0];

        } else {

            return false;

        }

    }
}

// Get last calendar day
if ( ! function_exists( 'lsvr_framework_get_calendar_last_day' ) ) {
    function lsvr_framework_get_calendar_last_day( $year = false, $month = false ) {

        $calendar_days = lsvr_framework_get_calendar_days( $year, $month );

        if ( ! empty( $calendar_days['post'] ) && is_array( $calendar_days['post'] ) ) {

            return end( $calendar_days['post'] );

        } elseif ( ! empty( $calendar_days['current'] ) && is_array( $calendar_days['current'] ) ) {

            return end( $calendar_days['current'] );

        } else {

            return false;

        }

    }
}

?>