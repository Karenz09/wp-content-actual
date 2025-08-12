<?php

// Person archive grid class
if ( ! function_exists( 'lsvr_pressville_the_person_post_archive_grid_class' ) ) {
	function lsvr_pressville_the_person_post_archive_grid_class( $class = '' ) {

		// Defaults
		$class_arr = array( 'post-archive__grid' );

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Columns
		$number_of_columns = ! empty( get_theme_mod( 'lsvr_person_archive_grid_columns', 4 ) ) ? (int) get_theme_mod( 'lsvr_person_archive_grid_columns', 4 ) : 4;
		$span = 12 / $number_of_columns;
		$md_cols = $span > 2 ? 2 : $span;
		$sm_cols = $span > 2 ? 2 : $span;

		array_push( $class_arr, 'lsvr-grid lsvr-grid--' . $number_of_columns . '-cols lsvr-grid--md-' . $md_cols . '-cols' );

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_pressville_person_post_archive_list_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( implode( ' ', $class_arr ) ) . '"';
		}

	}
}

// Person archive grid column class
if ( ! function_exists( 'lsvr_pressville_the_person_post_archive_grid_column_class' ) ) {
	function lsvr_pressville_the_person_post_archive_grid_column_class( $classs = '' ) {

		// Defaults
		$class_arr = array();

		// Passed
		if ( ! empty( $class ) ) {
			$class_arr = array_merge( $class_arr, explode( ' ', $class ) );
		}

		// Columns
		$number_of_columns = ! empty( get_theme_mod( 'lsvr_person_archive_grid_columns', 4 ) ) ? (int) get_theme_mod( 'lsvr_person_archive_grid_columns', 4 ) : 4;
		$span = 12 / $number_of_columns;
		$span_class = ' lsvr-grid__col--span-' . $span;
		$span_md_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--md-span-6' : '';
		$span_sm_class = 3 === $span || 4 === $span || 6 === $span ? ' lsvr-grid__col--sm-span-6' : '';
		array_push( $class_arr, 'lsvr-grid__col ' . $span_class . $span_md_class . $span_sm_class . $span_sm_class );

		// Filter
		array_push( $class_arr, apply_filters( 'lsvr_pressville_person_post_archive_grid_column_class', '' ) );

		// Echo
		if ( ! empty( $class_arr ) ) {
			echo ' class="' . esc_attr( implode( ' ', $class_arr ) ) . '"';
		}

	}
}

// Person role
if ( ! function_exists( 'lsvr_pressville_the_person_role' ) ) {
	function lsvr_pressville_the_person_role( $post_id ) {

		$person_role = lsvr_pressville_get_person_role( $post_id );
		echo ! empty( $person_role ) ? esc_html( $person_role ) : '';

	}
}

?>