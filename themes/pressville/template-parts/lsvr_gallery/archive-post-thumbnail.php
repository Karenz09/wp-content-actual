<?php if ( lsvr_pressville_has_gallery_post_archive_thumbnail( get_the_ID() ) ) : ?>

	<!-- POST HEADER : begin -->
	<header class="post__header">

		<?php if ( ! empty( lsvr_pressville_get_gallery_archive_thumbnail_url( get_the_ID() ) ) && true === get_theme_mod( 'lsvr_gallery_archive_cropped_thumb_enable', true ) ) : ?>

			<p class="post__thumbnail">
				<a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>" class="post__thumbnail-link post__thumbnail-link--cropped"
					style="background-image: url( '<?php echo esc_url( lsvr_pressville_get_gallery_archive_thumbnail_url( get_the_ID() ) ); ?>' );">

					<?php if ( ! empty( lsvr_pressville_get_gallery_archive_thumbnail_alt( get_the_ID() ) ) ) : ?>

						<span class="screen-reader-text">
							<?php echo esc_html( lsvr_pressville_get_gallery_archive_thumbnail_alt( get_the_ID() ) ) ; ?>
						</span>

					<?php endif; ?>

				</a>
			</p>

		<?php elseif ( ! empty( lsvr_pressville_get_gallery_archive_thumbnail_url( get_the_ID() ) ) ) : ?>

			<p class="post__thumbnail">
				<a href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>" class="post__thumbnail-link">
					<img src="<?php echo esc_url( lsvr_pressville_get_gallery_archive_thumbnail_url( get_the_ID() ) ); ?>" class="post__thumbnail-image"

						<?php if ( ! empty( lsvr_pressville_get_gallery_archive_thumbnail_alt( get_the_ID() ) ) ) : ?>
							alt="<?php echo esc_attr( lsvr_pressville_get_gallery_archive_thumbnail_alt( get_the_ID() ) ); ?>"
						<?php endif; ?>>

				</a>
			</p>

		<?php endif; ?>

	</header>
	<!-- POST HEADER : end -->

<?php endif; ?>