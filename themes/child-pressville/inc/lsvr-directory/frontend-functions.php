<?php

// Listing archive grid class
if ( ! function_exists( 'lsvr_pressville_the_listing_archive_grid_class' ) ) {
	function lsvr_pressville_the_listing_archive_grid_class() {

		$number_of_columns = ! empty( get_theme_mod( 'lsvr_listing_archive_grid_columns', 3 ) ) ? (int) get_theme_mod( 'lsvr_listing_archive_grid_columns', 3 ) : 3;
		$span = 12 / $number_of_columns;
		$md_cols = $span > 2 ? 2 : $span;
		$sm_cols = $span > 2 ? 2 : $span;
		$masonry = true === get_theme_mod( 'lsvr_listing_archive_masonry_enable', false ) ? ' lsvr-grid--masonry' : '';

		echo 'lsvr-grid lsvr-grid--' . esc_attr( $number_of_columns ) . '-cols lsvr-grid--md-' . esc_attr( $md_cols ) . '-cols lsvr-grid--sm-' . esc_attr( $sm_cols ) . '-cols' . esc_attr( $masonry );

	}
}

// Listing archive grid column class
if ( ! function_exists( 'lsvr_pressville_the_listing_archive_grid_column_class' ) ) {
	function lsvr_pressville_the_listing_archive_grid_column_class() {

		$number_of_columns = ! empty( get_theme_mod( 'lsvr_listing_archive_grid_columns', 3 ) ) ? (int) get_theme_mod( 'lsvr_listing_archive_grid_columns', 3 ) : 3;
		$span = 12 / $number_of_columns;

		// Get medium span class
		$span_md_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--md-span-6' : '';

		// Get small span class
		$span_sm_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--sm-span-6' : '';

		echo 'lsvr-grid__col lsvr-grid__col--span-' . esc_attr( $span . $span_md_class . $span_sm_class );

	}
}

// Listing post background thumbnail
if ( ! function_exists( 'lsvr_pressville_the_listing_post_archive_background_thumbnail' ) ) {
	function lsvr_pressville_the_listing_post_archive_background_thumbnail( $post_id ) {

		if ( has_post_thumbnail( $post_id ) ) {
			$thumb_size = (int) get_theme_mod( 'lsvr_listing_archive_grid_columns', 3 ) < 4 ? 'large' : 'medium';
			echo ' style="background-image: url( \'' . esc_url( get_the_post_thumbnail_url( $post_id, $thumb_size ) ) . '\' );"';
		}

	}
}

// Listing address
if ( ! function_exists( 'lsvr_pressville_the_listing_address' ) ) {
	function lsvr_pressville_the_listing_address( $post_id, $nl2br = true ) {

		$location_address = lsvr_pressville_get_listing_address( $post_id );
		if ( ! empty( $location_address ) ) {
			echo true === $nl2br ? nl2br( esc_html( $location_address ) ) : esc_html( $location_address );
		}

	}
}

?>