<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content">

	<?php if ( ! empty( $blog_posts ) ) : ?>

		<ul class="lsvr-post-list-widget__list">

    		<?php foreach ( $blog_posts as $blog_post ) : ?>

    			<li class="lsvr-post-list-widget__item<?php if ( true === $show_thumb && has_post_thumbnail( $blog_post->ID ) ) { echo ' lsvr-post-list-widget__item--has-thumb'; } ?>">
    				<div class="lsvr-post-list-widget__item-inner">

						<?php // Thumbnail
						if ( true === $show_thumb && has_post_thumbnail( $blog_post->ID ) ) : ?>

							<p class="lsvr-post-list-widget__item-thumb">
								<a href="<?php echo esc_url( get_permalink( $blog_post->ID ) ); ?>" class="lsvr-post-list-widget__item-thumb-link">
									<?php echo get_the_post_thumbnail( $blog_post->ID, 'thumbnail' ); ?>
								</a>
							</p>

						<?php endif; ?>

						<div class="lsvr-post-list-widget__item-content">

		        			<h4 class="lsvr-post-list-widget__item-title">
		        				<a href="<?php echo esc_url( get_permalink( $blog_post->ID ) ); ?>" class="lsvr-post-list-widget__item-title-link">
		        					<?php echo get_the_title( $blog_post->ID ); ?>
		        				</a>
		        			</h4>

							<?php // Date
							if ( true === $show_date ) : ?>

								<p class="lsvr-post-list-widget__item-date">
									<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $blog_post->post_date ) ) ); ?>
								</p>

							<?php endif; ?>

							<?php // Category
							if ( true === $show_category && lsvr_elements_has_post_terms( $blog_post->ID, 'category' ) ) : ?>

								<p class="lsvr-post-list-widget__item-category">
									<?php echo sprintf( esc_html__( 'in %s', 'lsvr-elements' ), lsvr_elements_get_post_category_html( $blog_post->ID, 'category', '<a href="%s" class="lsvr-post-list-widget__item-category-link">%s</a>' ) ); ?>
								</p>

							<?php endif; ?>

						</div>

					</div>
				</li>

    		<?php endforeach; ?>

		</ul>

		<?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

			<p class="widget__more">

				<?php if ( ! empty( $instance['category'] ) && ! empty( term_exists( (int) $instance['category'], 'category' ) ) ) : ?>

					<a href="<?php echo esc_url( get_term_link( (int) $instance['category'], 'category' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php else : ?>

					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>

				<?php endif; ?>

			</p>

		<?php endif; ?>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no posts', 'lsvr-elements' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>