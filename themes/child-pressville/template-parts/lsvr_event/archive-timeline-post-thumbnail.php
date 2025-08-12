<?php if ( has_post_thumbnail( $event_occurrence['postid'] ) ) : ?>

	<p class="post__thumbnail">
		<a href="<?php echo esc_url( get_permalink( $event_occurrence['postid'] ) ); ?>" class="post__thumbnail-link"
			style="background-image: url( '<?php echo esc_url( get_the_post_thumbnail_url( $event_occurrence['postid'], 'thumbnail' ) ); ?>' );">

			<?php if ( ! empty( lsvr_pressville_get_image_alt( get_post_thumbnail_id( $event_occurrence['postid'] ) ) ) ) : ?>

				<span class="screen-reader-text">
					<?php echo esc_html( lsvr_pressville_get_image_alt( get_post_thumbnail_id( $event_occurrence['postid'] ) ) ); ?>
				</span>

			<?php endif; ?>

		</a>
	</p>

<?php endif; ?>