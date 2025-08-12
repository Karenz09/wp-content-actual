<?php if ( true === get_theme_mod( 'lsvr_gallery_archive_date_enable', true ) ||
	lsvr_pressville_has_post_terms( get_the_ID(), 'lsvr_gallery_cat' ) ||
	true === get_theme_mod( 'lsvr_gallery_archive_image_count_enable', true ) ) : ?>

	<!-- POST INFO : begin -->
	<p class="post__meta">

		<?php if ( true === get_theme_mod( 'lsvr_gallery_archive_date_enable', true ) ) : ?>

			<!-- POST DATE : begin -->
			<span class="post__meta-item post__meta-item--date" role="group">
				<?php echo esc_html( get_the_date() ); ?>
			</span>
			<!-- POST DATE : end -->

		<?php endif; ?>

		<?php if ( lsvr_pressville_has_post_terms( get_the_ID(), 'lsvr_gallery_cat' ) ) : ?>

			<!-- POST CATEGORY : begin -->
			<span class="post__meta-item post__meta-item--category" title="<?php echo esc_attr( esc_html__( 'Category', 'pressville' ) ); ?>">
				<?php lsvr_pressville_the_post_terms( get_the_ID(), 'lsvr_gallery_cat', esc_html__( 'in %s', 'pressville' ) ); ?>
			</span>
			<!-- POST CATEGORY : end -->

		<?php endif; ?>

		<?php if ( true === get_theme_mod( 'lsvr_gallery_archive_image_count_enable', true ) ) : ?>

			<!-- POST IMAGES COUNT : begin -->
			<span class="post__meta-item post__meta-item--images">
				<?php echo esc_html( sprintf( _n( '%d image', '%d images', lsvr_pressville_get_gallery_images_count( get_the_ID() ), 'pressville' ), lsvr_pressville_get_gallery_images_count( get_the_ID() ) ) ); ?>
			</span>
			<!-- POST IMAGES COUNT : end -->

		<?php endif; ?>

	</p>
	<!-- POST INFO : end -->

<?php endif; ?>