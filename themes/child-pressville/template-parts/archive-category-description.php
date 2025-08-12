<?php if ( ( is_category() || is_tax( apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ) ) )
	&& ! empty( term_description( get_queried_object_id(), apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ) ) ) ) : ?>

	<!-- CATEGORY DESCRIPTION : begin -->
	<div class="post-category-description">
		<?php echo term_description( get_queried_object_id(), apply_filters( 'lsvr_pressville_post_category_taxonomy', '' ) ); ?>
	</div>
	<!-- CATEGORY DESCRIPTION : end -->

<?php endif; ?>