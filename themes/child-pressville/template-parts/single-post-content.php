<?php if ( ! empty( get_post()->post_content ) ) : ?>

	<!-- POST TEXT : begin -->
	<div class="post__content">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div>
	<!-- POST TEXT : end -->

<?php endif; ?>