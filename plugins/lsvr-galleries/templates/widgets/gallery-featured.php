<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content lsvr_gallery-featured-widget__content">

	<?php if ( ! empty( $gallery_post ) ) : ?>

		<?php // Thumbnail
		$gallery_thumb = lsvr_galleries_get_single_thumb( $gallery_post->ID );
		if ( ! empty( $gallery_thumb ) ) : ?>

			<p class="lsvr_gallery-featured-widget__thumb">
				<a href="<?php echo esc_url( get_permalink( $gallery_post->ID ) ); ?>" class="lsvr_gallery-featured-widget__thumb-link">
					<img src="<?php echo esc_url( $gallery_thumb['medium_url'] ); ?>" title="<?php echo esc_attr( $gallery_thumb['title'] ); ?>" alt="<?php echo esc_attr( $gallery_thumb['alt'] ); ?>">
				</a>
			</p>

		<?php endif; ?>

		<div class="lsvr_gallery-featured-widget__content-inner">

			<h4 class="lsvr_gallery-featured-widget__title">
				<a href="<?php echo esc_url( get_permalink( $gallery_post->ID ) ); ?>" class="lsvr_gallery-featured-widget__title-link">
					<?php echo get_the_title( $gallery_post->ID ); ?>
				</a>
			</h4>

			<?php // Date
			if ( true === $show_date ) : ?>

				<p class="lsvr_gallery-featured-widget__date">
					<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $gallery_post->post_date ) ) ); ?>
				</p>

			<?php endif; ?>

			<?php // Images count
			if ( true === $show_image_count && ! empty( lsvr_galleries_get_gallery_images_count( $gallery_post->ID ) ) ) : ?>

				<p class="lsvr_gallery-featured-widget__count">
					<?php echo esc_html( sprintf( _n( '%d image', '%d images', lsvr_galleries_get_gallery_images_count( $gallery_post->ID ), 'lsvr-galleries' ), lsvr_galleries_get_gallery_images_count( $gallery_post->ID ) ) ); ?>
				</p>

			<?php endif; ?>

			<?php // Excerpt
			if ( true === $show_excerpt && has_excerpt( $gallery_post->ID ) ) : ?>

				<div class="lsvr_gallery-featured-widget__excerpt">
					<?php echo wpautop( get_the_excerpt( $gallery_post->ID ) ); ?>
				</div>

			<?php endif; ?>

			<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

				<p class="widget__more">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_gallery' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
				</p>

			<?php endif; ?>

		</div>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no galleries', 'lsvr-galleries' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>