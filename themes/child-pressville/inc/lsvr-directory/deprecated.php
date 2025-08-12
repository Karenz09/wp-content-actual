<?php

// Listing archive map
if ( ! function_exists( 'lsvr_pressville_the_listing_archive_map' ) ) {
	function lsvr_pressville_the_listing_archive_map() {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( true == get_theme_mod( 'lsvr_listing_archive_map_enable', true ) ) { ?>

			<!-- LISTING ARCHIVE MAP : begin -->
			<div class="lsvr_listing-map">
				<div class="lsvr_listing-map__canvas lsvr_listing-map__canvas--loading"
					id="lsvr_listing-map__canvas"
					<?php if ( ! empty( lsvr_pressville_get_listing_archive_map_query_json() ) ) : ?>
						data-query="<?php echo esc_attr( lsvr_pressville_get_listing_archive_map_query_json() ); ?>"
					<?php endif; ?>
					data-maptype="<?php echo esc_attr( get_theme_mod( 'lsvr_listing_archive_map_type', 'roadmap' ) ); ?>"
					data-zoom="<?php echo esc_attr( get_theme_mod( 'lsvr_listing_archive_map_zoom', 16 ) ); ?>"
					data-mousewheel="false"></div>
				<div class="c-spinner lsvr_listing-map__spinner"></div>
			</div>
			<!-- LISTING ARCHIVE MAP : end -->

		<?php }

	}
}

// Listing post thumbnail
if ( ! function_exists( 'lsvr_pressville_the_listing_archive_thumbnail' ) ) {
	function lsvr_pressville_the_listing_archive_thumbnail( $post_id ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		if ( has_post_thumbnail( $post_id ) ) {

			$thumb_size = (int) get_theme_mod( 'lsvr_listing_archive_grid_columns', 3 ) < 4 ? 'large' : 'medium';

			// Cropped thumbnail
			if ( true === get_theme_mod( 'lsvr_listing_archive_cropped_thumb_enable', true ) ) {
				echo '<p class="post__thumbnail"><a href="' . esc_url( get_permalink( $post_id ) ) . '" class="post__thumbnail-link post__thumbnail-link--cropped"';
				echo ' style="background-image: url( \'' . esc_url( get_the_post_thumbnail_url( $post_id, $thumb_size ) ) . '\' );">';
				echo '</a></p>';
			}

			// Regular thumbnail
			else {
				echo '<p class="post__thumbnail"><a href="' . esc_url( get_permalink( $post_id ) ) . '" class="post__thumbnail-link">';
				echo get_the_post_thumbnail( $post_id, $thumb_size );
				echo '</a></p>';
			}

		}

	}
}

// Listing single image header
if ( ! function_exists( 'lsvr_pressville_the_listing_gallery_header' ) ) {
	function lsvr_pressville_the_listing_gallery_header( $post_id ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$gallery_images = get_post_meta( $post_id, 'lsvr_listing_gallery', true );
		$gallery_images = ! empty( $gallery_images ) ? explode( ',', $gallery_images ) : false;  ?>

		<?php // If listing has gallery, show it
		if ( ! empty( $gallery_images ) ) : ?>

			<!-- LISTING GALLERY : begin -->
			<div class="lsvr_listing-post-gallery lsvr_listing-post-gallery--loading lsvr_listing-post-gallery--<?php echo esc_attr( count( $gallery_images ) ); ?>-images">
				<div class="lsvr_listing-post-gallery__wrapper">

					<div class="lsvr_listing-post-gallery__list">

						<?php foreach ( $gallery_images as $image_id ) : ?>

							<div class="lsvr_listing-post-gallery__item">
								<a href="<?php echo esc_url( lsvr_pressville_get_image_url( $image_id, 'full' ) ); ?>" class="lsvr_listing-post-gallery__link"
									style="background-image: url( '<?php echo esc_url( lsvr_pressville_get_image_url( $image_id, 'medium' ) ); ?>' );">
									<img src="<?php echo esc_url( lsvr_pressville_get_image_url( $image_id, 'medium' ) ); ?>" class="lsvr_listing-post-gallery__image" alt="<?php echo esc_attr( lsvr_pressville_get_image_alt( $image_id ) ); ?>">
								</a>
							</div>

						<?php endforeach; ?>

					</div>
					<button type="button" class="c-arrow-button lsvr_listing-post-gallery__button lsvr_listing-post-gallery__button--prev">
						<i class="c-arrow-button__icon c-arrow-button__icon--left"></i>
					</button>
					<button type="button" class="c-arrow-button lsvr_listing-post-gallery__button lsvr_listing-post-gallery__button--next">
						<i class="c-arrow-button__icon c-arrow-button__icon--right"></i>
					</button>

				</div>
				<span class="c-spinner"></span>
			</div>
			<!-- LISTING GALLERY : end -->

		<?php endif; ?>

	<?php }
}

// Listing social links
if ( ! function_exists( 'lsvr_pressville_the_listing_social_links' ) ) {
	function lsvr_pressville_the_listing_social_links( $post_id ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$social_links = lsvr_pressville_get_listing_social_links( $post_id );
		if ( ! empty( $social_links ) ) : ?>

			<ul class="post__social-links">

				<?php foreach ( $social_links as $profile => $link ) : ?>

					<li class="post__social-links-item">
						<a href="<?php echo esc_url( $link ); ?>"
							class="post__social-links-link post__social-links-link--<?php echo esc_attr( $profile ); ?>"
							target="_blank"><span class="screen-reader-text"><?php echo esc_html( $link ); ?></span></a>
					</li>

				<?php endforeach; ?>

			</ul>

		<?php endif;

	}
}

// Listing contact info
if ( ! function_exists( 'lsvr_pressville_the_listing_contact_info' ) ) {
	function lsvr_pressville_the_listing_contact_info( $post_id ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$contact_info = lsvr_pressville_get_listing_contact_info( $post_id );
		if ( ! empty( $contact_info ) ) : ?>

			<ul class="post__contact">

				<?php foreach ( $contact_info as $profile => $contact ) : ?>

					<li class="post__contact-item post__contact-item--<?php echo esc_attr( $profile ); ?>">
						<?php if ( 'email' === $profile ) : ?>
							<a href="mailto:<?php echo esc_attr( $contact ); ?>" class="post__contact-item-link"><?php echo esc_html( $contact ); ?></a>
						<?php elseif ( 'website' === $profile ) : ?>
							<a href="<?php echo esc_url( $contact ); ?>" class="post__contact-item-link" target="_blank"><?php echo esc_html( $contact ); ?></a>
						<?php elseif ( 'phone' === $profile ) : ?>
							<a href="tel:<?php echo esc_html( $contact ); ?>" class="post__contact-item-link" target="_blank"><?php echo esc_html( $contact ); ?></a>
						<?php else : ?>
							<?php echo esc_html( $contact ); ?>
						<?php endif; ?>
					</li>

				<?php endforeach; ?>

			</ul>

		<?php endif;

	}
}

// Link to Google Maps
if ( ! function_exists( 'lsvr_pressville_the_listing_map_link' ) ) {
	function lsvr_pressville_the_listing_map_link( $post_id ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$map_link = lsvr_pressville_get_listing_map_link( $post_id );
		if ( ! empty( $map_link ) ) {
			echo '<p class="post__map-link-wrapper"><a href="' . esc_url( $map_link ) . '" class="post__map-link" target="_blank">' . esc_html__( 'Open in Google Maps', 'pressville' ) . '</a></p>';
		}

	}
}

// Opening hours
if ( ! function_exists( 'lsvr_pressville_the_listing_opening_hours' ) ) {
	function lsvr_pressville_the_listing_opening_hours( $post_id ) {

		trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

		$opening_hours_type = get_post_meta( $post_id, 'lsvr_listing_opening_hours', true );
		$opening_hours_custom = get_post_meta( $post_id, 'lsvr_listing_opening_hours_custom', true );
		$opening_hours_select = get_post_meta( $post_id, 'lsvr_listing_opening_hours_select', true );
		$opening_hours_note = get_post_meta( $post_id, 'lsvr_listing_opening_hours_note', true );

		if ( 'custom' == $opening_hours_type && ! empty( $opening_hours_custom ) ) {

			echo '<p class="post__hours-custom">' . nl2br( wp_kses( $opening_hours_custom, array(
				'strong' => array(),
			)) ) . '</p>';

		}
		else if ( 'select' == $opening_hours_type && ! empty( $opening_hours_select ) ) {

			$opening_hours = @json_decode( $opening_hours_select );

			if ( is_object( $opening_hours ) ) : ?>

				<ul class="post__hours-list">

					<?php foreach ( $opening_hours as $day => $hours ) : ?>

						<li class="post__hours-item post__hours-item--<?php echo strtolower( date( 'D', strtotime( $day ) ) ); ?>">
							<div class="post__hours-item-day">
								<?php echo date_i18n( 'l', strtotime( $day ) ); ?>
							</div>
							<div class="post__hours-item-value">

								<?php if ( 'closed' === $hours ) {

									esc_html_e( 'Closed', 'pressville' );

								} else {

									$time_from = substr( $hours, 0, strpos( $hours, '-' ) );
									$time_to = substr( $hours, strpos( $hours, '-' ) + 1, strlen( $hours ) );
									echo '<span class="opening-hours__day-from">' . esc_html( date_i18n( get_option( 'time_format' ), strtotime( $time_from ) ) ) . '</span>';
									echo ' - <span class="opening-hours__day-to">' . esc_html( date_i18n( get_option( 'time_format' ), strtotime( $time_to ) ) ) . '</span>';

								} ?>

							</div>
						</li>

					<?php endforeach; ?>

				</ul>

				<?php // Note
				if ( ! empty( $opening_hours_note ) ) : ?>
					<p class="post__hours-note">
						<?php echo nl2br( wp_kses( $opening_hours_note, array(
							'strong' => array(),
						)) ); ?>
					</p>
				<?php endif; ?>

			<?php endif;

		}

	}
}

// Listing single map
if ( ! function_exists( 'lsvr_pressville_the_listing_map' ) ) {
	function lsvr_pressville_the_listing_map( $post_id ) {
		if ( function_exists( 'lsvr_directory_get_listing_meta' ) ) {

			trigger_error( sprintf( LSVR_PRESSVILLE_DEPRECATED_ERROR_MSG, __METHOD__ ), E_USER_DEPRECATED );

			$listing_meta = lsvr_directory_get_listing_meta( $post_id );

			if ( true === get_theme_mod( 'lsvr_listing_single_map_enable', true ) &&
				! empty( $listing_meta['locating_method'] ) ) { ?>

				<!-- LISTING MAP : begin -->
				<div class="c-gmap post__map">
					<div class="c-gmap__canvas c-gmap__canvas--loading post__map-canvas"
					id="lsvr_listing-post-single-map__canvas"
					<?php if ( 'latlong' === $listing_meta['locating_method'] &&
						! empty( $listing_meta['latitude'] ) && ! empty( $listing_meta['longitude'] ) ) : ?>
						data-latlong="<?php echo esc_attr( $listing_meta['latitude'] . ',' . $listing_meta['longitude'] ); ?>"
						data-locating-method="latlong"
					<?php elseif ( 'address' === $listing_meta['locating_method'] &&
						! empty( $listing_meta['latitude_geocoded'] ) && ! empty( $listing_meta['longitude_geocoded'] ) ) : ?>
						data-latlong="<?php echo esc_attr( $listing_meta['latitude_geocoded'] . ',' . $listing_meta['longitude_geocoded'] ); ?>"
						data-locating-method="address"
					<?php elseif ( ! empty( $listing_meta['accurate_address'] ) ) : ?>
						data-address="<?php echo esc_attr( $listing_meta['accurate_address'] ); ?>"
					<?php endif; ?>
					data-maptype="<?php echo esc_attr( get_theme_mod( 'lsvr_listing_single_map_type', 'roadmap' ) ); ?>"
					data-zoom="<?php echo esc_attr( get_theme_mod( 'lsvr_listing_single_map_zoom', 17 ) ); ?>"
					data-mousewheel="false"></div>
				</div>
				<!-- LISTING MAP : end -->

			<?php }

		}
	}
}

?>