<?php if ( lsvr_pressville_has_post_terms( get_the_ID(), apply_filters( 'lsvr_pressville_post_tag_taxonomy', '' ) ) ) : ?>

	<!-- POST FOOTER : begin -->
	<footer class="post__footer">

		<!-- POST TAGS : begin -->
		<div class="post__tags">
			<span class="screen-reader-text"><?php esc_html_e( 'Tags', 'pressville' ); ?></span>
			<?php lsvr_pressville_the_post_terms( get_the_ID(), apply_filters( 'lsvr_pressville_post_tag_taxonomy', '' ), '%s', '' ); ?>
		</div>
		<!-- POST TAGS : end -->

	</footer>
	<!-- POST FOOTER : end -->

<?php endif; ?>