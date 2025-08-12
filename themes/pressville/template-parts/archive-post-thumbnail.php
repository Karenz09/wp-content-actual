<?php if ( has_post_thumbnail( get_the_ID() ) && true === apply_filters( 'lsvr_pressville_post_archive_cropped_thumbnail_enable', false ) ) : ?>

	<!-- POST THUMBNAIL : begin -->
	<p class="post__thumbnail post__thumbnail--cropped">
		<a href="<?php the_permalink(); ?>" class="post__thumbnail-link post__thumbnail-link--cropped"
			<?php echo ' style="background-image: url( \'' . esc_url( get_the_post_thumbnail_url( get_the_ID(), apply_filters( 'lsvr_pressville_post_archive_thumbnail_size', 'large' ) ) ) . '\' );"'; ?>>

            <?php if ( ! empty( lsvr_pressville_get_image_alt( get_post_thumbnail_id( get_the_ID() ) ) ) ) : ?>

                <span class="screen-reader-text"><?php echo esc_html( lsvr_pressville_get_image_alt( get_post_thumbnail_id( get_the_ID() ) ) ); ?></span>

            <?php endif; ?>

		</a>
	</p>
	<!-- POST THUMBNAIL : end -->

<?php elseif ( has_post_thumbnail( get_the_ID() ) ) : ?>

	<!-- POST THUMBNAIL : begin -->
	<p class="post__thumbnail">
		<a href="<?php the_permalink(); ?>" class="post__thumbnail-link">
			<?php the_post_thumbnail( apply_filters( 'lsvr_pressville_post_archive_thumbnail_size', 'large' ) ); ?>
		</a>
	</p>
	<!-- POST THUMBNAIL : end -->

<?php endif; ?>