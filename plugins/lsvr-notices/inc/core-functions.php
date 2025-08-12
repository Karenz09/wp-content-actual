<?php

if ( ! function_exists( 'lsvr_notices_has_post_terms' ) ) {
	function lsvr_notices_has_post_terms( $post_id, $taxonomy ) {

        $terms = wp_get_post_terms( $post_id, $taxonomy );
        return ! empty( $terms ) ? true : false;

	}
}

if ( ! function_exists( 'lsvr_notices_get_post_taxonomy_html' ) ) {
	function lsvr_notices_get_post_taxonomy_html( $post_id, $taxonomy = 'lsvr_notice_cat', $link_template = '<a href="%s">%s</a>' ) {

		$html_output = '';
        $terms = wp_get_post_terms( $post_id, $taxonomy );

        if ( ! empty( $terms ) ) {

            foreach ( $terms as $term ) {

				$html_output .= sprintf( $link_template, esc_url( get_term_link( $term->term_id, $taxonomy ) ), $term->name );
                $html_output .= $term !== end( $terms ) ? ', ' : '';

            }

        }

        return $html_output;

	}
}

?>