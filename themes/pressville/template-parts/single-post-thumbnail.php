<?php if ( has_post_thumbnail() && true === apply_filters( 'lsvr_pressville_post_single_thumbnail_enable', true ) ) : ?>

	<!-- POST THUMBNAIL : begin -->
	<p class="post__thumbnail">
		<?php the_post_thumbnail( apply_filters( 'lsvr_pressville_post_single_thumbnail_size', 'full' ) ); ?>
	</p>
	<!-- POST THUMBNAIL : end -->

<?php endif; ?>