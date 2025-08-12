<?php

// Get gallery archive layout
if ( ! function_exists( 'lsvr_pressville_get_gallery_archive_layout' ) ) {
	function lsvr_pressville_get_gallery_archive_layout() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$path_prefix = 'template-parts/lsvr_gallery/archive-layout-';

		// Get layout from Customizer
		if ( ! empty( locate_template( $path_prefix . get_theme_mod( 'lsvr_gallery_archive_layout', 'default' ) . '.php' ) ) ) {
			return get_theme_mod( 'lsvr_gallery_archive_layout', 'default' );
		}

		// Default layout
		else {
			return 'default';
		}

	}
}

// Gallery post thumbnail
if ( ! function_exists( 'lsvr_pressville_the_gallery_post_archive_thumbnail' ) ) {
	function lsvr_pressville_the_gallery_post_archive_thumbnail( $post_id ) {
		if ( function_exists( 'lsvr_galleries_get_single_thumb' ) ) {

			trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

			$thumbnail = lsvr_galleries_get_single_thumb( $post_id );
			if ( ! empty( $thumbnail ) ) {

				if ( get_theme_mod( 'lsvr_gallery_archive_grid_columns', 4 ) > 2 && ! empty( $thumbnail['url_medium'] ) ) {
					$image_url = $thumbnail['medium_url'];
				} else {
					$image_url = $thumbnail['full_url'];
				}

				// Cropped thumbnail
				if ( ! empty( $image_url ) && true === get_theme_mod( 'lsvr_gallery_archive_cropped_thumb_enable', true ) ) {
					echo '<p class="post__thumbnail"><a href="' . esc_url( get_the_permalink( $post_id ) ) . '" class="post__thumbnail-link post__thumbnail-link--cropped"';
					echo ' style="background-image: url( \'' . esc_url( $image_url ) . '\' );">';
					echo '</a></p>';
				}

				// Regular thumb
				else if ( ! empty( $image_url ) ) {
					echo '<p class="post__thumbnail"><a href="' . esc_url( get_the_permalink( $post_id ) ) . '" class="post__thumbnail-link">';
					echo '<img src="' . esc_url( $image_url ) . '" class="post__thumbnail-image" alt="' . esc_attr( $thumbnail['alt'] ) . '"';
					echo '</a></p>';
				}

			}

		}
	}
}

?>