<?php // If listing has gallery, show it
if ( ! empty( lsvr_pressville_get_listing_gallery_images( get_the_ID() ) ) ) : ?>

	<!-- LISTING GALLERY : begin -->
	<div class="lsvr_listing-post-gallery lsvr_listing-post-gallery--loading lsvr_listing-post-gallery--<?php echo esc_attr( count( lsvr_pressville_get_listing_gallery_images( get_the_ID() ) ) ); ?>-images">
		<div class="lsvr_listing-post-gallery__wrapper">

			<div class="lsvr_listing-post-gallery__list">

				<?php foreach ( lsvr_pressville_get_listing_gallery_images( get_the_ID() ) as $image_id ) : ?>

					<div class="lsvr_listing-post-gallery__item">
						<a href="<?php echo esc_url( lsvr_pressville_get_image_url( $image_id, 'full' ) ); ?>" class="lsvr_listing-post-gallery__link"
							style="background-image: url( '<?php echo esc_url( lsvr_pressville_get_image_url( $image_id, 'medium' ) ); ?>' );">
							<img src="<?php echo esc_url( lsvr_pressville_get_image_url( $image_id, 'medium' ) ); ?>" class="lsvr_listing-post-gallery__image" alt="<?php echo esc_attr( lsvr_pressville_get_image_alt( $image_id ) ); ?>">
						</a>
					</div>

				<?php endforeach; ?>

			</div>

			<button type="button" class="c-arrow-button lsvr_listing-post-gallery__button lsvr_listing-post-gallery__button--prev"
				title="<?php esc_html_e( 'Previous', 'pressville' ); ?>">
				<span class="c-arrow-button__icon c-arrow-button__icon--left" aria-hidden="true"></span>
			</button>

			<button type="button" class="c-arrow-button lsvr_listing-post-gallery__button lsvr_listing-post-gallery__button--next"
				title="<?php esc_html_e( 'Previous', 'pressville' ); ?>">
				<span class="c-arrow-button__icon c-arrow-button__icon--right" aria-hidden="true"></span>
			</button>

		</div>
		<span class="c-spinner"></span>
	</div>
	<!-- LISTING GALLERY : end -->

<?php endif; ?>