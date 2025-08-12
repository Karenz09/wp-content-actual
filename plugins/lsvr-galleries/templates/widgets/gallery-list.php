<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<?php if ( ! empty( $gallery_posts ) ) : ?>

		<ul class="lsvr_gallery-list-widget__list">

    		<?php foreach ( $gallery_posts as $gallery_id => $gallery_post ) : ?>

				<?php $gallery_thumb = lsvr_galleries_get_single_thumb( $gallery_id );
    			$gallery_post = $gallery_post['post']; ?>

    			<li class="lsvr_gallery-list-widget__item<?php if ( ! empty( $gallery_thumb ) ) { echo ' lsvr_gallery-list-widget__item--has-thumb'; } ?>">

    				<div class="lsvr_gallery-list-widget__item-inner">

						<?php if ( ! empty( $gallery_thumb['thumb_url'] ) ) : ?>

							<p class="lsvr_gallery-list-widget__item-thumb">
								<a href="<?php echo esc_url( get_permalink( $gallery_id ) ); ?>" class="lsvr_gallery-list-widget__item-thumb-link">
									<img src="<?php echo esc_url( $gallery_thumb['thumb_url'] ); ?>"
										class="lsvr_gallery-list-widget__item-thumb-img"
										title="<?php echo esc_attr( $gallery_post->post_title ); ?>"
										alt="<?php echo esc_attr( $gallery_thumb['alt'] ); ?>">
								</a>
							</p>

						<?php endif; ?>

						<div class="lsvr_gallery-list-widget__item-content">

							<h4 class="lsvr_gallery-list-widget__item-title">
								<a href="<?php echo esc_url( get_permalink( $gallery_id ) ); ?>" class="lsvr_gallery-list-widget__item-title-link">
									<?php echo esc_html( $gallery_post->post_title ); ?>
								</a>
							</h4>

							<?php // Date
							if ( true === $show_date ) : ?>

								<p class="lsvr_gallery-list-widget__item-date">
									<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $gallery_post->post_date ) ) ); ?>
								</p>

							<?php endif; ?>

							<?php // Image count
							if ( true === $show_image_count && ! empty( lsvr_galleries_get_gallery_images_count( $gallery_post->ID ) ) ) : ?>

								<p class="lsvr_gallery-list-widget__item-count">
									<?php echo esc_html( sprintf( _n( '%d image', '%d images', lsvr_galleries_get_gallery_images_count( $gallery_post->ID ), 'lsvr-galleries' ), lsvr_galleries_get_gallery_images_count( $gallery_post->ID ) ) ); ?>
								</p>

							<?php endif; ?>

						</div>

					</div>

    			</li>

    		<?php endforeach; ?>

		</ul>

		<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

			<p class="widget__more">

				<?php if ( ! empty( $instance['category'] ) && is_numeric( $instance['category'] ) ) : ?>

					<a href="<?php echo esc_url( get_term_link( (int) $instance['category'], 'lsvr_gallery_cat' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php else : ?>

					<a href="<?php echo esc_url( get_post_type_archive_link( 'lsvr_gallery' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php endif; ?>

			</p>

		<?php endif; ?>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no galleries', 'lsvr-galleries' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>