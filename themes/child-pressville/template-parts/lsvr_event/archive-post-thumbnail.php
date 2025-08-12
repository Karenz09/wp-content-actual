<?php if ( has_post_thumbnail( $event_occurrence['postid'] ) ) : ?>

	<!-- POST HEADER : begin -->
	<header class="post__header">

		<?php if ( ! empty( $event_occurrence['postid'] ) && true === get_theme_mod( 'lsvr_event_archive_cropped_thumb_enable', true ) ) : ?>

			<!-- POST THUMBNAIL : begin -->
			<p class="post__thumbnail post__thumbnail--cropped">
				<a href="<?php echo esc_url( get_permalink( $event_occurrence['postid'] ) ); ?>" class="post__thumbnail-link post__thumbnail-link--cropped"
					<?php echo ' style="background-image: url( \'' . esc_url( get_the_post_thumbnail_url( $event_occurrence['postid'], apply_filters( 'lsvr_pressville_event_archive_thumbnail_size', 'large' ) ) ) . '\' );"'; ?>>

					<?php if ( ! empty( lsvr_pressville_get_image_alt( get_post_thumbnail_id( $event_occurrence['postid'] ) ) ) ) : ?>

						<span class="screen-reader-text">
							<?php echo esc_html( lsvr_pressville_get_image_alt( get_post_thumbnail_id( $event_occurrence['postid'] ) ) ); ?>
						</span>

					<?php endif; ?>

				</a>
			</p>
			<!-- POST THUMBNAIL : end -->

		<?php elseif ( ! empty( $event_occurrence['postid'] ) && has_post_thumbnail( $event_occurrence['postid'] ) ) : ?>

			<!-- POST THUMBNAIL : begin -->
			<p class="post__thumbnail">
				<a href="<?php echo esc_url( get_permalink( $event_occurrence['postid'] ) ); ?>" class="post__thumbnail-link">
					<?php echo get_the_post_thumbnail( $event_occurrence['postid'], apply_filters( 'lsvr_pressville_event_archive_thumbnail_size', 'large' )  ); ?>
				</a>
			</p>
			<!-- POST THUMBNAIL : end -->

		<?php endif; ?>

	</header>
	<!-- POST HEADER : end -->

<?php endif; ?>