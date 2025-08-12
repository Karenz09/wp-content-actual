<?php global $lsvr_template_vars;
if ( ! empty( $lsvr_template_vars ) && is_array( $lsvr_template_vars ) ) : extract( $lsvr_template_vars );

// TEMPLATE : BEGIN ?>

<div class="widget__content lsvr-post-featured-widget__content">

	<?php if ( ! empty( $blog_post ) ) : ?>

		<?php // Thumbnail
		if ( has_post_thumbnail( $blog_post->ID ) ) : ?>

			<p class="lsvr-post-featured-widget__thumb">
				<a href="<?php echo esc_url( get_permalink( $blog_post->ID ) ); ?>" class="lsvr-post-featured-widget__thumb-link">
					<?php echo get_the_post_thumbnail( $blog_post->ID, 'medium' ); ?>
				</a>
			</p>

		<?php endif; ?>

        <div class="lsvr-post-featured-widget__content-inner">

			<h4 class="lsvr-post-featured-widget__title">
				<a href="<?php echo esc_url( get_permalink( $blog_post->ID ) ); ?>" class="lsvr-post-featured-widget__title-link">
					<?php echo get_the_title( $blog_post->ID ); ?>
				</a>
			</h4>

            <?php // Date
            if ( true === $show_date ) : ?>

                <p class="lsvr-post-featured-widget__date">
                    <?php echo esc_html( get_the_date( get_option( 'date_format' ), $blog_post->ID ) ); ?>
                </p>

            <?php endif; ?>

            <?php // Category
            if ( true === $show_category && lsvr_elements_has_post_terms( $blog_post->ID, 'category' ) ) : ?>

                <p class="lsvr-post-featured-widget__category">
                    <?php echo sprintf( esc_html__( 'in %s', 'lsvr-elements' ), lsvr_elements_get_post_category_html( $blog_post->ID, 'category', '<a href="%s" class="lsvr-post-featured-widget__category-link">%s</a>' ) ); ?>
                </p>

            <?php endif; ?>

            <?php // Excerpt
            if ( true === $show_excerpt && has_excerpt( $blog_post->ID ) ) : ?>

                <div class="lsvr-post-featured-widget__excerpt">

                    <?php echo wpautop( get_the_excerpt( $blog_post->ID ) ); ?>

                    <p class="lsvr-post-featured-widget__excerpt-more">
                        <a href="<?php echo esc_url( get_permalink( $blog_post->ID ) ); ?>" class="lsvr-post-featured-widget__excerpt-more-link"><?php esc_html_e( 'Read More', 'lsvr-elements' ); ?></a>
                    </p>

                </div>

            <?php endif; ?>

            <?php if ( ! empty( $instance[ 'more_label' ] ) ) : ?>

                <p class="widget__more">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="widget__more-link"><?php echo esc_html( $instance[ 'more_label' ] ); ?></a>
                </p>

            <?php endif; ?>

		</div>

	<?php else : ?>

		<p class="widget__no-results"><?php esc_html_e( 'There are no posts', 'lsvr-elements' ); ?></p>

	<?php endif; ?>

</div>

<?php // TEMPLATE : END
endif; ?>