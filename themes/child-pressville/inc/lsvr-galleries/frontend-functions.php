<?php

// Gallery archive grid class
if ( ! function_exists( 'lsvr_pressville_the_gallery_post_archive_grid_class' ) ) {
	function lsvr_pressville_the_gallery_post_archive_grid_class( $class = '' ) {

		// Defaults
		$class_arr = array( 'post-archive__grid' );

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Columns
		$number_of_columns = ! empty( get_theme_mod( 'lsvr_gallery_archive_grid_columns', 4 ) ) ? (int) get_theme_mod( 'lsvr_gallery_archive_grid_columns', 4 ) : 4;
		$span = 12 / $number_of_columns;
		$md_cols = $span > 2 ? 2 : $span;
		$sm_cols = $span > 2 ? 2 : $span;
		$masonry = true === get_theme_mod( 'lsvr_gallery_archive_masonry_enable', false ) ? ' lsvr-grid--masonry' : '';
		array_push( $class_arr, 'lsvr-grid lsvr-grid--' . $number_of_columns . '-cols lsvr-grid--md-' . $md_cols . '-cols lsvr-grid--sm-' . $sm_cols . '-cols' . $masonry );

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_pressville_gallery_post_archive_grid_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( implode( ' ', $class_arr ) ) . '"';
		}

	}
}

// Gallery archive grid column class
if ( ! function_exists( 'lsvr_pressville_the_gallery_post_archive_grid_column_class' ) ) {
	function lsvr_pressville_the_gallery_post_archive_grid_column_class( $class = '' ) {

		// Defaults
		$class_arr = array();

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Columns
		$number_of_columns = ! empty( get_theme_mod( 'lsvr_gallery_archive_grid_columns', 4 ) ) ? (int) get_theme_mod( 'lsvr_gallery_archive_grid_columns', 4 ) : 4;
		$span = 12 / $number_of_columns;
		$span_md_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--md-span-6' : '';
		$span_sm_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--sm-span-6' : '';
		array_push( $class_arr, 'lsvr-grid__col lsvr-grid__col--span-' . $span . $span_md_class . $span_sm_class );

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_pressville_gallery_post_archive_grid_column_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( implode( ' ', $class_arr ) ) . '"';
		}

	}
}

// Gallery post background thumbnail
if ( ! function_exists( 'lsvr_pressville_the_gallery_post_background_thumbnail' ) ) {
	function lsvr_pressville_the_gallery_post_background_thumbnail( $post_id ) {
		if ( function_exists( 'lsvr_galleries_get_single_thumb' ) ) {

			$thumbnail = lsvr_galleries_get_single_thumb( $post_id );
			if ( ! empty( $thumbnail ) ) {

				if ( get_theme_mod( 'lsvr_gallery_archive_grid_columns', 4 ) > 2 && ! empty( $thumbnail['medium_url'] ) ) {
					$image_url = $thumbnail['medium_url'];
				} else {
					$image_url = $thumbnail['full_url'];
				}

				if ( ! empty( $image_url ) ) {
					echo ' style="background-image: url( \'' . esc_url( $image_url ) . '\' );"';
				}

			}

		}
	}
}

// Image grid class
if ( ! function_exists( 'lsvr_pressville_the_gallery_post_single_grid_class' ) ) {
	function lsvr_pressville_the_gallery_post_single_grid_class( $class = '' ) {

		// Defaults
		$class_arr = array( 'post__image-list', 'lsvr-grid' );

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Masonry
		if ( true === get_theme_mod( 'lsvr_gallery_single_masonry_enable', true ) ) {
			array_push( $class_arr, 'post__image-list--masonry' );
		}

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_pressville_gallery_post_single_grid_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( implode( ' ', $class_arr ) ) . '"';
		}

	}
}

// Gallery single images column class
if ( ! function_exists( 'lsvr_pressville_the_gallery_post_single_column_class' ) ) {
	function lsvr_pressville_the_gallery_post_single_column_class( $class = '' ) {

		// Defaults
		$class_arr = array();

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Columns
		$number_of_columns = ! empty( get_theme_mod( 'lsvr_gallery_single_grid_columns', 4 ) ) ? (int) get_theme_mod( 'lsvr_gallery_single_grid_columns', 4 ) : 4;
		$span = 12 / $number_of_columns;
		$span_md_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--md lsvr-grid__col--md-span-6' : '';
		$span_sm_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--sm lsvr-grid__col--sm-span-6' : '';
		array_push( $class_arr, 'lsvr-grid__col lsvr-grid__col--span-' . $span . $span_md_class . $span_sm_class );

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_pressville_gallery_post_archive_grid_column_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( implode( ' ', $class_arr ) ) . '"';
		}

	}
}

?>