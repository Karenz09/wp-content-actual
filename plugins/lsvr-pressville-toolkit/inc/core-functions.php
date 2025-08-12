<?php

// Has post terms
if ( ! function_exists( 'lsvr_pressville_toolkit_has_post_terms' ) ) {
    function lsvr_pressville_toolkit_has_post_terms( $post_id, $taxonomy ) {

        $terms = wp_get_post_terms( $post_id, $taxonomy );
        return ! empty( $terms ) ? true : false;

    }
}

// Get taxonomy terms
if ( ! function_exists( 'lsvr_pressville_toolkit_get_terms' ) ) {
	function lsvr_pressville_toolkit_get_terms( $taxonomy ) {

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
if ( ! function_exists( 'lsvr_pressville_toolkit_get_menus' ) ) {
    function lsvr_pressville_toolkit_get_menus() {

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

// Get menu name by id
if ( ! function_exists( 'lsvr_pressville_toolkit_get_menu_name_by_id' ) ) {
    function lsvr_pressville_toolkit_get_menu_name_by_id( $menu_id ) {

        $menu = wp_get_nav_menu_object( $menu_id );
        return ! empty( $menu->name ) ? $menu->name : '';

    }
}

// Get custom sidebars
if ( ! function_exists( 'lsvr_pressville_toolkit_get_custom_sidebars' ) ) {
    function lsvr_pressville_toolkit_get_custom_sidebars() {

        $return = array();

        $custom_sidebars = get_theme_mod( 'custom_sidebars' );
        if ( ! empty( $custom_sidebars ) && '{' === substr( $custom_sidebars, 0, 1 ) ) {

            $custom_sidebars = (array) json_decode( $custom_sidebars );
            if ( ! empty( $custom_sidebars['sidebars'] ) ) {
                $custom_sidebars = $custom_sidebars['sidebars'];
                foreach ( $custom_sidebars as $sidebar ) {
                    $sidebar = (array) $sidebar;
                    if ( ! empty( $sidebar['id'] ) ) {

                        $sidebar_label = ! empty( $sidebar['label'] ) ? $sidebar['label'] : sprintf( esc_html__( 'Custom Sidebar %d', 'lsvr-pressville-toolkit' ), (int) $sidebar['id'] );
                        $return[ 'lsvr-pressville-custom-sidebar-' . $sidebar['id'] ] = $sidebar_label;

                    }
                }
            }

        }

        return $return;

    }
}

// Get sidebars
if ( ! function_exists( 'lsvr_pressville_toolkit_get_sidebars' ) ) {
    function lsvr_pressville_toolkit_get_sidebars() {

        $sidebar_list = array( 'lsvr-pressville-default-sidebar' => esc_html__( 'Default Sidebar', 'lsvr-pressville-toolkit'  ) );
        $custom_sidebars = lsvr_pressville_toolkit_get_custom_sidebars();
        if ( ! empty( $custom_sidebars ) ) {
            $sidebar_list = array_merge( $sidebar_list, $custom_sidebars );
        }

        return $sidebar_list;

    }
}

// Clean HTML
if ( ! function_exists( 'lsvr_pressville_toolkit_clean_shortcode_html' ) ) {
	function lsvr_pressville_toolkit_clean_shortcode_html( $html ) {

        $clean_html = str_replace( array( "\r", "\n", "\t" ), '', $html );
        $clean_html = preg_replace( '/\s+/', ' ', $clean_html );
        $clean_html = trim( preg_replace('/(\>)\s*(\<)/m', '$1$2', $clean_html ) );
        return $clean_html;

    }
}

// Get listing address
if ( ! function_exists( 'lsvr_pressville_toolkit_get_listing_address' ) ) {
    function lsvr_pressville_toolkit_get_listing_address( $post_id ) {

        $address = get_post_meta( $post_id, 'lsvr_listing_address', true );
        return ! empty( $address ) ? $address : false;

    }
}

// Has listing address
if ( ! function_exists( 'lsvr_pressville_toolkit_has_listing_address' ) ) {
    function lsvr_pressville_toolkit_has_listing_address( $post_id ) {

        $address = lsvr_pressville_toolkit_get_listing_address( $post_id );
        return ! empty( $address ) ? true : false;

    }
}

// Has event end time
if ( ! function_exists( 'lsvr_pressville_toolkit_has_event_end_time' ) ) {
    function lsvr_pressville_toolkit_has_event_end_time( $post_id ) {

        $endtime_enable = get_post_meta( $post_id, 'lsvr_event_end_time_enable', true );
        return 'true' === $endtime_enable ? true : false;

    }
}

// Gallery images count
if ( ! function_exists( 'lsvr_pressville_toolkit_get_gallery_images_count' ) ) {
    function lsvr_pressville_toolkit_get_gallery_images_count( $post_id ) {
        if ( function_exists( 'lsvr_galleries_get_gallery_images_count' ) ) {

            return (int) lsvr_galleries_get_gallery_images_count( $post_id );

        }
    }
}


?>