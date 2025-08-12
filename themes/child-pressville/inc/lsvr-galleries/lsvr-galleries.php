<?php

// Include additional files
require_once( get_template_directory() . '/inc/lsvr-galleries/actions.php' );
require_once( get_template_directory() . '/inc/lsvr-galleries/customizer-config.php' );
require_once( get_template_directory() . '/inc/lsvr-galleries/deprecated.php' );
require_once( get_template_directory() . '/inc/lsvr-galleries/frontend-functions.php' );

// Is gallery page
if ( ! function_exists( 'lsvr_pressville_is_gallery' ) ) {
	function lsvr_pressville_is_gallery() {

		if ( is_post_type_archive( 'lsvr_gallery' ) || is_tax( 'lsvr_gallery_cat' ) || is_tax( 'lsvr_gallery_tag' ) ||
			is_singular( 'lsvr_gallery' ) ) {
			return true;
		} else {
			return false;
		}

	}
}

// Get gallery archive title
if ( ! function_exists( 'lsvr_pressville_get_gallery_archive_title' ) ) {
	function lsvr_pressville_get_gallery_archive_title() {

		return get_theme_mod( 'lsvr_gallery_archive_title', esc_html__( 'Galleries', 'pressville' ) );

	}
}

// Has thumbnail
if ( ! function_exists( 'lsvr_pressville_has_gallery_post_archive_thumbnail' ) ) {
	function lsvr_pressville_has_gallery_post_archive_thumbnail( $post_id ) {
		if ( function_exists( 'lsvr_galleries_get_single_thumb' ) ) {

			$thumbnail = lsvr_galleries_get_single_thumb( $post_id );
			return ! empty( $thumbnail ) ? true : false;

		}
	}
}

// Get gallery images
if ( ! function_exists( 'lsvr_pressville_get_gallery_images' ) ) {
	function lsvr_pressville_get_gallery_images( $post_id ) {
		if ( function_exists( 'lsvr_galleries_get_gallery_images' ) ) {

			$gallery_images = lsvr_galleries_get_gallery_images( $post_id );
			return ! empty( $gallery_images ) ? $gallery_images : false;

		}
	}
}

// Gallery images count
if ( ! function_exists( 'lsvr_pressville_get_gallery_images_count' ) ) {
	function lsvr_pressville_get_gallery_images_count( $post_id ) {
		if ( function_exists( 'lsvr_galleries_get_gallery_images_count' ) ) {

			return (int) lsvr_galleries_get_gallery_images_count( $post_id );

		}
	}
}

// Has gallery images
if ( ! function_exists( 'lsvr_pressville_has_gallery_images' ) ) {
	function lsvr_pressville_has_gallery_images( $post_id ) {

		$images_count = lsvr_galleries_get_gallery_images_count( $post_id );
		return $images_count > 0 ? true : false;

	}
}

if ( ! function_exists( 'lsvr_pressville_get_gallery_archive_thumbnail_url' ) ) {
	function lsvr_pressville_get_gallery_archive_thumbnail_url( $post_id ) {
		if ( function_exists( 'lsvr_galleries_get_single_thumb' ) ) {

			$thumbnail = lsvr_galleries_get_single_thumb( $post_id );

			if ( ! empty( $thumbnail ) ) {

				if ( get_theme_mod( 'lsvr_gallery_archive_grid_columns', 4 ) > 2 && ! empty( $thumbnail['url_medium'] ) ) {
					return $thumbnail['medium_url'];
				} else {
					return $thumbnail['full_url'];
				}

			}

		}
	}
}

if ( ! function_exists( 'lsvr_pressville_get_gallery_archive_thumbnail_alt' ) ) {
	function lsvr_pressville_get_gallery_archive_thumbnail_alt( $post_id ) {
		if ( function_exists( 'lsvr_galleries_get_single_thumb' ) ) {

			$thumbnail = lsvr_galleries_get_single_thumb( $post_id );
			return ! empty( $thumbnail['alt'] ) ? $thumbnail['alt'] : '';

		}
	}
}

?>