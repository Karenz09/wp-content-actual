<?php if ( lsvr_pressville_has_gallery_images( get_the_ID() ) ) : ?>

	<!-- IMAGE LIST : begin -->
	<ul <?php lsvr_pressville_the_gallery_post_single_grid_class(); ?>>

		<?php // Add custom code at the top of images
		do_action( 'lsvr_pressville_gallery_single_images_top' ); ?>

		<?php foreach ( lsvr_pressville_get_gallery_images( get_the_ID() ) as $image ) : ?>

			<li <?php lsvr_pressville_the_gallery_post_single_column_class( 'post__image-item' ); ?>>
				<a href="<?php echo esc_url( $image[ 'full_url' ] ); ?>"
					class="post__image-link lsvr-open-in-lightbox"
					title="<?php echo esc_attr( $image[ 'title' ] ); ?>">

					<img class="post__image"

						<?php if ( get_theme_mod( 'lsvr_gallery_single_grid_columns', 4 ) > 2 && ! empty( $image[ 'medium_url' ] ) ) : ?>

							src="<?php echo esc_url( $image[ 'medium_url' ] ); ?>"

						<?php else : ?>

							src="<?php echo esc_url( $image[ 'full_url' ] ); ?>"

						<?php endif; ?>

						alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>">

				</a>
			</li>

		<?php endforeach; ?>

		<?php // Add custom code at the bottom of images
		do_action( 'lsvr_pressville_gallery_single_images_bottom' ); ?>

	</ul>
	<!-- IMAGE LIST : end -->

<?php endif; ?>